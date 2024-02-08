<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "アプリケーション｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>アプリケーション｜京都電機器株式会社</title>
<meta name="keywords" content="アプリケーション,瞬時電圧低下保護装置,瞬低保護装置,直流電源,京都電機器">
<meta name="description" content="アプリケーションをご紹介しています。京都電機器はコアテクノロジーであるスイッチング電源技術を中心に、パワーエレクトロニクス事業を展開しています。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="g02">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li>アプリケーション</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_application01.gif" width="54" height="47" alt="アプリケーション"></span>
<span class="title01">アプリケーション</span>
</h2>

<div id="contents">
<section class="section">
<ul class="applicationTabTitle">
<li><a class="active" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/'; ?>">瞬時電圧低下保護装置</a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/led.php'; ?>">画像処理用LED照明</a></li>
</ul>

<div class="applicationTabContents">
<table class="tableApplication01">
<colgroup>
<col class="colW20per">
<col class="colW40per">
<col class="colW40per">
</colgroup>

<tbody>
<tr>
<th class="tableApplicationTitle01">&nbsp;</th>
<th class="tableApplicationTitle01">施設名</th>
<th class="tableApplicationTitle01">事例</th>
</tr>

<tr>
<th class="tableApplicationTitle02">工場</td>
<td>
<ul>
<li>半導体製造工場</li>
<li>電子部品製造工場</li>
<li>樹脂原料加工工場</li>
<li>フィルム加工工場</li>
<li>繊維工場</li>
<li>自動車工場</li>
<li>製紙工場</li>
</ul>
</td>
<td>
<ul>
<li>オートメーション機器用</li>
<li>コンピュータ等の制御機器用</li>
<li>搬送モーター用</li>
</ul>
</td>
</tr>

<tr>
<th class="tableApplicationTitle02">その他</td>
<td>
<ul>
<li>研究施設</li>
<li>データーセンター</li>
</ul>
</td>
<td>
<ul>
<li>マグネットコイル用</li>
<li>コンピュータ等の制御機器</li>
</ul>
</td>
</tr>
</tbody>
</table>
<!-- /applicationTabContents --></div>
<!-- /section --></section>
<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>