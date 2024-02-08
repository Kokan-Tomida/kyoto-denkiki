<?php

/**--------------------------------------------------------------------
  ProjectName :
  description : 登録情報編集「確認」「完了」を行う
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

// 編集確認と完了
class edit_confirm extends Base{

	public function edit_confirm(){
		parent::Base();
	}

	public function Show(){
		global $edit_form;
		
		$this->_sessionName = "member_edit";

		//$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		if($this->checkLoged() == false){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}

		$this->initValue($edit_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState('edit',1,'CONFIRM_NEXT');

        if(is_set('to_complete', $this->m_vARGV, NULL)){
            $this->m_value = $_SESSION[$this->_sessionName]['input'];
            // 編集完了
            $this->_to_regist();
            exit;
        }

        $input = $_POST;
        $input = $this->_formatInput($input);
        $this->m_value = $input;
        $_SESSION[$this->_sessionName]['input'] = $input;
        $_SESSION[$this->_sessionName]['error'] = array();
        $error = $this->_validate($input);
        if (!empty($error)) {
	        $_SESSION[$this->_sessionName]['error'] = $error;
        	header("location: edit.php?back=1");
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
            $this->Search('kdn_member','*',"email_address ='".$input['email_address']."' and status <> ".MEMBERSHIP3." and id <> ".$input['id']);
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
            'member_pwd' => array(
                'itemName' => 'パスワード',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
        );
        return $fconfig;
	}

	private function _to_regist(){
		$this->m_value['note'] = htmlspecialchars_decode(axts('note',$this->m_value));
		$this->Edit('kdn_member', 'id='.$this->m_value['id'],$this->m_value);
		$from = $this->get_admin_mail();
		$to = $this->m_value['email_address'];
		$pref = $this->m_value['pref'];
		$data = $this->_makeMailData();
		list($subject,$body) = $this->createMailBodys('5',$data);
		$to_admin = $this->setFromAddress(MAIL_TYPE5,$pref);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject,$body);

		$this->m_objMail->send_user_mail();// 分岐2
		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		$this->clearSession(S_KEY10, S_KEY30);
        $_SESSION[$this->_sessionName] = null;
		header('location: edit_thanks.php');
		exit;
	}

	private function _makeMailData(){
		$data['company_name'] = $this->m_value['company_name'];
		$data['section'] = $this->m_value['section'];
		$data['charge_name'] = $this->m_value['charge_name'];
		$data['member_login_url'] = MEMBER_LOGIN_URL;
		return $data;
	}

}
$cl = new edit_confirm();
$menec = $cl->edit_confirm();
$data = $cl->m_value;
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>