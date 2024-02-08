<?php
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "各種データダウンロード｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>各種データダウンロード｜京都電機器株式会社</title>
<meta name="keywords" content="各種データダウンロード,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="各種データダウンロードについてご紹介しています。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
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

<body id="gDef" class="lDef">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$_SERVER['SERVER_NAME'].'/'; ?>">ホーム</a></li>
<li>各種データダウンロード</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_download01.gif" width="54" height="47" alt="カスタム製品について"></span>
<span class="title01">各種データダウンロード</span>
</h2>

<div id="contents">
<section class="section">
<div class="sectionIn01">
<p class="downloadIndexTxt">パワーエレクトロニクス製品、オプトエレクトロニクス製品では、<br>取扱説明書や外形図のPDF、もしくはDXFファイルなどをご利用いただけます。</p>
<div class="downloadIndexList01">
<ul>
<li>
<a href="<?php echo $TJF_HTTP.$_SERVER['SERVER_NAME'].'/download/power/'; ?>">
<div class="downloadIndexListIn01">
<div class="lineUpH01">
<p class="downloadIndexTit01">パワーエレクトロニクス｜各種データダウンロード</p>
<figure><img src="images/img_index01.jpg" width="397" height="222" alt="瞬時電圧保護装置・直流電源装置"></figure>
</div>
<!-- /downloadIndexListIn01 --></div>
<p class="downloadIndexBtn01">ダウンロードする</p>
</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$_SERVER['SERVER_NAME'].'/download/opt/'; ?>">
<div class="downloadIndexListIn01">
<div class="lineUpH01">
<p class="downloadIndexTit01">オプトエレクトロニクス｜各種データダウンロード</p>
<figure><img src="images/img_index02.jpg" width="397" height="222" alt="画像処理用LED照明・画像処理用蛍光灯照明・キセノン管ストロボ照明"></figure>										
</div>
<!-- /downloadIndexListIn01 --></div>
<p class="downloadIndexBtn01">ダウンロードする</p>
</a>
</li>
</ul>
<!-- /downloadIndexList01 --></div>
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