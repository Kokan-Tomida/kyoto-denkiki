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


class edit_complete extends Base{

	public function edit_complete(){
		parent::Base();
	}
	
	public function Show(){
		global $member_menu_form;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($member_menu_form);
		$this->m_objCommon->unsetSessionFormState('edit',0);
		$this->m_objCommon->unsetSessionFormState('edit',1);

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
new edit_complete();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>