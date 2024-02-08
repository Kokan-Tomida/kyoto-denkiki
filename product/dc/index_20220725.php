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
<title>電源｜京都電機器株式会社</title>
<meta name="keywords" content="直流電源装置,スパッタリング用DCパルス電源,プログラマブル電源,瞬時電圧低下保護装置,直流電源,京都電機器">
<meta name="description" content="電源の製品一覧をご紹介しています。京都電機器はコアテクノロジーであるスイッチング電源技術を中心に、パワーエレクトロニクス事業を展開しています。">
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
<li>電源</li>
</ul>
<h2 class="h2_basic01">
<span class="icon01"><img src="../../common/images/h2_product01.gif" width="54" height="47" alt="製品情報"></span>
<span class="title01">製品情報</span>
</h2>
<div class="productMainimgWrap">
<div class="productMainimgBox01">
<figure><img src="images/mainimg_dc01.jpg" width="960" height="230" alt="直流電源装置"></figure>
<div class="productMainimgInfo01">
<h2 class="productH201">電源</h2>
<p class="productMainimgTxt01">直流電源、交流電源、高圧電源など、幅広い分野で<br>新たなエレクトロニクスソリューションを展開します。</p>
<!-- /productMainimgInfo01 --></div>
<!-- /productMainimgBox01 --></div>

<div class="productMainimgBox02">
<p class="productTitle01">電源</p>
<p class="productTxt01">京都電機器は長年培ってきた固有の技術を元に直流電源、交流電源、高圧電源を設計開発してきました。インバーター回路には弊社で内製化に成功したスイッチング素子を搭載し、一般市販品では成し遂げられなかった高効率・高速応答を実現しました。これらの電源は半導体や液晶製造装置などの最先端の製造装置に組み込まれ、産業界に貢献しております。<br>用途に合わせたカスタム電源設計を得意とし、安全規格・環境対応のご要望にもお応えしております。</p>
<!-- /productMainimgBox02 --></div>
<!-- /productMainimgWrap --></div>
<div id="contents">
<article id="main">
<section class="section">
<div class="productLedList01">
<ul>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/dc/sat/'; ?>">
<div class="lineUpH01 new">
<div class="productListIn01">
<h3 class="productH302">スパッタリング用DCパルス電源<br><span>SAT-56S/SAT-56D</span></h3>
<figure><img src="images/pic_dc02.jpg" width="194" height="98" alt="スパッタリング用DCパルス電源"></figure>
<p class="productTxt01">SAT-56シリーズはアーク遮断回路を内蔵したスパッタリング用電源です。直流出力はもちろんのことパルス出力としても使用できます。シングル、デュアルタイプがあり用途にあった使い方が可能です。SiC素子を用いた弊社独自の回路により、アーク蓄積エネルギーを200μJ/kW以下にすることを実現しております。</p>
<!-- /productListIn01 --></div>
</div>
<p class="productBtn01">詳細を見る</p>
</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/dc/kdc/'; ?>">
<div class="lineUpH01">
<div class="productListIn01">
<h3 class="productH302 kdc">プログラマブルDC電源（CVCC）<span>KDC series</span></h3>
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