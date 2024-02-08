<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a2121.php 製品　edit
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a2121 extends Base{

	public function a2121(){
		parent::Base();
	}
	
	public function Show(){
		global $a2111_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a2111_form);
		$this->m_value['menu_g'] = G02;
		
		$get_data = in_get_data();
		$id = $this->checkParamId('target');
		if($id === false){
			header('location: a2100.php?');
			exit;
		}else{
			if(is_array($get_data)){
				if(in_array('target',array_keys($get_data)))	$this->_getData($id);
			}
		}		
		
		if(axts('mode', $this->m_vARGV) == 'search'){
		}
		if(axts('mode', $this->m_vARGV) == 'clear'){
			header('location: a2121.php?');
			exit;
		}
		if(axts('mode', $this->m_vARGV) == 'edit'){
			$this->_to_regist();
		}
		
		if(axts('mode',$this->m_value)){
			if(in_array($this->m_value['mode'],array('contents10','contents11','contents20','contents30','contents40',))){
				$this->_unfile($this->m_value['mode']);	
				$this->_reload_status($this->m_value['target']);
			}
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
		//$this->m_value['products_name'] = str_replace("\\",'',$this->m_value['products_name']);
		$msg = $this->_validate();
		if($msg == ''){
			$upmsg = $this->_upload();
			if($upmsg == '') {
				$this->_regist();
				$this->m_value = array();
				header("location: completion.php?mn=G02&ms=inf004");
				exit;
			}else{
				$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($upmsg);
			}
		}else{
			$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
		}
		$this->_reload_status(axts('target',$this->m_value));
	}
	
	private function _unfile($contents){
		if(file_exists(axts($contents,$this->m_value))){
			$r = unlink(axts($contents,$this->m_value));
		}
		$data = array(
			'id' => $this->m_value['target'],
			$contents => ''
		);
		$this->Edit('kdn_products', 'id='.$this->m_value['target'], $data);
		
	}
	
	private function _regist(){
		$this->m_value['id'] = $this->m_value['target'];
		$this->Edit('kdn_products', 'id='.$this->m_value['id'], $this->m_value);
	}

	private function _upload(){
		if(count($_FILES) != 5)		return array('','');
		global $CONTENTS_FILES,$CONTENTS_NAME,$CONTENTS_PREFIX_FILENAME;
		$msg = '';
		foreach($CONTENTS_FILES as $k1=>$ctl){
			if(($_FILES[$ctl]['name'] != '') and ($_FILES[$ctl]['error'] == 0)){			
				$new_id = $this->m_value['target'];
				///	$new_id = $this->getNextId($this->getStatusTable('kdn_products'));
				///	if(!$new_id)		continue;
				$products_name = $this->replace_upload_fname(axts('products_name',$this->m_value));
				$fname = $products_name.$CONTENTS_PREFIX_FILENAME[$k1];
				$m = substr($ctl,-1);
				$type = ($m == '0') ? 2 : 3;
				$this->m_objFiles->ini_setting($_FILES[$ctl],$type,UPLOAD_DIR_CONTENTS.DS.$new_id,$fname);
				list($res0,$res1) = $this->m_objFiles->validate();
				$msg .= ($res0 != '') ? $CONTENTS_NAME[$ctl].' '.$res0.'<br />' : '';
				$this->m_value[$ctl] = ($res1 != '') ? $res1 : '';
//			}else{
//				$this->m_value[$ctl] = '';
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
	
	public function _getData($id){
		if(!$id)	return false;
		$condition = 'id='.$id;
		$this->Search('kdn_products','*',$condition);
		$res = $this->getOneRow();
		$this->m_value['large_category_id'] = $res['large_category_id'];
		$this->m_value['middle_category_id'] = $res['middle_category_id'];
		$this->m_value['products_name'] = $res['products_name'];
		$this->m_value['order_of_row'] = $res['order_of_row'];
		$this->m_value['contents10'] = $res['contents10'];

		$this->m_value['contents10_status'] = ($this->m_value['contents10'] == '')
										? ''
										: $this->_uploaded_status('contents10');
		$this->m_value['contents11'] = $res['contents11'];
		$this->m_value['contents11_status'] = ($this->m_value['contents11'] == '')
										? ''
										: $this->_uploaded_status('contents11');
		$this->m_value['contents20'] = $res['contents20'];
		$this->m_value['contents20_status'] = ($this->m_value['contents20'] == '')
										? ''
										: $this->_uploaded_status('contents20');
		$this->m_value['contents30'] = $res['contents30'];
		$this->m_value['contents30_status'] = ($this->m_value['contents30'] == '')
										? ''
										: $this->_uploaded_status('contents30');
		$this->m_value['contents40'] = $res['contents40'];
		$this->m_value['contents40_status'] = ($this->m_value['contents40'] == '')
										? ''
										: $this->_uploaded_status('contents40');
	}
	private function _reload_status($id){
		if(!$id)	return false;
		$condition = 'id='.$id;
		$this->Search('kdn_products','*',$condition);
		$res = $this->getOneRow();
		$this->m_value['order_of_row'] = $res['order_of_row'];
		$this->m_value['contents10'] = $res['contents10'];

		$this->m_value['contents10_status'] = ($this->m_value['contents10'] == '')
										? ''
										: $this->_uploaded_status('contents10');
		$this->m_value['contents11'] = $res['contents11'];
		$this->m_value['contents11_status'] = ($this->m_value['contents11'] == '')
										? ''
										: $this->_uploaded_status('contents11');
		$this->m_value['contents20'] = $res['contents20'];
		$this->m_value['contents20_status'] = ($this->m_value['contents20'] == '')
										? ''
										: $this->_uploaded_status('contents20');
		$this->m_value['contents30'] = $res['contents30'];
		$this->m_value['contents30_status'] = ($this->m_value['contents30'] == '')
										? ''
										: $this->_uploaded_status('contents30');
		$this->m_value['contents40'] = $res['contents40'];
		$this->m_value['contents40_status'] = ($this->m_value['contents40'] == '')
										? ''
										: $this->_uploaded_status('contents40');
	}
	private function _uploaded_status($mode){
		$uploaded = "<div class=\"left pd-left20 pd-top6\">アップロード済</div>
      <div class=\"left\"><a href=\"javascript:void(0);\" onclick=\"changeMode('".$mode."');\"><img src=\"common/images/batsu.png\" alt=\"×\" width=\"32\" height=\"28\" class=\"png\" /></a></div>
";
		return $uploaded;
	} 	

}
$a2121 = new a2121();
$a2121->a2121();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>