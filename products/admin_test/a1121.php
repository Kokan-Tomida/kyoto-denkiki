<?php

/**--------------------------------------------------------------------
  ProjectName :  	Kyoto Denkiki Co.,Ltd. 
  					http://kdn-products.com
  description :		a1121.php  
  					category is registered . 
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a1121 extends Base{

	public function a1121(){
		parent::Base();
	}
	
	public function Show(){
		global $a1111_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a1111_form);
		$this->m_value['menu_g'] = G01;

		$get_data = in_get_data();
		$id = $this->checkParamId('target');
		if($id === false){
			header('location: a1100.php?1');
			exit;
		}else{
			if(is_array($get_data)){
				if(in_array('target',array_keys($get_data)))	$this->_getData($id);
			}
		}
		
		$this->_makeForm();

		if(axts('mode',$this->m_vARGV) == '0'){
			$this->Search('kdn_middle_category','image_path','id='.$this->m_value['target']);
			$res = $this->getOneRow();
			if($res){
				$this->m_value['image_path'] = $res['image_path'];
				if(file_exists($res['image_path'])){
					unlink($res['image_path']);
				}
				$data = array(
					'id' => $this->m_value['target'],
					'image_path' => ''
				);
				$this->Edit('kdn_middle_category','id='.$this->m_value['target'],$data);
			}			
			$this->Search('kdn_middle_category','image_path','id='.$this->m_value['target']);
			$res = $this->getOneRow();
			if($res){
				$this->m_value['image_path'] = $res['image_path'];
				if($this->m_value['image_path'] == ''){
					$this->m_value['image_path_status'] = 'アップロード画像なし';
				}else{
					$this->m_value['image_path_status'] = 'アップロード済'
					.'　<a href="javascript:void(0);" onclick="changeMode(0);">[削除]</a>';
				}
			}
		}

		if(axts('mode',$this->m_value) == 'edit'){
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
		if(count($msg)== 0){
			$condition = " large_category_id=".axts('large_category_id',$this->m_value)
							." and middle_category_name ='".axts('middle_category_name',$this->m_value)."'"
							." and id <> ".$this->m_value['target'];
			$this->Search('kdn_middle_category','*',$condition);
			if($this->getNumCount() == 1)	$msg[] = $G_VALIDATE_MESSAGE['val023'];
		}
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	
	private function _regist(){
/*		$condition = 'large_category_id = '.$this->m_value['large_category_id'];
		$this->Search('kdn_middle_category','max(order_of_row) as order_of_row',$condition);
		$res = $this->getOneRow();
		$order_of_row = ($res['order_of_row'] == '0') ? 1 : ($res['order_of_row'] + 1); 
		$this->m_value['order_of_row'] = $order_of_row; 
*/
		$this->m_value['id'] = $this->m_value['target'];
		$this->Edit('kdn_middle_category', 'id='.$this->m_value['target'],$this->m_value);
	}

	private function _upload(){
		if(!axts('image_path', $_FILES))	return null;
		if($_FILES['image_path']['error'] != 0)		return null;
		if($this->m_value['top_category_type'] == '')		return null;
		$fname = $this->m_value['top_category_type'].'_';
		$fname .= $this->m_value['large_category_id'].'_';
		$fname .= $this->m_value['target'].'_images';
		$this->m_objFiles->ini_setting($_FILES['image_path'],1,UPLOAD_DIR_MIDDLE_CATEGORY,$fname);
		return $this->m_objFiles->validate();
	}
	
	private function _to_regist(){
		global $G_VALIDATE_MESSAGE;
		$msg = $this->_validate();
		if($msg == ''){
			$upmsg = '';
			$res = $this->_upload();
			if($res != null) {
				$upmsg = $res[0];
				$uppath = $res[1];
				if($upmsg == ''){
					$this->m_value['image_path'] = $uppath;
					$this->_regist();
					header("location: completion.php?mn=G01&ms=inf002");
					exit;
				}else{
					$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($upmsg);
				}
			}else{
				$this->m_value['image_path'] = '';
				$this->_regist();
				header("location: completion.php?mn=G01&ms=inf002");
				exit;
			}
		}else{
			$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
		}
	}
	
	public function _getData($id){
		if(!$id)	return false;
		$condition = 'id='.$id;
		$this->Search('kdn_middle_category','*',$condition);
		$res = $this->getOneRowObject();
		$this->m_value['large_category_id'] = $res->large_category_id;
		$this->m_value['middle_category_name'] = $res->middle_category_name;
		$this->m_value['series_name'] = $res->series_name;
		$this->m_value['image_path'] = $res->image_path;
		$this->m_value['order_of_row'] = $res->order_of_row;
		if($this->m_value['image_path'] == ''){
			$this->m_value['image_path_status'] = 'アップロード画像なし';
		}else{
			$this->m_value['image_path_status'] = '<div class="left pd-left20 pd-top6">アップロード済</div>'
			.'　<div class="left"><a href="javascript:void(0);" onclick="changeMode(0);"><img src="common/images/batsu.png" alt="×" width="32" height="28" class="png" /></a></div>';
		}
	}

}
new a1121();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>