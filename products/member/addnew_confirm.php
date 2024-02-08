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

class addnew_confirm extends Base{

	public function addnew_confirm(){
		parent::Base();
	}

	public function Show(){
		global $addnew_form,$G_PREF_LIST;
		if($this->checkLoged() == true){
			header('location: menu.php');
			exit;
		}

		if($this->m_objCommon->judgeFormState('addnew',0,'CONFIRM') == false){
			header('location: addnew.php');
			exit;
		}

		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($addnew_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState('addnew',1,'CONFIRM_NEXT');

		if(is_set('to_return',$this->m_vARGV,NULL)){
			header('location: addnew.php');
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
		$this->m_value['status'] = '1';
		$query_strings = makeRandamVariable40();
		$this->m_value['query_strings'] = $query_strings;
		$this->m_value['temporary_registration'] = date('Y-m-d H:i:s');
		list($validity2,$validity) = $this->m_objCommon->getProgressDateTime(VALIDITY_TIME);
		$this->m_value['validity'] = $validity;
		// 漢字
		$this->m_value['validity2'] = $validity2;
		$this->Add('kdn_member', $this->m_value);

		$from = $this->get_admin_mail();
		$to = $this->m_value['email_address'];
		$data = $this->_makeMailData();
		list($subject,$body) = $this->createMailBodys('3',$data);
		$pref = axts('pref',$this->m_value);
		$to_admin = $this->setFromAddress(MAIL_TYPE3,$pref);
		//$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject_admin,$body);

		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject,$body);
		$this->m_objMail->send_user_mail();
		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		header('location: addnew_once_complete.php');
		exit;
	}

	private function _makeMailData(){
		foreach($this->m_value as $fld=>$v){
			if($fld == 'note'){
				$data[$fld] = $v;
			}else{
				$data[$fld] = $v;
			}
		}
		$data['validity'] = $this->m_value['validity2'];
		$data['access_url'] = THIS_REGISTRATION_URL.'?'.$this->m_value['query_strings'];
		return $data;
	}

}
new addnew_confirm();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>