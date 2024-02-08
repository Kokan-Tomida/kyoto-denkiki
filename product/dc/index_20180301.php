<?php 
require_once dirname(__FILE__) . "/../../common/system/application.php";
$lang = 1;
$hassocial = 1;
$h1 = "直流電源装置一覧｜京都電機器株式会社";
$path = "product/dc/";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>直流電源装置｜京都電機器株式会社</title>
<meta name="keywords" content="直流電源装置,プログラマブル電源,瞬時電圧低下保護装置,直流電源,京都電機器">
<meta name="description" content="直流電源装置の製品一覧をご紹介しています。京都電機器はコアテクノロジーであるスイッチング電源技術を中心に、パワーエレクトロニクス事業を展開しています。">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<script type="text/javascript" src="../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../common/js/jquery.sticky-kit.min.js"></script>
<script type="text/javascript" src="../../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="../../common/js/jquery-lineup.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$('.lineUpH01').lineUp();
});
</script>
</head>

<body id="g01" class="lDef">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">


<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/'; ?>">製品情報</a></li>
<li>直流電源装置</li>
</ul>
<h2 class="h2_basic01">
<span class="icon01"><img src="../../common/images/h2_product01.gif" width="54" height="47" alt="製品情報"></span>
<span class="title01">製品情報</span>
</h2>
<div class="productMainimgWrap">
<div class="productMainimgBox01">
<figure><img src="images/mainimg_dc01.jpg" width="960" height="230" alt="直流電源装置"></figure>
<div class="productMainimgInfo01">
<h2 class="productH201">直流電源装置</h2>
<p class="productMainimgTxt01">高効率スイッチング回路と<br>独自開発のノイズキャンセル回路を搭載した低リップル
<br>直流安定化電源</p>
<!-- /productMainimgInfo01 --></div>
<!-- /productMainimgBox01 --></div>

<div class="productMainimgBox02">
<p class="productTitle01">直流安定化電源</p>
<p class="productTxt01">京都電機器の直流安定化電源はPFC回路を標準装備し、最大力率0.99を実現しています。<br>また最新のスイッチング半導体素子を使うことに成功し、内部発熱を低減。高効率な直流安定化電源となっています。独自のノイズキャンセル回路も搭載しておりますので、低リップルであるのは当然のこと、部品の軽減・軽量化により電源本体の軽量化とコスト低減を追求した直流安定化電源です。<br>組込用やカスタマイズにも柔軟に対応しております。</p>
<!-- /productMainimgBox02 --></div>
<!-- /productMainimgWrap --></div>
<div id="contents">
<article id="main">
<section class="section">
<div class="productLedList01">
<ul>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/dc/kdc/'; ?>">
<div class="lineUpH01">
<div class="productListIn01">
<h3 class="productH302">プログラマブルDC電源<br>（CVCC）<span>KDC series</span></h3>
<figure><img src="images/pic_dc01.jpg" width="194" height="98" alt="プログラマブルDC電源（CVCC）KDC series"></figure>
<p class="productTxt01">1U（44㎜）サイズで最大1500Wの高出力直流安定化電源です。シンプルな設計で使いやすさを追求しています。マスタースレーブや通信機能はオプションで選択でき、幅広い分野や用途でお使いいただける直流安定化電源です。</p>
<!-- /productListIn01 --></div>
</div>
<p class="productBtn01">詳細を見る</p>
</a>
</li>
</ul>
<!-- /productList01 --></div>

<!-- download -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/download01.php'); ?>
<!-- /download -->

<ul class="ul_notes01 mt10">
<li>※サイト内にて記載しているデータ類は参考値です。製品の性能を保証するものではありません。</li>
</ul>
<!-- /section --></section>
<!-- /main --></article>

<div id="sub">
<div id="subFixer">
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/contact.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/banner01.php'); ?>
</div>
<!-- /sub --></div>

<!-- /contents --></div>

<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>