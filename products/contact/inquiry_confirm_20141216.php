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

require_once('../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class inquiry_confirm extends Base{
	
	var $m_password = false;

	public function inquiry_confirm(){
		parent::Base();
	}
	
	public function Show(){
		global $inquiry_form;
		if($this->checkLoged() != true){
			header('location: inquiry_guest.php');
			exit;		
		}
		
		if($this->m_objCommon->judgeFormState('inquiry',0,'CONFIRM') == false){
			header('location: inquiry.php');
			exit;		
		}
		
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_CONTACT);
		$this->initValue($inquiry_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState2('inquiry',1,'CONFIRM_NEXT');

		$this->_makeForm();
		if(is_set('to_return', $this->m_vARGV, NULL)){
			header('location: inquiry.php');
			exit;
		}
		if(is_set('to_complete', $this->m_vARGV, NULL)){
			$this->_to_regist();
		}
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $INQUIRY_CHECKBOX,$INQUIRY_SELECT_MEMBER;
		$this->m_value['inquiry_note_view'] = '';
		if(axts('inquiry_note',$this->m_value)){
			$this->m_value['inquiry_note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['inquiry_note']);
			$this->m_value['inquiry_note_view'] = nl2br($this->m_value['inquiry_note']);
		}

		$this->m_value['inquiry_select_view'] = '';
		if(axts('inquiry_select',$this->m_value)){
			$this->m_value['inquiry_select_view'] = $INQUIRY_SELECT_MEMBER[$this->m_value['inquiry_select']];
		}
		
		$this->m_value['inquiry_check_view'] = '';
		$this->m_value['inquiry_check_save'] = '';
		$this->m_value['inquiry_check_mail'] = '';
		$inquiry_check_mail = array();
		if(axts('inquiry_check',$this->m_value)){
			if((count($this->m_value['inquiry_check']) > 0) and (is_array($this->m_value['inquiry_check']))){
				$this->m_value['inquiry_check_view'] .= '<ul>';
				foreach($this->m_value['inquiry_check'] as $k){
					// password
					if(($k == '4') and (axts('inquiry_select',$this->m_value) == '3')){
						$this->m_password = true;
					}
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
			'inquiry_select' => axts('inquiry_select',$this->m_value),
			'inquiry_check' => $this->m_value['inquiry_check_save'],
			'inquiry_note' => htmlspecialchars_decode(axts('inquiry_note',$this->m_value)),
			'kdn_member_id' => axts('id',$this->m_value),
		);
		$this->Add('kdn_inquiry_history',$datas);
		
		$datas = array(
			'kdn_member_id' => axts('id',$this->m_value),
			'generate_date' => date('Y-m-d'),			
			'generate_time' => date('H:i:s'),
			'note1' => 	$this->m_value['inquiry_select_view']. ' '.$this->m_value['inquiry_check_mail'],		
			'note2' => htmlspecialchars_decode($this->m_value['inquiry_note']),
			'history_id' => mysql_insert_id(),
			'type' => HISTORY_TYPE2,
		);
		$this->Add('kdn_history',$datas);
		
		$from = $this->get_admin_mail();
		$to = $this->logedin_member_info('email_address');
		$data = $this->_makeMailData();
		list($subject,$body) = $this->createMailBodys('1',$data);
		$this->m_objMail->set_ini($from,$to,$subject,$body);
		$this->m_objMail->send_user_mail();
		
		// remainder
/*		
		if($this->m_password == true){
			$data = $this->_makeMailDataRemainder();
			$edit_data = array(
				'member_pwd'=>$data['new_password'],
				'id' => axts('id',$this->m_value)
			);
			$this->Edit('kdn_member','id='.axts('id',$this->m_value),$edit_data);
			
			list($subject,$body) = $this->createMailBodys('7',$data);
			$this->m_objMail->set_ini($from,$to,$subject,$body);
			$this->m_objMail->send_user_mail();
		}
*/
		
		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		$this->clearSession(S_KEY10, S_KEY30);
		header('location: inquiry_complete.php');
		exit;
	}
	
	private function _makeMailData(){
		$data['company_name'] = $this->m_value['company_name'];
		$data['section'] = $this->m_value['section'];
		$data['charge_name'] = $this->m_value['charge_name'];
		$data['inquiry_note'] = htmlspecialchars_decode($this->m_value['inquiry_note']);
		$data['inquiry_select_view'] = $this->m_value['inquiry_select_view'];
		$data['inquiry_check_view_mail'] = $this->m_value['inquiry_check_mail'];
		return $data;
	}
	
	private function _makeMailDataRemainder(){
		$data['company_name'] = $this->m_value['company_name'];
		$data['section'] = $this->m_value['section'];
		$data['charge_name'] = $this->m_value['charge_name'];
		$data['new_password'] = substr(makeRandamVariable40(),1,MEMBER_PWD_LENGTH);
		return $data;
	}

}
new inquiry_confirm();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>