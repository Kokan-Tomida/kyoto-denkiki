<?php

	/*---------------------------------------------------------
	* @description : 		user ip	　
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function getUserIP(){
		$ip = "";
		$ip = $_SERVER['REMOTE_ADDR'];
		return $ip;
	}

	/*---------------------------------------------------------
	* @description :
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function setExternalToSession( $external ){
		$_SESSION['members']['request'] = array();
		foreach( $external as $key=>$val ){
			$_SESSION['members']['request'][$key] = $val;
		}
	}

	/*---------------------------------------------------------
	* @description :
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function clearSession(){
		$_SESSION['members']['request'] = array();
	}

	/*---------------------------------------------------------
	* @description :
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function setRegistForm( $aPosted ){
		$retArray = array();
		global $RegistForm;
		foreach($RegistForm as $val ){
			$retArray[$val] = $aPosted[$val];
		}
		return $retArray;
	}

	/*---------------------------------------------------------
	* @description :
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function setRegistFormEnc( $aPosted ){
		$retArray = array();
		global $RegistForm;
		foreach($RegistForm as $val ){
			$retArray[$val] = cnv($aPosted[$val]);
		}	
		return $retArray;		
	}

	/*---------------------------------------------------------
	* @description :
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function cnv($str){
		if ( $str == "") return $str;
		$enc = mb_detect_encoding($str);
		if($enc != CHARSET){
			return mb_convert_encoding($str, CHARSET, $enc);
		}
		return $str;
	}

	/*---------------------------------------------------------
	* @description :
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function cnvi($str,$toenc = 'SJIS'){
		if ( $str == "") return $str;
		$enc = mb_detect_encoding($str);
		if($enc != $toenc){
			return mb_convert_encoding($str, $toenc, $enc);
		}
		return $str;
	}

	/*---------------------------------------------------------
	* @description : 		user agent
	* @param: 
	* @return: agent
	---------------------------------------------------------*/
	function getUserAgent(){
		$agent = "";
		$ret = $_SERVER['HTTP_USER_AGENT'];
		$agent = $ret;
		if ( strlen($ret) > 100 )  $agent = substr( $ret , 0, 100 );
		return $agent;
	}

	/*---------------------------------------------------------
	* @description :
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function _log($msg, $for_db = false){
		$yobi = date( "l", mktime( 0, 0, 0, date("m") , date("d")+1 , date("Y")) );
		$target = ($for_db == false) ? PATH_LOG.DS.$yobi.'_log.txt' : PATH_LOG.DS.'db/'.$yobi.'_log.txt';
		$newf = ($for_db == false) ? PATH_LOG.DS.date("l").'_log.txt' : PATH_LOG.DS.'db/'.date("l").'_log.txt';
		if(file_exists($target)){
			unlink($target);
		}
		$ip = getUserIP();
		$nm = '';
		if(aexists2(S_KEY11,S_KEY99,$_SESSION)){
			$nm =  (axts('login_id',$_SESSION[S_KEY11][S_KEY99])) ? $_SESSION[S_KEY11][S_KEY99]['login_id'] : '(not login)'; 
		}
		$outmsg = date("Y-m-d H:i:s")." ".$ip."\n".$msg."\n\n";
		error_log($outmsg, 3, $newf);
	}

	/*---------------------------------------------------------
	* @description : 指定キーが配列にあるかどうか判定
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function aexists($key, $target_array){
		if(!is_array($target_array)){
			return false;
		}
		if(strlen($key) == 0){
			return false;
		}
		return array_key_exists($key, $target_array);
	}

	/*---------------------------------------------------------
	* @description : 指定キーが配列にあるかどうか判定
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function aexists2($key1, $key2 = "", $target_array){
		if(!is_array($target_array)){
			return false;
		}
		if(strlen($key1) == 0){
			return false;
		}
		if(strlen($key2) > 0){
			return (array_key_exists($key1, $target_array)) ? array_key_exists($key2,$target_array[$key1]) : false;
		}else{
			return array_key_exists($key1, $target_array);
		}
	}

	/*---------------------------------------------------------
	* @description : 指定キーが配列にある場合は値を返す
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function axts($key, $target_array, $return_value=''){
		return (aexists($key, $target_array)) ? $target_array[$key] : $return_value;
	}

	/*---------------------------------------------------------
	* @description : 指定キーが配列にあり値があるかどうか
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function is_set($key, $target_array, $return_value=''){
		$value = axts($key, $target_array, $return_value);
		return isset($value);
	}

	/*---------------------------------------------------------
	* @description :　配列の値が 
	* 				   配列の場合は、keyをカンマ区切りの文字列で返却
	* 　　　　　　　　　　　　　配列ではない場合、値を返却
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function get_keys($in_array){
		if(!is_array($in_array))		return $in_array;
		$in_key = array_keys($in_array);
		if(is_array($in_key)){
			$in_keys = array_values($in_key);
			return implode(",", $in_keys);
		}else{
			return $in_array;
		}
	}

	/*---------------------------------------------------------
	* @description :　配列の指定のキーを取得 
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function get_key_one($in_array,$index){
		if(!is_array($in_array))		return false;
		$in_key = array_keys($in_array);
		if(array_key_exists($index,$in_key)){
			return $in_key[$index];
		}else{
			return false;
		}
	}
	
	/*---------------------------------------------------------
	* @description :　配列のキーが無い場合は作成  初期化
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function make_array_key($in_array, $key1, $key2=""){
		if(!aexists($key1, $in_array)){
			$in_array[$key1] = array();
		}
		if($key2 != ""){
			if(!aexists($key2, $in_array[$key1])){
				$in_array[$key1][$key2] = array();
			}
		}
		return $in_array;
	}

	/*---------------------------------------------------------
	* @description :　配列   初期化
	* @param: 
	* @return:
	---------------------------------------------------------*/
	function init_array($in_array){
		$in_array = array();
	}


	function isSubmit($target){
		if(!is_array($target))	return false;
		$ret = array();
		$needle = array("to_search", "to_confirm", "to_return", "to_complete", "to_returnto", "to_list", "to_reset", "to_new", "to_csv", "to_copy", "to_addline", "to_pdf","to_delline");
		foreach($needle as $key){
			$ret[] = array_key_exists($key, $target);
		}
		return in_array(true, $ret);
	}

?>
