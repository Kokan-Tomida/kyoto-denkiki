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
		//while(list($key, $val) = each($this->m_value)){
		foreach($this->m_value AS $key => $val){
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
		$error = mysql_error();		
		$this->m_sql_dump[] = $query;
		$this->m_sql_dump[] = $error;
		$this->_log_db($query,$error);
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
		
		foreach($construct as $k=>$v){
			if(($v['Field'] != 'created') and ($v['Field'] != 'modified')){
				if(!aexists($v['Field'],$ins_values))	continue;
			}
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
		}
		return $select_large_category_id;
	}
	
	public function makeFormMiddleCategory(){
		$list = $this->makeList('kdn_middle_category', array('id','middle_category_name'), '', 'order_of_row ASC');
		$select_middle_category_id = axts('middle_category_id',$this->m_value,'');
		$this->m_value['option_middle_category_id'] = $this->m_objCommon->makeOption($list,$select_middle_category_id);
	}

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
	
	/**
	 * @param $addnew_flg	'1' 新規　/ '2' 編集
	 * @param $target_id    編集のID
	 **/
	public function validate_member($addnew_flg = '1',$target_id=null,$exist_flg = true){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if(($addnew_flg == '2') and ($target_id)){
			$this->Search('kdn_member','*',"id =".$target_id." and status = ".MEMBERSHIP2);
			if($this->getNumCount() != 1){
				$msg[] = $G_VALIDATE_MESSAGE['val027'];
				return $msg;
			}
		}elseif(($addnew_flg == '2') and ($target_id == null)){
			$msg[] = $G_VALIDATE_MESSAGE['val027'];
			return $msg;
		}
		
		// company_name val002
		if($this->m_objValidate->isNull($this->m_value['company_name'])){
			$msg[] = $G_VALIDATE_MESSAGE['val002'];
		}else{
			if($exist_flg == true){
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
			}
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
		}else{
			if(strpos($this->m_value['telno'],'-') !== false){
				$t = explode('-',$this->m_value['telno']);
				if(count($t) == 3){
					if((strlen($t[0]) == 0) or (strlen($t[1]) == 0) or (strlen($t[2]) == 0)){
						$msg[] = $G_VALIDATE_MESSAGE['val010'];
					} 
				}else{
					$msg[] = $G_VALIDATE_MESSAGE['val010'];
				}
			}
		}
		// fax val012
		$f = str_replace('-','',axts('faxno',$this->m_value));
		if(!$this->m_objValidate->isNull($f)){
			if(!$this->m_objValidate->chkNo(axts('faxno',$this->m_value))){
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
			if($exist_flg == true){
				if($addnew_flg == '1'){ 
					$this->Search('kdn_member','*',"email_address ='".$this->m_value['email_address']."' and status <> ".MEMBERSHIP3);
					if($this->getNumCount() == 1){
						$msg[] = $G_VALIDATE_MESSAGE['val008'];
					}
				}elseif($addnew_flg == '2'){
					$this->Search('kdn_member','*',"email_address ='".$this->m_value['email_address']."' and status <> ".MEMBERSHIP3." and id <> ".$target_id);
					if($this->getNumCount() == 1){
						$msg[] = $G_VALIDATE_MESSAGE['val008'];
					}
				}
			}
		}
		return $msg;
	}
	
	/**
	 * @param $addnew_flg	'1' 新規　/ '2' 編集
	 * @param $target_id    編集のID
	 **/
	public function validate_member2($addnew_flg = '1',$target_id=null,$exist_flg = true){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if(($addnew_flg == '2') and ($target_id)){
			$this->Search('kdn_member','*',"id =".$target_id." and status = ".MEMBERSHIP2);
			if($this->getNumCount() != 1){
				$msg[] = array('exists',$G_VALIDATE_MESSAGE['val027']);
				return $msg;
			}
		}elseif(($addnew_flg == '2') and ($target_id == null)){
			$msg[] = array('exists',$G_VALIDATE_MESSAGE['val027']);
			return $msg;
		}
		
		// company_name val002
		if($this->m_objValidate->isNull($this->m_value['company_name'])){
			$msg[] = array('company_name',$G_VALIDATE_MESSAGE['val002']);
/*		}else{
			if($exist_flg == true){
				if($addnew_flg == '1'){ 
					$this->Search('kdn_member','*',"company_name ='".$this->m_value['company_name']."' and status <> ".MEMBERSHIP3);
					if($this->getNumCount() == 1){
						$msg[] = array('company_name',$G_VALIDATE_MESSAGE['val016']);
					}
				}elseif($addnew_flg == '2'){
					$this->Search('kdn_member','*',"company_name ='".$this->m_value['company_name']."' and status <> ".MEMBERSHIP3." and id <> ".$target_id);
					if($this->getNumCount() == 1){
						$msg[] = array('company_name',$G_VALIDATE_MESSAGE['val016']);
					}
				}
			}
*/			
		}
		// zip val009
		$zip = $this->m_value['zip1'].$this->m_value['zip2'];
		if(strlen($zip) != 7){
			$msg[] = array('zipno',$G_VALIDATE_MESSAGE['val009']);
		}elseif(!$this->m_objValidate->chkNo($zip)){
			$msg[] = array('zipno',$G_VALIDATE_MESSAGE['val014']);
		}
		// pref val0015 address1 val015
		if($this->m_objValidate->isNull($this->m_value['pref'])){
			$msg[] = array('pref',$G_VALIDATE_MESSAGE['val015']);
		}
		if($this->m_objValidate->isNull($this->m_value['address1'])){
			$msg[] = array('address1',$G_VALIDATE_MESSAGE['val015']);
		}
		// tel val010
		if(!$this->m_objValidate->chkNo($this->m_value['telno'])){
			$msg[] = array('telno',$G_VALIDATE_MESSAGE['val010']);
		}else{
			if(strpos($this->m_value['telno'],'-') !== false){
				$t = explode('-',$this->m_value['telno']);
				if(count($t) == 3){
					if((strlen($t[0]) == 0) or (strlen($t[1]) == 0) or (strlen($t[2]) == 0)){
						$msg[] = array('telno',$G_VALIDATE_MESSAGE['val010']);
					} 
				}else{
					$msg[] = array('telno',$G_VALIDATE_MESSAGE['val010']);
				}
			}
		}
		// fax val012
		$fno = axts('faxno',$this->m_value);
		$f = str_replace('-','',$fno);
		if(!$this->m_objValidate->isNull($f)){
			if(!$this->m_objValidate->chkNo($fno)){
				$msg[] = array('faxno',$G_VALIDATE_MESSAGE['val012']);
			}else{
				if(strpos($fno,'-') !== false){
					$fa = explode('-',$fno);
					if(count($fa) == 3){
						if((strlen($fa[0]) == 0) or (strlen($fa[1]) == 0) or (strlen($fa[2]) == 0)){
							$msg[] = array('faxno',$G_VALIDATE_MESSAGE['val012']);
						} 
					}else{
						$msg[] = array('faxno',$G_VALIDATE_MESSAGE['val012']);
					}
				}
			}
		}
		// section
		// charge_name val006
		if($this->m_objValidate->isNull($this->m_value['charge_name'])){
			$msg[] = array('charge_name',$G_VALIDATE_MESSAGE['val006']);
		}
		// email_address val004
		if(!$this->m_objValidate->chk_email($this->m_value['email_address'])){
			$msg[] = array('email_address',$G_VALIDATE_MESSAGE['val004']);
		}else{
			if($exist_flg == true){
				if($addnew_flg == '1'){ 
					$this->Search('kdn_member','*',"email_address ='".$this->m_value['email_address']."' and status = ".MEMBERSHIP2);
					if($this->getNumCount() == 1){
						$msg[] = array('email_address',$G_VALIDATE_MESSAGE['val008']);
					}
				}elseif($addnew_flg == '2'){
					$this->Search('kdn_member','*',"email_address ='".$this->m_value['email_address']."' and status = ".MEMBERSHIP2." and id <> ".$target_id);
					if($this->getNumCount() == 1){
						$msg[] = array('email_address',$G_VALIDATE_MESSAGE['val008']);
					}
				}
			}
		}
		return $msg;
	}

	/**
	 * @param $inquiry_flg	'1' ゲスト　/ '2' 会員
	 * @param $target_id    対象の会員ID
	 * @param $exists       ゲストの場合、メールアドレスの存在チェックをしない
	 **/
	public function validate_inquiry($inquiry_flg = '1',$target_id=null,$exists=true){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if($inquiry_flg == '1'){
			// quest
			$msg = $this->validate_member($inquiry_flg,null,false);
		}
		if($this->m_objValidate->isNull($this->m_value['inquiry_select'])){
			$msg[] = $G_VALIDATE_MESSAGE['val050'];
		}
		if(count($this->m_value['inquiry_check']) == 0){
			$msg[] = $G_VALIDATE_MESSAGE['val051'];
		}
		if($this->m_objValidate->isNull($this->m_value['inquiry_note'])){
			$msg[] = $G_VALIDATE_MESSAGE['val052'];
		}
		return $msg;			
	}
		
	/**
	 * @param $inquiry_flg	'1' ゲスト　/ '2' 会員
	 * @param $target_id    対象の会員ID
	 * @param $exists       ゲストの場合、メールアドレスの存在チェックをしない
	 **/
	public function validate_inquiry2($inquiry_flg = '1',$target_id=null,$exists=true){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if($inquiry_flg == '1'){
			// quest
			$msg = $this->validate_member2($inquiry_flg,null,false);
		}
		if($this->m_objValidate->isNull($this->m_value['inquiry_select'])){
			$msg[] = array('inquiry_select',$G_VALIDATE_MESSAGE['val050']);
		}
		if(count($this->m_value['inquiry_check']) == 0){
			$msg[] = array('inquiry_check',$G_VALIDATE_MESSAGE['val051']);
		}
		if($this->m_objValidate->isNull($this->m_value['inquiry_note'])){
			$msg[] = array('inquiry_note',$G_VALIDATE_MESSAGE['val052']);
		}
		return $msg;			
	}

	public function validate_sample2(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		if(!$this->m_objValidate->isNull($this->m_value['cable_count'])){
			if(!is_numeric($this->m_value['cable_count'])){
				$msg[] = array('cable_count',$G_VALIDATE_MESSAGE['val055']);
			}
		}
		if(!$this->m_objValidate->isNull($this->m_value['cable_length_other'])){
			if(!is_numeric($this->m_value['cable_length_other'])){
				$msg[] = array('cable_length_other',$G_VALIDATE_MESSAGE['val056']);
			}
		}
		$today = date('Ymd');
		$lent_start_flg = false;
		$d0 = $this->m_value['lent_start_date_year'].$this->m_value['lent_start_date_month'].$this->m_value['lent_start_date_day'];
		$d1 = $this->m_value['lent_start_date_month'].$this->m_value['lent_start_date_day'].$this->m_value['lent_start_date_year'];
		if((strlen($this->m_value['lent_start_date_month']) == 2) and (strlen($this->m_value['lent_start_date_day']) == 2) and (strlen($this->m_value['lent_start_date_year']) == 4)){
			$lent_start_flg = true;
			if(checkdate($this->m_value['lent_start_date_month'],$this->m_value['lent_start_date_day'],$this->m_value['lent_start_date_year']) == false){
				$msg[] = array('lent_start_date',$G_VALIDATE_MESSAGE['val057']);
				$lent_start_flg = false;
			}
		}else{
			//if((strlen($d1) > 0 ) and (strlen($d1) < 8 )){
			if(strlen($d1) < 8 ){
				$msg[] = array('lent_start_date',$G_VALIDATE_MESSAGE['val057']);
				$lent_start_flg = false;
			}
		}
		$return_flg = false;
		$d2 = $this->m_value['return_date_year'].$this->m_value['return_date_month'].$this->m_value['return_date_day'];
		if((strlen($this->m_value['return_date_month']) == 2) and (strlen($this->m_value['return_date_day']) == 2) and (strlen($this->m_value['return_date_year']) == 4)){
			$return_flg = true;
			if(checkdate($this->m_value['return_date_month'],$this->m_value['return_date_day'],$this->m_value['return_date_year']) == false){
				$msg[] = array('return_date',$G_VALIDATE_MESSAGE['val058']);
				$return_flg = false;
			}
		}else{
			if((strlen($d2) > 0 ) and (strlen($d2) < 8 )){
				$msg[] = array('return_date',$G_VALIDATE_MESSAGE['val058']);
				$return_flg = false;
			}
		}
		if(($lent_start_flg == true) and ($d0 < $today)){
			$msg[] = array('lent_start_date',$G_VALIDATE_MESSAGE['val061']);
		}
		if(($lent_start_flg == true) and ($return_flg == true)){
			if($d0 > $d2){
				$msg[] = array('return_date',$G_VALIDATE_MESSAGE['val060']);
			}
		}
		if(($this->m_value['cable_needs'] == '1') and ($this->m_value['cable_count'] == '')){
			$msg[] = array('cable_count',$G_VALIDATE_MESSAGE['val059']);
		}
		return $msg;			
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
	
	public function setLoginHistory($id){
		if(!$id)	return false;
		$data = array(
					'kdn_member_id' => $id,
					'member_id' => $this->m_value['member_id'],
					'login_date' => date('Y-m-d'),
					'login_time' => date('H:i:s'),
					'ip_address' => getUserIP(),
					'url' => $_SERVER['SCRIPT_NAME'],
		);
		$this->Add('kdn_login_history',$data);		
		$data = array(
					'kdn_member_id' => $id,
					'generate_date' => date('Y-m-d'),
					'generate_time' => date('H:i:s'),
					'note1' => $_SERVER['SCRIPT_NAME'],
					'note2' => getUserIP(),
					'history_id' => mysql_insert_id(),
					'type' => HISTORY_TYPE3,
		);
		$this->Add('kdn_history',$data);		
	}
	
	public function loged_header(){
		// 山田 太郎様　会員メニュー　ログアウト
		// ログイン／会員登録
		$sep = '／';
		$name = $this->logedin_member_info('charge_name');
		$header = '';
		if($name != null){
			$header .= $name.SAMA;
			$header .= $sep;
			$header .= '<a href="'.THIS_ROOT_URL_MEMBER.DS.'menu.php'.'">会員メニュー</a>';
			$header .= $sep;
			$header .= '<a href="'.THIS_ROOT_URL_MEMBER.DS.'logout.php'.'">ログアウト</a>';
		}else{
			$header .= '<a href="'.THIS_ROOT_URL_MEMBER.'">ログイン／会員登録</a>';
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
		$dummy_image = "images/no_p.jpg";
		$condition = 'large_category_id='.$large_category;
		$this->Search('kdn_middle_category','*',$condition,'order_of_row asc');
		$result = $this->m_objDB->getResult();
		$count = $this->getNumCount();
		$c=$cnt;
		$i=1;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$is = (strlen($c) == 1) ? '0'.$c : $c;
			$j = $c*2-1;
			$js = (strlen($j) == 1) ? '0'.$j : $j;
			$p = $c*2;
			$ps = (strlen($p) == 1) ? '0'.$p : $p;
    		if($i==1){
    			$res .= "<div class=\"clearfix mg-top30\">\n";
    		}elseif($c%2!=0){
    			$res .= "<div class=\"clearfix mg-top6\">\n";
    		}
      		if($c%2==0){
	      		$res .= "<!--  Even start  -->\n";
				$res .= "<div class=\"right wd-460\">\n";
      		}else{
	      		$res .= "<!--  Odd start  -->\n";
				$res .= "<div class=\"left wd-460\">\n";
      		}

	        $res.= "<div class=\"clearfix\">\n";
    	    $res.= "<div class=\"left\">\n";
    	    $file = $this->is_exists_file($row['image_path']);
    	    $name = $row['middle_category_name'];
    	    
    	    if($file != ''){
				$res .= "<img src=\"".$file."\" alt=\"".$name."\" width=\"70\" height=\"70\" />\n";
    	    }else{
				$res.= "<img src=\"".$dummy_image."\" alt=\"".$name."\" width=\"70\" height=\"70\" />\n";
    	    }
			$res .= "</div>\n";
          	$res .= "<div class=\"left fs14 pd-left16\">\n";
            $res .= "<p><strong class=\"fs_grey\">".$name."</strong></p>\n";
            $res .= "<p><strong class=\"fs_lightblue\">".$row['series_name']."</strong></p>\n";
          	$res .= "</div>\n";
          	$res .= "<div class=\"right\">\n";
            $res .= "<div id=\"productsbar_ac".$js."\">\n";
            $res .= "<a href=\"javascript:;\" onClick=\"document.getElementById('productsbar_ac".$ps."').style.display='block';document.getElementById('productsbar_ac".$js."').style.display='none';document.getElementById('ac".$is."').style.display='none';\"><img src=\"images/up_arrow_btn.gif\" width=\"30\" height=\"70\" /></a>\n";
            $res .= "</div>\n";
            $res .= "<div id=\"productsbar_ac".$ps."\">\n";
            $res .= "<a href=\"javascript:;\" onClick=\"document.getElementById('productsbar_ac".$js."').style.display='block';document.getElementById('productsbar_ac".$ps."').style.display='none';document.getElementById('ac".$is."').style.display='block';\"><img src=\"images/down_arrow_btn.gif\" width=\"30\" height=\"70\" /></a>\n";
            $res .= "</div>\n";
          	$res .= "</div>\n";
        	$res .= "</div>\n";
        	$res .= "<div><img src=\"images/products_line.gif\" width=\"460\" height=\"3\" /></div>\n";
        	$res .= "<div id=\"ac".$is."\">\n";
          	$res .= "<div class=\"mg-top6\">\n";
          	
			$condition = 'large_category_id='.$large_category.' and middle_category_id='.$row['id'];
			$this->Search('kdn_products','*',$condition,'order_of_row asc');
			$result1 = $this->m_objDB->getResult();
			$q = mysql_num_rows($result1);
			if($q > 0){
	            $res .= "<table width=\"460\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"dltb\">\n";
	            $res .= "<tr>\n";
	            $res .= "<td width=\"220\" rowspan=\"2\"><div class=\"txtleft fs14\">製品名</div></td>\n";
	            $res .= "<td colspan=\"2\" class=\"bleft\">外形図</td>\n";
	            $res .= "<td width=\"48\" class=\"bleft\">仕様書</td>\n";
	            $res .= "<td width=\"48\" class=\"bleft\">取説</td>\n";
	            $res .= "<td width=\"48\" class=\"bleft\">その他</td>\n";
	            $res .= "</tr>\n";
	            $res .= "<tr>\n";
	            $res .= "<td width=\"48\" class=\"bleft\">PDF</td>\n";
	            $res .= "<td width=\"48\" class=\"bleft\">DXF</td>\n";
	            $res .= "<td class=\"bleft\">PDF</td>\n";
	            $res .= "<td class=\"bleft\">PDF</td>\n";
	            $res .= "<td class=\"bleft\">PDF</td>\n";
	            $res .= "</tr>\n";
			}

			$u=0;
			while($row1 = mysql_fetch_array($result1,MYSQL_ASSOC)){
				$id = $row1['id'];
				$cl = ($u%2==0) ? 'dlcell' : '';
				$cln = ($u%2==0) ? 'class="dlcell"' : '' ;
				$res .= "<tr>\n";
	            $res .= "<td ".$cln."><div class=\"txtleft dl_text02\">".$row1['products_name']."</div></td>\n";
				//$contents = $this->is_exists_file($row1['contents10']);
				if(file_exists($row1['contents10'])){
	            	$res .= "<td class=\"".$cl." bleft\"><a href=\"javascript:void(0);\" onclick=\"set_param(".$id.",'contents10','')\"><img src=\"images/ico_pdf.gif\" width=\"16\" height=\"16\" /></a></td>\n";
				}else{
	            	$res .= "<td class=\"".$cl." bleft\"></td>\n";
				}
				//$contents = $this->is_exists_file($row1['contents11']);
				if(file_exists($row1['contents11'])){
	            	$res .= "<td class=\"".$cl." bleft\"><a href=\"javascript:void(0);\" onclick=\"set_param(".$id.",'contents11','')\"><img src=\"images/ico_dxf.gif\" width=\"16\" height=\"16\" /></a></td>\n";
				}else{
	            	$res .= "<td class=\"".$cl." bleft\"></td>\n";
				}
				//$contents = $this->is_exists_file($row1['contents20']);
				if(file_exists($row1['contents20'])){
	            	$res .= "<td class=\"".$cl." bleft\"><a href=\"javascript:void(0);\" onclick=\"set_param(".$id.",'contents20','')\"><img src=\"images/ico_pdf.gif\" width=\"16\" height=\"16\" /></a></td>\n";
				}else{
	            	$res .= "<td class=\"".$cl." bleft\"></td>\n";
				}
				//$contents = $this->is_exists_file($row1['contents30']);
				if(file_exists($row1['contents30'])){
	        	    $res .= "<td class=\"".$cl." bleft\"><a href=\"javascript:void(0);\" onclick=\"set_param(".$id.",'contents30','')\"><img src=\"images/ico_pdf.gif\" width=\"16\" height=\"16\" /></a></td>\n";
				}else{
	    	        $res .= "<td class=\"".$cl." bleft\"></td>\n";
				}
				//$contents = $this->is_exists_file($row1['contents40']);
				if(file_exists($row1['contents40'])){
		            $res .= "<td class=\"".$cl." bleft\"><a href=\"javascript:void(0);\" onclick=\"set_param(".$id.",'contents40','')\"><img src=\"images/ico_pdf.gif\" width=\"16\" height=\"16\" /></a></td>\n";
				}else{
		            $res .= "<td class=\"".$cl." bleft\"></td>\n";
				}
	            $res .= "</tr>\n";
	            $u++;
			}
            if($q > 0)	$res .= "</table>\n";
          	$res .= "</div>\n";
        	$res .= "</div>\n";
      		$res .= "</div>\n";
      		if($c%2==0){
	      		$res.= "<!--  Even end  -->\n";
      		}else{
	      		$res.= "<!--  Odd end  -->\n";
      		}
      		if($i%2==0){
				$res .= "</div>\n";
      		}
      		//if($c!=$count)	$c++;
      		$c++;
      		$i++;
		}
      		if($count%2 != 0){
				$res .= "</div>\n";
      		}
		return array($count,$res);					
	}
	
	public function open_close_js($large_category,$para_open,$para_close){
		//$res = "<a href=\"javascript:;\" onClick=\"document.getElementById('productsbar_ac".$ps."').style.display='block';document.getElementById('productsbar_ac".$js."').style.display='none';document.getElementById('ac".$is."').style.display='none';\"><img src=\"images/up_arrow_btn.gif\" width=\"30\" height=\"70\" /></a>\n";
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
		if(strpos($path,DOMAIN) !== false){
			$f = explode(DOMAIN,$path);
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
/*
		echo "<div align=left><br><hr>[ ***** For Test ***** ]<hr><pre>";
		
		echo "[STACK TRACE]<br>";

		debug_print_backtrace();
		echo "<hr>[SQL DUMP]<br>";
		$sql = implode("<br />", $this->m_sql_dump);
		echo $sql;
		
		echo "<hr>[SESSION]<br>";
		var_export($_SESSION);

		echo "<hr>[POST]<br>";
		var_export($_POST);
		echo "<hr>[GET]<br>";
		var_export($_GET);
		echo "<hr>[FILE]<br>";
		var_export($_FILES);
		echo "<hr>[value]<br>";
		var_export($this->m_value);
		echo "<hr>[server]<br>";
		var_export($_SERVER);

		echo "</pre></div>";
*/

	}
}
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>