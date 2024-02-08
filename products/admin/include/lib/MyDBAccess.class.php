<?php

/**--------------------------------------------------------------------
  description :		MyDBAccess.class.php
  ProjectName :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

class MyDBAccess {

	var $mResult = null;		// result
	var $mDB = null;			// connection

	function __construct( ) {
	}

	/* ---------------------------------------------------------
	* @description :	接続
	* @param:
	* @return :
	-----------------------------------------------------------*/
	function my_connect() {
		// $db = mysql_connect(G_HOST, G_USER, G_PASS);
		// mysql_select_db(G_DBNAME,$db);
		// if (!$db) {
		// 	session_unset();
		// 	header("location: ".ERROR_PAGE);
		// 	exit;
		// }
		$dsn = 'mysql:charset=UTF8;dbname=' . G_DBNAME . ';host=localhost';

		try{
			$dbh = new PDO($dsn, G_USER, G_PASS);
		}catch (PDOException $e){
		
			//print('Error:'.$e->getMessage());
			//die();
			session_unset();
			header("location: ".ERROR_PAGE);
			exit;
		}

		$this->mDB = $dbh;

	}

	/* ---------------------------------------------------------
	* @description :	切断
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function my_disconnect() {
	  	$this->mDB = null;
	  	//if($this->mDB)	@mysql_close($this->mDB);
	} // my_disconnect

	/* ---------------------------------------------------------
	* @description :	SQLの実行
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function exec($query) {
		// mysql_select_db(G_DBNAME , $this->mDB );
		// mysql_set_charset('utf8');
		// $this->mResult = mysql_query($query);
		// if (!$this->mResult) {
		// 	_log("exec_".$query);
		// 	_log("exec_".mysql_error());
		// 	//session_unset();
		// 	if(G_SYS_TEST){
		// 		header("location: ".ERROR_PAGE);
		// 		exit;
		// 	}
		// }

		$this->mResult = $this->mDB->query($query);

		if( !$this->mResult ) {
			_log("exec_".$query);
			//_log("exec_".mysql_error());
			session_unset();
			if(G_SYS_TEST){
				header("location: ".ERROR_PAGE);
				exit;
			}
		}
		
		//$this->mResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/* ---------------------------------------------------------
	* @description :	SQLの実行 prepare
	* @arg :
	* @return :
	-----------------------------------------------------------*/
	function exec_prepare( $query , $aCondition ) {
		// if(is_array($aCondition)){
		// 	if(count($aCondition) == 0)	return NULL;
		// }
		// $this->mResult = $this->mDB->query($query, $aCondition );
		// if(!$this->mResult){
		// 	session_unset();
		// 	header("location: ".ERROR_PAGE);
		// 	exit;
		// }
		$stmt = $this->mDB->prepare($query);
		foreach($aCondition as $key => $value){
			$stmt->bindValue($key, $value);
			//$stmt->bindParam( ':id', $aCondition, PDO::PARAM_INT);
		}
		
		$res = $stmt->execute();

		if( !$res ) {
			session_unset();
		 	header("location: ".ERROR_PAGE);
		 	exit;	
		}
		
		$this->mResult = $res->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($this->mResult);
	}

	/* ---------------------------------------------------------
	* @description :	使用する結果リソースを取得
	* @arg :
	* @return :
	-----------------------------------------------------------*/
	function getResult($aResult = false){
		if(!$aResult) {
			return $this->mResult;
		}else{
			return $aResult;
		}
	}

	/* ---------------------------------------------------------
	* @description :
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function getLink() {
		return $this->mDB;
	}

	/* ---------------------------------------------------------
	* @description :	メッセージ表示
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function _setErrorMessage($msg){
		if($msg){
			echo "<html>";
			echo "<head>";
			echo "<meta http-equiv=\"content-type\" content=\"text/html;charset=".CHARSET."\">";
			echo "<title>".TITLE."</title>";
			echo "<body>";
			echo "<br><font color=\"red\"><b>$msg</b></font><br>";
			echo "</body>";
			echo "</html>";
		}
	}

	/* ---------------------------------------------------------
	* @description :
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function getErrorInfo() {
		$error = "";
		if ($this->stmt) {
			$errorInfo = $this->stmt->errorInfo();
			$error = var_export($errorInfo, true);
		}
		return $error;
	}
}
/* Copyright(C) Kyoto Denkiki Co.,Ltd. All Rights Reserved */

?>