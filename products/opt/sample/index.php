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

require_once('../../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class index extends Base{

	public function index(){
		parent::Base();
	}

	public function Show(){
		global $contact_index_form;
		if($this->checkLoged() == true){
			header('location: sample.php');
			exit;
		}
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_OPT_SAMPLE);
		$this->initValue($contact_index_form);
		$this->clearSession(S_KEY10,S_KEY30);

		if(is_set('to_login', $this->m_vARGV,NULL)){
			$this->validate_questionnaire();
			if($this->m_value['validate_msg'] == ''){
				$mem_info = $this->logedin($this->m_value['member_id'],$this->m_value['member_pwd']);
				if($mem_info != false){
					$this->setLoginHistory($mem_info['id'],$this->m_value['questionnaire']);
					$this->setLoginSess();
					$this->send_loginmail(MAIL_TYPE2,$this->m_value['questionnaire']);
					header('location: sample.php');
					exit;
				}
			}
		}
		$this->make_questionnaire();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}




}
new index();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>