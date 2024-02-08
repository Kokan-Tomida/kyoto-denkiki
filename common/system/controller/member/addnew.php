<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		member addnew
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once(dirname(__FILE__) . '/../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class addnew extends Base{

	var $m_alert;

	public function addnew(){
		parent::Base();
	}
	
	public function Show(){
		global $addnew_form,$FORM_STATE;
		$this->_sessionName = "member_add";

		if($this->checkLoged() == true){
			header('location: menu.php');
			exit;		
		}
		
		$this->initValue($addnew_form);
		
		
		$this->m_value['validate_msg'] = array();
        if ($_GET['back']) {
        	$this->m_value = $_SESSION[$this->_sessionName]['input'];
        	$this->m_value['validate_msg'] = $_SESSION[$this->_sessionName]['error'];
        } else {
            // 初期表示
			$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
			$this->m_objCommon->unsetSessionFormState(get_class(),1);
			$this->m_value['note'] = str_replace(chr(10).chr(10),chr(10),axts('note',$this->m_value));
        }
        
		$this->_makeForm();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $G_PREF_LIST;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
		$this->m_value['check_privacy'] = (axts('privacy',$this->m_value) == '') ? '' : 'checked';
	}
}
$cl = new addnew();
$memadn = $cl->addnew();
$data = $cl->m_value;
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>