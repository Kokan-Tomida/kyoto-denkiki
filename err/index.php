<?php 
	require_once dirname(__FILE__) . "/../common/system/application.php";
	$lang = 0;
	$hassocial = 0;
	$h1 = "送信エラー｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>送信エラー｜京都電機器株式会社</title>
<meta name="keywords" content="送信エラー,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="送信エラー。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body>

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_err01.gif" width="54" height="47" alt="送信エラー"></span>
<span class="title01">送信エラー</span>
</h2>

<div id="contents">
<section class="section">
<div class="contactWrap01">
<p class="contactFormTxt01">送信に失敗しました。<br>恐れ入りますが、再度お手続き頂くか、お電話にてお問い合わせください。</p>
<p class="contactBackTop01"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>"><span>TOPページへ</span></a></p>
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