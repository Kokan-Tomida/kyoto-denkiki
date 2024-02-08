<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 1;
$h1 = "京都电机器株式会社";
$path = "";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>京都电机器株式会社</title>
<meta name="keywords" content="京都电机器,图像处理用LED照明,瞬时电压下降保护装置">
<meta name="description" content="京都电机器株式会社">
<link rel="stylesheet" type="text/css" href="/common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="/common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/slider-pro.min.css" media="all">
<script type="text/javascript" src="/common/js/jquery.js"></script>
<script type="text/javascript" src="/common/js/jquery.sticky-kit.min.js"></script>
<script type="text/javascript" src="/common/js/common.js"></script>
<script type="text/javascript" src="/common/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="/common/js/jquery.sliderPro.min.js"></script>
<script type="text/javascript" src="/common/js/toppage.js"></script>
<!--[if lt IE 9]><script src="/common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="/common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="top">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header02.php'); ?>
<!-- /header -->

<div id="topMainimgWrap">

<div id="topMainimg" class="lang_cn" lang="zh">
<ul class="sp-slides">
<li class="sp-slide">
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/corporate/'; ?>">
<div class="topMainimgIn">
<figure><img src="/images/pic_slider01_01_cn.jpg" width="960" height="300" alt="in the future 技术共鸣，开创未来"></figure>
<p class="topMainimgBtn"><span>详情请咨询京都电机器</span></p>
<!-- /topMainimgIn --></div>
</a>
</li>
<li class="sp-slide">
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/dc/kdc/'; ?>">
<div class="topMainimgIn">
<figure><img src="/images/pic_slider01_02.jpg" width="960" height="300" alt="可编程DC电源（CVCC）KDC series"></figure>
<div class="topMainimgDetail02">
<p class="topMainimgTxt01">可编程DC电源（CVCC）</p>
<p class="topMainimgTxt02">KDC</p>
<p class="topMainimgTxt03">series</p>
<p class="topMainimgTxt04">搭载着高效率开关回路的直流电源</p>
<!-- /topMainimgDetail02 --></div>
<p class="topMainimgBtn"><span>查看本产品详情</span></p>
<!-- /topMainimgIn --></div>
</a>
</li>
<li class="sp-slide">
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/rgb/'; ?>">
<div class="topMainimgIn">
<figure><img src="/images/pic_slider01_03.jpg" width="960" height="300" alt="RGB照明"></figure>
<div class="topMainimgDetail02">
<p class="topMainimgTxt01">可针对各种照明定制RGB发光</p>
<p class="topMainimgTxt02">RGB照明</p>
<p class="topMainimgTxt03">　</p>
<p class="topMainimgTxt04">可在同一框体内实现RGB发光<br>实现了小型、高照度、高均匀性</p>
<!-- /topMainimgDetail02 --></div>
<p class="topMainimgBtn"><span>查看本产品详情</span></p>
<!-- /topMainimgIn --></div>
</a>
</li>
</ul>
</div><!-- /topMainimg -->
<!-- /topMainimgWrap --></div>


<div id="topSlider02Wrap" class="lang_cn" lang="zh">
<p class="topSlider02Tit01">新产品信息</p>
<div id="topSlider02">		
<div class="topSlider02In">
<p class="prev"><a href="#"><img src="/images/ico_slider_arrow01.gif" alt="前へ" width="20" height="30"></a></p>
<p class="next"><a href="#"><img src="/images/ico_slider_arrow02.gif" alt="次へ" width="20" height="30"></a></p>
<ul class="clearfix">
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/rgb/'; ?>">
<figure><img src="/images/pic_slider02_02.jpg" width="225" height="105" alt="RGB照明"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
<p>
可定制RGB发光
<span>RGB照明</span>
</p>
</div>
<p class="topSlider02Txt03">可在同一框体内实现RGB发光<br>实现了小型、高照度、高均匀性</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/dla/'; ?>">
<figure><img src="/images/pic_slider02_01.jpg" width="225" height="105" alt="DLA series"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
<p>
DIN导轨安装型 LED照明电源 
<span>DLA series</span>
</p>
</div>
<p class="topSlider02Txt03">DIN安装型4路输出超小型电源<br>最多可连接8台(32路)</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdpb/'; ?>">
<figure><img src="/images/pic_slider02_06.jpg" width="225" height="105" alt="KDPB series"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
	<p>
		高亮度LED线性照明
		<span>KDPB series</span>
	</p>
</div>
<p class="topSlider02Txt03">最适合替换荧光灯的线性照明采用独有技术，实现高均匀性</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdfp/'; ?>">
<figure><img src="/images/pic_slider02_08.jpg" width="225" height="105" alt="KDFP series"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
	<p>
		   LED平板照明
		<span>KDFP series</span>
	</p>
</div>

<p class="topSlider02Txt03">搭载LED的大面积照明<br>最适合目测检查的背光灯</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/kdpl2_fan/'; ?>">
<figure><img src="/images/pic_slider02_04.jpg" width="225" height="105" alt="KDPL2-FAN"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
	<p>
		高亮度LED线性照明
		<span>KDPL2-FAN</span>
	</p>
</div>

<p class="topSlider02Txt03">通过冷却风扇，可以实现约2倍于KDPL2的照度。(发光面约100万lx)</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lga_302/'; ?>">
<figure><img src="/images/pic_slider02_07.jpg" width="225" height="105" alt="LGA-302 series"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
	<p>
		频闪控制照明电源
		<span>LGA-302 series</span>
	</p>
</div>

<p class="topSlider02Txt03">可连接我公司生产的12V照明产品的频闪发光电源 搭载通信功能(选配)</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lfm-80w/'; ?>">
<figure><img src="/images/pic_slider02_03.jpg" width="225" height="105" alt="LFM-80W"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
	<p>
		光纤抽出型照明
		<span>LFM-80W</span>
	</p>
</div>

<p class="topSlider02Txt03">通过采用LED，实现免维护。实现了相当于200W金属卤化物灯的亮度、小型化。</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/led/lpa/'; ?>">
<figure><img src="/images/pic_slider02_05.jpg" width="225" height="105" alt="LPA series"></figure>

<div class="topSlider02Detail">
<div class="topSlider02Txt01">
	<p>
		微距镜头同轴照明・聚光照明<br>专用照明电源
		<span>LPA series</span>
	</p>
</div>

<p class="topSlider02Txt03">PLS2/PLS3/PLH2/PLH3专用电源。通过电阻BOX可自由连接各种照明。</p>
<!-- /topSlider02Detail --></div>

</a>
</li>
</ul>
<!-- /topSlider02In --></div>
<!-- /topSlider02 --></div>
<!-- /topSlider02Wrap --></div>


<div id="wrapper">
<div id="wrapperIn">
<div id="contents">

<article id="main">
<section class="section lang_cn" lang="zh">
<h2 class="topH201">
<span class="icon01"><img src="/images/ico_product01.gif" width="44" height="38" alt="产品信息"></span>
<span class="title01">产品信息</span>
<span class="btn01"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/'; ?>">产品信息详情</a></span>
</h2>

<div class="topProductBox01">
<h3 class="topH301"><span>电力电子技术|电源相关产品</span></h3>
<ul>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/mdp/'; ?>">
<figure>
<img src="/images/pic_product01.jpg" width="224" height="126" alt="瞬时电压下降保护装置">
<figcaption>瞬时电压下降保护装置</figcaption>
</figure>
</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/dc/'; ?>">
<figure>
<img src="/images/pic_product02.jpg" width="224" height="126" alt="直流电源装置">
<figcaption>直流电源装置</figcaption>
</figure>
</a>
</li>
</ul>
<!-- /topProductBox01 --></div>

<div class="topProductBox02">
<h3 class="topH301"><span>光电技术|光学相关产品</span></h3>
<ul>                 
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/led/'; ?>">
<figure>
<img src="/images/pic_product03.jpg" width="224" height="126" alt="图像处理用LED照明">
<figcaption>图像处理用LED照明</figcaption>
</figure>
</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/fluorescent/'; ?>">
<figure>
<img src="/images/pic_product04.jpg" width="224" height="126" alt="图像处理用荧光灯照明">
<figcaption>图像处理用荧光灯照明</figcaption>
</figure>
</a>
</li>
<li>
<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/cn/product/xenon/'; ?>">
<figure>
<img src="/images/pic_product05.jpg" width="224" height="126" alt="氙气灯管频闪装置">
<figcaption>氙气灯管频闪装置</figcaption>
</figure>
</a>
</li>
</ul>
<!-- /topProductBox02 --></div>
<!-- /section --></section>	

<section class="section">
<h2 class="topH201">
<span class="icon01"><img src="/images/ico_application01.gif" width="44" height="38" alt="アプリケーション"></span>
<span class="title01">アプリケーション</span>
<span class="btn01"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/'; ?>">アプリケーションを詳しく見る</a></span>
</h2>

<div class="topApplicationBox01">
<ul class="clearfix">
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/'; ?>">瞬時電圧低下保護装置</a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/application/led.php'; ?>">画像処理用LED照明</a></li>
</ul>
<!-- /topApplicationBox01 --></div>
<!-- /section --></section>                  

<section class="section">
<h2 class="topH201">
<span class="icon01"><img src="/images/ico_information01.gif" width="44" height="38" alt="インフォメーション"></span>
<span class="title01">インフォメーション</span>
<span class="btn01"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/information/'; ?>">一覧を見る</a></span>
</h2>
<div class="topInformationBox01">
<ul class="topInformationList01">
<li>
<div class="topInformationDate01">
<p class="date">2017年1月30日</p>
<p class="topInformationIco01"><img src="/information/images/ico_product01.gif" width="90" height="20" alt="製品"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">光学総合カタログをリニューアルしました。</p>
<p class="mt15"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/product/catalog/'; ?>" target="_blank">[光学総合カタログ 2016-2017]</a></p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2016年3月1日</p>
<p class="topInformationIco01"><img src="/information/images/ico_news01.gif" width="90" height="20" alt="ニュース"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">2017年度新卒採用の応募受付を開始しました。</p>
<p class="topInformationTxt01">京都電機器株式会社では、採用特設サイトで、2017年度の新卒採用応募受付を開始しました。<br>弊社にご興味のある方はぜひ一度ご覧ください。</p>
<p class="mt15"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/careers/'; ?>" target="_blank">[京都電機器 採用特設サイト]</a></p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2015年12月14日</p>
<p class="topInformationIco01"><img src="/information/images/ico_product01.gif" width="90" height="20" alt="製品"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">「フラットパネル照明FP-302、305、402」のメンテナンス並びに生産終了のご案内 </p>
<p class="topInformationTxt01">
詳細は<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/stop/'; ?>">「生産中止製品について」</a>ページよりご確認ください。</p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2015年11月27日</p>
<p class="topInformationIco01"><img src="/information/images/ico_news01.gif" width="90" height="20" alt="ニュース"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">中国文ページを開設しました。</p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2015年5月21日</p>
<p class="topInformationIco01"><img src="/information/images/ico_news01.gif" width="90" height="20" alt="ニュース"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">ホームページをリニューアルしました。</p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2015年5月21日</p>
<p class="topInformationIco01"><img src="/information/images/ico_product01.gif" width="90" height="20" alt="製品"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">新製品を掲載しました。</p>
<p class="topInformationTxt01">「新製品情報」からもアクセスしてください。</p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2015年4月9日</p>
<p class="topInformationIco01"><img src="/information/images/ico_product01.gif" width="90" height="20" alt="製品"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">「キセノン管ストロボ照明装置」の生産終了のご案内</p>
<p class="topInformationTxt01">
詳細は<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/stop/'; ?>">「生産中止製品について」</a>ページよりご確認ください。</p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2015年3月1日</p>
<p class="topInformationIco01"><img src="/information/images/ico_news01.gif" width="90" height="20" alt="ニュース"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">2016年度新卒採用の応募受付を開始しました。</p>
<p class="topInformationTxt01">京都電機器株式会社では、採用特設サイトで、2016年度の新卒採用応募受付を開始しました。<br>弊社にご興味のある方はぜひ一度ご覧ください。</p>
<p class="mt15"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/careers/'; ?>" target="_blank">[京都電機器 採用特設サイト]</a></p>
<!-- /topInformationDetail01 --></div>
</li>
<li>
<div class="topInformationDate01">
<p class="date">2015年2月27日</p>
<p class="topInformationIco01"><img src="/information/images/ico_product01.gif" width="90" height="20" alt="製品"></p>
<!-- /topInformationDate01 --></div>
<div class="topInformationDetail01">
<p class="topInformationTit01">「キセノン管ストロボ照明装置」の生産終了のご案内</p>
<p class="topInformationTxt01">
詳細は<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/stop/'; ?>">「生産中止製品について」</a>ページよりご確認ください。</p>
<!-- /topInformationDetail01 --></div>
</li>
</ul>
<!-- /topInformationBox01 --></div>
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