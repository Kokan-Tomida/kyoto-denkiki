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

$CONTENTS_PREFIX_FILENAME = array(
	'_outline', '_outline', '_spec', '_manual', '_other'
);
/*
$CONTENTS_NAME = array(
	'_outline' => '外形図',
	'_outline' => '外形図',
	'_spec' => '仕様書PDF',
	'_manual' => '取扱説明書PDF',
	'_other' => 'その他PDF'
);
*/

define('MEMBERSHIP1','1');
define('MEMBERSHIP2','2');
define('MEMBERSHIP3','3');
$MEMBERSHIP = array(
	'1' => '仮登録',
	'2' => '本登録',
	'3' => '退会',
);

define('IMAGE_E1','アップロード済');
define('IMAGE_E2','アップロード画像なし');

define('HISTORY_TYPE1','sample');
define('HISTORY_TYPE2','inquiry');
define('HISTORY_TYPE3','login');
define('HISTORY_TYPE4','download');

$HISTORY_TYPE_J = array(
	HISTORY_TYPE1 => '貸し出し',
	HISTORY_TYPE2 => '問い合わせ',
	HISTORY_TYPE3 => 'ログイン',
	HISTORY_TYPE4 => 'ダウンロード',
);

$SEAECH_MEMBER_KFN = array(
	'1' => '会員のみ',
	'2' => '非会員のみ',
	'3' => '両方',
);

?>