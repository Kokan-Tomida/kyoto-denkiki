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

	define('THIS_DOMAIN', HTTP.DOMAIN);
	define('THIS_DOMAIN_HTTPS', HTTPS.DOMAIN);

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

	
		

	if(G_SYS_TEST == false){
		/* ============================================================================================*/
		// debug
		/* ============================================================================================*/
		define('SUBDIR_CONTACT', '/products/contact_test');
		define('SUBDIR_MEMBER', '/products/member_test');
		
		define('SUBDIR_OPT', '/products/opt_test');
		define('SUBDIR_OPT_DOWNLOAD', '/products/opt_test/download');
		define('SUBDIR_OPT_SAMPLE', '/products/opt_test/sample');
		define('SUBDIR_POWER', '/products/power_test');
		define('SUBDIR_POWER_DOWNLOAD', '/products/power_test/download');
		
		// admin
		define('SUBDIR', '/products/admin_test');
		// config test
		$pathmod = $_SERVER['DOCUMENT_ROOT'].PARENT_SUBDIR.'/products/config/test/include';
		$mail_pathmod = $_SERVER['DOCUMENT_ROOT'].PARENT_SUBDIR.'/products/config/test/mail';

		// Root URL http
		define('THIS_ROOT_URL', HTTP.$_SERVER['HTTP_HOST']);
		// Root URL https
		define('THIS_ROOT_URL_HTTPS', HTTP.$_SERVER['HTTP_HOST']);
		
		if(IS_HTTPS == false){
			/* =======================================================================*/
			// ** debug http ** debug http ** debug http ** debug http 
			/* ========================================================================*/
	
			define('THIS_ROOT_URL_CONTACT', THIS_DOMAIN.SUBDIR_CONTACT);
			define('THIS_ROOT_URL_MEMBER', THIS_DOMAIN.SUBDIR_MEMBER);
			// opt
			define('THIS_ROOT_URL_OPT', THIS_DOMAIN.SUBDIR_OPT);
			// オプトエレクトロニクスダウンロードコンテンツ  // opt/download
			define('THIS_ROOT_URL_OPT_DOWNLOAD', THIS_DOMAIN.SUBDIR_OPT_DOWNLOAD);
			// オプトサンプル機貸出 	// opt/sample
			define('THIS_ROOT_URL_OPT_SAMPLE', THIS_DOMAIN.SUBDIR_OPT_SAMPLE);
  			// power
			define('THIS_ROOT_URL_POWER', THIS_DOMAIN.SUBDIR_POWER);
			// パワーエレクトロニクスダウンロードコンテンツ  // power/download
			define('THIS_ROOT_URL_POWER_DOWNLOAD', THIS_DOMAIN.SUBDIR_POWER_DOWNLOAD);
			
			//define('THIS_ROOT_URL_CONTACT_GUEST', THIS_DOMAIN.SUBDIR_CONTACT.DS.'inquiry_guest.php');
		
			// 会員　本登録用アクセスURL
			define('THIS_REGISTRATION_URL',THIS_ROOT_URL_MEMBER.DS.'this_registration.php');
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

		}else{
			/* =======================================================================*/
			// ** debug https ** debug https ** debug https ** debug https 
			/* ========================================================================*/
	
			define('THIS_ROOT_URL_CONTACT', THIS_DOMAIN_HTTPS.SUBDIR_CONTACT);
			define('THIS_ROOT_URL_MEMBER', THIS_DOMAIN_HTTPS.SUBDIR_MEMBER);
			// opt
			define('THIS_ROOT_URL_OPT', THIS_DOMAIN.SUBDIR_OPT);
			// オプトエレクトロニクスダウンロードコンテンツ  // opt/download
			define('THIS_ROOT_URL_OPT_DOWNLOAD', THIS_DOMAIN_HTTPS.SUBDIR_OPT_DOWNLOAD);
			// オプトサンプル機貸出 	// opt/sample
			define('THIS_ROOT_URL_OPT_SAMPLE', THIS_DOMAIN_HTTPS.SUBDIR_OPT_SAMPLE);
  			// power
			define('THIS_ROOT_URL_POWER', THIS_DOMAIN.SUBDIR_POWER);
			// パワーエレクトロニクスダウンロードコンテンツ  // power/download
			define('THIS_ROOT_URL_POWER_DOWNLOAD', THIS_DOMAIN_HTTPS.SUBDIR_POWER_DOWNLOAD);
			
			define('THIS_ROOT_URL_CONTACT_GUEST', THIS_DOMAIN_HTTPS.SUBDIR_CONTACT.DS.'inquiry_guest.php');
		
			// 会員　本登録用アクセスURL
			define('THIS_REGISTRATION_URL',THIS_ROOT_URL_MEMBER.DS.'this_registration.php');
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
		}
			
		define('PATH_MODULES', $pathmod);
		
		define('PATH_LIB', $path.SUBDIR.DS.'include'.'/lib');
		
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
		define('ERROR_PAGE' ,THIS_DOMAIN.'/alert.html');
		define('E404_PAGE' ,THIS_DOMAIN.'/e404.html');
		// http://www.kdn.co.jp/404/index.html
		
		// Message Page
		//define('ANNOUNCE_PAGE',THIS_DOMAIN.'/announcement.php');
	
		define('AUTHORITY_LOGIN','kdn');
		define('AUTHORITY_PASS','kdn01395cw');
		
		/*------------------------
		 * DB MySQL
		 *-----------------------*/
		// Database Connect Option  test
		define('G_HOST', 'mysql131.heteml.jp');
		define('G_USER', '_kdn_develop_db');
		define('G_PASS', 'd3ffdh8xa77b3hj');
		define('G_DBNAME', '_kdn_develop_db');

	}else{
		
		/* ============================================================================================*/
		// release
		/* ============================================================================================*/
		define('SUBDIR_CONTACT', '/products/contact');
		define('SUBDIR_MEMBER', '/products/member');

		define('SUBDIR_OPT', '/products/opt');
		define('SUBDIR_OPT_DOWNLOAD', '/products/opt/download');
		define('SUBDIR_OPT_SAMPLE', '/products/opt/sample');
		define('SUBDIR_POWER', '/products/power');
		define('SUBDIR_POWER_DOWNLOAD', '/products/power/download');

		//define('SUBDIR_CONTACT', '/products/contact');
		//define('SUBDIR_MEMBER', '/products/member');
		//define('SUBDIR_OPT', '/products/opt/download');
		//define('SUBDIR_OPT_SAMPLE', '/products/opt/sample');
		//define('SUBDIR_POWER', '/products/power/download');

		// admin
		define('SUBDIR', '/products/admin');
		// config release
		$pathmod = $_SERVER['DOCUMENT_ROOT'].PARENT_SUBDIR.'/products/config/release/include';
		$mail_pathmod = $_SERVER['DOCUMENT_ROOT'].PARENT_SUBDIR.'/products/config/release/mail';
	
		// Root URL http
		define('THIS_ROOT_URL', HTTP.$_SERVER['HTTP_HOST']);
		// Root URL https
		define('THIS_ROOT_URL_HTTPS', HTTP.$_SERVER['HTTP_HOST']);
		
		define('THIS_ROOT_URL_CONTACT', THIS_DOMAIN_HTTPS.SUBDIR_CONTACT);
		define('THIS_ROOT_URL_MEMBER', THIS_DOMAIN_HTTPS.SUBDIR_MEMBER);
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
		define('THIS_REGISTRATION_URL',THIS_ROOT_URL_MEMBER.DS.'this_registration.php');
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
		
		define('PATH_LIB', $path.SUBDIR.DS.'include'.'/lib');
		
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
		define('ERROR_PAGE' ,THIS_DOMAIN.'/alert.html');
		define('E404_PAGE' ,THIS_DOMAIN.'/e404.html');
		// http://www.kdn.co.jp/404/index.html
		
		// Message Page
		//define('ANNOUNCE_PAGE',THIS_DOMAIN.'/announcement.php');
	
		define('AUTHORITY_LOGIN','kdn');
		define('AUTHORITY_PASS','kdn01395cw');
		
		/*------------------------
		 * DB MySQL
		 *-----------------------*/
		// Database Connect Option  test
		// define('G_HOST', 'mysql130.heteml.jp');
		// define('G_USER', '_kdn_system_db');
		// define('G_PASS', 'j2yl099hwapj7gk');
		// define('G_DBNAME', '_kdn_system_db');

//		define('G_HOST', 'localhost');
//		define('G_USER', 'root');
//		define('G_PASS', 'S65C32DA');
//		define('G_DBNAME', '_kdn_system_db');

		define('G_HOST', 'localhost');
		define('G_USER', '_kdn_system_db');
		define('G_PASS', 'j2yl099hwapj7gk');
		define('G_DBNAME', '_kdn_system_db');

	}

?>