<?php

class Base{

	var $m_objDB;
	var $m_vARGV;
	var $m_objValidate;
	var $m_objCommon;
	var $m_value = array();
	var $m_alert = array();
	var $m_sql_dump = array();

	public function Base(){

		$this->m_objDB = new MyDBAccess();
		$this->m_objDB->my_connect();
		if (is_null($this->m_objDB->mDB)) {
			// DBに接続できない時はアクション中止
			return;
		}

		$this->m_objValidate = new Validate();
		$this->m_objTemplate = new Template();
		$this->m_objCommon = new Common();
		$this->m_objCSV = new CSVCreate();
		$this->m_objFiles = new Files();
		$this->m_objMail = new MemberMail();

		$this->m_vARGV = $this->m_objValidate->escapeTagALL($_POST);
		$this->m_vARGV = $this->m_objValidate->escapeTagALL($_GET,$this->m_vARGV);

		if(aexists2(S_KEY11,S_KEY99,$_SESSION)){
			$this->m_carried = (axts('admin_user_id', $_SESSION[S_KEY11][S_KEY99])) ? $_SESSION[S_KEY11][S_KEY99]['admin_user_id'] : null;
		}
		$this->Action();
	
	}

	public function Action(){
		//while(list($key, $val) = each($this->m_value)){
		foreach($this->m_value as $key=>$val){
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
		$this->set_link();
	}

	public function getViewHTML($class_name,$path){
		$template = "";
		$page = array('index');
		if(!in_array($class_name, $page)){
			$template .= $this->m_objTemplate->load_file($path.DS.'common_header.tpl');
			$template .= $this->m_objTemplate->load_file($path.DS.$class_name.'.tpl');
			$template .= $this->m_objTemplate->load_file($path.DS.'common_footer.tpl');
		}else{
			$template .= $this->m_objTemplate->load_file($path.DS.$class_name.'.tpl');
		}
		return $template;
	}

	public function getViewHTML_no($class_name,$path){
		$template = "";
		$template .= $this->m_objTemplate->load_file($path.DS.$class_name.'.tpl');
		$this->set_link();
		return $template;
	}

	public function set_link(){
		// member/index
		$this->m_value['this_root_url_member'] = THIS_ROOT_URL_MEMBER;
		// 会員　本登録用アクセスURL  member/this_registration
		$this->m_value['this_registration_url'] = THIS_REGISTRATION_URL;
		// 会員　編集用URL member/edit.php
		$this->m_value['member_edit_url'] = MEMBER_EDIT_URL;
		// 会員  退会URL  member/confirm_withdraw
		$this->m_value['member_withdraw_url'] = MEMBER_WITHDRAW_URL;
		// 会員　ログイン  member/index
		$this->m_value['member_login_url'] = MEMBER_LOGIN_URL;
		// 会員　新規登録  member/addnew
		$this->m_value['member_regist_url'] = MEMBER_REGIST_URL;

		// contact/index
		$this->m_value['this_root_url_contact'] = THIS_ROOT_URL_CONTACT;
		// contact/inquiry_guest
		$this->m_value['this_root_url_contact_guest'] = THIS_ROOT_URL_CONTACT_GUEST;

		// opt/index
		$this->m_value['this_root_url_opt'] = THIS_ROOT_URL_OPT;
		// opt/sample/index
		$this->m_value['this_root_url_opt_sample'] = THIS_ROOT_URL_OPT_SAMPLE;
		// オプトエレクトロニクスダウンロードコンテンツ opt/download/index
		$this->m_value['this_root_url_opt_download'] = THIS_ROOT_URL_OPT_DOWNLOAD;
		// オプトサンプル機貸出 opt/sample/index
		$this->m_value['this_root_url_opt_sample'] = THIS_ROOT_URL_OPT_SAMPLE;

		// power/index
		$this->m_value['this_root_url_power'] = THIS_ROOT_URL_POWER;
		// パワーエレクトロニクスダウンロードコンテンツ  power/download/index
		$this->m_value['this_root_url_power_download'] = THIS_ROOT_URL_POWER_DOWNLOAD;


	}

	public function getViewTPL($path){
		$template = '';
		$template .= $this->m_objTemplate->load_file($path);
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
		$error = $this->m_objDB->getErrorInfo();
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
		$this->_log_db($query,$error);
	}

	public function Inserts($table, $condition=null){
		$query = $this->_inserts($table, $condition);
		$this->m_objDB->exec($query);
		$error = $this->m_objDB->getErrorInfo();
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function Edit($table, $condition='', $values){
		$query = $this->_update_query($table,$condition, $values);
		$this->m_objDB->exec($query);
		$error = $this->m_objDB->getErrorInfo();
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function Delete($table, $condition){
		$query = $this->_delete_query($table,$condition);
		$this->m_objDB->exec($query);
		$error = $this->m_objDB->getErrorInfo();
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function Search($table, $field = '*', $condition='', $order='', $groupby='', $limit=''){
		$query = $this->_select_query($table, $field, $condition, $order, $groupby,$limit);
		$this->m_objDB->setResult($query);
		$error = $this->m_objDB->getErrorInfo();
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function Query($query){
		if($query == "")	return;
		$this->m_objDB->exec($query);
		$error = $this->m_objDB->getErrorInfo();
		$this->_log_db($query,$error);
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
	}

	public function getNumCount(){
		//$c = $this->m_objDB->fetchColumn();
		//$count = ($result != false) ? mysql_num_rows($result) : 0;
		$count = $this->m_objDB->getCount();
		return $count;
	}

	public function getOneRow(){
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		//return mysql_fetch_array($result,MYSQL_ASSOC);
		return $result[0];
	}

	/*public function getOneRowObject(){
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		return mysql_fetch_object($result);
	}*/

	/*public function fetchCount($table, $condition=''){
		$this->Search($table, "count(*) as count", $condition);
		$result = $this->m_objDB->getResult();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = ($result != false) ? $row['count'] : null;
		return $count;
	}*/

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

	/*public function getStatusTable($table){
		$query = "SHOW TABLE STATUS LIKE '".$table."'";
		$this->Query($query);
        $res = $this->getOneRowObject();
		return $res;
	}*/

	/*public function getNextId($status){
		if(!$status)	return null;
		return $status->Auto_increment;
	}*/

	/*public function makeList($table, $field, $condition='',$order=' id asc'){
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
	}*/

	private function _insert_query($table, $insert_values = null){
		if($table == '')	return;
		$construct = $this->_getConstruct($table);
		if(!is_array($construct))	return;
		$query = "INSERT INTO ".$table." (";
		$val = array();
		$ins_values = ($insert_values == array()) ? $_SESSION[S_KEY10][S_KEU20] : $insert_values;
		$today = date("Y-m-d H:i:s");

		foreach($construct as $k=>$v){
			if(($v['Field'] != 'created') and ($v['Field'] != 'modified')){
				if(!aexists($v['Field'],$ins_values))	continue;
			}
			if($v['Field'] != 'id'){
				$fields[] =  $v['Field'];
				// PDO::quote
				if(($v['Field'] == 'created') or ($v['Field'] == 'modified')){
					$val[] = $this->m_objDB->mDB->quote($today);
				}elseif($v['Field'] == 'carried'){
					$carried = aexists($v['Field'], $ins_values) ? $ins_values[$v['Field']] : ' ';
					$val[] = $this->m_objDB->mDB->quote($carried);
				}else{
					if(is_array($ins_values[$v['Field']])){
						$va = array_keys($ins_values[$v['Field']]);
						$other = implode(",", $va);
					}else{
						$other = $ins_values[$v['Field']];
					}
					$val[] = $this->m_objDB->mDB->quote($other);
				}
			}
		}
		$query .= implode(",", $fields);
		$query .= " ) VALUES ( ";
		$query .= implode(",", $val);
		$query .= ")";
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
						// PDO::quote
						$val[] = $v['Field']."=".$this->m_objDB->mDB->quote( get_keys($ins_values[$v['Field']]) );
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
		//$this->m_objDB->exec($query);
		$stmt = $this->m_objDB->mDB->query($query);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//while($row = mysql_fetch_array($this->m_objDB->getResult(),MYSQL_ASSOC)){
		foreach($result as $row){
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

	/*public function fetchRows($db_result){
		$list = array();
		if(!$db_result)		return $list;
		while($row = mysql_fetch_array($db_result,MYSQL_ASSOC)){
			$list[] = $row;
		}
		return $list;
	}*/

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

	/*public function makeFormLargeCategory(){
		$list = $this->makeList('kdn_large_category', array('id','large_category_name'), '');
		$select_large_category_id = axts('large_category_id',$this->m_value,'');
		$this->m_value['option_large_category_id'] = $this->m_objCommon->makeOption($list,$select_large_category_id);
		if(axts('large_category_id', $this->m_value)){
			if(in_array($this->m_value['large_category_id'], array_keys($list))){
				$top = $this->getTopCategoryTypeName($list[$this->m_value['large_category_id']]);
				$this->m_value['top_category_type'] = $top[0];
				$this->m_value['top_category_name'] = $top[1];
			}
		}
		return $select_large_category_id;
	}

	public function makeFormMiddleCategory(){
		$list = $this->makeList('kdn_middle_category', array('id','middle_category_name'), '', 'order_of_row ASC');
		$select_middle_category_id = axts('middle_category_id',$this->m_value,'');
		$this->m_value['option_middle_category_id'] = $this->m_objCommon->makeOption($list,$select_middle_category_id);
	}*/

	public function delete_m($target){
		if($this->m_objValidate->isNull($target))	return;
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
	}

	public function down_m($large_category_id,$target_id,$target_order){
		if($target_order == 1)	return null;
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
		if($target_order == 1)	return null;
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

	public function change_withdrawal($target_id){
		if($this->m_objValidate->isNull($target_id))		return false;
		if(!$this->m_objValidate->isNumber($target_id))		return false;
		$edit = array(
			'id' => $target_id,
			'status' => MEMBERSHIP3,
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

	public function createMailBodys($type,$values){
		global $MAIL_TYPE;
		if(!in_array($type,array_keys($MAIL_TYPE)))		return false;

		$path = PATH_MAIL_TEMPLATE.DS.$MAIL_TYPE[$type][1];
		$mail_template = $this->getViewTPL($path);
		$body = $this->m_objTemplate->set_value($mail_template, $values);
		return array($MAIL_TYPE[$type][0],$body);
	}

	public function get_admin_mail(){
		$this->Search('kdn_baseinfo','*');
		$res = $this->getOneRow();
		if(!$res)	return false;
		return $res['admin_mail'];
	}

	public function checkLoged(){
		if(!aexists2(S_KEY11, S_KEY99, $_SESSION)){
			return false;
		}else{
			if(aexists('member_id',$_SESSION[S_KEY11][S_KEY99])){
				if((axts('member_id',$_SESSION[S_KEY11][S_KEY99]) == '')
					or (axts('member_pwd',$_SESSION[S_KEY11][S_KEY99]) == '' ) ){
						return false;
				}
				$condition = "member_id='".$_SESSION[S_KEY11][S_KEY99]['member_id']."' and member_pwd ='".$_SESSION[S_KEY11][S_KEY99]['member_pwd']."' and status='".MEMBERSHIP2."'";
				$this->Search('kdn_member','*',$condition);
				if($this->getNumCount() != 1)	return false;
			}else{
				return false;
			}
		}
		return true;
	}

	public function logedin($id,$pwd){
		$condition = "member_id='".$id."' and member_pwd ='".$pwd."' and status='".MEMBERSHIP2."'";
		$this->Search('kdn_member','*',$condition);
		if($this->getNumCount() != 1)	return false;
		return $this->getOneRow();
	}

	public function logedin_member_info($fld=''){
		if($this->checkLoged() == true){
			$mem_info = $this->logedin($_SESSION[S_KEY11][S_KEY99]['member_id'],$_SESSION[S_KEY11][S_KEY99]['member_pwd']);
			if($mem_info == false)	return null;
			if(($fld != '') and (aexists($fld,$mem_info)))		return $mem_info[$fld];
			return $mem_info;
		}
		return null;
	}

	public function makeMailDataMemberInfo(){
		global $G_PREF_LIST;
		$str = '';
		$info = $this->logedin_member_info();
		if(is_null($info))	return $str;
		$str .= "\n御社名：";
		$str .= $info['company_name'];
		$str .= "\n郵便番号：";
		$str .= $info['zip1'].'-'.$info['zip2'];
		$str .= "\n都道府県：";
		$str .= axts($info['pref'],$G_PREF_LIST,'');
		$str .= "\nご住所：";
		$str .= $info['address1'];
		$str .= "\nTEL：";
		$str .= $info['telno'];
		$str .= "\nFAX：";
		$str .= $info['faxno'];
		$str .= "\n担当部署：";
		$str .= $info['section'];
		$str .= "\nご担当者名：";
		$str .= $info['charge_name'];
		$str .= "\nメールアドレス：";
		$str .= $info['email_address'];
		$str .= "\n備考：";
		$str .= $info['note'];
		$str .= "\n管理備考：";
		$str .= $info['admin_note'];
		return $str;
	}

	public function setFromAddress($mail_type,$pref=''){
		global $MAIL_TYPE,$G_MAIL_TO_DISTRIBUTION,$G_PREF_LIST,$G_AREA_WEST,$G_AREA_EAST,$G_ADMIN_EAST_MAIL,$G_ADMIN_WEST_MAIL;
		if(!axts($mail_type,$MAIL_TYPE))	return false;
// 2015/01/06 コメントアウト
//		if(!axts($mail_type,$G_MAIL_TO_DISTRIBUTION))	return false;
		// 問い合わせ MAIL_TYPE1
		// 貸出 MAIL_TYPE2
		// ログイン MAIL_TYPE9
		// ダウンロード MAIL_TYPE10
		$to_admin = array();
		$from = $this->get_admin_mail();
		if(!axts($mail_type,$MAIL_TYPE))		return $to_admin;
		//if(($mail_type == MAIL_TYPE3) or ($mail_type == MAIL_TYPE4) or ($mail_type == MAIL_TYPE5) or ($mail_type == MAIL_TYPE6) or ($mail_type == MAIL_TYPE7) ){
		//	$to_admin = $this->get_admin_mail();
		//	return array($from);
		//}elseif(($mail_type == MAIL_TYPE1) or ($mail_type == MAIL_TYPE2) or ($mail_type == MAIL_TYPE8) or ($mail_type == MAIL_TYPE9) or ($mail_type == MAIL_TYPE10)){
			if($G_MAIL_TO_DISTRIBUTION[$mail_type] == '1')	return array($from);
			if(in_array($pref,$G_AREA_WEST) and (!in_array($pref,$G_AREA_EAST))){
				return array($G_ADMIN_WEST_MAIL,$from);
			}elseif(!in_array($pref,$G_AREA_WEST) and (in_array($pref,$G_AREA_EAST))){
				return array($G_ADMIN_EAST_MAIL,$from);
			}elseif(in_array($pref,$G_AREA_WEST) and (in_array($pref,$G_AREA_EAST))){
				return array($G_ADMIN_EAST_MAIL,$G_ADMIN_WEST_MAIL,$from);
			}
		//}
		return $to_admin;
	}

	public function createMailSubject($mail_type,$pref,$questionnaire='',$inquiry_check='',$products='',$company=''){
		global $MAIL_TYPE,$G_MAIL_TO_DISTRIBUTION,$G_PREF_LIST;
		if(!axts($mail_type,$MAIL_TYPE))	return false;
// 2015/01/06 コメントアウト
//		if(!axts($mail_type,$G_MAIL_TO_DISTRIBUTION))	return false;
		// company_name
		$company_name = $this->logedin_member_info('company_name');
		// pref
		//$pref = $this->logedin_member_info('pref');
		$pref_name = axts($pref,$G_PREF_LIST,'');
		$subject_admin = '';
		if($mail_type == MAIL_TYPE1){
		// 問い合わせ MAIL_TYPE1 inquiry_check
			$subject_admin = "".$inquiry_check."".$company_name."様 (".$pref_name.")";
		}elseif($mail_type == MAIL_TYPE8){
		// 問い合わせ MAIL_TYPE8 inquiry_check
			$subject_admin = "".$inquiry_check."".$company."様 (".$pref_name.")";
		}elseif($mail_type == MAIL_TYPE2){
		// 貸出 MAIL_TYPE2
			$subject_admin = "【貸出】".$company_name."様 (".$pref_name.")";
		}elseif($mail_type == MAIL_TYPE9){
		// ログイン MAIL_TYPE9 アンケート1
			$subject_admin = "ログイン 【".$questionnaire."】".$company_name."様 (".$pref_name.")";
		}elseif($mail_type == MAIL_TYPE10){
		// ダウンロード MAIL_TYPE10 製品名
			$subject_admin = "【DL】【".$products."】".$company_name."様 (".$pref_name.")";
		}
		return $subject_admin;
	}

	public function products_info($products_id,$fld='',$loged_check=false){
		if(!$products_id)	return null;
		$condition = "id=".$products_id;
		if($loged_check == true){
			if($this->checkLoged() == true){
				$this->Search('kdn_products','*',$condition);
				if($this->getNumCount() != 1)	return false;
				$info = $this->getOneRow();
				if(($fld != '') and (aexists($fld,$info)))		return $info[$fld];
				return $info;
			}else{
				return null;
			}
		}else{
			$this->Search('kdn_products','*',$condition);
			if($this->getNumCount() != 1)	return false;
			$info = $this->getOneRow();
			if(($fld != '') and (aexists($fld,$info)))		return $info[$fld];
			return $info;
		}
	}

	public function products_detail_info($products_id){
		if(!$products_id)	return null;
		$condition = "P.id=".$products_id;
		$field = 'P.id,L.large_category_name,M.middle_category_name,P.products_name,M.series_name,';
		$field .= 'P.contents10,P.contents11,P.contents20,P.contents30,P.contents40';
		$table = 'kdn_products P left outer join kdn_middle_category M on P.middle_category_id=M.id ';
		$table .= ' left outer join kdn_large_category L on P.large_category_id=L.id';
		$this->Search($table,$field,$condition);
		if($this->getNumCount() != 1)	return false;
		$info = $this->getOneRow();
		return $info;
	}

	public function products_note1($pinfo){
		if(!is_array($pinfo))	return null;
		$res = array();
		$res[] = (aexists('id',$pinfo)) ? 'ID:'.$pinfo['id'] : '';
		$res[] = (aexists('large_category_name',$pinfo)) ? $pinfo['large_category_name'] : '';
		$res[] = (aexists('middle_category_name',$pinfo)) ? $pinfo['middle_category_name'] : '';
		$res[] = (aexists('series_name',$pinfo)) ? $pinfo['series_name'] : '';
		$res[] = (aexists('products_name',$pinfo)) ? $pinfo['products_name'] : '';
		return (count($res) > 0) ? implode('/',$res) : '';
	}

	public function products_note2($pinfo,$contents_name){
		global $CONTENTS_NAME;
		if(!is_array($pinfo))	return null;
		if(!in_array($contents_name,array_keys($CONTENTS_NAME)))	return null;
		return $CONTENTS_NAME[$contents_name];
	}


	public function setLoginSess(){
		$_SESSION[S_KEY11][S_KEY99]['member_id'] = $this->m_value['member_id'];
		$_SESSION[S_KEY11][S_KEY99]['member_pwd'] = $this->m_value['member_pwd'];
		$_SESSION[S_KEY11][S_KEY99]['login_datetime'] = date('Y-m-d H:i:s');
	}

	public function setLoginHistory($id,$questionnaire=array()){
		global $G_QUESTIONNAIRE;
		if(!$id)	return false;
		$data = array(
					'kdn_member_id' => $id,
					'member_id' => //$id, 
					$this->m_value['member_id'],
					'login_date' => date('Y-m-d'),
					'login_time' => date('H:i:s'),
					'ip_address' => getUserIP(),
					'url' => $_SERVER['SCRIPT_NAME'],
		);
		$this->Add('kdn_login_history',$data);

		$a1 = array();
		$a2 = '';
		if(is_array($questionnaire)){
			foreach($questionnaire as $kx=>$vx){
				if((aexists($kx,$questionnaire)) and (aexists2($kx,'1', $G_QUESTIONNAIRE))){
					$a1[] = "[".$kx."]".$G_QUESTIONNAIRE[$kx]['1'][$questionnaire[$kx]];
				}
			}
		}
		$data = array(
					'kdn_member_id' => $id,
					'generate_date' => date('Y-m-d'),
					'generate_time' => date('H:i:s'),
					'note1' => ((count($a1) > 0) ? implode("\n",$a1) : ""),
					'note2' => $_SERVER['SCRIPT_NAME'],
					'note3' => getUserIP(),
					'history_id' => $this->m_objDB->mDB->lastInsertId(),
					'type' => HISTORY_TYPE3,
		);
		$this->Add('kdn_history',$data);
	}

	public function loged_header(){
		// 山田 太郎様　会員メニュー　ログアウト
		// ログイン／会員登録
		$name = $this->logedin_member_info('charge_name');
		$header = array();
		if ($name) {
			$header['is_login'] = true;
			$header['name'] = $name;
		} else {
			$header['is_login'] = false;
		}
		return $header;
	}

	public function member_status($id){
		$this->Search('kdn_member','status','id='.$id);
		$res = $this->getOneRow();
		if(!$res)	return false;
		return $res['status'];
	}

	public function list_contents($large_category,$cnt){
		$res = '';
		if(!$large_category)	return;
		$condition = 'large_category_id='.$large_category;
		$this->Search('kdn_middle_category','*',$condition,'order_of_row asc');
		$result = $this->m_objDB->getResult();
		$count = $this->getNumCount();
		$data = array();
		
		foreach ($result as $row) {
			$udata = array();
			// カテゴリ画像
    	    $categoryFile = $this->is_exists_file($row['image_path']);
    	    $file = "";
    	    if ($categoryFile) {
    	    	$file = $categoryFile;
    	    }
    	    if ($file == "") {
    	    	if ($large_category <= 3) {
	    	    	$file = "images/img_power02.jpg";
    	    	} else {
	    	    	$file = "images/img_opt02.jpg";
    	    	}
    	    }
    	    // カテゴリ名
    	    $name = $row['middle_category_name'];

			$condition = 'large_category_id='.$large_category.' and middle_category_id='.$row['id'];
			$this->Search('kdn_products','*',$condition,'order_of_row asc');
			$result1 = $this->m_objDB->getResult();
			$count = $this->m_objDB->getCount();

    	    $udata['file'] = $file;
    	    $udata['name'] = $name;
    	    $udata['series_name'] = $row['series_name'];
			$udata['count'] = $count;

			$pcount=0;
			foreach ($result1 as $row1) {
				$id = $row1['id'];
				$pdata = array();
				$pdata['product_name'] = $row1['products_name'];
				$pdata['file_exists10'] = file_exists($row1['contents10']);
				$pdata['file_exists11'] = file_exists($row1['contents11']);
				$pdata['file_exists20'] = file_exists($row1['contents20']);
				$pdata['file_exists30'] = file_exists($row1['contents30']);
				$pdata['file_exists40'] = file_exists($row1['contents40']);
				$pdata['id'] = $id;

				$udata['products'][$pcount] = $pdata;
	            $pcount++;
			}
      		$data[] = $udata;
		}
		return array($count,$data);
	}

	public function make_questionnaire(){
		global $G_QUESTIONNAIRE;
		$this->m_value['questionnaire_qa'] = '';
		if(!is_array($G_QUESTIONNAIRE)){
			return;
		}
		$str = '';
		foreach($G_QUESTIONNAIRE as $k=>$v){
			$str .= '<tr><th>['.$k.'] '.$v[0].'</th></tr>';
			$str .= '<tr><td><ul class="memberIndexRadio01">';
			if(is_array($v)){
				if(is_array($v[1])){
					foreach($v[1] as $k2=>$v2){
						$ix = $k.'-'.$k2;

						$clsName = "";
						if ($k2 == 1) {
							$clsName = "first";
						} else if ($k2 == count($v[1])) {
							$clsName = "last";
						}
						// エラー時にチェックボックスの値を再現
						$checkedStr = "";
						if ($this->m_value['questionnaire'][$k] == $k2) {
							$checkedStr .= " checked";
						}
						$str .= "<li class=\"{$clsName}\">"
						."<label><input type=\"radio\" name=\"questionnaire[".$k."]\" value=\"".$k2."\""
						.$checkedStr . ">"
						."<span>" . $v2
						."</span></li>";
					}
				}
			}
			$str .= "</ul></td></tr>";
		}
		$this->m_value['questionnaire_qa'] = $str;
	}
	public function validate_questionnaire(){
		global $G_QUESTIONNAIRE,$G_VALIDATE_MESSAGE;
		$msg = '';
		if(!aexists('questionnaire',$this->m_value)){
			$msg = $G_VALIDATE_MESSAGE['val070'];
			$this->m_value['validate_msg'] = $msg;
			return;
		}
		if(!is_array($this->m_value['questionnaire'])){
			$msg = $G_VALIDATE_MESSAGE['val070'];
		}
		if(count($G_QUESTIONNAIRE) != count($this->m_value['questionnaire'])){
			$msg = $G_VALIDATE_MESSAGE['val070'];
		}
		$this->m_value['validate_msg'] = $msg;
	}
	public function send_loginmail($mail_type,$questionnaire=array()){
		global $G_MAIL_TO_DISTRIBUTION,$G_QUESTIONNAIRE;
		$from = $this->get_admin_mail();
		$to = '';
		$subject = '';
		$body = '';
		$body_admin = '';
		$s = array();
		foreach($questionnaire as $k=>$v){
			$s[] = "[".$k."]".$G_QUESTIONNAIRE[$k][1][$v];
		}
		$body_admin .= (count($s) > 0) ? implode("\n",$s) ."\n---------------------------------------": '';
		$pref = $this->logedin_member_info('pref');
		$to_admin = $this->setFromAddress($mail_type,$pref);
		$body_admin .= $this->makeMailDataMemberInfo();
		$q = $this->m_value['questionnaire'][1];
		$subject_admin = $this->createMailSubject(MAIL_TYPE9,$pref,$G_QUESTIONNAIRE[1][1][$q]);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject_admin,$body_admin);
		$this->m_objMail->send_user_mail();// 分岐[1]

	}
	public function open_close_js($large_category,$para_open,$para_close){
		if(is_array($para_open)){
			$open_js = '';
			foreach($para_open as $k=>$v){
				$open_js .= "document.getElementById('productsbar_ac".$v[0]."').style.display='block';document.getElementById('productsbar_ac".$v[1]."').style.display='none';document.getElementById('ac".$v[2]."').style.display='none';";
			}
		}
		$this->m_value['open_js'.$large_category] = "<a href=\"javascript:;\" onClick=\"" .
				"$open_js" ."\">".
				$large_category." [ALL OPEN]</a>\n";
	}

	private function is_exists_file($path){
		if(!$path)	return false;
		$file = $path;

		// テスト環境
		if ( strpos($path,'kdn-products.com') !== false ) {
			$f = explode('kdn-products.com',$path);
			$testFile = 'http://kdn-products.com' . $f[1];
			if ( file_exists($testFile) ) {
				return $testFile;
			} else {
				return false;
			}
		}

// 2014/10/09 kdn-products.com -> www.kdn.co.jp へ移行時に以下に変更
// 2023/11/06 サブディレクトリを追加したため以下に変更
		// 本番環境
		if(strpos($path,'html/www') !== false){
			$f = explode('html/www',$path);
			$file = $f[1];
		}
		if(file_exists($path)){
			return THIS_DOMAIN.$file;
		}
		return '';
	}

	function header_for_download($createfile) {
		if ( $createfile == NULL ){
			return NULL;
		}

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");

		$file = basename($createfile);
		switch ( strtoupper(strrchr($file , '.' ))){
			case ".XLS":
				header( "Content-type: application/x-msexcel" );
				break;
			case ".PDF":
				header('Content-type: application/pdf');
				break;
			case ".DOC":
				header('Content-type: application/msword');
				break;
			case ".PPT":
				header('Content-type: application/vnd.ms-powerpoint');
				break;
			case ".TXT":
				header('Content-type: application/octet-stream');
			 	break;
			case ".DXF":
				header('Content-type: application/octet-stream');
			 	break;
			 default:
				 header('Content-type: application/force-download');
		}
		//$header="Content-Disposition: attachment; filename=".mb_convert_encoding($strDefaultName, "SJIS","EUC-JP" ).";";
		$header="Content-Disposition: attachment; filename=".basename($createfile).";";
		header($header );
		header("Content-length: ". filesize($createfile));
		readfile($createfile);
		exit;
	}

	private function _log_db($query,$err){
		_log($query,true);
		_log($err,true);
	}

	private function _afterAction(){
		if(G_SYS_TEST == true)	return;
	}
}
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>