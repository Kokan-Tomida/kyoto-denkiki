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

class sample_completion extends Base{

	public function sample_completion(){
		parent::Base();
	}
	
	public function Show(){
		global $inquiry_complete_form;
		$template = $this->getViewHTML_no(get_class(),PATH_TEMPLATE_OPT_SAMPLE);
		$this->initValue($inquiry_complete_form);

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
new sample_completion();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>