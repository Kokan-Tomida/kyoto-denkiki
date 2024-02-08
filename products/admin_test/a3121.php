<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a3121.php 会員情報登録
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a3121 extends Base{

	public function a3121(){
		parent::Base();
	}
	
	public function Show(){
		global $a3111_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a3111_form);
		$this->m_value['menu_g'] = G03;
		
		if($this->_chkParam() == false){
			header('location: a3100.php');
			exit;
		}
		
		if(!isSubmit($this->m_vARGV)){
			$this->getData($this->m_value['target']);
		}
		
		if(is_set('to_regist', $this->m_vARGV, NULL)){
			$this->_to_regist($this->m_value['target']);
		}
		
		$this->_makeForm();
		
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $G_PREF_LIST;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
	}

	private function _to_regist($id){
		global $G_VALIDATE_MESSAGE;
		$msg = $this->_validate($id);
		if($msg == ''){
			$this->m_value['id'] = $id;
			$this->m_value['member_id'] = $this->m_value['email_address'];
			$this->m_value['note'] = htmlspecialchars_decode(axts('note',$this->m_value));
			$this->Edit('kdn_member', 'id='.$id,$this->m_value);
			$this->m_value = array();
			header("location: completion.php?mn=G03&ms=inf005");
			exit;
		}else{
			$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
		}
	}

	private function _validate($id){
		global $G_VALIDATE_MESSAGE;
		$msg = $this->validate_member('2',$id);
		if(strlen($this->m_value['member_pwd'])==0){
			$msg[] = $G_VALIDATE_MESSAGE['val043'];
		}
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	
	private function getData($id){
		$this->Search('kdn_member','*','id='.$id);
		$res = $this->getOneRow();
		if(!is_array($res))		return null;
		foreach($res as $k=>$v){
			$this->m_value[$k] = htmlspecialchars($v);
		}
		return true;
	}
	
	private function _chkParam(){
		if((!aexists('target',$this->m_vARGV)) or (!aexists('target',$this->m_value))){
			return false;	
		}
		if(aexists('target',$this->m_vARGV)){
			$this->m_value['target'] = $this->m_vARGV['target'];
		}
		if(!is_numeric($this->m_value['target'])){
			return false;
		}
		return true;
	}
	
}
new a3121();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>