<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "お問い合わせ｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>お問い合わせ｜京都電機器株式会社</title>
<meta name="keywords" content="お問い合わせ,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="お問い合わせ。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
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

<body id="g05">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<ul id="breadcrumb">
	<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
	<li>お問い合わせ</li>
</ul>
	
	<h2 class="h2_basic01">
		<span class="icon01"><img src="../common/images/h2_contact01.gif" width="54" height="47" alt="お問い合わせ"></span>
		<span class="title01">お問い合わせ</span>
	</h2>
	
	<div id="contents">
		<section class="section">
			<div class="contactWrap01">
				<div class="contactBox01">
					<h3 class="conactH301"><span><span id="contactIcoWeb">WEBでのお問い合わせ</span></span></h3>
					<div class="contactList01">	
						<ul>
							<li>
								<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/contact/form1/index.php?ctype=1'; ?>">
									<div class="lineUpH01">
										<div class="contactListIn01">
											<figure>
												<img src="images/ico_estimate01.gif" width="64" height="64" alt="見積希望">
												<figcaption>見積希望</figcaption>
											</figure>
											<p class="contactTxt01">製品の見積に関するお問い合わせを受け付けております。</p>
										<!-- /contactListIn01 --></div>
									</div>
									<p class="contactBtn01">お問い合わせはこちら</p>
									</a>
								</li>
							<li>
								<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/contact/form1/index.php?ctype=2'; ?>">
									<div class="lineUpH01">
										<div class="contactListIn01">
											<figure>
												<img src="images/ico_product01.gif" width="64" height="64" alt="製品に関するお問い合わせ">
												<figcaption>製品に関するお問い合わせ</figcaption>
											</figure>
											<p class="contactTxt01">製品の技術的なご質問を当社の専門スタッフがお受けいたします。</p>
										<!-- /contactListIn01 --></div>
									</div>
									<p class="contactBtn01">お問い合わせはこちら</p>
									</a>
								</li>
							<li>
								<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/contact/form2/'; ?>">
									<div class="lineUpH01">
										<div class="contactListIn01">
											<figure>
												<img src="images/ico_sample01.gif" width="64" height="64" alt="サンプル機貸し出し依頼">
												<figcaption>サンプル機貸し出し依頼</figcaption>
											</figure>
											<p class="contactTxt01">オプトエレクトロニクス製品では、導入前にサンプル機の貸し出しを行っております。</p>
										<!-- /contactListIn01 --></div>
									</div>
									<p class="contactBtn01">お問い合わせはこちら</p>
									</a>
								</li>
							</ul>
						<!-- /contactList01 --></div>
					<!-- /contactBox01 --></div>
				
				
				<div class="contactBox01">
					<h3 class="conactH301"><span><span id="contactIcoTel">お電話でのお問い合わせ</span></span></h3>
					<ul class="contactList02">
						<li>
							<div>
								<p class="contactShop01">東日本営業所</p>
								<p class="contactShopTxt01">046-297-4141</p>
								</div>
							</li>
						<li>
							<div>
								<p class="contactShop01">西日本営業所</p>
								<p class="contactShopTxt01">0774-25-7700</p>
								</div>
							</li>
						</ul>
					<p class="contactShopTime01">&lt;受付時間&gt; 9:00～17:45　(定休日/土日祝)</p>
					<!-- /contactBox01 --></div>
				
				
				<div class="contactBox01">
					<h3 class="conactH301"><span><span id="contactIcoFax">FAXでのお問い合わせ</span></span></h3>
					<ul class="contactList02">
						<li>
							<div>
								<p class="contactShop01">東日本営業所</p>
								<p class="contactShopTxt01">046-224-1100</p>
								</div>
							</li>
						<li>
							<div>
								<p class="contactShop01">西日本営業所</p>
								<p class="contactShopTxt01">0774-25-7713</p>
								</div>
							</li>
						</ul>
					<p class="contactShopTime01">&lt;受付時間&gt; 24時間　(年中無休)</p>
					<!-- /contactBox01 --></div>
				
				<!-- /contactWrap01 --></div>
			<!-- /section --></section>
		<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>