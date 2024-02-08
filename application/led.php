<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "画像処理用LED照明｜アプリケーション｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>画像処理用LED照明｜アプリケーション｜京都電機器株式会社</title>
<meta name="keywords" content="アプリケーション,画像処理用蛍光灯照明,画像処理用LED照明,キセノン管ストロボ装置,京都電機器">
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
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/'; ?>">アプリケーション</a></li>
<li>画像処理用LED照明</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_application01.gif" width="54" height="47" alt="アプリケーション"></span>
<span class="title01">アプリケーション</span>
</h2>

<div id="contents">
<section class="section">
<ul class="applicationTabTitle">
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/'; ?>">瞬時電圧低下保護装置</a></li>
<li><a class="active" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/led.php'; ?>">画像処理用LED照明</a></li>
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
<th class="tableApplicationTitle01">装置名</th>
<th class="tableApplicationTitle01">事例</th>
</tr>

<tr>
<th class="tableApplicationTitle02">検査装置</td>
<td>
<ul>
<li>錠剤検査機</li>
<li>WEB検査機</li>
<li>印字検査機</li>
<li>外観検査機</li>
<li>フィルム検査機</li>
<li>色彩選別機</li>
</ul>
</td>
<td>
<ul>
<li>探傷検査用照明</li>
<li>形状検査用照明</li>
<li>異物検査用照明</li>
</ul>
</td>
</tr>

<tr>
<th class="tableApplicationTitle02">組立装置</td>
<td>
<ul>
<li>ダイボンダー</li>
<li>チップマウンター</li>
<li>貼合せ装置</li>
</ul>
</td>
<td>
<ul>
<li>外観検査用照明</li>
<li>位置決め用照明</li>
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