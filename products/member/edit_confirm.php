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

require_once('../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class edit_confirm extends Base{

	public function edit_confirm(){
		parent::Base();
	}

	public function Show(){
		global $edit_form,$G_PREF_LIST;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		if($this->checkLoged() == false){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}

		if($this->m_objCommon->judgeFormState('edit',0,'CONFIRM') == false){
			header('location: edit.php');
			exit;
		}

		$this->initValue($edit_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState('edit',1,'CONFIRM_NEXT');

		if(is_set('to_return',$this->m_vARGV,NULL)){
			header('location: edit.php');
			exit;
		}

		if(axts('note',$this->m_value)){
			$this->m_value['note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['note']);
			$this->m_value['note_view'] = nl2br($this->m_value['note']);
		}
		if(axts('pref',$this->m_value)){
			$this->m_value['pref_name'] = $G_PREF_LIST[$this->m_value['pref']];
		}

		if(is_set('to_complete', $this->m_vARGV, NULL)){
			$this->_to_regist();
		}
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _to_regist(){
		$this->m_value['note'] = htmlspecialchars_decode(axts('note',$this->m_value));
		$this->Edit('kdn_member', 'id='.$this->m_value['id'],$this->m_value);
		$from = $this->get_admin_mail();
		$to = $this->m_value['email_address'];
		$pref = $this->m_value['pref'];
		$data = $this->_makeMailData();
		list($subject,$body) = $this->createMailBodys('5',$data);
		$to_admin = $this->setFromAddress(MAIL_TYPE5,$pref);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject,$body);

		//$this->m_objMail->set_ini($from,$to,$subject,$body);
		$this->m_objMail->send_user_mail();
		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		$this->clearSession(S_KEY10, S_KEY30);
		header('location: edit_complete.php');
		exit;
	}

	private function _makeMailData(){
		$data['company_name'] = $this->m_value['company_name'];
		$data['section'] = $this->m_value['section'];
		$data['charge_name'] = $this->m_value['charge_name'];
		$data['member_login_url'] = MEMBER_LOGIN_URL;
		return $data;
	}

}
new edit_confirm();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>