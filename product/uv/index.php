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
<title>UV-LED照射装置｜京都電機器株式会社</title>
<meta name="keywords" content="UV-LED照射装置,プログラマブル電源,瞬時電圧低下保護装置,直流電源,京都電機器">
<meta name="description" content="UV-LED照射装の製品一覧をご紹介しています。京都電機器はコアテクノロジーであるスイッチング電源技術を中心に、パワーエレクトロニクス事業を展開しています。">
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
<li>UV-LED照射装置</li>
</ul>
<h2 class="h2_basic01">
<span class="icon01"><img src="../../common/images/h2_product01.gif" width="54" height="47" alt="製品情報"></span>
<span class="title01">製品情報</span>
</h2>
<div class="productMainimgWrap">
<div class="productMainimgBox01">
<figure><img src="images/mainimg_uv01.jpg" width="960" height="230" alt="UV-LED照射装置"></figure>
<div class="productMainimgInfo01">
<h2 class="productH201">UV-LED照射装置</h2>
<p class="productMainimgTxt01">硬化に適した波長のLEDを選択できます。<br>照射/消灯が自在なので必要な時間だけ照射が可能です<br>
LED照射器がランプ照射器の持つ課題を解決します。</p>
<!-- /productMainimgInfo01 --></div>
<!-- /productMainimgBox01 --></div>

<div class="productMainimgBox02">
<p class="productTitle01">UV-LED照射装置</p>
<p class="productTxt01">UV-LED照射器はランプ照射器の置換えとして使われています。点灯と消灯が自在に行えること、ウォームアップ時間が短いことなど、誰にでも簡単に操作することができます。ランプ照射器にあるランプ交換もなく、メンテナンスコスト削減に貢献いたします。波長は365、375、385、395、405nmを揃え、用途に合わせた出力強度の設計が可能です。照射器だけでなくコントローラー部も合わせて提供しております。</p>
<!-- /productMainimgBox02 --></div>
<!-- /productMainimgWrap --></div>
<div id="contents">
<article id="main">
<section class="section">
<div class="productLedList01">
<ul>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/uv/uv_led/'; ?>">
<div class="lineUpH01">
<div class="productListIn01">
<h3 class="productH302"><span>UV-LED照射器</span></h3>
<figure><img src="images/pic_uv01.jpg" width="194" height="98" alt="UV-LED照射器"></figure>
<p class="productTxt01">空冷式と水冷式をラインナップしています。照射強度も用途に合わせて設計することができます。
LED駆動用のハイパワーコントローラーも合わせて提供いたします。
</p>
<!-- /productListIn01 --></div>
</div>
<p class="productBtn01">詳細を見る</p>
</a>


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