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


class addnew_once_complete extends Base{

	public function addnew_once_complete(){
		parent::Base();
	}
	
	public function Show(){
		global $addnew_complete_form;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($addnew_complete_form);

		$this->clearSession(S_KEY10,S_KEY30);
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	
}
new addnew_once_complete();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>