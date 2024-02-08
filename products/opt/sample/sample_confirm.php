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

require_once('../../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class sample_confirm extends Base{
	
	var $m_password = false;

	public function sample_confirm(){
		parent::Base();
	}
	
	public function Show(){
		global $inquiry_form;
		if($this->checkLoged() != true){
			header('location: index.php');
			exit;		
		}
		
		if($this->m_objCommon->judgeFormState('sample',0,'CONFIRM') == false){
			header('location: sample.php');
			exit;		
		}
		
		$template = $this->getViewHTML_no(get_class(),PATH_TEMPLATE_OPT_SAMPLE);
		$this->initValue($inquiry_form);
		$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
		$this->m_objCommon->setSessionFormState2('sample',1,'CONFIRM_NEXT');

		$this->_makeForm();
		if(is_set('to_return', $this->m_vARGV, NULL)){
			header('location: sample.php');
			exit;
		}
		if(is_set('to_complete', $this->m_vARGV, NULL)){
			$this->_to_regist();
		}
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $CABLE_LENGTH,$NEEDS;
		// power_needs
		$this->m_value['power_needs_view'] = $NEEDS[$this->m_value['power_needs']];
		if(axts('sample_note',$this->m_value)){
			$this->m_value['sample_note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['sample_note']);
			$this->m_value['sample_note_view'] = nl2br($this->m_value['sample_note']);
		}
		$s = array();
		if(axts('cable_length',$this->m_value)){
			if(is_array($this->m_value['cable_length'])){
				foreach($this->m_value['cable_length'] as $k=>$v){
					$s[] = ($v != '') ? $CABLE_LENGTH[$v] : '';
				}		
			}
		}
		$this->m_value['cable_length'] = (count($s) > 0) ? implode(',',$s) : '';
		$this->m_value['cable_needs_view'] = $NEEDS[$this->m_value['cable_needs']];
		
		$this->m_value['cable_length_other_view'] = $this->m_value['cable_length_other'].' m';
		$this->m_value['cable_count_view'] = ($this->m_value['cable_count']).' 本';
		
		if((strlen($this->m_value['lent_start_date_year']) == 4) and (strlen($this->m_value['lent_start_date_month']) == 2) and (strlen($this->m_value['lent_start_date_day']) == 2)){
			$this->m_value['lent_start_date'] =  $this->m_value['lent_start_date_year'].'/'.$this->m_value['lent_start_date_month'].'/'.$this->m_value['lent_start_date_day'];
			$this->m_value['lent_start_date_view'] =  $this->m_value['lent_start_date_year'].'年'.$this->m_value['lent_start_date_month'].'月'.$this->m_value['lent_start_date_day'].'日';
		}else{
			$this->m_value['lent_start_date'] = '';  
			$this->m_value['lent_start_date_view'] = '';
		}
		if((strlen($this->m_value['return_date_year']) == 4) and (strlen($this->m_value['return_date_month']) == 2) and (strlen($this->m_value['return_date_day']) == 2)){
			$this->m_value['return_date'] =  $this->m_value['return_date_year'].'/'.$this->m_value['return_date_month'].'/'.$this->m_value['return_date_day'];
			$this->m_value['return_date_view'] =  $this->m_value['return_date_year'].'年'.$this->m_value['return_date_month'].'月'.$this->m_value['return_date_day'].'日';
		}else{
			$this->m_value['return_date'] = '';
			$this->m_value['return_date_view'] = '';
		}

	}

	private function _to_regist(){
		$this->m_value['sample_note'] = htmlspecialchars_decode($this->m_value['sample_note']);
		$this->Add('kdn_sample_history',$this->m_value);
		$this->Query('select last_insert_id() as last_id from kdn_sample_history');
		$res = $this->getOneRow();
	
		//mysql_insert_id()
		$note1 = '照明 -1.型式・台数: '.axts('model1',$this->m_value).' 照明 -2.型式・台数: '.axts('model2',$this->m_value);
		$note2 = '電源: '.$this->m_value['power_needs_view'].'  型式・台数: '.axts('power_type',$this->m_value);
		$note3 = '対象物ワーク: '.axts('target_work',$this->m_value);
		//$note3 = '貸し出し希望日: '.axts('lent_start_date_view',$this->m_value).' 返却予定日: '.axts('return_date_view',$this->m_value);
		$data = array(
			'kdn_member_id' => $this->logedin_member_info('id'),
			'generate_date' => date('Y-m-d'),
			'generate_time' => date('H:i:s'),
			'note1' => $note1,
			'note2' => $note2,
			'note3' => $note3,
			'history_id' => axts('last_id',$res),
			'type' => HISTORY_TYPE1 
		);
		$this->Add('kdn_history',$data);
/*
		$from = $this->get_admin_mail();
		$mem = $this->logedin_member_info();
		$to = $mem['email_address'];
		$this->m_value['section'] = $mem['section'];
		//$data = $this->_makeMailData();
		list($subject,$body) = $this->createMailBodys('2',$this->m_value);
		$this->m_objMail->set_ini($from,$to,$subject,$body);
		$this->m_objMail->send_user_mail();
*/
		$from = $this->get_admin_mail();
		$to = $this->logedin_member_info('email_address');
		list($subject,$body) = $this->createMailBodys(MAIL_TYPE2,$this->m_value);
		$pref = $this->logedin_member_info('pref');
		$to_admin = $this->setFromAddress(MAIL_TYPE2,$pref);
		$body_admin = $this->makeMailDataMemberInfo();
		$subject_admin = $this->createMailSubject(MAIL_TYPE2,$pref);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject_admin,$body."\n".MAIL_BODY_SEPARETION.$body_admin);
		$this->m_objMail->send_user_mail();

		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		$this->clearSession(S_KEY10, S_KEY30);
		header('location: sample_completion.php');
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
	
}
new sample_confirm();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>