<?php 
	require_once dirname(__FILE__) . "/../../common/system/application.php";
	$lang = 0;
	$hassocial = 0;
	$h1 = "パワーエレクトロニクス 各種データダウンロード｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>パワーエレクトロニクス 各種データダウンロード｜京都電機器株式会社</title>
<meta name="keywords" content="パワーエレクトロニクス 各種データダウンロード,瞬時電圧低下保護装置,瞬低保護装置,直流電源,京都電機器">
<meta name="description" content="パワーエレクトロニクス 各種データダウンロード。京都電機器はコアテクノロジーであるスイッチング電源技術を中心に、パワーエレクトロニクス事業を展開しています。">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<script type="text/javascript" src="../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="../../common/js/jquery-lineup.min.js"></script>
<script type="text/javascript" src="../../common/js/download.js"></script>
<script type="text/javascript">
$(window).load(function() {
	//$('.lineUpH01').lineUp();
});
</script>
</head>

<body id="gDef" class="lDef">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<h2 class="h2_basic01">
<span class="icon01"><img src="../../common/images/h2_download01.gif" width="54" height="47" alt="電源関連製品 各種データダウンロード"></span>
<span class="title01">パワーエレクトロニクス 各種データダウンロード</span>
</h2>

<div id="contents">
<section class="section">

<ul class="downloadTabTitle">
<li class="tab01"><a href="#tab01" class="active">瞬時電圧低下保護装置</a></li>
<li class="tab02"><a href="#tab02">直流電源装置</a></li>
<li class="tab03"><a href="#tab03">その他</a></li>
</ul>

<div class="downloadTabContents">

<form name="frm" method="post" action="index.php">
<input type="hidden" name="pid">
<input type="hidden" name="pname">
<input type="hidden" name="ppath">
</form>
<div id="tab01">
<h3 class="h3_basic01"><span>瞬時電圧低下保護装置</span></h3>
<div class="downloadAcBox01 clearfix">
<ul class="leftColumn">
<?php for ($i = 1; $i <= $data['content_count'][1]; $i+=2): ?>
<?php $productsBase = $data['content_list1-' . $i]; ?>	
<?php $products = $data['content_list1-' . $i]['products']; ?>
<li class="itemcell">
<a href="#">
<div class="downloadAcHeadWrap01">
<div class="downloadAcHead01">
<figure><img src="<?php echo $productsBase['file']; ?>" width="70" height="70" alt="<?php echo $productsBase['name']; ?>"></figure>
<div class="downloadAcHeadIn01">
<p class="downloadAcHeadTit01"><?php echo $productsBase['name']; ?></p>
<p class="downloadAcHeadTit02"><?php echo $productsBase['series_name']; ?></p>
<!-- /downloadAcHeadIn01 --></div>
<!-- /downloadAcHead01 --></div>
<!-- /downloadAcHeadWrap01 --></div>
</a>
<div class="downloadAcContents01">
<table class="downloadTable01">
<colgroup>
<col class="colW01">
<col class="colW02">
<col class="colW03">
<col class="colW04">
<col class="colW05">
<col class="colW06">
</colgroup>
<tr>
<th rowspan="2" class="taL">製品名</th>
<th colspan="2">外形図</th>
<th>仕様書</th>
<th>取説</th>
<th>その他</th>
</tr>
<tr>
<th>PDF</th>
<th>DXF</th>
<th>PDF</th>
<th>PDF</th>
<th>DXF</th>
</tr>
<?php include PATH_TEMPLATE . "/download/list_part.tpl"; ?>
</table>
<!-- /downloadAcContents01 --></div>
</li>
<?php endfor; ?>
</ul>

<ul class="rightColumn">
<?php for ($i = 2; $i <= $data['content_count'][1]; $i+=2): ?>
<?php $productsBase = $data['content_list1-' . $i]; ?>	
<?php $products = $data['content_list1-' . $i]['products']; ?>
<li class="itemcell">
<a href="#">
<div class="downloadAcHeadWrap01">
<div class="downloadAcHead01">
<figure><img src="<?php echo $productsBase['file']; ?>" width="70" height="70" alt="<?php echo $productsBase['name']; ?>"></figure>
<div class="downloadAcHeadIn01">
<p class="downloadAcHeadTit01"><?php echo $productsBase['name']; ?></p>
<p class="downloadAcHeadTit02"><?php echo $productsBase['series_name']; ?></p>
<!-- /downloadAcHeadIn01 --></div>
<!-- /downloadAcHead01 --></div>
<!-- /downloadAcHeadWrap01 --></div>
</a>
<div class="downloadAcContents01">
<table class="downloadTable01">
<colgroup>
<col class="colW01">
<col class="colW02">
<col class="colW03">
<col class="colW04">
<col class="colW05">
<col class="colW06">
</colgroup>
<tr>
<th rowspan="2" class="taL">製品名</th>
<th colspan="2">外形図</th>
<th>仕様書</th>
<th>取説</th>
<th>その他</th>
</tr>
<tr>
<th>PDF</th>
<th>DXF</th>
<th>PDF</th>
<th>PDF</th>
<th>DXF</th>
</tr>
<?php include PATH_TEMPLATE . "/download/list_part.tpl"; ?>
</table>
<!-- /downloadAcContents01 --></div>
</li>
<?php endfor; ?>
</ul>




<!-- /downloadAcBox01 --></div>
<!-- /tab1 --></div>


<div id="tab02">
<h3 class="h3_basic01"><span>直流電源装置</span></h3>
<div class="downloadAcBox01 clearfix">
<ul class="leftColumn">
<?php for ($i = 1; $i <= $data['content_count'][2]; $i+=2): ?>
<?php $productsBase = $data['content_list2-' . $i]; ?>	
<?php $products = $data['content_list2-' . $i]['products']; ?>
<li class="itemcell">
<a href="#">
<div class="downloadAcHeadWrap01">
<div class="downloadAcHead01">
<figure><img src="<?php echo $productsBase['file']; ?>" width="70" height="70" alt="<?php echo $productsBase['name']; ?>"></figure>
<div class="downloadAcHeadIn01">
<p class="downloadAcHeadTit01"><?php echo $productsBase['name']; ?></p>
<p class="downloadAcHeadTit02"><?php echo $productsBase['series_name']; ?></p>
<!-- /downloadAcHeadIn01 --></div>
<!-- /downloadAcHead01 --></div>
<!-- /downloadAcHeadWrap01 --></div>
</a>
<div class="downloadAcContents01">
<table class="downloadTable01">
<colgroup>
<col class="colW01">
<col class="colW02">
<col class="colW03">
<col class="colW04">
<col class="colW05">
<col class="colW06">
</colgroup>
<tr>
<th rowspan="2" class="taL">製品名</th>
<th colspan="2">外形図</th>
<th>仕様書</th>
<th>取説</th>
<th>その他</th>
</tr>
<tr>
<th>PDF</th>
<th>DXF</th>
<th>PDF</th>
<th>PDF</th>
<th>DXF</th>
</tr>
<?php include PATH_TEMPLATE . "/download/list_part.tpl"; ?>
</table>
<!-- /downloadAcContents01 --></div>
</li>		
<?php endfor; ?>						
</ul>

<ul class="rightColumn">
<?php for ($i = 2; $i <= $data['content_count'][2]; $i+=2): ?>
<?php $productsBase = $data['content_list2-' . $i]; ?>	
<?php $products = $data['content_list2-' . $i]['products']; ?>
<li class="itemcell">
<a href="#">
<div class="downloadAcHeadWrap01">
<div class="downloadAcHead01">
<figure><img src="<?php echo $productsBase['file']; ?>" width="70" height="70" alt="<?php echo $productsBase['name']; ?>"></figure>
<div class="downloadAcHeadIn01">
<p class="downloadAcHeadTit01"><?php echo $productsBase['name']; ?></p>
<p class="downloadAcHeadTit02"><?php echo $productsBase['series_name']; ?></p>
<!-- /downloadAcHeadIn01 --></div>
<!-- /downloadAcHead01 --></div>
<!-- /downloadAcHeadWrap01 --></div>
</a>
<div class="downloadAcContents01">
<table class="downloadTable01">
<colgroup>
<col class="colW01">
<col class="colW02">
<col class="colW03">
<col class="colW04">
<col class="colW05">
<col class="colW06">
</colgroup>
<tr>
<th rowspan="2" class="taL">製品名</th>
<th colspan="2">外形図</th>
<th>仕様書</th>
<th>取説</th>
<th>その他</th>
</tr>
<tr>
<th>PDF</th>
<th>DXF</th>
<th>PDF</th>
<th>PDF</th>
<th>DXF</th>
</tr>
<?php include PATH_TEMPLATE . "/download/list_part.tpl"; ?>
</table>
<!-- /downloadAcContents01 --></div>
</li>		
<?php endfor; ?>						
</ul>





<!-- /downloadAcBox01 --></div>
<!-- /tab2 --></div>


<div id="tab03">
<h3 class="h3_basic01"><span>その他</span></h3>
<div class="downloadAcBox01 clearfix">
<ul class="leftColumn">
<?php for ($i = 1; $i <= $data['content_count'][3]; $i+=2): ?>
<?php $productsBase = $data['content_list3-' . $i]; ?>	
<?php $products = $data['content_list3-' . $i]['products']; ?>
<li class="itemcell">
<a href="#">
<div class="downloadAcHeadWrap01">
<div class="downloadAcHead01">
<figure><img src="<?php echo $productsBase['file']; ?>" width="70" height="70" alt="<?php echo $productsBase['name']; ?>"></figure>
<div class="downloadAcHeadIn01">
<p class="downloadAcHeadTit01"><?php echo $productsBase['name']; ?></p>
<p class="downloadAcHeadTit02"><?php echo $productsBase['series_name']; ?></p>
<!-- /downloadAcHeadIn01 --></div>
<!-- /downloadAcHead01 --></div>
<!-- /downloadAcHeadWrap01 --></div>
</a>
<div class="downloadAcContents01">
<table class="downloadTable01">
<colgroup>
<col class="colW01">
<col class="colW02">
<col class="colW03">
<col class="colW04">
<col class="colW05">
<col class="colW06">
</colgroup>
<tr>
<th rowspan="2" class="taL">製品名</th>
<th colspan="2">外形図</th>
<th>仕様書</th>
<th>取説</th>
<th>その他</th>
</tr>
<tr>
<th>PDF</th>
<th>DXF</th>
<th>PDF</th>
<th>PDF</th>
<th>DXF</th>
</tr>
<?php include PATH_TEMPLATE . "/download/list_part.tpl"; ?>
</table>
<!-- /downloadAcContents01 --></div>
</li>
<?php endfor; ?>							
</ul>

<ul class="rightColumn">
<?php for ($i = 2; $i <= $data['content_count'][3]; $i+=2): ?>
<?php $productsBase = $data['content_list3-' . $i]; ?>	
<?php $products = $data['content_list3-' . $i]['products']; ?>
<li class="itemcell">
<a href="#">
<div class="downloadAcHeadWrap01">
<div class="downloadAcHead01">
<figure><img src="<?php echo $productsBase['file']; ?>" width="70" height="70" alt="<?php echo $productsBase['name']; ?>"></figure>
<div class="downloadAcHeadIn01">
<p class="downloadAcHeadTit01"><?php echo $productsBase['name']; ?></p>
<p class="downloadAcHeadTit02"><?php echo $productsBase['series_name']; ?></p>
<!-- /downloadAcHeadIn01 --></div>
<!-- /downloadAcHead01 --></div>
<!-- /downloadAcHeadWrap01 --></div>
</a>
<div class="downloadAcContents01">
<table class="downloadTable01">
<colgroup>
<col class="colW01">
<col class="colW02">
<col class="colW03">
<col class="colW04">
<col class="colW05">
<col class="colW06">
</colgroup>
<tr>
<th rowspan="2" class="taL">製品名</th>
<th colspan="2">外形図</th>
<th>仕様書</th>
<th>取説</th>
<th>その他</th>
</tr>
<tr>
<th>PDF</th>
<th>DXF</th>
<th>PDF</th>
<th>PDF</th>
<th>DXF</th>
</tr>
<?php include PATH_TEMPLATE . "/download/list_part.tpl"; ?>
</table>
<!-- /downloadAcContents01 --></div>
</li>
<?php endfor; ?>							
</ul>
<!-- /downloadAcBox01 --></div>
<!-- /tab3 --></div>

<!-- /productTabContents --></div>			
<!-- /section --></section>
<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>