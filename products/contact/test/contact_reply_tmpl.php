<?php

/*--------------------------------------------------------------------------
	フォームメール - sformmmail2
	(c)Sapphirus.Biz

	※このスクリプトの文字エンコードは euc-jp から変更しないで下さい。
--------------------------------------------------------------------------*/

// 自動返信のSubject（件名）
$replySubject = 'お問い合わせありがとうございました。';

//送信メッセージ
$replyMessage = <<< EOD
{$sfm_mail->tantou}様
この度は京都電機器株式会社へお問い合わせありがとうございます。
追って弊社担当よりご連絡差し上げます。
-------------------------------------------------------------------------
御社名
{$sfm_mail->cname}

郵便番号
{$sfm_mail->zip}

都道府県
{$sfm_mail->address1}

ご住所
{$sfm_mail->address2}

TEL
{$sfm_mail->tel}

FAX
{$sfm_mail->fax}

担当部署
{$sfm_mail->busyo}

ご担当者名
{$sfm_mail->tantou}

メールアドレス
{$sfm_mail->email}

お問い合わせ種別
{$sfm_mail->syubetsu01}
{$sfm_mail->syubetsu02}

お問い合わせ内容
{$sfm_mail->toiawase}
-------------------------------------------------------------------------
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
Power Electronics and Optelectronics
Kyoto Denkiki Co.,Ltd.
+++++++++++++++++++++++++++++++++++++
京都電機器株式会社
〒611-0041
京都府宇治市槙島町十六19-1
電話　0774-25-7710
e-mail　products@kdn.co.jp

▼コーポレートサイト
http://www.kdn.co.jp/
▼パワーエレクトロニクスサイト
http://kdn-products.com/power/
▼オプトエレクトロニクスサイト
http://kdn-products.com/opt/
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
EOD;

?>
