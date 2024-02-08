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

require_once(dirname(__FILE__) . '/../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class edit_per extends Base{

	var $m_alert;

	public function edit_per(){
		parent::Base();
	}

	public function Show(){
		global $edit_form,$FORM_STATE;
		$this->_sessionName = "member_edit";

		if($this->checkLoged() == false){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}
		$this->initValue($edit_form);
		$this->getData();
		
		$this->m_value['validate_msg'] = array();
        if ($_GET['back']) {
        	$this->m_value = $_SESSION[$this->_sessionName]['input'];
        	$this->m_value['validate_msg'] = $_SESSION[$this->_sessionName]['error'];
        } else {
            // 初期表示
			$this->m_value = $this->logedin_member_info();
			$this->m_objCommon->unsetSessionFormState(get_class(),1);
			$this->m_value['note'] = str_replace(chr(10).chr(10),chr(10),axts('note',$this->m_value));
        }
		$this->_makeForm();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $G_PREF_LIST;
		list($tel1, $tel2, $tel3) = explode("-", $this->m_value['telno']);
		$this->m_value['tel1'] = $tel1;
		$this->m_value['tel2'] = $tel2;
		$this->m_value['tel3'] = $tel3;
		list($fax1, $fax2, $fax3) = explode("-", $this->m_value['faxno']);
		$this->m_value['fax1'] = $fax1;
		$this->m_value['fax2'] = $fax2;
		$this->m_value['fax3'] = $fax3;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
		$this->m_value['check_privacy'] = (axts('privacy',$this->m_value) == '') ? '' : 'checked';
	}

	private function getData(){
		$res = $this->logedin_member_info();
		if(!is_array($res))		return null;
		foreach($res as $k=>$v){
			if(($k == 'telno') and ($v != '') and (strpos($v,'-') !== false)){
				$t = explode('-',$v);
				for($i = 0; $i < count($t); $i++){
					$j = $i+1;
					$this->m_value['tel'.$j] = $t[$i];
				}
			}elseif(($k == 'faxno') and ($v != '') and (strpos($v,'-') !== false)){
				$t = explode('-',$v);
				for($i = 0; $i < count($t); $i++){
					$j = $i+1;
					$this->m_value['fax'.$j] = $t[$i];
				}
			}else{	
				$this->m_value[$k] = htmlspecialchars($v);
			}
		}
		return true;
	}

}
$cl = new edit_per();
$memedp = $cl->edit_per();
$data = $cl->m_value;

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>