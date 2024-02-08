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


class edit extends Base{

	var $m_alert;
	
	public function edit(){
		parent::Base();
	}
	
	public function Show(){
		global $edit_form,$FORM_STATE;
		if($this->checkLoged() == false){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($edit_form);
		
		if($this->m_objCommon->judgeFormState(get_class(),1,$FORM_STATE[1]) == true){
			// 確認画面から戻った場合
			$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
			$this->m_objCommon->unsetSessionFormState(get_class(),1);
			$this->m_value['note'] = str_replace(chr(10).chr(10),chr(10),axts('note',$this->m_value));
		}else{
			if(!isSubmit($this->m_vARGV)){
				if($this->getData() == null){
					header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
					exit;
				}
			}
		}
		
		if(is_set('to_reset', $this->m_vARGV, NULL)){
			$this->getData();
		}
		
		if(is_set('to_confirm', $this->m_vARGV, NULL)){
			$msg = $this->_validate2();
			if(count($msg) == 0){
				$this->m_value['zip'] = $this->m_value['zip1'].'-'.$this->m_value['zip2'];
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState('edit',0,'CONFIRM');
				header('location: edit_confirm.php');
				exit;
			}else{
				$template = $this->getViewHTML('edit_confirm_alert',PATH_TEMPLATE_MEMBER);
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('edit',1,'CONFIRM_NEXT');
				foreach($edit_form as $k=>$v){
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
		$msg = $this->validate_member('2',$this->m_value['id']);
		if(!axts('member_pwd',$this->m_value)){
			$msg[] = $G_VALIDATE_MESSAGE['val043'];
		}
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
		$msg = $this->validate_member2('2',$this->m_value['id']);
		//if($this->m_value['privacy'] == ''){
		//	$msg[] = array('privacy',$G_VALIDATE_MESSAGE['val017']);
		//}
		if(!axts('member_pwd',$this->m_value)){
			$msg[] = array('member_pwd',$G_VALIDATE_MESSAGE['val043']);
		}
		return $msg;
	}

	private function getData(){
		$res = $this->logedin_member_info();
		if(!is_array($res))		return null;
		foreach($res as $k=>$v){
			if(($k == 'telno') and ($v != '') and (strpos($v,'-') !== false)){
				$t = explode('-',$v);
				for($i = 0; $i < count($t); $i++){
					$j = $i+1;
					$this->m_value['tel'.$j] = $t[$i];
				}
			}elseif(($k == 'faxno') and ($v != '') and (strpos($v,'-') !== false)){
				$t = explode('-',$v);
				for($i = 0; $i < count($t); $i++){
					$j = $i+1;
					$this->m_value['fax'.$j] = $t[$i];
				}
			}else{	
				$this->m_value[$k] = htmlspecialchars($v);
			}
		}
		return true;
	}
	
}
new edit();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>