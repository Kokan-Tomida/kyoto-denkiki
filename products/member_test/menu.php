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

require_once('../config/test/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class menu extends Base{

	public function menu(){
		parent::Base();
	}
	
	public function Show(){
		global $member_menu_form;
		if($this->checkLoged() == false){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($member_menu_form);
		$this->clearSession(S_KEY10,S_KEY30);
		$this->m_value['hellow_name'] = $this->logedin_member_info('charge_name');
		$this->m_value['hellow_name'] .= SAMA;
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
}
new menu();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>