<?php
require_once dirname(__FILE__) . "/../../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "インフォメーション｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>インフォメーション｜京都電機器株式会社</title>
<meta name="keywords" content="インフォメーション,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="インフォメーションの一覧をご紹介しています。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<script type="text/javascript" src="../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="gDef" class="l06">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$_SERVER['SERVER_NAME'].'/'; ?>">ホーム</a></li>
<li>インフォメーション</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../../common/images/h2_information01.gif" width="54" height="47" alt="インフォメーション"></span>
<span class="title01">インフォメーション</span>
</h2>

<div id="contents">
<article id="main">
<div id="mainIn">
<h3 class="h3_basic01"><span>ニュースリリース</span></h3>
<section class="section">
<ul class="informationList01">
<li>
<div class="informationDate01">
<p>2014年2月28日</p>
<p class="informationIco01"><img src="../images/ico_product01.gif" width="90" height="20" alt="製品"></p>
<!-- /informationDate01 --></div>

<div class="informationTxtBox01">
<p class="informationTit01">各種データダウンロードページを公開いたしました。</p>
<p class="informationTxt01">各製品の外形図、仕様書、取扱説明書等をダウンロードしていただけます。<br>ご利用には会員登録が必要です。登録されていない方は、<a href="<?php echo $TJF_HTTP.$_SERVER['SERVER_NAME'].'/member/'; ?>">こちら</a>から会員登録をお願いいたします。</p>
<!-- /informationTxtBox01 --></div>
</li>
</ul>
</section>
<!-- /mainIn --></div>
<!-- /main --></article>

<div id="sub">
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/information.php'); ?>
<!-- /sub --></div>

<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer -->

</body>
</html>