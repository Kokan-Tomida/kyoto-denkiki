<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 0;
$h1 = "会員メニュー｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>会員メニュー｜京都電機器株式会社</title>
<meta name="keywords" content="会員メニュー,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="会員メニュー。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="../common/js/heightLine.js"></script>
</head>

<body id="gDef" class="lDef">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_member01.gif" width="54" height="47" alt="会員メニュー"></span>
<span class="title01">会員メニュー</span>
</h2>

<div id="contents">
<section class="section">
<div class="memberWrap02">
<p class="memberMenuTxt01"><?php echo $data['hellow_name']; ?></p>				
<div class="memberWrapIn02">

<div class="memberMenuList01">
<ul>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/download/power/'; ?>"><div class="heightLine-H01"><p class="memberDL01">パワーエレクトロニクス<br>ダウンロードコンテンツ</p></div></a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/download/opt/'; ?>"><div class="heightLine-H01"><p class="memberDL01">オプトエレクトロニクス<br>ダウンロードコンテンツ</p></div></a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/member/contact/form1/'; ?>"><div class="heightLine-H01"><p class="memberMail01">会員用お問い合わせフォーム</p></div></a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/member/contact/form2/'; ?>"><div class="heightLine-H01"><p class="memberMail01">オプトエレクトロニクス<br>サンプル機貸し出し依頼</p></div></a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/member/edit.php'; ?>"><div class="heightLine-H01"><p class="memberEdit01">登録情報の編集</p></div></a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/member/withdraw.php'; ?>"><div class="heightLine-H01"><p class="memberWithdrawal01">退会</p></div></a></li>
</ul>											
<!-- /memberMenuList01 --></div>

<!-- /memberWrapIn02 --></div>
<!-- /memberWrap02 --></div>
<!-- /section --></section>
<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>