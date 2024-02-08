<?php

$TOP_CONTENTS = array(
	'P' => 'パワーエレクトロニクス',
	'O' => 'オプトエレクトロニクス'
);

$CONTENTS_FILES = array(
	'contents10', 'contents11', 'contents20', 'contents30', 'contents40'
);

$CONTENTS_NAME = array(
	'contents10' => '外形図PDF',
	'contents11' => '外形図DXF',
	'contents20' => '仕様書PDF',
	'contents30' => '取扱説明書PDF',
	'contents40' => 'その他PDF'
);

define('MEMBERSHIP1','1');
define('MEMBERSHIP2','2');
define('MEMBERSHIP3','3');
$MEMBERSHIP = array(
	'1' => '仮登録',
	'2' => '本登録',
	'3' => '退会',
);

define('IMAGE_E1','アップロード画像あり');
define('IMAGE_E2','アップロード画像なし');

// 会員パスワードの長さ
define('MEMBER_PWD_LENGTH',8);

// 会員ログイン後の敬称
define('SAMA',' 様');

// 問い合わせ種別プルダウン
$INQUIRY_SELECT_MEMBER = array(
	'1' => 'パワーエレクトロニクス製品に関するお問い合わせ',
	'2' => 'オプトエレクトロニクス製品に関するお問い合わせ',
);
$INQUIRY_SELECT = array(
	'1' => 'パワーエレクトロニクス製品に関するお問い合わせ',
	'2' => 'オプトエレクトロニクス製品に関するお問い合わせ',
	'3' => '会員用パスワード再発行',
);

$INQUIRY_CHECKBOX = array(
	'1' => '見積希望',
	'2' => '製品購入について',
	'3' => 'カタログ・各種資料請求',
	'4' => 'その他のお問い合わせ',
);

// Form state
$FORM_STATE = array(
	'0' => 'CONFIRM',
	'1' => 'CONFIRM_NEXT',
);

$NEEDS = array(
	'1' => '必要',
	'2' => '不要',
);
$CABLE_LENGTH = array(
	'1' => '2m',
	'2' => '3m',
	'3' => '4m',
	'4' => 'その他',
);

define('HISTORY_TYPE1','sample');
define('HISTORY_TYPE2','inquiry');
define('HISTORY_TYPE3','login');
define('HISTORY_TYPE4','download');

?>