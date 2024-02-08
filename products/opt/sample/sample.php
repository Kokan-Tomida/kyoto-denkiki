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

require_once('../../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class sample extends Base{

	public function sample(){
		parent::Base();
	}
	
	public function Show(){
		global $sample_form,$FORM_STATE;
		
		if($this->checkLoged() != true){
			header('location: index.php');
			exit;		
		}
		if(is_set('to_reset',$this->m_vARGV,null)){
			$this->m_vARGV = array();
		}

		$template = $this->getViewHTML_no(get_class(),PATH_TEMPLATE_OPT_SAMPLE);
		$this->initValue($sample_form);
		
		if($this->m_objCommon->judgeFormState(get_class(),1,$FORM_STATE[1]) == true){
			// 確認画面から戻った場合
			$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
			$this->m_objCommon->unsetSessionFormState(get_class(),1);
			$this->m_value['sample_note'] = str_replace(chr(10).chr(10),chr(10),axts('sample_note',$this->m_value));
		}
		
		$mem_info = $this->logedin_member_info();
		if(is_set('to_confirm',$this->m_vARGV,null)){
			$msg = $this->_validate2($mem_info['id']);
			if(count($msg) == 0){
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('sample',0,'CONFIRM');
				header('location: sample_confirm.php');
				exit;
			}else{
				$template = $this->getViewHTML_no('sample_confirm_alert',PATH_TEMPLATE_OPT_SAMPLE);
				$this->m_objCommon->setSessionFromExternal($this->m_value,true);
				$this->m_objCommon->setSessionFormState2('sample',1,'CONFIRM_NEXT');
				foreach($sample_form as $k=>$v){
					$this->m_alert[$k] = (aexists($k,$this->m_vARGV)) ? $this->m_vARGV[$k] : $v;
				}
				foreach($msg as $ix => $mm){
					if(count($mm) == 2)	$this->m_alert[$mm[0]] = $mm[1];
				}
				if((!axts('lent_start_date',$this->m_alert)) and (axts('lent_start_date_year',$this->m_value)) and (axts('lent_start_date_month',$this->m_value)) and (axts('lent_start_date_day',$this->m_value))){
					$this->m_alert['lent_start_date'] = $this->m_value['lent_start_date_year'].'年'.$this->m_value['lent_start_date_month'].'月'.$this->m_value['lent_start_date_day'].'日';
				}
_log(var_export($this->m_alert,1));
_log(var_export($this->m_value,1));
				if((!axts('return_date',$this->m_alert)) and (axts('return_date_year',$this->m_value)) and (axts('return_date_month',$this->m_value)) and (axts('return_date_day',$this->m_value))){
					$this->m_alert['return_date'] = $this->m_value['return_date_year'].'年'.$this->m_value['return_date_month'].'月'.$this->m_value['return_date_day'].'日';
				}
				$this->m_alert['company_name'] = $mem_info['company_name'];
				$this->m_alert['charge_name'] = $mem_info['charge_name'];
				$this->m_alert['header_link'] = $this->loged_header();
				return $this->m_objTemplate->set_value($template, $this->m_alert);
			}
		}
		$this->_makeForm($mem_info);
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm($member_info){
		global $CABLE_LENGTH,$NEEDS;
		$this->m_value['radio_power_needs'] = $this->m_objCommon->makeRadio($NEEDS,'power_needs',axts('power_needs',$this->m_value),true);
		$cable_length = (axts('cable_length',$this->m_value)) ? $this->m_value['cable_length'] : array();
		$sep = count($CABLE_LENGTH) + 1;
		$this->m_value['checkbox_cable_length'] = $this->m_objCommon->makeCheckbox($CABLE_LENGTH,'cable_length',$cable_length,$sep);
		$this->m_value['company_name'] = $member_info['company_name'];
		$this->m_value['charge_name'] = $member_info['charge_name'];
		$this->m_value['kdn_member_id'] = $member_info['id'];
		$this->m_value['check_cable_needs1'] = ($this->m_value['cable_needs'] != '2') ? 'checked="checked"' : '';
		$this->m_value['check_cable_needs2'] = ($this->m_value['cable_needs'] == '2') ? 'checked="checked"' : '';
		$this->m_value['check_privacy'] = ($this->m_value['privacy'] == '1') ? 'checked="checked"' : '';

		//option_return_date_year,month,day
		$this->m_value['option_return_date_year'] =  $this->m_objCommon->selYear(axts('return_date_year',$this->m_value),date('Y'),true );
		$this->m_value['option_return_date_month'] =  $this->m_objCommon->selMonth(axts('return_date_month',$this->m_value),true );
		$this->m_value['option_return_date_day'] =  $this->m_objCommon->selDay(axts('return_date_day',$this->m_value),axts('return_date_month',$this->m_value,''),axts('return_date_day',$this->m_value,''));
		//option_lent_start_date_year,month,day
		$this->m_value['option_lent_start_date_year'] =  $this->m_objCommon->selYear(axts('lent_start_date_year',$this->m_value),date('Y'),true );
		$this->m_value['option_lent_start_date_month'] =  $this->m_objCommon->selMonth(axts('lent_start_date_month',$this->m_value),true );
		$this->m_value['option_lent_start_date_day'] =  $this->m_objCommon->selDay(axts('lent_start_date_day',$this->m_value),axts('lent_start_date_month',$this->m_value,''),axts('lent_start_date_day',$this->m_value,''));
	}
	
/*
	private function _validate($id){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$msg = $this->validate_inquiry('2',$id);
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
*/	
	private function _validate2($id){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$msg = $this->validate_sample2();
		return $msg;
	}
	
}
new sample();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>