<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		member addnew
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('../config/test/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');

class addnew extends Base{

	var $m_alert;

	public function addnew(){
		parent::Base();
	}
	
	public function Show(){
		global $addnew_form,$FORM_STATE;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		if($this->checkLoged() == true){
			header('location: menu.php');
			exit;		
		}
				
		if(is_set('to_reset', $this->m_vARGV, NULL)){
			$this->m_vARGV = array();
		}
		
		$this->initValue($addnew_form);
		
		if($this->m_objCommon->judgeFormState(get_class(),1,$FORM_STATE[1]) == true){
			// 確認画面から戻った場合
			$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
			$this->m_objCommon->unsetSessionFormState(get_class(),1);
			$this->m_value['note'] = str_replace(chr(10).chr(10),chr(10),axts('note',$this->m_value));
		}
		
		if(is_set('to_confirm', $this->m_vARGV, NULL)){
			$msg = $this->_validate2();
			if(count($msg) == 0){
				$this->m_value['zip'] = $this->m_value['zip1'].'-'.$this->m_value['zip2'];
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState('addnew',0,'CONFIRM');
				header('location: addnew_confirm.php');
				exit;
			}else{
				$template = $this->getViewHTML('addnew_confirm_alert',PATH_TEMPLATE_MEMBER);
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('addnew',1,'CONFIRM_NEXT');
				foreach($addnew_form as $k=>$v){
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
		global $G_PREF_LIST;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
		$this->m_value['check_privacy'] = (axts('privacy',$this->m_value) == '') ? '' : 'checked';
	}
	
	private function _output_alert(){
		global $G_PREF_LIST;
		if(axts('note',$this->m_value)){
			$this->m_alert['note'] = str_replace(chr(10).chr(10),chr(10),$this->m_value['note']);
			$this->m_alert['note_view'] = nl2br($this->m_alert['note']);
		}
		if($this->m_alert['privacy'] == '1')	$this->m_alert['privacy'] = '同意';
		if(aexists($this->m_alert['pref'],$G_PREF_LIST))	$this->m_alert['pref'] = $G_PREF_LIST[$this->m_alert['pref']];
var_export($this->m_alert['telno']);			
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
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if($this->m_value['privacy'] == ''){
			return $G_VALIDATE_MESSAGE['val017'];
		}
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
		$msg = $this->validate_member('1');
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	
	private function _validate2(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
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
		$msg = $this->validate_member2('1');
		if($this->m_value['privacy'] == ''){
			$msg[] = array('privacy',$G_VALIDATE_MESSAGE['val017']);
		}
		return $msg;
	}

}
new addnew();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>