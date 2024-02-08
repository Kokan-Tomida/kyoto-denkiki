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

require_once('../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class addnew_complete extends Base{

	public function addnew_complete(){
		parent::Base();
	}
	
	public function Show(){
		global $addnew_complete_form;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($addnew_complete_form);
		
		$this->clearSession(S_KEY10,S_KEY30);

		$this->_makeForm();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	

	
}
new addnew_complete();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>