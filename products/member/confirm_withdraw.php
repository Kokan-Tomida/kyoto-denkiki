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


class confirm_withdraw extends Base{

	public function confirm_withdraw(){
		parent::Base();
	}

	public function Show(){
		global $edit_form;
		if($this->checkLoged() == false){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($edit_form);

		$this->getData();
		if($this->m_value['id'] == null){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}

		if(is_set('to_complete',$this->m_vARGV,null)){
			$this->_withdraw();
			$this->clearSession(S_KEY10,S_KEY20);
			$this->clearSession(S_KEY10, S_KEY30);
			$this->clearSession(S_KEY11,S_KEY99);
			header('location: completion_withdraw.php');
			exit;
		}

		if(is_set('to_back',$this->m_vARGV,null)){
			header('location: menu.php');
			exit;
		}
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function getData(){
		global $G_PREF_LIST;
		$res = $this->logedin_member_info();
		if(!is_array($res))		return null;
		foreach($res as $k=>$v){
			$this->m_value[$k] = $v;
		}
		$this->m_value['zip'] = $this->m_value['zip1'].'-'.$this->m_value['zip2'];
		$this->m_value['note_view'] = ($this->m_value['note'] != '') ? nl2br($this->m_value['note']) : '';
		$this->m_value['pref_name'] = ($this->m_value['pref'] != '') ? $G_PREF_LIST[$this->m_value['pref']] : '';
		return true;
	}

	private function _withdraw(){
		$data = array(
			'id' => $this->m_value['id'],
			'status' => '3',
			'withdrawal_registration' => date('Y-m-d H:i:s'),
			'this_registration' => null,
			'member_id' => null,
			'member_pwd' => null
		);
		$this->Edit('kdn_member','id='.$this->m_value['id'],$data);
		$mail_data = array(
			'company_name' => $this->m_value['company_name'],
			'charge_name' => $this->m_value['charge_name'],
			'section' => $this->m_value['section'],
		);
		$from = $this->get_admin_mail();
		$to = axts('email_address',$this->m_value);
		$pref = axts('pref',$this->m_value);
		list($subject,$body) = $this->createMailBodys('6',$mail_data);
		$to_admin = $this->setFromAddress(MAIL_TYPE6,$pref);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject,$body);
		//$this->m_objMail->set_ini($from,$to,$subject,$body);
		$this->m_objMail->send_user_mail();
		$this->m_value = array();
	}

}
new confirm_withdraw();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */

?>