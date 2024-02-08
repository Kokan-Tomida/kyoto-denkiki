<?php

/*--------------------------------------------------------------------------
	フォームメール - sformmmail2
	(c)Sapphirus.Biz

	※このスクリプトの文字エンコードは euc-jp から変更しないで下さい。
--------------------------------------------------------------------------*/

// 自動返信のSubject（件名）
$replySubject = '【オプトエレクトロニクス】サンプル機貸出のお申込み';

//送信メッセージ
$replyMessage = <<< EOD
{$sfm_mail->tantou}様
この度はオプトエレクトロニクスのサンプル機貸出へ
お申込みありがとうございます。
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

【ご希望貸し出し内容】

照明
1.型式 {$sfm_mail->syomei01}
2.型式 {$sfm_mail->syomei02}

電源
{$sfm_mail->dengen01}
電源形式 {$sfm_mail->dengen02}

延長ケーブル
電源形式 {$sfm_mail->cable01} {$sfm_mail->cable02} 本
{$sfm_mail->cable03}{$sfm_mail->cable04} m

貸し出し希望日
{$sfm_mail->kiboubi01}年{$sfm_mail->kiboubi02}月{$sfm_mail->kiboubi03}日

返却予定日
{$sfm_mail->yoteibi01}年{$sfm_mail->yoteibi02}月{$sfm_mail->yoteibi03}日

対象物ワーク
{$sfm_mail->work01}

ワークの大きさ
{$sfm_mail->work02}

距離
カメラ-照明 {$sfm_mail->kyori01}
照明-ワーク {$sfm_mail->kyori02}

検査内容
{$sfm_mail->kensa}
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
