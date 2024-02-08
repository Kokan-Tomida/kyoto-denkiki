<?php

/**--------------------------------------------------------------------
  ProjectName :
  description :
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/
include 'ChromePhp.php';
ChromePhp::log('hello world');
ChromePhp::log($_SERVER);

// using labels
foreach ($_SERVER as $key => $value) {
    ChromePhp::log($key, $value);
}

// warnings and errors
ChromePhp::warn('this is a warning');
ChromePhp::error('this is an error');



require_once('../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class index extends Base{

	public function index(){
		parent::Base();
	}

	public function Show(){
		global $member_index_form;
		if($this->checkLoged() == true){
			header('location: menu.php');
			exit;
		}
		$this->m_value['first_login_message'] = '';

		$this->m_value['validate_msg'] = '';
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($member_index_form);
		$this->clearSession(S_KEY10,S_KEY30);

		if(is_set('to_login', $this->m_vARGV,NULL)){
			$this->_validate_questionnaire();
			if($this->m_value['validate_msg'] == ''){
				$mem_info = $this->logedin($this->m_value['member_id'],$this->m_value['member_pwd']);
				if($mem_info != false){
					$this->setLoginHistory($mem_info['id'],$this->m_value['questionnaire']);
					$this->setLoginSess();
					$this->send_loginmail(MAIL_TYPE9,$this->m_value['questionnaire']);
					header('location: menu.php');
					exit;
				}
			}
		}
		if(axts('first',$this->m_vARGV))	$this->m_value['first_login_message'] = '本登録が完了いたしましたので、本登録完了メールを配信しました。<br />そちらに記載されているパスワードと登録されたメールアドレスでログインを行ってください。';
		$this->make_questionnaire();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _make_questionnaire(){
		global $G_QUESTIONNAIRE;
		$this->m_value['questionnaire_qa'] = '';
		if(!is_array($G_QUESTIONNAIRE)){
			return;
		}
		$str = '';
		foreach($G_QUESTIONNAIRE as $k=>$v){
			$str .= '<b>['.$k.'] '.$v[0].'</b>';
			$str .= '<br>';
			if(is_array($v)){
				if(is_array($v[1])){
				foreach($v[1] as $k2=>$v2){
					$ix = $k.'-'.$k2;
					$str .= "<input type=\"radio\" name=\"questionnaire[".$k."]\" value=\"".$k2."\">".$v2."　";
				}
				}
			}
			$str .= '<br>';
		}
		$this->m_value['questionnaire_qa'] = $str;
	}
	private function _validate_questionnaire(){
		global $G_QUESTIONNAIRE,$G_VALIDATE_MESSAGE;
		$msg = '';
		if(!is_array($this->m_value['questionnaire'])){
			$msg = $G_VALIDATE_MESSAGE['val070'];
		}
		if(count($G_QUESTIONNAIRE) != count($this->m_value['questionnaire'])){
			$msg = $G_VALIDATE_MESSAGE['val070'];
		}
		$this->m_value['validate_msg'] = $msg;
	}

}
new index();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>