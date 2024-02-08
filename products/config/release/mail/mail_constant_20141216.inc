<?php

/******************************************************************
 * メール　件名
 *******************************************************************/

/*
*プロダクツサイトのお問い合わせフォーム  会員/ゲスト
*/
define('PRODUCTS_INQUIRY_SUBJECT','【京都電機器プロダクツ】お問い合わせありがとうございました。');

/*
*オプトエレクトロニクスのサンプル機貸出フォーム
*/
define('OPT_RENT_SUBJECT','【オプトエレクトロニクス】サンプル機貸出のお申込み');

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
);


/**************************************************************
 * 仮登録URL　有効時間
 ***************************************************************/
define('VALIDITY_TIME',24);

define('MAIL_FROM_NAME','京都電機器株式会社');

?>