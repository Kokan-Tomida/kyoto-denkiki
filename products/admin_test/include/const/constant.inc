<?php

	/**--------------------------------------------------
	@description:		Constant.inc 
	----------------------------------------------------*/

	/*------------------------
	 * debug
	 *-----------------------*/
	// false --- Debug
	// true ---- Release
	define('G_SYS_TEST', false);
	
	/*------------------------
	 * environment
	 *-----------------------*/
	mb_language('ja');
	define('CHARSET', 'utf-8');

	/*------------------------
	 * constant
	 *-----------------------*/
	define('IME_STYLE', 'style="ime-mode:disabled;"');
	define('CERTAIN', '<div class="at">(*)</div>');
	define('DISPLAY_STYLE_NONE', 'style="display:none;"');
	define('DISPLAY_STYLE_VISIBLE', 'style="display:visible;"');

	/*------------------------
	 * session key
	 *-----------------------*/
	define('S_KEY10', 'management');
	define('S_KEY20', 'form');
	define('S_KEY21', 'query');
	define('S_KEY22', 'searchkey');
	
	define('S_KEY30', 'status');
	
	define('S_KEY11', 'authority');
	define('S_KEY99', 'admin');
	
	define('CSS_PATH', 'common/css');
	define('G01', CSS_PATH.DS.'menu_g01.css');
	define('G02', CSS_PATH.DS.'menu_g02.css');
	define('G03', CSS_PATH.DS.'menu_g03.css');
	define('G04', CSS_PATH.DS.'menu_g04.css');
	define('G05', CSS_PATH.DS.'menu_g05.css');

	/*------------------------
	 *  一覧ページ　表示行数/Page
	 *-----------------------*/
	if(G_SYS_TEST){
		//release
		define("VIEW_PAR_PAGE", 15);
		// 1ページに表示するページ番号の個数
		define("VIEW_PAGENO", 5);
	}else{
		//debug
		define("VIEW_PAR_PAGE", 15);
		// 1ページに表示するページ番号の個数
		define("VIEW_PAGENO", 5);
	}
	
	// メール日本語デコード
	define('MAIL_DECODE', 'ISO-2022-JP');
	
	// Mail
	require_once('mail.inc');

	// 都道府県、年号、性別	
	require_once('constant2.inc');

	// マスタ関連
	require_once('constant3.inc');

	// message
	require_once('message.inc');
	
	// form
	require_once('elements.inc');

?>