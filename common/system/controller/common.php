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

require_once(dirname(__FILE__) . '/../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

// 静的ページでの共通処理
class commonDisplay extends Base{

	var $m_alert;

	public function commonDisplay(){
		parent::Base();
	}
	
	public function Show(){
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

}
$cl = new commonDisplay();
$cl->commonDisplay();
$data = $cl->m_value;

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>
