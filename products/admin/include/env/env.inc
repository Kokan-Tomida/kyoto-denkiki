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

	// test	
	define('SUBDIR', '/products/admin');

	define('THIS_DOMAIN', HTTP.DOMAIN);
	define('DS', '/');
	
	// Root URL https
	define('THIS_ROOT_URL', HTTP.$_SERVER['HTTP_HOST'].SUBDIR);
	
	$path = $_SERVER['DOCUMENT_ROOT'].SUBDIR;
	define('AP_ROOT', $path);
	
	$pathmod = $path.'/include';	
	define('PATH_MODULES', $pathmod);
	define('PATH_LIB', PATH_MODULES.'/lib');
	define('PATH_TEMPLATE', PATH_MODULES.'/view');
	
	$WEB_SERVER_NAME = $_SERVER['SERVER_NAME'];	
	
	// log
	define('PATH_LOG', PATH_MODULES.'/log');
	// Error Page
	define('ERROR_PAGE' ,THIS_ROOT_URL.'/alert.html');
	define('E404_PAGE' ,THIS_ROOT_URL.'/e404.html');
	// http://www.kdn.co.jp/404/index.html
	
	// Message Page
	//define('ANNOUNCE_PAGE',THIS_ROOT_URL.'/announcement.php');
	//define('AUTHORITY_LOGIN','kdn');
	//define('AUTHORITY_PASS','kdn01395cw');
	
		/*------------------------
	 * DB MySQL
	 *-----------------------*/
	// Database Connect Option
	// define('G_HOST', 'mysql130.heteml.jp');
	define('G_HOST', 'localhost');
	//define('G_USER', '_kdn_system_db');
	define('G_USER', 'kdn');
	define('G_PASS', 'j2yl099hwapj7gk');
	//define('G_PASS', 'J2yl099hwapj7gk$');
	define('G_DBNAME', '_kdn_system_db');
	
	/*------------------------
	 * UPLOAD
	 *-----------------------*/
	// upload 最大サイズ image,pdf
	define('MAX_SIZE', 2097152);	//1MB=1024KB=1048576Byte
	// upload ディレクトリ  $_SERVER['DOCUMENT_ROOT']
	define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/products_files');
	define('UPLOAD_DIR_MIDDLE_CATEGORY', UPLOAD_DIR.'/middle_category');
	define('UPLOAD_DIR_CONTENTS', UPLOAD_DIR.'/contents');

	// 拡張子 image/pdf
	$ALLOW_EXT1 = array('jpg','jpeg');
	$ALLOW_EXT11 = array('jpg','jpeg','gif','png');
	$ALLOW_EXT2 = array('pdf');
	$ALLOW_EXT3 = array('dxf');
	// アップロード可能最大ファイルサイズ(width,height)
	$ALLOW_PX_SIZE = array(70,70);

	/*------------------------
	 * CSV
	 *-----------------------*/
	// CSV ディレクトリ名
	define('CSV_PATH', './files/output');

	// CSV 先頭のタイトル行を出力するかどうか設定   (true 出力する / false 出力しない)
	define('CSV_TITLE_OUTPUT', true);



?>
