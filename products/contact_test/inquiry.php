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

require_once('../config/test/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class inquiry extends Base{

	public function inquiry(){
		parent::Base();
	}
	
	public function Show(){
		global $inquiry_form,$FORM_STATE,$INQUIRY_SELECT_MEMBER,$INQUIRY_CHECKBOX;
		
		if($this->checkLoged() != true){
			header('location: inquiry_guest.php');
			exit;		
		}
		if(is_set('to_reset',$this->m_vARGV,null)){
			$this->m_vARGV = array();
		}

		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_CONTACT);
		$this->initValue($inquiry_form);
		
		if($this->m_objCommon->judgeFormState(get_class(),1,$FORM_STATE[1]) == true){
			// 確認画面から戻った場合
			$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
			$this->m_objCommon->unsetSessionFormState(get_class(),1);
			$this->m_value['inquiry_note'] = str_replace(chr(10).chr(10),chr(10),axts('inquiry_note',$this->m_value));
		}
		
		$mem_info = $this->logedin_member_info();

		
		if(is_set('to_confirm',$this->m_vARGV,null)){
			$msg = $this->_validate2($mem_info['id']);
			//var_export($msg);
			if(count($msg) == 0){
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('inquiry',0,'CONFIRM');
				header('location: inquiry_confirm.php');
				exit;
			}else{
				$template = $this->getViewHTML('inquiry_confirm_alert',PATH_TEMPLATE_CONTACT);
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('inquiry',1,'CONFIRM_NEXT');
				foreach($msg as $ix => $mm){
					if(count($mm) == 2)	$this->m_alert[$mm[0]] = $mm[1];
				}
				$this->m_alert['company_name'] = $this->m_value['company_name'];
				$this->m_alert['charge_name']  = $this->m_value['charge_name'];
				if(axts('inquiry_select',$this->m_value)){
					if(aexists($this->m_value['inquiry_select'],$INQUIRY_SELECT_MEMBER))	$this->m_alert['inquiry_select'] = $INQUIRY_SELECT_MEMBER[$this->m_value['inquiry_select']];
				}
				if(axts('inquiry_note',$this->m_value)){
					$this->m_alert['inquiry_note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['inquiry_note']);
					$this->m_alert['inquiry_note'] = nl2br($this->m_alert['inquiry_note']);
				}
				if(axts('inquiry_check',$this->m_value)){
					if(is_array($this->m_value['inquiry_check'])){
						$inquiry_check= array();
						foreach($this->m_value['inquiry_check'] as $k){
							if(axts($k,$INQUIRY_CHECKBOX))	$inquiry_check[] = $INQUIRY_CHECKBOX[$k];	
						}
						$this->m_alert['inquiry_check'] = implode('<br />',$inquiry_check);
					}
				}
				$this->m_alert['header_link'] = $this->loged_header();
				return $this->m_objTemplate->set_value($template, $this->m_alert);
			}
		}
		$this->_makeForm($mem_info);
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm($member_info){
		global $INQUIRY_CHECKBOX,$INQUIRY_SELECT_MEMBER;
		//option_inquiry_select
		$this->m_value['option_inquiry_select'] = $this->m_objCommon->makeOption($INQUIRY_SELECT_MEMBER,axts('inquiry_select',$this->m_value));
		//checkbox_inquiry_check
		$inquiry_check = (axts('inquiry_check',$this->m_value)) ? $this->m_value['inquiry_check'] : array();
		$this->m_value['checkbox_inquiry_check'] = $this->m_objCommon->makeCheckbox($INQUIRY_CHECKBOX,'inquiry_check',$inquiry_check);
		//company_name,charge_name
		$this->m_value['company_name'] = $member_info['company_name'];
		$this->m_value['charge_name'] = $member_info['charge_name'];
		$this->m_value['id'] = $member_info['id'];
	}

	private function _validate($id){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$msg = $this->validate_inquiry('2',$id);
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	
	private function _validate2($id){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$msg = $this->validate_inquiry2('2',$id);
		return $msg;
	}
	
}
new inquiry();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>