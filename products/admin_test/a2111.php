<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a2111.php 製品　新規登録
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a2111 extends Base{

	public function a2111(){
		parent::Base();
	}
	
	public function Show(){
		global $a2111_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a2111_form);
		$this->m_value['menu_g'] = G02;
		
		if(axts('mode', $this->m_vARGV) == 'search'){
		}
		if(axts('mode', $this->m_vARGV) == 'clear'){
		}
		if(axts('mode', $this->m_vARGV) == 'addnew'){
			$this->_to_regist();
		}
		
		$this->_makeForm();
		

		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		$select_large_category_id = $this->makeFormLargeCategory();

		$condition = ($select_large_category_id != '') ? 'large_category_id='.$select_large_category_id : '';
		$order = 'order_of_row asc';	
		$list = $this->makeList_middle_series('kdn_middle_category', array('id','middle_category_name','series_name'), $condition,$order);
		$select_middle_category_id = axts('middle_category_id',$this->m_value,'');
		$this->m_value['option_middle_category_id'] = $this->m_objCommon->makeOption($list,$select_middle_category_id);
	}

	private function _to_regist(){
		global $G_VALIDATE_MESSAGE;
		$this->m_value['products_name'] = htmlspecialchars_decode(axts('products_name',$this->m_value),ENT_QUOTES);
		$this->m_value['products_name'] = str_replace("\\",'',$this->m_value['products_name']);
		$this->m_value['products_name'] = str_replace("\"",'',$this->m_value['products_name']);
		$this->m_value['products_name'] = str_replace("\'",'',$this->m_value['products_name']);
		$this->m_value['products_name'] = str_replace("'",'',$this->m_value['products_name']);
		$msg = $this->_validate();
		if($msg == ''){
			$upmsg = $this->_upload();
			if($upmsg == ''){
				$this->_regist();
				$this->m_value = array();
				header("location: completion.php?mn=G03&ms=inf004");
				exit;
			}else{
				$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($upmsg);
			}
		}else{
			$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
		}
	}
	
	private function _regist(){
		$condition = 'large_category_id = '.$this->m_value['large_category_id'];
		$condition .= ' and middle_category_id = '.$this->m_value['middle_category_id'];
		$this->Search('kdn_products','max(order_of_row) as order_of_row',$condition);
		$res = $this->getOneRow();
		$order_of_row = ($res['order_of_row'] == '0') ? 1 : ($res['order_of_row'] + 1); 
		$this->m_value['order_of_row'] = $order_of_row; 
		$this->Add('kdn_products', $this->m_value);



	}

	private function _upload(){
		if(count($_FILES) != 5)		return array('','');
		global $CONTENTS_FILES,$CONTENTS_NAME,$CONTENTS_PREFIX_FILENAME;
		$msg = '';
		foreach($CONTENTS_FILES as $k1=>$ctl){
			if(($_FILES[$ctl]['name'] != '') and ($_FILES[$ctl]['error'] == 0)){			
				$new_id = null;
				$new_id = $this->getNextId($this->getStatusTable('kdn_products'));
				if(!$new_id)		continue;
				$products_name = $this->replace_upload_fname(axts('products_name',$this->m_value));
				$fname = $products_name.$CONTENTS_PREFIX_FILENAME[$k1];
				$m = substr($ctl,-1);
				$type = ($m == '0') ? 2 : 3;
				$this->m_objFiles->ini_setting($_FILES[$ctl],$type,UPLOAD_DIR_CONTENTS.DS.$new_id,$fname);
				list($res0,$res1) = $this->m_objFiles->validate();
				$msg .= ($res0 != '') ? $CONTENTS_NAME[$ctl].' '.$res0.'<br />' : '';
				$this->m_value[$ctl] = ($res1 != '') ? $res1 : '';
			}else{
				$this->m_value[$ctl] = '';
			}
		}
		return $msg;
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if(axts('large_category_id',$this->m_value) == ''){
			$msg[] = $G_VALIDATE_MESSAGE['val021'];
		}
		if(axts('middle_category_id',$this->m_value) == ''){
			$msg[] = $G_VALIDATE_MESSAGE['val024'];
		}
		if(axts('products_name',$this->m_value) == ''){
			$msg[] = $G_VALIDATE_MESSAGE['val025'];
		}
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	

	
}
new a2111();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>