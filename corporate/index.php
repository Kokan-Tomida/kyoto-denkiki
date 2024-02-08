<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 1;
$hassocial = 1;
$h1 = "代表ご挨拶｜京都電機器株式会社";
$path = "corporate/";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>代表ご挨拶｜京都電機器株式会社</title>
<meta name="keywords" content="代表ご挨拶,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="代表ご挨拶。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="g04" class="l01">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">


<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li>企業情報</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_corporate01.gif" width="54" height="47" alt="企業情報"></span>
<span class="title01">企業情報</span>
</h2>

<div id="contents">
<article id="main">
<div id="mainIn">
<h3 class="h3_basic01"><span>代表ご挨拶</span></h3>
<section class="section">
<p class="indexTxt01">お客様の様々なニーズにお応えできるよう、<br>独自の技術力を磨き、技術革新にチャレンジし続けてまいります。</p>
<div class="indexDetailBox01">
<figure class="indexImg01"><img src="images/pic_index01.jpg" width="218" height="218" alt="代表取締役社長　小西 秀人"></figure>
<p>弊社は、主にパワーエレクトロニクスとオプトエレクトロニクスの二つの事業分野を中心にビジネスを展開しております。<br>パワーエレクトロニクス分野では、高周波スイッチング技術をもとに、半導体や液晶製造設備等の産業用に使用される、高信頼性の電源装置を提供しております。そして、スマートグリッドに関連する次世代エネルギー分野にも注力し、創エネ・省エネ・蓄エネをキーワードに、より高効率の電源を開発しています。また、電源の心臓部であるパワーデバイスを自社製パワーモジュールとして開発し、その搭載製品を拡大して、小型化とコストダウンにつなげています。<br>オプトエレクトロニクス分野では、エレクトロニクスから、食品、薬品…等の様々な業界向けの外観検査用照明装置を提供しております。光源としては、LED、蛍光管、キセノン管等を用い、光学系と電源双方の技術をもとに、お客様の様々な検査ニーズにお応えしております。<br>また、この二つの事業分野をつなぐのが、マイコンを活用した制御技術で、従来のアナログ中心の制御から、デジタル制御への転換を強力に推進しています。フルデジタル制御化により、コストダウンと多機能、高性能化、小型化を同時に実現し、お客様の利便性を高めてまいります。<br>京都電機器株式会社は、お客様の様々なニーズにお応えできるよう、独自の技術力を磨き、技術革新にチャレンジし続けてまいりますので、今後とも、一層のご愛顧、御支援を賜りますようお願い申し上げます。</p>
<!-- /indexDetailBox01 --></div>
<p class="indexImg02"><img src="images/txt_index01.gif" width="185" height="20" alt="代表取締役社長　小西 秀人"></p>

<div class="indexDetailBox02">
<p><img src="images/img_index01.gif" width="678" height="352" alt="経営理念"></p>
<p><img src="images/img_index02.gif" width="678" height="420" alt="社是"></p>
<!-- /indexDetailBox02 --></div>
</section>
<!-- /mainIn --></div>
<!-- /main --></article>

<div id="sub">
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/corporate.php'); ?>
<!-- /sub --></div>
<!-- /contents --></div>

<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>