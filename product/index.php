<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 1;
$hassocial = 1;
$h1 = "製品情報｜京都電機器株式会社";
$path = "product/";
?>
<!DOCTYPE html>

<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>製品情報｜京都電機器株式会社</title>
<meta name="keywords" content="製品情報,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="製品情報の一覧をご紹介しています。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/jquery.sticky-kit.min.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="../common/js/jquery-lineup.min.js"></script>
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
<li>製品情報</li>
</ul>
<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_product01.gif" width="54" height="47" alt="製品情報"></span>
<span class="title01">製品情報</span>
</h2>
<div id="contents">
<article id="main">
<section class="section">
<div class="productList01">
<h3 class="h3_basic01"><span>パワーエレクトロニクス｜電源関連製品</span></h3>
<ul>
  <li>
    <a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/dc/'; ?>">
      <div class="lineUpH01">
        <div class="productListIn01">
          <h3 class="productH301">電源</h3>
          <figure><img src="images/pic_index01.jpg" width="309" height="98" alt="直流電源装置"></figure>
          <p class="productTxt01">SiC素子を搭載した直流電源、高圧電源、高速パルス電源をラインナップ。長年培ってきた要素技術を元に用途に合わせた電源設計にも対応しております。</p>
          <!-- /productListIn01 --></div>
      </div>
      <p class="productBtn01">製品を見る</p>
    </a>
  </li>
  <li>
    <a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/mdp/'; ?>">
      <div class="lineUpH01">
        <div class="productListIn01">
          <h3 class="productH301">瞬時電圧低下保護装置</h3>
          <figure><img src="images/pic_index02.jpg" width="309" height="98" alt="瞬時電圧低下保護装置"></figure>
          <p class="productTxt01">瞬時電圧低下と瞬時電断を保護します。バッテリーレス/ファンレスによりUPSに比べ長寿命・メンテナンスフリーを実現した瞬低・瞬断専用対策装置です。800VAから200kVAまで幅広くラインナップしています。</p>
          <!-- /productListIn01 --></div>
        </div>
        <p class="productBtn01">製品を見る</p>
      </a>
  </li>

</ul>

<h3 class="h3_basic01"><span>オプトエレクトロニクス｜光学関連製品</span></h3>        
<ul>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/'; ?>">
<div class="lineUpH01">
<div class="productListIn01">
<h3 class="productH301">画像処理用LED照明</h3>
<figure><img src="images/pic_index03.jpg" width="309" height="98" alt="画像処理用LED照明"></figure>
<p class="productTxt01">LEDを使用した画像処理用の各種照明、電源を設計・製作しています。近年LEDは画像処理検査機やWEB検査機のみならず住宅、自動車関連の需要も広がり、技術革新のめざましい分野です。京都電機器はそういったお客様のご要望にマッチした照明と電源をご提供いたします。</p>
<!-- /productListIn01 --></div>
</div>
<p class="productBtn01">製品を見る</p>
</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/uv/'; ?>">
<div class="lineUpH01">
<div class="productListIn01">
<h3 class="productH301">UV-LED照射装置</h3>
<figure><img src="images/pic_index04.jpg" width="309" height="98" alt="UV-LED照射装置"></figure>
<p class="productTxt01">UV硬化用のLED照射器です。用途に合わせて、波長の選定と照射強度設計を行います。空冷タイプ・水冷タイプをラインナップしています。</p>
<!-- /productListIn01 --></div>
</div>
<p class="productBtn01">製品を見る</p>
</a>
</li>
</ul>
<!-- /productList01 --></div>

<div class='productList02'>
<h3 class="h3_basic01"><span>その他取り扱い製品</span></h3>
<ul>
    <li>
        <a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/'; ?>">
          <figure>
            <figcaption>画像処理用蛍光灯照明</figcaption>
          </figure>
        </a>
    </li>
    <!-- li>
        <a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/xenon/'; ?>">
          <figure>
            <figcaption>キセノン管ストロボ装置</figcaption>
          </figure>
        </a>
    </li -->
  </ul> 
</div>

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