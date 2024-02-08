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
			header('location: '.THIS_DOMAIN.SUBDIR_OPT_DOWNLOAD.DS.'download_list.php');
			exit;		
		}
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_OPT_DOWNLOAD);
		$this->initValue($contact_index_form);
		$this->clearSession(S_KEY10,S_KEY30);

		if(is_set('to_login', $this->m_vARGV,NULL)){
			$mem_info = $this->logedin($this->m_value['member_id'],$this->m_value['member_pwd']);
			if($mem_info != false){
				$this->setLoginHistory($mem_info['id']);
				$this->setLoginSess();
				header('location: '.THIS_DOMAIN.SUBDIR_OPT_DOWNLOAD.DS.'download_list.php');
				exit;		
			}
		}
		$this->m_value['member_login_url'] = MEMBER_LOGIN_URL;
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	

	
}
new index();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>