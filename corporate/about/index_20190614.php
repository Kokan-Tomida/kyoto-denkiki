<?php
require_once dirname(__FILE__) . "/../../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "会社概要｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>会社概要｜京都電機器株式会社</title>
<meta name="keywords" content="会社概要,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="会社概要をご紹介しています。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<script type="text/javascript" src="../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="g04" class="l02">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">


<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/corporate/'; ?>">企業情報</a></li>
<li>会社概要</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../../common/images/h2_corporate01.gif" width="54" height="47" alt="企業情報"></span>
<span class="title01">企業情報</span>
</h2>

<div id="contents">
<article id="main">
<div id="mainIn">
<h3 class="h3_basic01"><span>会社概要</span></h3>
<section class="section">
<figure><img src="../images/pic_about01.jpg" width="666" height="240" alt="会社概要" class="img_basic01"></figure>
<div class="aboutDetailBox01">
<div class="aboutTable01">
<table class="table_basic01">
<colgroup>
<col class="colW01">
<col>
</colgroup>
<tr>
<th>名称</th>
<td>京都電機器株式会社</td>
</tr>
<tr>
<th>創業</th>
<td>昭和30年2月21日</td>
</tr>
<tr>
<th>設立</th>
<td>昭和37年3月6日</td>
</tr>
<tr>
<th>資本金</th>
<td>9,060万円</td>
</tr>
<tr>
<th>決算期</th>
<td>3月31日（年1回）</td>
</tr>
<tr>
<th>代表者</th>
<td>小西 秀人</td>
</tr>
<tr>
<th>従業員</th>
<td>150名</td>
</tr>
<tr>
<th>本社所在地</th>
<td>〒611-0041 京都府宇治市槇島町十六19-1<br>TEL：0774-25-7711　FAX：0774-25-7712</td>
</tr>
<tr>
<th>役員</th>
<td>
<ul class="ul_list01">
<li class="first"><span class="title01">代表取締役社長</span><span class="txt01">小西 秀人</span></li>
<li><span class="title01">取締役</span><span class="txt01">竹内 晃</span></li>
<li><span class="title01">取締役</span><span class="txt01">中村 浩</span></li>
<li><span class="title01">執行役員</span><span class="txt01">伊藤 良治</span></li>
<li><span class="title01">執行役員</span><span class="txt01">小島 亨</span></li>
<li><span class="title01">執行役員</span><span class="txt01">波来谷 徹</span></li>
<li class="last"><span class="title01">監査役</span><span class="txt01">中野 雄介</span></li>
</ul>

</td>
</tr>
</table>
<!-- /aboutTable01 --></div>
<!-- /aboutDetailBox01 --></div>
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