<div id="subContactBox">
<h3 class="subContactH301">お問い合わせ</h3>
<nav id="lNaviTel">
<ul>
<li>
<p class="title01">東日本営業所</p>
<p class="number01"><span>046-297-4141</span></p>
</li>
<li>
<p class="title01">西日本営業所</p>
<p class="number01"><span>0774-25-7700</span></p>	
</li>
</ul>
<p class="time01">受付時間：平日9:00～17:45</p>
<!-- /lNaviTel --></nav>

<nav id="lNaviContact">

<?php
	$reqURL = $_SERVER["REQUEST_URI"];
	$prop = explode("/product/", $reqURL);
	$prop = $prop[1];
	$prop = explode("/", $prop);
	$prop = $prop[0]."-".$prop[1];
?>


<ul>
<li id="lNaviForm1"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/contact/form1/index.php?pcode='.$prop.'&ctype=1'; ?>"><span>見積希望</span></a></li>
<li id="lNaviProduct"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/contact/form1/index.php?pcode='.$prop.'&ctype=2'; ?>"><span>製品に関するお問い合わせ</span></a></li>
</ul>
<!-- /lNaviContact --></nav>
<!-- /subContactBox --></div>