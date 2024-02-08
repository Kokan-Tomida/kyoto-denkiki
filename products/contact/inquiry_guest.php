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


class inquiry_guest extends Base{

	var $m_alert;

	public function inquiry_guest(){
		parent::Base();
	}

	public function Show(){
		global $inquiry_form,$FORM_STATE;
		if($this->checkLoged() == true){
			header('location: inquiry.php');
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

		if(is_set('to_confirm',$this->m_vARGV,null)){
			$msg = $this->_validate2($this->m_value['id']);
			if(count($msg) == 0){
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('inquiry_guest',0,'CONFIRM');
				header('location: inquiry_guest_confirm.php');
				exit;
			}else{
				$template = $this->getViewHTML('inquiry_guest_confirm_alert',PATH_TEMPLATE_CONTACT);
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('inquiry_guest',1,'CONFIRM_NEXT');
				foreach($inquiry_form as $k=>$v){
					$this->m_alert[$k] = (aexists($k,$this->m_vARGV)) ? $this->m_vARGV[$k] : $v;
				}
				foreach($msg as $ix => $mm){
					if(count($mm) == 2)	$this->m_alert[$mm[0]] = $mm[1];
				}
				$this->_output_alert();
				$this->m_alert['header_link'] = $this->loged_header();
				return $this->m_objTemplate->set_value($template, $this->m_alert);
			}
		}
		$this->_makeForm();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _makeForm(){
		global $INQUIRY_CHECKBOX,$INQUIRY_SELECT,$G_PREF_LIST;
		//option_inquiry_select
		$this->m_value['option_inquiry_select'] = $this->m_objCommon->makeOption($INQUIRY_SELECT,axts('inquiry_select',$this->m_value));
		//checkbox_inquiry_check
		$inquiry_check = (axts('inquiry_check',$this->m_value)) ? $this->m_value['inquiry_check'] : array();
		$this->m_value['checkbox_inquiry_check'] = $this->m_objCommon->makeRadio($INQUIRY_CHECKBOX,'inquiry_check',$inquiry_check);
		$this->m_value['check_privacy'] = (axts('privacy',$this->m_value) == '1') ? ' checked' : '';
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
	}
	private function _output_alert(){
		global $G_PREF_LIST,$INQUIRY_SELECT,$INQUIRY_CHECKBOX;
		if(axts('note',$this->m_value)){
			$this->m_alert['note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['note']);
			$this->m_alert['note_view'] = nl2br($this->m_alert['note']);
		}
		if($this->m_alert['privacy'] == '1')	$this->m_alert['privacy'] = '同意';
		if(aexists($this->m_alert['pref'],$G_PREF_LIST))	$this->m_alert['pref'] = $G_PREF_LIST[$this->m_alert['pref']];
		if(!axts('telno',$this->m_alert)){
			if((axts('tel1',$this->m_value) != '') and (axts('tel2',$this->m_value) != '') and (axts('tel3',$this->m_value) != '')){
				$this->m_alert['telno'] = (axts('tel1',$this->m_value)).'-'.(axts('tel2',$this->m_value)).'-'.(axts('tel3',$this->m_value));
			}
		}
		if(!axts('faxno',$this->m_alert)){
			if((axts('fax1',$this->m_value) != '') and (axts('fax2',$this->m_value) != '') and (axts('fax3',$this->m_value) != '')){
				$this->m_alert['faxno'] = (axts('fax1',$this->m_value)).'-'.(axts('fax2',$this->m_value)).'-'.(axts('fax3',$this->m_value));
			}
		}
		if(!axts('zipno',$this->m_alert)){
			if((axts('zip1',$this->m_value) != '') and (axts('zip2',$this->m_value) != '') ){
				$this->m_alert['zipno'] = $this->m_value['zip1'].'-'.$this->m_value['zip2'];
			}
		}
		if(axts('inquiry_select',$this->m_value)){
			if(aexists($this->m_value['inquiry_select'],$INQUIRY_SELECT))	$this->m_alert['inquiry_select'] = $INQUIRY_SELECT[$this->m_value['inquiry_select']];
		}
		if(axts('inquiry_note',$this->m_value)){
			$this->m_alert['inquiry_note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['inquiry_note']);
			$this->m_alert['inquiry_note'] = nl2br($this->m_alert['inquiry_note']);
		}
		if(axts('inquiry_check',$this->m_value)){
			//if(is_array($this->m_value['inquiry_check'])){
				$inquiry_check= array();
				$k = $this->m_value['inquiry_check'];
				//foreach($this->m_value['inquiry_check'] as $k){
				//	if(axts($k,$INQUIRY_CHECKBOX))	$inquiry_check[] = $INQUIRY_CHECKBOX[$k];
				//}
				//$this->m_alert['inquiry_check'] = implode('<br />',$inquiry_check);
				$this->m_alert['inquiry_check'] = axts($k,$INQUIRY_CHECKBOX);
			//}
		}
	}

	private function _validate($id=null){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if($this->m_value['privacy'] == ''){
			return $G_VALIDATE_MESSAGE['val018'];
		}
		if((axts('tel1',$this->m_value) != '') or (axts('tel2',$this->m_value) != '') or (axts('tel3',$this->m_value) != '')){
			$this->m_value['telno'] = (axts('tel1',$this->m_value)).'-'.(axts('tel2',$this->m_value)).'-'.(axts('tel3',$this->m_value));
		}else{
			$this->m_value['telno'] = '';
		}
		if((axts('fax1',$this->m_value) != '') or (axts('fax2',$this->m_value) != '') or (axts('fax3',$this->m_value) != '')){
			$this->m_value['faxno'] = (axts('fax1',$this->m_value)).'-'.(axts('fax2',$this->m_value)).'-'.(axts('fax3',$this->m_value));
		}else{
			$this->m_value['faxno'] = '';
		}
		$msg = $this->validate_inquiry('1',null,false);
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}

	private function _validate2($id){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if((axts('tel1',$this->m_value) != '') and (axts('tel2',$this->m_value) != '') and (axts('tel3',$this->m_value) != '')){
			$this->m_value['telno'] = (axts('tel1',$this->m_value)).'-'.(axts('tel2',$this->m_value)).'-'.(axts('tel3',$this->m_value));
		}else{
			$this->m_value['telno'] = '';
		}
		if((axts('fax1',$this->m_value) != '') and (axts('fax2',$this->m_value) != '') and (axts('fax3',$this->m_value) != '')){
			$this->m_value['faxno'] = (axts('fax1',$this->m_value)).'-'.(axts('fax2',$this->m_value)).'-'.(axts('fax3',$this->m_value));
		}else{
			$this->m_value['faxno'] = '';
		}
		$msg = $this->validate_inquiry2('1',null,false);
		if($this->m_value['privacy'] == ''){
			$msg[] = array('privacy',$G_VALIDATE_MESSAGE['val018']);
		}
		return $msg;
	}

}
new inquiry_guest();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>