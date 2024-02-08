<?php

require_once('./include/ProcessStart.inc');

class Base{

	var $m_objDB;
	var $m_vARGV;
	var $m_objValidate;
	var $m_objCommon;
	var $m_value = array();
	var $m_sql_dump = array();
	
	public function Base(){

		$this->m_objDB = new MyDBAccess();
		$this->m_objDB->my_connect();
		
		$this->m_objValidate = new Validate();
		$this->m_objTemplate = new Template();
		$this->m_objCommon = new Common();
		$this->m_objCSV = new CSVCreate();
		$this->m_objFiles = new Files();
		
		$this->m_vARGV = $this->m_objValidate->escapeTagALL($_POST);
		$this->m_vARGV = $this->m_objValidate->escapeTagALL($_GET,$this->m_vARGV);

		if(aexists2(S_KEY11,S_KEY99,$_SESSION)){
			$this->m_carried = (axts('admin_user_id', $_SESSION[S_KEY11][S_KEY99])) ? $_SESSION[S_KEY11][S_KEY99]['admin_user_id'] : null;
		}
		$this->Action();

		/*
		foreach($_POST AS $key => $value ){
			$this->m_vARGV[$key] = $value;
		}
		foreach($_GET AS $key => $value ){
			$this->m_vARGV[$key] = $value;
		}
		*/	
	}
	
	public function Action(){
		while(list($key, $val) = each($this->m_value)){
			if($val == NULL) $this->m_value[$key] = "";
		}
		print $this->Show();
		$this->_afterAction();
		$this->m_objDB->my_disconnect();
	}
	
	public function Show(){
	}
	
	public function getConnection(){
		return $this->m_objDB;
	}
	
	public function initValue($form_elements){
		if(!is_array($form_elements)){
			return;
		}
		foreach($form_elements as $k=>$v){
			$this->m_value[$k] = (aexists($k,$this->m_vARGV)) ? $this->m_vARGV[$k] : $v;
		}
	}
	
	public function getViewHTML($class_name){
		$template = "";
		$page = array('index');
		if(!in_array($class_name, $page)){
			$template .= $this->m_objTemplate->load_file(PATH_TEMPLATE.DS.'/globalheader.tpl');
			$template .= $this->m_objTemplate->load_file(PATH_TEMPLATE.DS.$class_name.'.tpl');
			$template .= $this->m_objTemplate->load_file(PATH_TEMPLATE.DS.'globalfooter.tpl');
		}else{
			$template .= $this->m_objTemplate->load_file(PATH_TEMPLATE.DS.$class_name.'.tpl');
		}
		return $template;
	}

	public function transaction_begin(){
		$this->Query('BEGIN');
	}

	public function transaction_commit(){
		$this->Query('COMMIT');
	}

	public function transaction_rollback(){
		$this->Query('ROLLBACK');
	}

	public function toComplete($mcode){
		$_SESSION[S_KEY10][S_KEY21]['mcode'] = $mcode;
		$_SESSION[S_KEY10][S_KEY20] = array();
	}
	
	public function toChange($page,$pageno){
		$nowpage = THIS_DOMAIN.$page;
		$_SESSION[S_KEY10][S_KEY21]['returnpage'] = $nowpage;
		$_SESSION[S_KEY10][S_KEY21]['pageno'] = $pageno;
	}
	
	public function Add($table, $values=null){
		$query = $this->_insert_query($table, $values);		
		$this->m_objDB->exec($query);		
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = mysql_error();
	}
	
	public function Inserts($table, $condition=null){
		$query = $this->_inserts($table, $condition);		
		$this->m_objDB->exec($query);		
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = mysql_error();
	}

	public function Edit($table, $condition='', $values){
		$query = $this->_update_query($table,$condition, $values);
		$this->m_objDB->exec($query);
		$error = mysql_error();		
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function Delete($table, $condition){
		$query = $this->_delete_query($table,$condition);		
		$this->m_objDB->exec($query);		
		$error = mysql_error();		
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}
	
	public function Search($table, $field = '*', $condition='', $order='', $groupby='', $limit=''){
		$query = $this->_select_query($table, $field, $condition, $order, $groupby,$limit);		
		$this->m_objDB->exec($query);
		$error = mysql_error();		
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function Query($query){
		if($query == "")	return;		
		$this->m_objDB->exec($query);
		$error = mysql_error();		
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function getNumCount(){
		$result = $this->m_objDB->getResult();
		$count = ($result != false) ? mysql_num_rows($result) : 0;
		return $count;
	}

	public function getOneRow(){
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		return mysql_fetch_array($result,MYSQL_ASSOC);
	}

	public function getOneRowObject(){
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		return mysql_fetch_object($result);
	}

	public function fetchCount($table, $condition=''){
		$this->Search($table, "count(*) as count", $condition);
		$result = $this->m_objDB->getResult();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = ($result != false) ? $row['count'] : null;
		return $count;
	}
	
	public function uniqueCheck($table,$condition){
		$this->Search($table, '*', $condition);
		if($this->getNumCount() == 1)		return true;
		return false;
	}
	
	public function clearSession($key1, $key2=NULL){
		if(($key1) and ($key2)){
			$_SESSION[$key1][$key2] = array();
		}elseif(($key1) and (!$key2)){
			$_SESSION[$key1] = array();
		}
	}
	
	public function getStatusTable($table){
		$query = "SHOW TABLE STATUS LIKE '".$table."'";
		$this->Query($query); 
        $res = $this->getOneRowObject();
		return $res;
	}
	
	public function getNextId($status){
		if(!$status)	return null;
		return $status->Auto_increment;
	}

	public function makeList($table, $field, $condition='',$order=' id asc'){
		$list = array();
		if(count($field) != 2)		return $list;
		if($field[0] != 'id') 		return $list;
		$fields = implode(",", $field);
		$this->Search($table, $fields, $condition, $order);
		$result = $this->m_objDB->getResult();
		if(!$result)	return $list;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$list[$row[$field[0]]] = $row[$field[1]];
		}
		return $list;
	}
	
	public function makeList_middle_series($table, $field, $condition='',$order=' id asc'){
		$list = array();
		if($field[0] != 'id') 		return $list;
		$fields = implode(",", $field);
		$this->Search($table, $fields, $condition, $order);
		$result = $this->m_objDB->getResult();
		if(!$result)	return $list;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$list[$row[$field[0]]] = $row[$field[1]].' / '.$row[$field[2]];
		}
		return $list;
	}

	private function _insert_query($table, $insert_values = null){
		if($table == '')	return;
		$construct = $this->_getConstruct($table);
		if(!is_array($construct))	return;
		$query = "INSERT INTO ".$table." (";
		$val = array();
		$ins_values = ($insert_values == array()) ? $_SESSION[S_KEY10][S_KEU20] : $insert_values;
		$today = date("Y-m-d H:i:s");
		
		if(!aexists('carried',$ins_values)){
			$ins_values['carried'] = $this->m_carried;
		}
		foreach($construct as $k=>$v){
			if(!aexists($v['Field'],$ins_values))	continue;
			if($v['Field'] != 'id'){
				$fields[] =  $v['Field'];
				if(($v['Field'] == 'created') or ($v['Field'] == 'modified')){
					$val[] =  $today;
				}elseif($v['Field'] == 'carried'){
					$val[] = aexists($v['Field'], $ins_values) ? $ins_values[$v['Field']] : ' ';
				}else{
					if(is_array($ins_values[$v['Field']])){
						$va = array_keys($ins_values[$v['Field']]);
						$val[] = implode(",", $va);
					}else{
						$val[] = $ins_values[$v['Field']];
					}
				}
			}				
		}
		$query .= implode(",", $fields);
		$query .= " ) VALUES ( '";
		$query .= implode("','", $val);
		$query .= "')";
		return $query;
	}

	private function _inserts($table, $condition = ""){
		if($table == '')	return;
		$construct = $this->_getConstruct($table);
		if(!is_array($construct))	return;
		$query = "INSERT INTO ".$table." (";
		foreach($construct as $k=>$v){
			if($v['Field'] != 'id') $fld[] = $v['Field'];
		}
		$flds = implode(",", $fld);	
		$query .= $flds.") SELECT ".$flds." FROM ".$table." WHERE ".$condition;
		return $query;	
	}

	private function _update_query($table, $condition = '', $update_values = array()){
		if($table == "")	return;
		$construct = $this->_getConstruct($table);
		if(!is_array($construct))	return;
		$query = "UPDATE ".$table." SET ";
		$val = array();
		$cond = "";
		$ins_values = ($update_values == array()) ? $_SESSION[S_KEY10][S_KEY20] : $update_values;
		$today = date("Y-m-d H:i:s");
		if(!aexists('carried',$ins_values)){
			$ins_values['carried'] = $this->m_carried;
		}
		foreach($construct as $k=>$v){
			if(($v['Field'] != 'id') and ($v['Field'] != 'created')){
				if($v['Field'] == 'modified'){
					$val[] =  "modified ='".$today."'";
				}elseif($v['Field'] == 'carried'){
					$val[] = "carried = '".(aexists($v['Field'], $ins_values) ? $ins_values[$v['Field']] : 'a')."'";
				}elseif($v['Field'] == 'admin_user_id'){
					$val[] = "admin_user_id = '".(aexists('admin_user_id', $ins_values) ? $ins_values['admin_user_id'] : '')."'";
				}else{
					if(aexists($v['Field'], $ins_values)){
						$val[] = $v['Field']."='".get_keys($ins_values[$v['Field']])."'";
					}
				}
			}				
			if(($v['Field'] == 'id') and (aexists($v['Field'], $ins_values))){
				$cond = ($condition != "") ? $condition : "id=".$ins_values['id'];
			}
		}
		if($cond == "" )	return;
		$query .= implode(',', $val);
		$query .= ($cond != '') ? ' WHERE '.$cond : '';
		return $query;
	}

	private function _delete_query($table, $condition){
		if($table == "")	return;
		if($condition == "" )	return;
		$query = "DELETE FROM  ".$table;
		$query .= " WHERE ".$condition;
		return $query;
	}
	
	private function _select_query($table, $field = '*', $condition='', $order='', $groupby='', $limit=''){
		if($table == "")	return;
		$query = "SELECT ".$field." FROM ".$table;
		$query .= ($condition != "" ) ? " WHERE ".$condition : '';
		$query .= ($order != "" ) ? " ORDER BY ".$order : '';
		$query .= ($groupby != "" ) ? " GROUP BY ".$groupby : '';
		$query .= ($limit != "" ) ? " LIMIT ".$limit : '';
		return $query;
	}

	private function _getConstruct($table){
		if($table == "")	return;
		$construst = array();
		$query = "SHOW COLUMNS FROM ".$table;
		$this->m_objDB->exec($query);
		while($row = mysql_fetch_array($this->m_objDB->getResult(),MYSQL_ASSOC)){
			$construct[] = $row;	
		}
		return $construct;
	}
	
	public function pushValueFromARGV(){
		if(!is_array($this->m_vARGV))	return;
		if(count($this->m_vARGV) == 0)	return;
		foreach($this->m_vARGV as $k=>$v){
			if(!aexists($k,$this->m_value)){
				if(!is_array($v)){
					$this->m_value[$k] = $v;
				}else{
					foreach($v as $k1=>$v1){
						$this->m_value[$k][$k1] = $v1;
					}
				}
			}		
		}
	}

	public function pushValueFromARGV2(){
		if(!is_array($this->m_vARGV))	return;
		if(count($this->m_vARGV) == 0)	return;
		foreach($this->m_vARGV as $k=>$v){
			if(!is_array($v)){
				$this->m_value[$k] = $v;
			}else{
				foreach($v as $k1=>$v1){
					$this->m_value[$k][$k1] = $v1;
				}
			}
		}
	}

	public function makeMessage(){
		global $G_INFO_MESSAGE, $G_ERROR_MESSAGE;
		$announce = "";
		$mcode = $_SESSION[S_KEY10][S_KEY21]['mcode'];
		$announce = (aexists($mcode, $G_INFO_MESSAGE))
						? $G_INFO_MESSAGE[$mcode]
						: (((aexists($mcode, $G_ERROR_MESSAGE)))
							? $G_ERROR_MESSAGE[$mcode]
							:""	); 
		return $announce;		
	}
	
	public function fetchRows($db_result){
		$list = array();
		if(!$db_result)		return $list;
		while($row = mysql_fetch_array($db_result,MYSQL_ASSOC)){
			$list[] = $row;
		}
		return $list;
	}
	
	public function getTopCategoryTypeName($param){
		if(strlen($param) < 2)		return null;
		global $TOP_CONTENTS;
		$k = array_keys($TOP_CONTENTS);
		$type = substr($param,0,1);
		if(in_array($type,$k)){
			return array($type,$TOP_CONTENTS[$type]);
		}
		return null;		
	}
	
	function calcTax($value){
		if($this->m_objValidate->isNull($value))	return null;
		if(!$this->m_objValidate->isNumber($value))	return null;
		if($value == 0)		return 0;
		$res = 0;
		switch (TAX_CAL){
			case 1:
				$res = ceil($value * TAX_RATE);
				break;
			case 2:
				$res = round($value * TAX_RATE);
				break;
			case 3:
				$res = floor($value * TAX_RATE);
				break;
		}
		return $res;
	}
	
	public function upload_image($ctl_name, $cnt, $dir, &$values,$new_fname){
		$control = $ctl_name.$cnt;
		$upload_result = array('','');
		if(aexists($control,$_FILES)){		
			if(axts('error',(axts($control, $_FILES))) == 0){
				$this->m_objFiles->ini_setting($_FILES[$control],'1',array($dir,$values['anken_no']),$new_fname);
				$upload_result = $this->m_objFiles->validate();
				if($upload_result[0] == ''){
					$src = $upload_result[1];
					
					$values[$control] = '<img src="'.$src.'"><br />';
					$values['path'.$cnt] = $upload_result[1];
					$values['ext'.$cnt] = $upload_result[2];
					$values['filesize'.$cnt] = $upload_result[3];
				}
			}
		}
		return $upload_result[0];
	}
	
	public function upload_image_order_company($ctl_name, $cnt, $dir, &$values,$new_fname){
		$control = $ctl_name.$cnt;
		$upload_result = array('','');
		if(aexists($control,$_FILES)){
			if(axts('error',(axts($control, $_FILES))) == 0){
				$this->m_objCFiles->ini_setting($_FILES[$control],'1',$dir,$new_fname);
				$upload_result = $this->m_objCFiles->validate();
				if($upload_result[0] == ''){
					$src = $upload_result[1];
					
					$values[$control] = '<img src="'.$src.'"><br />';
					$values['path'.$cnt] = $upload_result[1];
					$values['ext'.$cnt] = $upload_result[2];
					$values['filesize'.$cnt] = $upload_result[3];
				}
			}
		}
		return $upload_result[0];
	}
	
	public function choiceLink($param){
		if(!defined($param))		return false;
		$res = '';
		switch($param){
			case 'G01':
				$res = CSS_PATH.DS.'menu_g01.css';
				break;
			case 'G02':
				$res = CSS_PATH.DS.'menu_g02.css';
				break;
			case 'G03':
				$res = CSS_PATH.DS.'menu_g03.css';
				break;
			case 'G04':
				$res = CSS_PATH.DS.'menu_g04.css';
				break;
			case 'G05':
				$res = CSS_PATH.DS.'menu_g05.css';
				break;
		}
		return $res;
	}
	
	public function makeFormLargeCategory(){
		$list = $this->makeList('kdn_large_category', array('id','large_category_name'), '');
		$select_large_category_id = axts('large_category_id',$this->m_value,'');
		$this->m_value['option_large_category_id'] = $this->m_objCommon->makeOption($list,$select_large_category_id);
		if(axts('large_category_id', $this->m_value)){
			if(in_array($this->m_value['large_category_id'], array_keys($list))){
				$top = $this->getTopCategoryTypeName($list[$this->m_value['large_category_id']]);
				$this->m_value['top_category_type'] = $top[0];
				$this->m_value['top_category_name'] = $top[1];
			}
		}else{
			$this->m_value['top_category_type'] = '';
			$this->m_value['top_category_name'] = '';
		}
		return $select_large_category_id;
	}
	
	public function makeFormMiddleCategory(){
		$list = $this->makeList('kdn_middle_category', array('id','middle_category_name'), '', 'order_of_row ASC');
		$select_middle_category_id = axts('middle_category_id',$this->m_value,'');
		$this->m_value['option_middle_category_id'] = $this->m_objCommon->makeOption($list,$select_middle_category_id);
	}

	public function delete_m($target){
		if($this->m_objValidate->isNull($target))	return null;
		$condition = 'middle_category_id='.$target;
		$this->Search('kdn_products','*',$condition);
		if($this->getNumCount() > 0)	return false;
		
		$condition = 'id='.$target;
		$this->Search('kdn_middle_category','*',$condition);
		$res = $this->getOneRow();
		if(!$res)	return null;
		$l_id = $res['large_category_id'];
		$order_of_row = $res['order_of_row'];
		$condition1 = 'large_category_id='.$l_id;
		$this->Search('kdn_middle_category','*',$condition1);
		$row = $this->getNumCount();
		$this->_change_order($row,$order_of_row,'kdn_middle_category',$condition1);
		$this->Delete('kdn_middle_category','id='.$target);
		return null;
	}
	
	public function down_m($large_category_id,$target_id,$target_order){
		//if($target_order == 1)	return null;
		if(!$this->m_objValidate->isNumber((int)$target_order))		return null;
		if($this->m_objValidate->isNull($large_category_id))	return null;
		if($this->m_objValidate->isNull($target_id))	return null;
		$up_order = $target_order + 1;
		$down_order = $target_order - 1;
		$condition = 'large_category_id ='.$large_category_id.' and order_of_row = '.$up_order;
		$this->Search('kdn_middle_category','id,order_of_row',$condition);
		$res = $this->getOneRow();
		$query = 'UPDATE kdn_middle_category SET order_of_row='.$target_order.' WHERE id='.$res['id'];
		$this->Query($query);
		$query = 'UPDATE kdn_middle_category SET order_of_row='.$up_order.' WHERE id='.$target_id;
		$this->Query($query);
	}
	
	public function up_m($large_category_id,$target_id,$target_order){
		if($target_order == 1)	return null;
		if(!$this->m_objValidate->isNumber((int)$target_order))		return null;
		if($this->m_objValidate->isNull($large_category_id))	return null;
		if($this->m_objValidate->isNull($target_id))	return null;
		$up_order = $target_order + 1;
		$down_order = $target_order - 1;
		$condition = 'large_category_id ='.$large_category_id.' and order_of_row = '.$down_order;
		$this->Search('kdn_middle_category','id,order_of_row',$condition);
		$res = $this->getOneRow();
		$query = 'UPDATE kdn_middle_category SET order_of_row='.$target_order.' WHERE id='.$res['id'];
		$this->Query($query);
		$query = 'UPDATE kdn_middle_category SET order_of_row='.$down_order.' WHERE id='.$target_id;
		$this->Query($query);
	}

	public function delete_p($target){
		if($this->m_objValidate->isNull($target))	return null;
		$condition = 'id='.$target;
		$this->Search('kdn_products','*',$condition);
		$res = $this->getOneRow();
		if(!$res)	return null;
		$l_id = $res['large_category_id'];
		$m_id = $res['middle_category_id'];
		$order_of_row = $res['order_of_row'];
		$condition1 = 'large_category_id='.$l_id.' and middle_category_id='.$m_id;
		$this->Search('kdn_products','*',$condition1);
		$row = $this->getNumCount();
		$this->_change_order($row,$order_of_row,'kdn_products',$condition1);
		$this->Delete('kdn_products',$condition);
	}
	
	/*
	 * @param $rows   更新対象件数 （conditionにマッチする件数）
	 * @param $order_of_row　更新対象開始order_of_row
	 * @param $table　テーブル名
	 * @param $condition 更新対象の条件
	 */
	private function _change_order($rows,$order_of_row,$table,$condition){
		$start_rows = $order_of_row+1;
		for($start=$start_rows; $start<=$rows; $start++){
			$r = $start-1;
			$cond = $condition.' and order_of_row='.$start;
			$this->Search($table,'*',$cond);
			if($this->getNumCount() != 1)	continue;
			$query = 'UPDATE '.$table.' SET order_of_row='.$r.' WHERE '.$cond;
			$this->Query($query);
		}
	}
	
	public function down_p($large_category_id,$middle_category_id,$target_id,$target_order){
		//if($target_order == 1)	return null;
		if(!$this->m_objValidate->isNumber((int)$target_order))		return null;
		if($this->m_objValidate->isNull($target_id))	return null;
		if($this->m_objValidate->isNull($large_category_id))	return null;
		if($this->m_objValidate->isNull($middle_category_id))	return null;
		$up_order = $target_order + 1;
		$down_order = $target_order - 1;
		$condition = 'large_category_id ='.$large_category_id;
		$condition .= ' and middle_category_id ='.$middle_category_id;
		$condition .= ' and order_of_row = '.$up_order;
		$this->Search('kdn_products','id,order_of_row',$condition);
		$res = $this->getOneRow();
		$query = 'UPDATE kdn_products SET order_of_row='.$target_order.' WHERE id='.$res['id'];
		$this->Query($query);
		$query = 'UPDATE kdn_products SET order_of_row='.$up_order.' WHERE id='.$target_id;
		$this->Query($query);
	}
	
	public function up_p($large_category_id,$middle_category_id,$target_id,$target_order){
		if($target_order == 1)	return null;
		if(!$this->m_objValidate->isNumber((int)$target_order))		return null;
		if($this->m_objValidate->isNull($target_id))	 return null;
		if($this->m_objValidate->isNull($large_category_id))	return null;
		if($this->m_objValidate->isNull($middle_category_id))	return null;
		$up_order = $target_order + 1;
		$down_order = $target_order - 1;
		$condition = 'large_category_id ='.$large_category_id;
		$condition .= ' and middle_category_id ='.$middle_category_id;
		$condition .= ' and order_of_row = '.$down_order;
		$this->Search('kdn_products','id,order_of_row',$condition);
		$res = $this->getOneRow();
		$query = 'UPDATE kdn_products SET order_of_row='.$target_order.' WHERE id='.$res['id'];
		$this->Query($query);
		$query = 'UPDATE kdn_products SET order_of_row='.$down_order.' WHERE id='.$target_id;
		$this->Query($query);
	}
	
	/**
	 * @param $addnew_flg	'1' 新規　/ '2' 編集
	 * @param $target_id    編集のID
	 **/
	public function validate_member($addnew_flg = '1',$target_id=null){
		global $G_VALIDATE_MESSAGE;
		if(($addnew_flg == '2') and ($target_id)){
			$this->Search('kdn_member','*',"id =".$target_id." and status <> ".MEMBERSHIP3);
			if($this->getNumCount() != 1){
				return $G_VALIDATE_MESSAGE['val027'];
			}
		}elseif(($addnew_flg == '2') and ($target_id == null)){
			return $G_VALIDATE_MESSAGE['val027'];
		}
		
		$msg = array();
		// company_name val002
		if($this->m_objValidate->isNull($this->m_value['company_name'])){
			$msg[] = $G_VALIDATE_MESSAGE['val002'];
/*
		}else{
			if($addnew_flg == '1'){ 
				$this->Search('kdn_member','*',"company_name ='".$this->m_value['company_name']."' and status <> ".MEMBERSHIP3);
				if($this->getNumCount() == 1){
					$msg[] = $G_VALIDATE_MESSAGE['val016'];
				}
			}elseif($addnew_flg == '2'){
				$this->Search('kdn_member','*',"company_name ='".$this->m_value['company_name']."' and status <> ".MEMBERSHIP3." and id <> ".$target_id);
				if($this->getNumCount() == 1){
					$msg[] = $G_VALIDATE_MESSAGE['val016'];
				}
			}
*/
		}
		// zip val009
		$zip = $this->m_value['zip1'].$this->m_value['zip2'];
		if($this->m_objValidate->isNull($zip)){
			$msg[] = $G_VALIDATE_MESSAGE['val009'];
		}elseif(!$this->m_objValidate->chkNo($zip)){
			$msg[] = $G_VALIDATE_MESSAGE['val014'];
		}
		// pref val0015 address1 val015
		if(($this->m_objValidate->isNull($this->m_value['pref'])) or ($this->m_objValidate->isNull($this->m_value['address1']))){
			$msg[] = $G_VALIDATE_MESSAGE['val015'];
		}
		// tel val010
		if(!$this->m_objValidate->chkNo($this->m_value['telno'])){
			$msg[] = $G_VALIDATE_MESSAGE['val010'];
		}
		// fax val012
		if(!$this->m_objValidate->isNull($this->m_value['faxno'])){
			if(!$this->m_objValidate->chkNo($this->m_value['faxno'])){
				$msg[] = $G_VALIDATE_MESSAGE['val012'];
			}
		}
		// section
		// charge_name val006
		if($this->m_objValidate->isNull($this->m_value['charge_name'])){
			$msg[] = $G_VALIDATE_MESSAGE['val006'];
		}
		// email_address val004
		if(!$this->m_objValidate->chk_email($this->m_value['email_address'])){
			$msg[] = $G_VALIDATE_MESSAGE['val004'];
		}else{
			if($addnew_flg == '1'){ 
				$this->Search('kdn_member','*',"email_address ='".$this->m_value['email_address']."' and status = ".MEMBERSHIP2);
				if($this->getNumCount() == 1){
					$msg[] = $G_VALIDATE_MESSAGE['val008'];
				}
			}elseif($addnew_flg == '2'){
				$this->Search('kdn_member','*',"email_address ='".$this->m_value['email_address']."' and status = ".MEMBERSHIP2." and id <> ".$target_id);
				if($this->getNumCount() == 1){
					$msg[] = $G_VALIDATE_MESSAGE['val008'];
				}
			}
		}
		return $msg;
	}
	
	public function change_withdrawal($target_id){
		if($this->m_objValidate->isNull($target_id))		return false;		
		if(!$this->m_objValidate->isNumber($target_id))		return false;
		$edit = array(
			'id' => $target_id,
			'status' => MEMBERSHIP3,
			'withdrawal_registration' => date('Y-m-d H:i:s'),
		);		
		$this->Edit('kdn_member','id='.$target_id,$edit);
	}
	
	/*
	 * @param	$target_name	control name
	 * @param	$get_flg	(default)false/ true $_GET
	 */
	public function checkParamId($target_name){
		$v = null;
		if((!axts($target_name,$_GET)) and (!axts($target_name,$this->m_value))){
			return false;
		}elseif((axts($target_name,$_GET)) and (!axts($target_name,$this->m_value))){	
			$v = $_GET[$target_name];
		}else{	
			$v = $this->m_value[$target_name];
		}
		if($this->m_objValidate->isNull($v))	return false;
		if(!$this->m_objValidate->isNumber($v))	return false;
		if($v == 0)	return false;
		return $v;
	}
	public function member_info($id){
		if(!$id)	return null;
		$condition = "id=".$id;
		$this->Search('kdn_member','*',$condition);
		if($this->getNumCount() != 1)	return false;
		return $this->getOneRow();
	}	
	public function inquiry_guest_info($id){
		if(!$id)	return null;
		$condition = "id=".$id;
		$this->Search('kdn_inquiry_history','*',$condition);
		if($this->getNumCount() != 1)	return false;
		return $this->getOneRow();
	}
	
	public function replace_upload_fname($products_name){
		if(empty($products_name))	return $products_name;
		//$pname = htmlspecialchars_decode($products_name);
		$search = array('/','\\',':','*','?','"','<','>','|','#','{','}','%','&','~');
		$replace = '_';
		foreach($search as $needle){
			$products_name = str_replace($needle,$replace,$products_name);
		}
		return $products_name;
	}
	
	private function _log_db($query,$err){
		_log($query,true);
		_log($err,true);
	}

	private function _afterAction(){
		if(G_SYS_TEST == true)	return;
/*
		$sql = implode("<br />", $this->m_sql_dump);
		
		echo "<div align=left><br><hr>[ ***** For Test ***** ]<hr><pre>";

		echo "[STACK TRACE]<br>";
		debug_print_backtrace();
		echo "<hr>[SQL DUMP]<br>";
		echo $sql;
		echo "<hr>[POST]<br>";
		var_export($_POST);

		echo "<hr>[SESSION]<br>";
		var_export($_SESSION);
		
		echo "<hr>[GET]<br>";
		var_export($_GET);
		echo "<hr>[FILE]<br>";
		var_export($_FILES);

 		echo "<hr>[value]<br>";
		var_export($this->m_value);

		echo "</pre></div>";
*/		
	}
}
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>