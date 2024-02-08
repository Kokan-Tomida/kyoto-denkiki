<?php

/**--------------------------------------------------------------------
  ProjectName :
  description : 新規会員登録の「確認」「仮登録」を行う
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once(dirname(__FILE__) . '/../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');
require_once(PATH_MODULES."/lib/Validator.class.php");

class addnew_confirm extends Base{

	public function addnew_confirm(){
		parent::Base();
	}

	public function Show(){
		global $addnew_form,$G_PREF_LIST;

		$this->_sessionName = "member_add";

		if($this->checkLoged() == true){
			header('location: menu.php');
			exit;
		}

		$this->initValue($addnew_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState('addnew',1,'CONFIRM_NEXT');

		if(is_set('to_complete', $this->m_vARGV, NULL)){
            // 仮登録処理
            $this->m_value = $_SESSION[$this->_sessionName]['input'];
			$this->_to_regist();
            exit;
		}

        // 確認
        $input = $_POST;
        $input = $this->_formatInput($input);
        $this->m_value = $input;
        $_SESSION[$this->_sessionName]['input'] = $input;
        $_SESSION[$this->_sessionName]['error'] = array();
        $error = $this->_validate($input);
        if (!empty($error)) {
	        $_SESSION[$this->_sessionName]['error'] = $error;
        	header("location: addnew.php?back=1");
        	exit;
        }

		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	// 入力値整形
	private function _formatInput($input){
        global $G_PREF_LIST;

        if ($input['zip1'] || $input['zip2']) {
			$input['zip'] = $input['zip1'] . '-' . $input['zip2'];
        }
        if ($input['tel1'] || $input['tel2'] || $input['tel3']) {
			$input['telno'] = $input['tel1'] . '-' . $input['tel2'] . '-' . $input['tel3'];
		}
        if ($input['fax1'] || $input['fax2'] || $input['fax3']) {
			$input['faxno'] = $input['fax1'] . '-' . $input['fax2'] . '-' . $input['fax3'];
		} else {
            $input['faxno'] = "";
        }
        $input['pref_name'] = $G_PREF_LIST[$input['pref']];
		return $input;
	}

	// バリデーション
	private function _validate($input){
        global $G_VALIDATE_MESSAGE;

        $formConfig = $this->_getFormConfig();
        // 引数チェック
        if ( count($input) < 1 || count($formConfig) < 1 ) {
            // error=trueを返す
            return true;
        }
        // エラーチェック バリデーションクラス１Validator
        $error = array();
        $validator = new Validator();
        foreach ($formConfig as $formName => $config) {
           // 入力値をバリデーション用にセット
            $config["data"] = $input[ $formName ];

            $validResult = $validator->check($config);
            if ($validResult) {
                $error[ $formName ] = $validResult;
            }
        }

        // メールアドレス重複チェック バリデーションクラス2 Validate
        if (!$error['email_address']){
            $this->Search('kdn_member','*',"email_address ='".$input['email_address']."' and status <> ".MEMBERSHIP3);
            if($this->getNumCount() == 1){
                $error['email_address'] = $G_VALIDATE_MESSAGE['val008'];
            }
        }
        return $error;
	}
	// バリデーション設定
	private function _getFormConfig(){
        $fconfig = array(
            'company_name' => array(
                'itemName' => '-',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'section' => array(
                'itemName' => '-',  
                'checkList' => array(
                    //'NotEmpty'  => '1',
                ),
            ),
            'charge_name' => array(
                'itemName' => '-',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'zip' => array(
                'itemName' => '郵便番号',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                    'Zipcode'  => '1',
                ),
            ),
            'pref' => array(
                'itemName' => '-',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'address1' => array(
                'itemName' => '-',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'telno' => array(
                'itemName' => '電話番号',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                    'Tel'  => '1',
                ),
            ),
            'faxno' => array(
                'itemName' => 'FAX',  
                'checkList' => array(
                    'Fax'  => '1',
                ),
            ),
            'email_address' => array(
                'itemName' => 'メールアドレス',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                    'Mail'  => '1',
                ),
            ),
            'agree' => array(
                'itemName' => '同意',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
        );
        return $fconfig;
	}

	private function _to_regist(){
		$this->m_value['note'] = htmlspecialchars_decode(axts('note',$this->m_value));
		$this->m_value['status'] = '1';
		$query_strings = makeRandamVariable40();
		$this->m_value['query_strings'] = $query_strings;
		$this->m_value['temporary_registration'] = date('Y-m-d H:i:s');
		list($validity2,$validity) = $this->m_objCommon->getProgressDateTime(VALIDITY_TIME);
		$this->m_value['validity'] = $validity;
		// 漢字
		$this->m_value['validity2'] = $validity2;
		$this->Add('kdn_member', $this->m_value);

		$from = $this->get_admin_mail();
		$to = $this->m_value['email_address'];
		$data = $this->_makeMailData();
		list($subject,$body) = $this->createMailBodys('3',$data);
		$pref = axts('pref',$this->m_value);
		$to_admin = $this->setFromAddress(MAIL_TYPE3,$pref);
		//$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject_admin,$body);

		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject,$body);
		$this->m_objMail->send_user_mail(); // 分岐2
		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
        $_SESSION[$this->_sessionName] = null;
		header('location: addnew_pre_register.php');
		exit;
	}

	private function _makeMailData(){
		foreach($this->m_value as $fld=>$v){
			if($fld == 'note'){
				$data[$fld] = $v;
			}else{
				$data[$fld] = $v;
			}
		}
		$data['validity'] = $this->m_value['validity2'];
		$data['access_url'] = THIS_REGISTRATION_URL.'?'.$this->m_value['query_strings'];
		return $data;
	}

}
$cl = new addnew_confirm();
$memac = $cl->addnew_confirm();
$data = $cl->m_value;

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>