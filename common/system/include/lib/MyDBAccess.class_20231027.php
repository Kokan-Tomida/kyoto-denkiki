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
		$sockCond = ($WEB_SERVER_NAME == "localhost" ? ";unix_socket=/tmp/mysql.sock" : "");
		$dsn = 'mysql:dbname=' . G_DBNAME . $sockCond . ';host=' . G_HOST;
		$user = G_USER;
		$password = G_PASS;

		try {
		    $dbh = new PDO($dsn, $user, $password);
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		    $dbh->query("SET NAMES utf8;");
		} catch (PDOException $e) {
		    $log = 'Connection failed: ' . $e->getMessage();
		    _log($log);
			session_unset();
			return;
			//header("location: ".ERROR_PAGE);
			//exit;
		}

		//$db = mysql_connect(G_HOST, G_USER, G_PASS);
		//mysql_select_db(G_DBNAME,$db);
		/*if (!$db) {
			session_unset();
			header("location: ".ERROR_PAGE);
			exit;
		}*/
		$this->mDB = $dbh;
	}

	/* ---------------------------------------------------------
	* @description :	切断
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function my_disconnect() {
		if($this->mDB) {
			$this->mDB = null;
		}
	}

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
		$this->stmt = $this->mDB->prepare($query);
		$this->mResult = $this->stmt->execute();
		if (!$this->mResult) {
			_log("exec_".$query);
			_log("exec_".$this->mDB->errorInfo());
			//session_unset();
			if(G_SYS_TEST){
				//header("location: ".ERROR_PAGE);
				//exit;
			}
		}
	}
	/* ---------------------------------------------------------
	* @description :	SQLの実行
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function setResult($query) {
		$stmt = $this->mDB->query($query);
		$this->mResult = null;
		if ($stmt) {
			$this->mResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	/* ---------------------------------------------------------
	* @description :	SQLの実行 prepare
	* @arg :
	* @return :
	-----------------------------------------------------------*/
	function exec_prepare( $query , $aCondition ) {
		if(is_array($aCondition)){
			if(count($aCondition) == 0)	return NULL;
		}
		$this->mResult = $this->mDB->query($query, $aCondition );
		if(!$this->mResult){
			// session_unset();
			// header("location: ".ERROR_PAGE);
			// exit;
		}
	}

	/* ---------------------------------------------------------
	* @description :
	* @param :
	* @return :
	-----------------------------------------------------------*/
	function getCount() {
		$count = 0;
		if ( !empty($this->mResult) ) {
			//$count = 1;
			$count = count($this->mResult);
		}
		return $count;
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
/* COPYRIGHT(C) DeeSystem. ALL RIGHTS RESERVED. */

?>