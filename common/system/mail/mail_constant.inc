<?php

/******************************************************************
 * メール　件名
 *******************************************************************/

/*
*プロダクツサイトのお問い合わせフォーム  会員/ゲスト
*/
define('PRODUCTS_INQUIRY_SUBJECT','【京都電機器】お問い合わせありがとうございました。');

/*
*オプトエレクトロニクスのサンプル機貸出フォーム
*/
define('OPT_RENT_SUBJECT','【京都電機器】貸出機のお申込みありがとうございました。');

/*
*プロダクツサイトの会員登録フォーム　仮登録完了
*/
define('MEMBER_REGIST_FIRST_SUBJECT','【京都電機器】仮会員登録のご案内');

/*
*　会員本登録完了
*/
define('MEMBER_REGIST_COMPLETE_SUBJECT','【京都電機器】本会員登録完了のご案内');

/*
*　会員情報　編集完了
*/
define('MEMBER_EDIT_SUBJECT','【京都電機器】会員情報変更の受け付け');

/*
*　退会完了
*/
define('MEMBER_WITHDRAW_SUBJECT','【京都電機器】退会を受け付けました');

/*
 * 会員　パスワードの再発行
 */
define('MEMBER_PASSWORD_REMAINDER_SUBJECT','【京都電機器】パスワード再発行');

/*
 * 会員　ログイン通知
*/
define('MEMBER_LOGINED_SUBJECT','');

/*
 * 会員　ダウンロード
*/
define('PRODUCTS_DOWNLOAD_SUBJECT','');


// 会員問い合わせ
define('MAIL_TYPE1','1');
// サンプル機貸出
define('MAIL_TYPE2','2');
// 会員仮登録
define('MAIL_TYPE3','3');
// 会員本登録
define('MAIL_TYPE4','4');
// 会員情報編集
define('MAIL_TYPE5','5');
// 会員退会
define('MAIL_TYPE6','6');
// リマインダ
define('MAIL_TYPE7','7');
// ゲスト問い合わせ
define('MAIL_TYPE8','8');
// ログイン
define('MAIL_TYPE9','9');
// ダウンロード
define('MAIL_TYPE10','10');



/**************************************************************
 * メールタイプ
 ***************************************************************/
$MAIL_TYPE = array(
	'1' => array(PRODUCTS_INQUIRY_SUBJECT,'products_inquiry.txt'),
	'2' => array(OPT_RENT_SUBJECT,'opt_rent.txt'),
	'3' => array(MEMBER_REGIST_FIRST_SUBJECT,'member_regist_first.txt'),
	'4' => array(MEMBER_REGIST_COMPLETE_SUBJECT,'member_regist_complete.txt'),
	'5' => array(MEMBER_EDIT_SUBJECT,'member_edit.txt'),
	'6' => array(MEMBER_WITHDRAW_SUBJECT,'member_withdraw.txt'),
	'7' => array(MEMBER_PASSWORD_REMAINDER_SUBJECT,'member_password_remainder.txt'),
	'8' => array(PRODUCTS_INQUIRY_SUBJECT,'products_inquiry_guest.txt'),
	'9' => array(MEMBER_LOGINED_SUBJECT,'member_logined.txt'),
	'10' => array(PRODUCTS_DOWNLOAD_SUBJECT,'products_download.txt'),
);


/**************************************************************
 * 仮登録URL　有効時間
 ***************************************************************/
define('VALIDITY_TIME',1);

define('MAIL_FROM_NAME','京都電機器株式会社');


/**************************************************************
 * メール本文中の区切り文字
***************************************************************/
define('MAIL_BODY_SEPARETION',"\n-------------------------------------------\n");

?>