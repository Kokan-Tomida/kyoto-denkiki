<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a4100.php 履歴一覧 all
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('../config/test/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');



class inquiry_guest_confirm extends Base{

	public function inquiry_guest_confirm(){
		parent::Base();
	}
	
	public function Show(){
		global $inquiry_form;
		if($this->checkLoged() == true){
			header('location: inquiry.php');
			exit;		
		}
		
		if($this->m_objCommon->judgeFormState('inquiry_guest',0,'CONFIRM') == false){
			header('location: inquiry_guest.php');
			exit;		
		}
		
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_CONTACT);
		$this->initValue($inquiry_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState2('inquiry_guest',1,'CONFIRM_NEXT');

		$this->_makeForm();
		if(is_set('to_return', $this->m_vARGV, NULL)){
			header('location: inquiry_guest.php');
			exit;
		}
		if(is_set('to_complete', $this->m_vARGV, NULL)){
			$this->_to_regist();
		}
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $INQUIRY_CHECKBOX,$INQUIRY_SELECT,$G_PREF_LIST;
		
		if(axts('pref',$this->m_value)){
			$this->m_value['pref_name'] = $G_PREF_LIST[$this->m_value['pref']];
		}
		if((axts('zip1',$this->m_value)) and (axts('zip2',$this->m_value))){
			$this->m_value['zip'] = $this->m_value['zip1'].'-'.$this->m_value['zip2'];
		}

		$this->m_value['inquiry_note_view'] = '';
		if(axts('inquiry_note',$this->m_value)){
			$this->m_value['inquiry_note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['inquiry_note']);
			$this->m_value['inquiry_note_view'] = nl2br($this->m_value['inquiry_note']);
		}

		$this->m_value['inquiry_select_view'] = '';
		if(axts('inquiry_select',$this->m_value)){
			$this->m_value['inquiry_select_view'] = $INQUIRY_SELECT[$this->m_value['inquiry_select']];
		}
		
		$this->m_value['inquiry_check_view'] = '';
		$this->m_value['inquiry_check_save'] = '';
		$this->m_value['inquiry_check_mail'] = '';
		$inquiry_check_mail = array();
		if(axts('inquiry_check',$this->m_value)){
			if((count($this->m_value['inquiry_check']) > 0) and (is_array($this->m_value['inquiry_check']))){
				$this->m_value['inquiry_check_view'] .= '<ul>';
				foreach($this->m_value['inquiry_check'] as $k){
					$this->m_value['inquiry_check_view'] .= '<li>'.$INQUIRY_CHECKBOX[$k].'</li><br />';
					$inquiry_check_mail[] = $INQUIRY_CHECKBOX[$k];
				}
				$this->m_value['inquiry_check_view'] .= '</ul>';
				$this->m_value['inquiry_check_save'] = implode(',',array_keys($this->m_value['inquiry_check']));
				$this->m_value['inquiry_check_mail'] = (count($inquiry_check_mail) > 0) ? implode(',',$inquiry_check_mail) : '';
			}
		}
	}

	private function _to_regist(){
		$datas = array(
			'company_name' => axts('company_name',$this->m_value),
			'zip' => axts('zip',$this->m_value),
			'pref' => axts('pref',$this->m_value),
			'address1' => axts('address1',$this->m_value),
			'telno' => axts('telno',$this->m_value),
			'faxno' => axts('faxno',$this->m_value),
			'section' => axts('section',$this->m_value),
			'charge_name' => axts('charge_name',$this->m_value),
			'email_address' => axts('email_address',$this->m_value),
			'inquiry_select' => axts('inquiry_select',$this->m_value),
			'inquiry_check' => $this->m_value['inquiry_check_save'],
			'inquiry_note' => htmlspecialchars_decode(axts('inquiry_note',$this->m_value)),
		);
		$this->Add('kdn_inquiry_history',$datas);
		
		$data = array(
			'kdn_member_id' => null,
			'generate_date' => date('Y-m-d'),			
			'generate_time' => date('H:i:s'),
			'note1' => 	$this->m_value['inquiry_select_view']. ' '.$this->m_value['inquiry_check_mail'],		
			'note2' => htmlspecialchars_decode($this->m_value['inquiry_note']),
			'note3' => '',
			'history_id' => mysql_insert_id(),
			'type' => HISTORY_TYPE2,
		);
		$this->Add('kdn_history',$data);

		$from = $this->get_admin_mail();
		$to = axts('email_address',$this->m_value);
		$data = $this->_makeMailData($datas);
		list($subject,$body) = $this->createMailBodys('8',$data);
		$this->m_objMail->set_ini($from,$to,$subject,$body);
		$this->m_objMail->send_user_mail();
		
		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		$this->clearSession(S_KEY10, S_KEY30);
		header('location: inquiry_complete.php');
		exit;
	}
	
	private function _makeMailData($data){
		$data['pref_name'] = $this->m_value['pref_name'];
		$data['inquiry_note'] = htmlspecialchars_decode($this->m_value['inquiry_note']);
		$data['inquiry_select_view'] = $this->m_value['inquiry_select_view'];
		$data['inquiry_check_view_mail'] = $this->m_value['inquiry_check_mail'];
		return $data;
	}
	
}
new inquiry_guest_confirm();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>