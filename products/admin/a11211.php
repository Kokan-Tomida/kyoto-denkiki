<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		index.php
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/


require_once('./include/ProcessStart.inc');
class index extends Base{

	public function index(){
		parent::Base();
	}
	
	public function Show(){
		global $index_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($index_form);
		
		if(axts('mode', $this->m_vARGV) == 'change'){
			$this->m_value = $this->pushValueFromARGV();
		}
		
		$this->_makeForm();
		
		if(axts('mode', $this->m_vARGV) == 'to_confirm'){
			$msg = $this->_validate();
			$this->m_value['to_confirm'] = 'to_confirm';
			if($msg == ''){
				$this->m_objCommon->setSessionFromExternal($this->m_value);
				header("location: conf.php");
				exit;

			}else{
				$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
			}
		}

		if(axts('mode', $this->m_vARGV) == 'to_return'){
			$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
			$template = $this->getViewHTML(get_class());
			$_SESSION = array();
		}

		// Reset
		if(axts('mode', $this->m_vARGV) == 'to_reset'){
			$this->m_vARGV = array();
			$this->initValue($index_form);
			$this->_makeForm();
		}			
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


/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>