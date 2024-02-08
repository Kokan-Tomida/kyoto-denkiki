<?php

/**--------------------------------------------------------------------
  ProjectName :  	opt/technical/xenon/index2.php
  description :		
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('../../../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class index2 extends Base{

	public function index2(){
		parent::Base();
	}
	
	public function Show(){
		$template = $this->getViewHTML_no(get_class(),PATH_TEMPLATE_OPT.DS.'technical'.DS.'xenon');
		
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
}
new index2();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>