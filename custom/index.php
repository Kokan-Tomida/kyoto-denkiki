<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "カスタム製品の製作について";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>カスタム製品について｜京都電機器株式会社</title>
<meta name="keywords" content="カスタム製品,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="カスタム製品の製作についてご紹介しています。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="../common/js/jquery-lineup.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$('.lineUpH01').lineUp();
});
</script>
</head>

<body id="gDef" class="lDef">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li>カスタム製品の製作について</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_custom01.gif" width="54" height="47" alt="カスタム製品について"></span>
<span class="title01">カスタム製品の製作について</span>
</h2>

<div id="contents">
<section class="section">
<div class="sectionIn01">
<div class="customIndexList01">
<ul>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/custom/power/'; ?>">
<div class="customIndexListIn01">
<div class="lineUpH01">
<p class="customIndexTit01">カスタム電源の製作について</p>
<figure><img src="images/img_index01.jpg" width="396" height="138" alt="カスタム電源の製作について"></figure>
<div class="customIndexTxtBox01">
<p>弊社は、お客様のシステムの中で的確に機能する電源の役割とは何かを、常に考え続けてまいりました。言われた通りのものをつくるのではなく、蓄積したノウハウを最大限に活用し、ベストなトポロジーの選定から、安全性確保のための保護回路の検討、信頼性を担保するための熱設計、部品の品質評価等を踏まえて、最適な電源のカスタマイゼーションをご提案させて頂きます。</p>
<!-- /customIndexTxtBox01 --></div>
</div>
<!-- /customIndexListIn01 --></div>
<p class="customIndexBtn01">詳細はこちら</p>
</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/custom/opt/'; ?>">
<div class="customIndexListIn01">
<div class="lineUpH01">
<p class="customIndexTit01">カスタム照明の製作について</p>
<figure><img src="images/img_index02.jpg" width="396" height="138" alt="カスタム照明の製作について"></figure>
<div class="customIndexTxtBox01">
<p>当社では、カタログ掲載商品以外にお客様より"こんな形状の照明はできないか"、"こんなワーク見るための照明はないか"等の声にお応えするためカスタムLED照明を独自の技術や製造方法でもって提供できるようがんばっております。</p>
<!-- /customIndexTxtBox01 --></div>
</div>
<!-- /customIndexListIn01 --></div>
<p class="customIndexBtn01">詳細はこちら</p>
</a>
</li>
</ul>
<!-- /customIndexList01 --></div>
<!-- /sectionIn01 --></div>
<!-- /section --></section>
<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>