<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a4100.php 履歴一覧 all
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('../config/test/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class thanks extends Base{

	public function thanks(){
		parent::Base();
	}
	
	public function Show(){
		global $thanks_complete_form;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($thanks_complete_form);

		if(axts('mode', $this->m_vARGV) == 'change'){
			$this->m_value = $this->pushValueFromARGV();
		}
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
new thanks();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>