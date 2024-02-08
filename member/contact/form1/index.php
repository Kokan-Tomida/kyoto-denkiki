<?php 
require_once dirname(__FILE__) . "/../../../common/system/application.php";
$lang = 0;
$hassocial = 0;
	
$h1 = "見積希望/製品に関するお問い合わせ｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>見積希望/製品に関するお問い合わせ｜京都電機器株式会社</title>
<meta name="keywords" content="見積希望/製品に関するお問い合わせ,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="見積希望/製品に関するお問い合わせ。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/colorbox.css" media="all">
<script type="text/javascript" src="../../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../../common/js/common.js"></script>
<script type="text/javascript" src="../../js/jquery.colorbox-min.js"></script>
<!--[if lt IE 9]><script src="../../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../../common/js/selectivizr-min.js"></script><![endif]-->
<script>
$(function() {
    $(".single").colorbox({
    maxWidth:"90%",
    maxHeight:"90%",
    opacity: 0.7
  });
});
</script>
</head>

<body id="g06" class="lDef">

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
<span class="icon01"><img src="../../../common/images/h2_contact02.gif" width="54" height="47" alt="お問い合わせ"></span>
<span class="title01">見積希望 / 製品に関するお問い合わせ</span>
</h2>

<div id="contents">
<section class="section">

<p class="contactLocation01"><img src="../images/img_contact_location01.png" width="960" height="47" alt="STEP1. 必要事項の入力"></p>

<?php $product = $data['product']; if ($product): ?>
<div class="contactProduct01">
<div class="contactProductIn01">
<figure><img src="<?php echo h($product['image']); ?>" width="194" height="98" alt="パワーライン照明 KDPL series"></figure>
<div class="contactProductInfo01">
<p class="contactProductTit01"><?php echo h($product['name']); ?></p>
<p class="contactProductTit02"><?php echo h($product['series']); ?></p>
</div>
<!-- /contactProductIn01 --></div>

<div class="contactProductTxtBox01">
<p><?php echo h($product['description']); ?></p>
<!-- /contactProductTxtBox01 --></div>
<!-- /contactProduct01 --></div>
<?php endif; ?>


<div class="contactWrap01">
<form action="confirm.php" method="post">
<div class="contactForm01Info01">
<p>下記フォームに必要事項をご入力のうえ送信してください。弊社担当より折り返しご連絡させて頂きます。</p>

<ul>
<li>・数字は半角で、カタカナは全角で入力してください。</li>
<li>・必須項目は必ず入力してください。</li>
<li>・<a class="single" href="/common/images/not_text.gif" title="機種依存文字">こちら</a>のような機種依存文字は使用しないでください。</li>
<li>・内容によっては回答に時間がかかる場合がございますので、あらかじめご了承ください。</li>
</ul>
<!-- /memberForm01Info01 --></div>
<div class="contactForm01">
<table class="contactFormTable01">
<tr>
<th class="conactTit01">お問い合わせ種別</th>
<th class="conactMust01"><span>必須</span></th>
<td>
<ul class="contactSelectList01"><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['inquiry_select']; ?></span>
<ul class="conactRadio01"><!--
--><li><label><input type="radio" name="inquiry_check" value="1" <?php if ($data['inquiry_check'] == 1): ?>checked<?php endif; ?>><span>見積希望</span></label></li><!--
--><li><label><input type="radio" name="inquiry_check" value="2" <?php if ($data['inquiry_check'] == 2): ?>checked<?php endif; ?>><span>製品に関するお問い合わせ</span></label></li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['inquiry_check']; ?></span>
</td>
</tr>						
<tr>
<th colspan="2">御社名</th>
<td><?php echo h($data['company_name']); ?></td>
</tr>
<tr>
<th colspan="2">ご担当者名</th>
<td><?php echo h($data['charge_name']); ?> 様</td>
</tr>
<tr>
<th colspan="2">お問い合わせ内容</th>
<td><textarea name="inquiry_note" rows="5" cols="10"><?php echo h($data['inquiry_note']); ?></textarea>
<span class="error"><?php echo $data['validate_msg']['inquiry_note']; ?></span>
</td>
</tr>
</table>

<div class="contactBtnBox01">
<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
<p class="contactSend01"><input type="submit" value="送信内容の確認"></p>
<!-- /contactBtnBox01 --></div>

<!-- /contactForm01 --></div>
</form>
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