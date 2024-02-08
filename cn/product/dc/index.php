<?php 
require_once dirname(__FILE__) . "/../../../common/system/application.php";
$lang = 1;
$h1 = "直流电源装置｜京都电机器株式会社";
$path = "/product/dc/";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>直流电源装置｜京都电机器株式会社</title>
<meta name="keywords" content="直流电源装置,可编程电源,瞬时电压下降保护装置,直流电源,京都电机器">
<meta name="description" content="直流电源装置">
<link rel="stylesheet" type="text/css" href="/common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="/common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="/product/css/style.css" media="all">
<script type="text/javascript" src="/common/js/jquery.js"></script>
<script type="text/javascript" src="/common/js/jquery.sticky-kit.min.js"></script>
<script type="text/javascript" src="/common/js/common.js"></script>
<!--[if lt IE 9]><script src="/common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="/common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="/common/js/jquery-lineup.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$('.lineUpH01').lineUp();
});
</script>
</head>

<body id="g01" class="lDef">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header02.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">


<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/'; ?>">ホーム</a></li>
<li class="lang_cn" lang="zh"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/'; ?>">产品信息</a></li>
<li class="lang_cn" lang="zh">直流电源装置</li>
</ul>
<h2 class="h2_basic01 lang_cn" lang="zh">
<span class="icon01"><img src="/common/images/h2_product01.gif" width="54" height="47" alt="产品信息"></span>
<span class="title01">产品信息</span>
</h2>
<div class="productMainimgWrap lang_cn" lang="zh">
<div class="productMainimgBox01">
<figure><img src="/product/dc/images/mainimg_dc01.jpg" width="960" height="230" alt="直流电源装置"></figure>
<div class="productMainimgInfo01">
<h2 class="productH201">直流电源装置</h2>
<p class="productMainimgTxt01">搭载了高效开关电路和独自研发的降噪电路的<br>低纹波直流稳压电源
</p>
<!-- /productMainimgInfo01 --></div>
<!-- /productMainimgBox01 --></div>

<div class="productMainimgBox02">
<p class="productTitle01">直流稳压电源</p>
<p class="productTxt01">京都电气设备的直流稳压电源中标配PFC电路，最大功率因数可实现0.99。
此外，我公司通过成功使用最新的开关半导体元件，有效降低了内部发热，使其成为了高效的直流稳压电源。由于搭载了独自研发的降噪电路，因此低纹波是理所当然的，通过减轻元器件和轻量化处理，实现了电源主体的轻量化和追求降低成本的直流稳压电源产品。<br>
不论是嵌入式还是定制式都可以灵活应对。</p>
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
<div class="productListIn01 lang_cn" lang="zh">
<h3 class="productH302">可编程DC电源<br>(CVCC)<span>KDC series</span></h3>
<figure><img src="/product/dc/images/pic_dc01.jpg" width="194" height="98" alt="可编程DC电源（CVCC）KDC series"></figure>
<p class="productTxt01">采用1U（44㎜）尺寸规格且最高可达1500W的高输出直流稳压电源。追求以简单的设计来实现使用方便性。可以通过选项来选择主从配置和通信功能且广泛应用于多个领域和用途的直流稳压电源。</p>
<!-- /productListIn01 --></div>
</div>
<p class="productBtn01">查看本产品详情</p>
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
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer02.php'); ?>
<!-- /footer --> 

</body>
</html>