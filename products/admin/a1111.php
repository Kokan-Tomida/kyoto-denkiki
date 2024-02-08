<?php

/**--------------------------------------------------------------------
  ProjectName :  	Kyoto Denkiki Co.,Ltd.
  					https://www.kdn.co.jp/products/
  description :		a1111.php
  					category is registered newly.
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a1111 extends Base{

	public function a1111(){
		parent::Base();
	}

	public function Show(){
		global $a1111_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a1111_form);
		$this->m_value['menu_g'] = G01;

		$this->_makeForm();

		if(is_set('to_regist', $this->m_vARGV,NULL)){
			$this->_to_regist();
		}
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _makeForm(){
		$this->makeFormLargeCategory();
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if(!axts('large_category_id',$this->m_value,null)){
			$msg[] = $G_VALIDATE_MESSAGE['val021'];
		}
		if(!axts('middle_category_name',$this->m_value,null)){
			$msg[] = $G_VALIDATE_MESSAGE['val022'];
		}
//		if(count($msg)== 0){
//			$condition = " large_category_id=".axts('large_category_id',$this->m_value)." and middle_category_name ='".axts('middle_category_name',$this->m_value)."'";
//			$this->Search('kdn_middle_category','*',$condition);
//			if($this->getNumCount() == 1)	$msg[] = $G_VALIDATE_MESSAGE['val023'];
//		}
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}

	private function _regist(){
		$condition = 'large_category_id = '.$this->m_value['large_category_id'];
		$this->Search('kdn_middle_category','max(order_of_row) as order_of_row',$condition);
		$res = $this->getOneRow();
		$order_of_row = ($res['order_of_row'] == '0') ? 1 : ($res['order_of_row'] + 1);
		$this->m_value['order_of_row'] = $order_of_row;
		$this->Add('kdn_middle_category', $this->m_value);
	}

	private function _upload(){
		if(!axts('image_path', $_FILES))	return null;
		if($_FILES['image_path']['error'] != 0)		return null;
		if($this->m_value['top_category_type'] == '')		return null;
		$new_id = null;
		$new_id = $this->getNextId($this->getStatusTable('kdn_middle_category'));
		if(!$new_id)		return null;
		$fname = $this->m_value['top_category_type'].'_';
		$fname .= $this->m_value['large_category_id'].'_';
		$fname .= $new_id.'_images';
		$this->m_objFiles->ini_setting($_FILES['image_path'],1,UPLOAD_DIR_MIDDLE_CATEGORY,$fname);
		return $this->m_objFiles->validate();
	}

	private function _to_regist(){
		global $G_VALIDATE_MESSAGE;
		$msg = $this->_validate();
		if($msg == ''){
			$res = $this->_upload();
			if($res !== false){
				$upmsg = $res[0];
				$uppath = $res[1];
				if($upmsg == ''){
					$this->m_value['image_path'] = $uppath;

					$this->_regist();
					$this->m_value = array();
					header("location: completion.php?mn=G01&ms=inf002");
					exit;
				}else{
					$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($upmsg);
				}
			}else{
				$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($G_VALIDATE_MESSAGE['val019']);
			}
		}else{
			$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
		}
	}
}
$a1111 = new a1111();
$a1111->a1111();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>