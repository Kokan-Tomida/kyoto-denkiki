<?php

/**--------------------------------------------------------------------
  ProjectName :
  description :		お問い合わせフォームの「確認」「送信」を行う
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once(dirname(__FILE__) . '/../../../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');
require_once(PATH_MODULES."/lib/Validator.class.php");


class confirm extends Base{

	var $m_password = false;

	public function confirm(){
		parent::Base();
	}

	public function Show(){
		global $inquiry_form;
		$this->_sessionName = "member_contact_form1";
        $this->_sessionStartParamName = 'member_contact_form1_start_param';
		if($this->checkLoged() != true){
            // 未ログインのとき、ログインページに遷移
            $url = "/member/";
            header('location: ' . $url);
			exit;
		}

		$this->initValue($inquiry_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState2('inquiry',1,'CONFIRM_NEXT');
        // 商品データを取得
        $productData = $this->_getProductData($_SESSION[$this->_sessionStartParamName]['pcode']);

		if(is_set('to_complete', $this->m_vARGV, NULL)){
            // 送信
			$this->m_value = $_SESSION[$this->_sessionName]['input'];
            $this->_makeForm();
			$this->_to_regist();
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
        	header("location: index.php?back=1");
        	exit;
        }

        $this->m_value['product'] = $productData;
        
        $this->_makeForm();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

    // 商品データを取得
    private function _getProductData($pcode) {
        $csvUrl = AP_ROOT . "/common/csv/product.csv";
        $lines = file($csvUrl);
        array_shift($lines);
        if ($lines) {
            foreach ($lines as $line) {
                $tmp = $this->_getProductDataLine($pcode, $line);
                if ($tmp !== false) {
                    $data = $tmp;
                    break;
                }
            }
        }
        return $data;
    }

    // 商品データを配列で取得（pcodeに一致する行の時）
    private function _getProductDataLine($pcode, $line) {

        // 引用符を除去
        $line = ltrim($line, '"');
        $line = rtrim($line, '"');
        $line = str_replace('","', ',', $line);

        $columns = explode(",", $line);
        if ($columns[0] != $pcode) {
            return false;
        }
        $data = array();
        $data['code'] = $columns[0];
        $data['name'] = $columns[1];
        $data['series'] = $columns[2];
        $data['image'] = $columns[3];
        $data['description'] = $columns[4];
        return $data;
    }

	// 入力値整形
	private function _formatInput($input){
        global $G_PREF_LIST;

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
        return $error;
	}
	// バリデーション設定
	private function _getFormConfig(){
        $fconfig = array(
            'inquiry_check' => array(
                'itemName' => '-',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'inquiry_note' => array(
                'itemName' => '-',  
                'checkList' => array(
                    //'NotEmpty'  => '1',
                ),
            ),
        );
        return $fconfig;
	}

    // 種別名称
    private function _getTypeName($key, $val) {
        $types = array(
            'inquiry_check' => array(
                1 => '見積希望',
                2 => '製品に関するお問い合わせ',
            ),
        );
        return $types[$key][$val];
    }

	private function _makeForm(){

		if(axts('inquiry_check',$this->m_value)){
			$this->m_value['inquiry_check_view'] = $this->_getTypeName('inquiry_check', $this->m_value['inquiry_check']);
		}
		$mem_info = $this->logedin_member_info();
        $this->m_value['company_name'] = $mem_info['company_name'];
		$this->m_value['section'] = $mem_info['section'];
		$this->m_value['charge_name'] = $mem_info['charge_name'];
	}

	private function _to_regist(){
		global $INQUIRY_CHECKBOX;

		$datas = array(
			'inquiry_check' => $this->m_value['inquiry_check'],
			'inquiry_note' => 
                htmlspecialchars_decode(axts('inquiry_note',$this->m_value)),
			'kdn_member_id' => axts('id',$this->m_value),
		);
		$this->Add('kdn_inquiry_history',$datas);

		$datas = array(
			'kdn_member_id' => axts('id',$this->m_value),
			'generate_date' => date('Y-m-d'),
			'generate_time' => date('H:i:s'),
			'note1' => 	$this->m_value['inquiry_check_view'],
			'note2' => 
                htmlspecialchars_decode($this->m_value['inquiry_note']),
			'history_id' => $this->m_objDB->mDB->lastInsertId(),
			'type' => HISTORY_TYPE2,
		);
		$this->Add('kdn_history',$datas);

		$inquiry_check_string = '';
		if(axts('inquiry_check',$this->m_value)){
			if(is_array($this->m_value['inquiry_check'])){
				$inquiry_check= array();
				foreach($this->m_value['inquiry_check'] as $k){
					if(axts($k,$INQUIRY_CHECKBOX))	$inquiry_check[] = $INQUIRY_CHECKBOX[$k];
				}
				$inquiry_check_string = implode(",",$inquiry_check);
			}
		}

		$inquiry_check_strings = '【' . $this->m_value['inquiry_check_view'] . '】';
		$from = $this->get_admin_mail();
		$pref = $this->logedin_member_info('pref');
		$to = $this->logedin_member_info('email_address');
		$data = $this->_makeMailData();
		$to_admin = $this->setFromAddress(MAIL_TYPE1,$pref);
		list($subject,$body) = $this->createMailBodys(MAIL_TYPE1,$data);
		$body_admin = $this->makeMailDataMemberInfo() . $productStr;
		$subject_admin = $this->createMailSubject(MAIL_TYPE1,$pref,'',$inquiry_check_strings);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject_admin,$body.MAIL_BODY_SEPARETION.$body_admin);
		$this->m_objMail->send_user_mail();// 分岐2

		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		$this->clearSession(S_KEY10, S_KEY30);
		header('location: thanks.php');
		exit;
	}

	private function _makeMailData(){

        $mem_info = $this->logedin_member_info();
		$data['company_name'] = $mem_info['company_name'];
		$data['section'] = $mem_info['section'];
		$data['charge_name'] = $mem_info['charge_name'];
		$data['inquiry_note'] = htmlspecialchars_decode($this->m_value['inquiry_note']);
		$data['inquiry_select_view'] = $this->m_value['inquiry_select_view'];
		$data['inquiry_check_view_mail'] = $this->m_value['inquiry_check_view'];
		return $data;
	}

}
$cl = new confirm();
$data = $cl->m_value;

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>