<?php

/**--------------------------------------------------------------------
  description:		env.inc  environment
  ProjectName :  
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/
 
	/*------------------------
	 * サーバ
	 *-----------------------*/
	define('DOMAIN', $_SERVER['HTTP_HOST']);
	define('HTTP', 'http://');
	define('HTTPS', 'https://');

	define('PARENT_SUBDIR', '');
	$WEB_SERVER_NAME = $_SERVER['SERVER_NAME'];
	
	$isHttps = false;
	if ( isset($_SERVER['HTTPS']) ) {
		if ($_SERVER['HTTPS'] == 'on') {
			$isHttps = true;
		}
	}

	if ($isHttps) {
		//   http://
		define('THIS_DOMAIN', HTTPS.DOMAIN.PARENT_SUBDIR);
	} else {
		//   https://
		define('THIS_DOMAIN', HTTP.DOMAIN.PARENT_SUBDIR);
	}
	define('THIS_DOMAIN_HTTPS', HTTPS.DOMAIN.PARENT_SUBDIR);

	define('DS', '/');

	$path = $_SERVER['DOCUMENT_ROOT'];
	define('AP_ROOT', $path);
	
	/*------------------------
	 * debug
	 *-----------------------*/
	// false --- Debug
	// true ---- Release
	define('G_SYS_TEST', true);
	define('IS_HTTPS', true);

	
	/* ============================================================================================*/
	// release
	/* ============================================================================================*/
	$baseDir = "/common/system/";

	define('SUBDIR_CONTACT', '/contact');
	define('SUBDIR_MEMBER', '/member');

	define('SUBDIR_OPT', '/opt');
	define('SUBDIR_OPT_DOWNLOAD', '/opt/download');
	define('SUBDIR_OPT_SAMPLE', '/opt/sample');
	define('SUBDIR_POWER', '/power');
	define('SUBDIR_POWER_DOWNLOAD', '/power/download');

	// admin
	define('SUBDIR', $baseDir . 'admin');
	// config release
	$pathmod = $_SERVER['DOCUMENT_ROOT'].PARENT_SUBDIR. $baseDir . 'include';
	$mail_pathmod = $_SERVER['DOCUMENT_ROOT'].PARENT_SUBDIR. $baseDir . 'mail';

	// Root URL http
	define('THIS_ROOT_URL', HTTP.$_SERVER['HTTP_HOST']);
	// Root URL https
	define('THIS_ROOT_URL_HTTPS', HTTP.$_SERVER['HTTP_HOST']);
	
	define('THIS_ROOT_URL_CONTACT', THIS_DOMAIN.SUBDIR_CONTACT);
	define('THIS_ROOT_URL_MEMBER', THIS_DOMAIN.SUBDIR_MEMBER);
	// opt
	define('THIS_ROOT_URL_OPT', THIS_DOMAIN.SUBDIR_OPT);
	// オプトエレクトロニクスダウンロードコンテンツ  // opt/download
	define('THIS_ROOT_URL_OPT_DOWNLOAD', THIS_DOMAIN.SUBDIR_OPT_DOWNLOAD);
	// オプトサンプル機貸出 	// opt/sample
	define('THIS_ROOT_URL_OPT_SAMPLE', THIS_DOMAIN_HTTPS.SUBDIR_OPT_SAMPLE);
	// power
	define('THIS_ROOT_URL_POWER', THIS_DOMAIN.SUBDIR_POWER);
	// パワーエレクトロニクスダウンロードコンテンツ  // power/download
	define('THIS_ROOT_URL_POWER_DOWNLOAD', THIS_DOMAIN.SUBDIR_POWER_DOWNLOAD);
	
	//define('THIS_ROOT_URL_CONTACT_GUEST', THIS_DOMAIN_HTTPS.SUBDIR_CONTACT.DS.'inquiry_guest.php');

	// 会員　本登録用アクセスURL
	define('THIS_REGISTRATION_URL',THIS_ROOT_URL_MEMBER.DS.'addnew_register.php');
	// 会員　編集用URL
	define('MEMBER_EDIT_URL',THIS_ROOT_URL_MEMBER.DS.'edit.php');
	// 会員  退会URL
	define('MEMBER_WITHDRAW_URL',THIS_ROOT_URL_MEMBER.DS.'confirm_withdraw.php');
	// 会員　ログイン
	define('MEMBER_LOGIN_URL',THIS_ROOT_URL_MEMBER);
	// 会員　新規登録
	define('MEMBER_REGIST_URL',THIS_ROOT_URL_MEMBER.DS.'addnew.php');
	// ゲスト問い合わせ
	define('THIS_ROOT_URL_CONTACT_GUEST',THIS_ROOT_URL_CONTACT.DS.'inquiry_guest.php');
		
	define('PATH_MODULES', $pathmod);
	
	//define('PATH_LIB', $path.SUBDIR.DS.'include'.'/lib');
	define('PATH_LIB', PATH_MODULES.'/lib');
	
	define('PATH_TEMPLATE', PATH_MODULES.'/view');
	define('PATH_TEMPLATE_CONTACT', PATH_TEMPLATE.DS.'contact');
	define('PATH_TEMPLATE_MEMBER', PATH_TEMPLATE.DS.'member');
	define('PATH_TEMPLATE_OPT', PATH_TEMPLATE.DS.'opt');
	define('PATH_TEMPLATE_OPT_SAMPLE', PATH_TEMPLATE.DS.'opt'.DS.'sample');
	define('PATH_TEMPLATE_POWER', PATH_TEMPLATE.DS.'power');
	define('PATH_TEMPLATE_OPT_DOWNLOAD', PATH_TEMPLATE.DS.'opt'.DS.'download');
	define('PATH_TEMPLATE_POWER_DOWNLOAD', PATH_TEMPLATE.DS.'power'.DS.'download');
		
	define('PATH_MAIL_TEMPLATE', $mail_pathmod);

	// log
	define('PATH_LOG', PATH_MODULES.'/log');
	// Error Page
	define('ERROR_PAGE' ,'/error.php');
	define('E404_PAGE' ,THIS_DOMAIN.'/e404.html');
	define('ERROR_MAIL_PAGE' ,'/err/');
	// http://www.kdn.co.jp/404/index.html
	
	// Message Page
	//define('ANNOUNCE_PAGE',THIS_DOMAIN.'/announcement.php');

	define('AUTHORITY_LOGIN','kdn');
	define('AUTHORITY_PASS','kdn01395cw');
	
	/*------------------------
	 * DB MySQL
	 *-----------------------*/
	$mysqlHost = "localhost";
	// 20231020comentout
	//if ( strpos($_SERVER["SERVER_NAME"], "kdn-careers.com") !== false ) {
	//	$mysqlHost = "mysql139.heteml.jp";
	//}
	define('G_HOST', $mysqlHost);
	//define('G_USER', '_kdn_system_db');
	define('G_USER', 'kdn');
	define('G_PASS', 'j2yl099hwapj7gk');
	//define('G_PASS', 'J2yl099hwapj7gk$');
	define('G_DBNAME', '_kdn_system_db');
?>
