<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		login_history_delete.php ログイン履歴の削除
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

	$root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/admin/include/env/env.inc');
	require_once($root.'/admin/include/const/constant3.inc');
	$r = require_once($root.'/admin/include/const/cron.inc');
	if(!$r)		exit;
	require_once(PATH_LIB.'/MyDBAccess.class.php');

	$m_objDB = new MyDBAccess();
	$m_objDB->my_connect();

	if(!defined('LOGIN_HISTORY_DELETE'))		exit;
	if(!defined('BEGIN_ACCULATION'))			exit;
	if(empty(LOGIN_HISTORY_DELETE))				exit;
	if(empty(BEGIN_ACCULATION))					exit;
	if(LOGIN_HISTORY_DELETE == 0)				exit;
	
	if(strpos(BEGIN_ACCULATION,'-') === false)	exit;
	$acculation_date = explode('-',BEGIN_ACCULATION);
	if(!is_array($acculation))					exit;
	if(!checkdate($acculation_date[1],$acculation_date[2],$acculation_date[0]))		exit;
	
	// start_date ymd
	//BEGIN_ACCULATION
	
	$cdate = date('Y-m-d',mktime(0,0,0,date('m')-LOGIN_HISTORY_DELETE,date('d'),date('Y')));

	if(BEGIN_ACCULATION < $cadata)		exit;
	
	$condition = "login_date <= '".$cdate."'";
	$query = 'DELETE FROM kdn_login_history WHERE '.$condition;
		
	$m_objDB->exec($query);
	$error = mysql_error();
	$affected = mysql_affected_rows();
	if($affected == -1)		$affected = 0;	
	
	$target = PATH_LOG.DS.'db/cron_log.txt';
	$outmsg = date("Y-m-d H:i:s")." ".$query."\n".$error."\n\n";
	error_log($outmsg, 3, $target);
	$outmsg = date("Y-m-d H:i:s")." Records deleted: ".$affected."\n\n";
	error_log($outmsg, 3, $target);
	
	$condition = "generate_date <= '".$cdate."' and type='".HISTORY_TYPE3."'";
	$query = 'DELETE FROM kdn_history WHERE '.$condition;
	$affected = mysql_affected_rows();
	if($affected == -1)		$affected = 0;	
		
	$m_objDB->exec($query);
	$error = mysql_error();		
	$outmsg = date("Y-m-d H:i:s")." ".$query."\n".$error."\n\n";
	error_log($outmsg, 3, $target);

	$outmsg = date("Y-m-d H:i:s")." Records deleted: ".$affected."\n\n";
	error_log($outmsg, 3, $target);
	
	
?>