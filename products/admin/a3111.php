<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a3111.php 会員情報新規登録
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a3111 extends Base{

	public function a3111(){
		parent::Base();
	}
	
	public function Show(){
		global $a3111_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a3111_form);
		$this->m_value['menu_g'] = G03;
		
		if(axts('mode', $this->m_vARGV) == 'regist'){
			$this->_to_regist();
		}
		
		$this->_makeForm();
		
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $G_PREF_LIST;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
	}

	private function _to_regist(){
		global $G_VALIDATE_MESSAGE;
		$msg = $this->_validate();
		if($msg == ''){
			$this->m_value['status'] = MEMBERSHIP2;
			$this->m_value['member_id'] = $this->m_value['email_address'];
			$this->m_value['this_registration'] = date('Y-m-d H:i:s');
			$this->m_value['note'] = htmlspecialchars_decode(axts('note',$this->m_value));
			$this->Add('kdn_member', $this->m_value);
			$this->m_value = array();
			header("location: completion.php?mn=G03&ms=inf005");
			exit;
		}else{
			$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
		}
	}

	private function _validate(){
		$msg = $this->validate_member('1');
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	
}
$a3111 = new a3111();
$a3111->a3111();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>