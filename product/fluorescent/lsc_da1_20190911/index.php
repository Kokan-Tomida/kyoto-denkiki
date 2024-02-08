<?php 
require_once dirname(__FILE__) . "/../../../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "LSC-DA1 series｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>LSC-DA1 series｜京都電機器株式会社</title>

<meta name="keywords" content="LSC-DA1 series,,画像処理用蛍光灯照明,画像処理用LED照明,キセノン管ストロボ装置,京都電機器">
<meta name="description" content="LSC-DA1 seriesをご紹介しています。京都電機器オプトエレクトロニクス事業では、画像処理LEDの照明などの画像処理分野を中心に、その周辺機器などを取り扱っています。">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../../css/style.css" media="all">
<script type="text/javascript" src="../../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../../common/js/jquery.sticky-kit.min.js"></script>
<script type="text/javascript" src="../../../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="g01" class="l203">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">


<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/'; ?>">製品情報</a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/fluorescent/'; ?>">画像処理用蛍光灯照明</a></li>
<li>LSC-DA1 series</li>
</ul>
<h2 class="h2_basic01">
<span class="icon01"><img src="../../../common/images/h2_product01.gif" width="54" height="47" alt="製品情報"></span>
<span class="title01">画像処理用蛍光灯照明</span>
</h2>
<div id="contents">
<article id="main">
<section class="section">
<div class="productMainimgKasoWrap">
<div class="productMainimgSeriesBox01">
<figure><img src="images/mainimg_01.jpg" width="708" height="147" alt="8bit D/A変換装置 LSC-DA1 series"></figure>
<div class="productMainimgSeriesBoxIn02">	
<p class="productSeriesTitle01">8bit D/A変換装置</p>
<h2 class="productSeriesH201">LSC-DA1 series</h2>
</div>
<!-- /productMainimgSeriesBox01 --></div>

<div class="productMainimgKasoBox02">
<p class="productKasoTitle01"><span>8bitデジタル信号を0-5Vのアナログ信号に変換する装置です</span></p>
<!-- /productMainimgKasoBox02 --></div>
<!-- /productMainimgKasoWrap --></div>


<div class="productTabWrap">

<ul class="productTabTitle">
<li class="tab01"><a href="#tab01" class="active">仕様</a></li>
<li class="tab02"><a href="#tab02">外形図</a></li>
</ul>

<div class="productTabContents">			
<div id="tab01">
<div class="productTabBox01">
<h3 class="productTabH301">仕様</h3>
<div class="productW430px">
<table class="tableLineUp01">
<colgroup>
<col class="colW33per">
<col>
</colgroup>
<tr>
<th>&nbsp;</th>
<th>Specifications</th>
</tr>
<tr>
<td class="taL">入力電圧</td>
<td>AC100V±10% 50&frasl;60Hz</td>
</tr>
<tr>
<td class="taL bg01">入力電流</td>
<td class="bg01">0.2A</td>
</tr>
<tr>
<td class="taL">信号入力</td>
<td>DIGITAL Bit8</td>
</tr>
<tr>
<td class="taL bg01">信号出力</td>
<td class="bg01">0&#xFF5E;5V &frasl; 5mA</td>
</tr>
</table>
<!-- /productW430px --></div>
<!-- /productTabBox01 --></div>

<div class="productTabBox01">
<div class="productTableLayoutBox01 mt10 clearfix">
<div class="productW250px flL">
<figure><img src="images/img_sample01.gif" width="249" height="345" alt="LSC-DA1"></figure>							
<!-- /productW250px --></div>

<div class="productW390px flR">
<p class="productTableLayoutTxt01">External I&frasl;O</p>
<table class="tableLineUp01 narrow">
<colgroup>
<col class="colW19per">
<col class="colW31per">
<col class="colW19per">
<col class="colW31per">
</colgroup>
<tr>
<th>Pin No.</th>
<th>Pin Detail</th>
<th>Pin No.</th>
<th>Pin Detail</th>
</tr>
<tr>
<td>1</td>
<td>bit8 (MSB)</td>
<td>2</td>
<td>Bit7</td>
</tr>
<tr>
<td class="bg01">3</td>
<td class="bg01">bit6</td>
<td class="bg01">4</td>
<td class="bg01">Bit5</td>
</tr>
<tr>
<td>5</td>
<td>bit4</td>
<td>6</td>
<td>Bit3</td>
</tr>
<tr>
<td class="bg01">7</td>
<td class="bg01">bit2</td>
<td class="bg01">8</td>
<td class="bg01">Bit1 (LSB)</td>
</tr>
<tr>
<td>9</td>
<td>COMMON</td>
<td>10</td>
<td>COMMON</td>
</tr>
<tr>
<td class="bg01">11</td>
<td class="bg01">COMMON</td>
<td class="bg01">12</td>
<td class="bg01">COMMON</td>
</tr>
<tr>
<td>13</td>
<td>COMMON</td>
<td>14</td>
<td>COMMON</td>
</tr>
<tr>
<td class="bg01">15</td>
<td class="bg01">COMMON</td>
<td colspan="2" class="bg01">&nbsp;</td>
</tr>
</table>
<!-- /productW390px --></div>
<!-- /productTableLayoutBox01 --></div>
<ul class="ul_notes01 mt05">
<li>※信号用接点は、微弱電流対応品をご使用下さい。</li>
</ul>
<!-- /productTabBox01 --></div><!-- download -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/download02.php'); ?>
<!-- /download -->
<!-- /tab1 --></div>



<div id="tab02">
<div class="productTabBox01">
<h3 class="productTabH301">外形図</h3>
<figure><img src="images/img_drawing01.gif" width="667" height="308" alt="外形図" class="img_basic02"></figure>
<!-- /productTabBox01 --></div>
<!-- download -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/download02.php'); ?>
<!-- /download -->

<!-- /tab2 --></div>
<!-- /productTabContents --></div>

<!-- /productTabWrap --></div>
<!-- /section --></section>
<!-- /main --></article>

<div id="sub">
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/fluorescent.php'); ?>
<div id="subFixer">
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/contactsample.php'); ?>
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