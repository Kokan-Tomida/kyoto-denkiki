<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a5100.php 基本情報
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a5100 extends Base{
	
	var $m_abled = false;
	var $m_id;

	public function a5100(){
		parent::Base();
	}
	
	public function Show(){
		global $a5111_form,$G_INFO_MESSAGE;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a5111_form);
		$this->m_value['menu_g'] = G05;

		$this->_abled();
			
		if(axts('mode', $this->m_vARGV) == 'edit1'){
			$msg = $this->_validate();
			if($msg == ''){
				$this->_edit_pass();
				$this->m_value['validate_msg2'] = $this->m_objCommon->set_iMsg($G_INFO_MESSAGE['inf003']);
			}else{
				$this->m_value['validate_msg1'] = $this->m_objCommon->set_eMsg($msg);
			}
		}
		if(axts('mode', $this->m_vARGV) == 'edit2'){
			$msg = $this->_validate();
			if($msg == ''){
				$this->_edit_mail();
				$this->m_value['validate_msg2'] = $this->m_objCommon->set_iMsg($G_INFO_MESSAGE['inf003']);
			}else{
				$this->m_value['validate_msg2'] = $this->m_objCommon->set_eMsg($msg);
			}
		}
		
		$this->_makeForm();
		
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _abled(){
		$this->Search('kdn_baseinfo','*','');
		$n = $this->getNumCount();
		if($n == 1){
			$this->m_abled = true;
			$res = $this->getOneRow();
			$this->m_id = $res['id'];
		}
	}

	private function _makeForm(){
		if($this->m_abled == false)		return;		
		$this->Search('kdn_baseinfo','*','');
		$res = $this->getOneRow();
		$this->m_value['pwd_modified'] = $res['pwd_modified'];
		$this->m_value['admin_mail'] = $res['admin_mail'];
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if($this->m_value['mode'] == 'edit1'){
			if(!aexists('admin_password',$this->m_value)){
				$msg[] = $G_VALIDATE_MESSAGE['val040'];
			}elseif($this->m_objValidate->isNull($this->m_value['admin_password'])){
				$msg[] = $G_VALIDATE_MESSAGE['val040'];
			}else{
				if(!$this->m_objValidate->isAscii($this->m_value['admin_password'])){
					$msg[] = $G_VALIDATE_MESSAGE['val041'];
				}				
				if(strlen($this->m_value['admin_password']) > 10){
					$msg[] = $G_VALIDATE_MESSAGE['val042'];
				}				
			}
		}elseif($this->m_value['mode'] == 'edit2'){
			if(!aexists('admin_mail',$this->m_value)){
				$msg[] = $G_VALIDATE_MESSAGE['val004'];
			}elseif(!$this->m_objValidate->chk_email($this->m_value['admin_mail'])){
				$msg[] = $G_VALIDATE_MESSAGE['val004'];
			}
		}
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
	
		return $res;
	}
	
	private function _edit_pass(){
		if($this->m_abled == false)		return;
		$data = array(
			'id' => $this->m_id,
			'admin_password' => $this->m_value['admin_password'],
			'pwd_modified' => date('Y-m-d H:i:s'),
			'modified' => date('Y-m-d H:i:s'),
		);
		$this->Edit('kdn_baseinfo','',$data);
	}
	
	private function _edit_mail(){
		if($this->m_abled == false)		return;		
		$data = array(
			'id' => $this->m_id,
			'admin_mail' => $this->m_value['admin_mail'],
			'modified' => date('Y-m-d H:i:s'),
		);
		$this->Edit('kdn_baseinfo','',$data);
	}

	
}
$a5100 = new a5100();
$a5100->a5100();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>