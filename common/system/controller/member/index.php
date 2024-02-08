<?php

/**--------------------------------------------------------------------
  ProjectName :
  description : ログイン処理
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once(dirname(__FILE__) . '/../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class index extends Base{

	public function index(){
		parent::Base();
	}

	public function Show(){
		global $contact_index_form;
		if($this->checkLoged() == true){
			header('location: menu.php');
			exit;
		}

		//$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_CONTACT);
		$this->initValue($contact_index_form);
		$this->clearSession(S_KEY10,S_KEY30);

		if(is_set('to_login', $this->m_vARGV,NULL)){
			$this->validate_questionnaire();
			if($this->m_value['validate_msg'] == ''){
				$mem_info = $this->logedin($this->m_value['member_id'],$this->m_value['member_pwd']);
				if($mem_info != false){
					$this->setLoginHistory($mem_info['id'],$this->m_value['questionnaire']);
					$this->setLoginSess();

					// 管理者宛メール送信（西日本、東日本）setting_area.incに設定のアドレス
					$this->send_loginmail(MAIL_TYPE9,$this->m_value['questionnaire']);
					header('location: menu.php');
					exit;
				} else {
					$this->m_value['validate_msg'] = 'メールアドレスまたはパスワードを確認して下さい。';
				}
			}
		}
		if ($this->m_vARGV['first'] == 1) {
			$this->m_value['first_login_message'] = '本登録が完了いたしましたので、本登録完了メールを配信しました。'
			. '<br />そちらに記載されているパスワードと登録されたメールアドレスでログインを行ってください。';
		} else if ($this->m_vARGV['first'] == 2) {
			$this->m_value['first_login_message'] = 'すでに本登録が完了済みのURLです。';
		} else if ($this->m_vARGV['first'] == 9) {
			$this->m_value['first_login_message'] = '本登録の有効期限が切れておりますので、再度ご登録をお願い致します。';
		}
		$this->make_questionnaire();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}




}
$cl = new index();
$memidx=$cl->index();
$data = $cl->m_value;

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>