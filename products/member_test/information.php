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


class information extends Base{

	public function information(){
		parent::Base();
	}
	
	public function Show(){
		global $information_form;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($information_form);
		$this->clearSession(S_KEY10,S_KEY30);

		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
}
new information();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>