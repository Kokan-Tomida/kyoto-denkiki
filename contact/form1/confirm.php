<?php 
	require_once dirname(__FILE__) . "/../../common/system/application.php";
    require_once(dirname(__FILE__)."/system/lib.php"); 
    require_once(dirname(__FILE__)."/system/ctl.php"); 
    $ctl = new Controller();
    $ctl->action();
    $input = $ctl->getInput();
    $error = $ctl->getError();
    $product = $ctl->getProduct();

	$lang = 0;
	$hassocial = 0;
	$h1 = "確認画面｜見積希望/製品に関するお問い合わせ｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>確認画面｜見積希望/製品に関するお問い合わせ｜京都電機器株式会社</title>
<meta name="keywords" content="確認画面,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="確認画面。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<script type="text/javascript" src="../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../common/js/common.js"></script><!--[if lt IE 9]><script src="../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="g05">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<h2 class="h2_basic01">
<span class="icon01"><img src="../../common/images/h2_contact02.gif" width="54" height="47" alt="お問い合わせ"></span>
<span class="title01">見積希望 / 製品に関するお問い合わせ</span>
</h2>

<div id="contents">
<section class="section">

<p class="contactLocation01"><img src="../images/img_contact_location02.png" width="960" height="47" alt="STEP2. 入力内容のご確認"></p>

<?php if ($product): ?>
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
<p class="contactFormTxt01">入力内容をご確認いただき、間違いがなければ「送信する」ボタンで送信してください。</p>

<form action="finish.php" method="post">
<div class="contactForm01">
<table class="contactFormTable01">
<tr>
<th class="conactTit01">お問い合わせ種別</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['ctype_name']); ?></td>
</tr>						
<tr>
<th class="conactTit01">御社名</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['company_name']); ?></td>
</tr>
<tr>
<th colspan="2">担当部署</th>
<td><?php echo h($input['section_name']); ?></td>
</tr>
<tr>
<th class="conactTit01">ご担当者名</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['person_name']); ?></td>
</tr>
<tr>
<th class="conactTit01">郵便番号</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['zip']); ?></td>
</tr>
<tr>
<th class="conactTit01">都道府県</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['pref_name']); ?></td>
</tr>
<tr>
<th class="conactTit01">ご住所</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['address']); ?></td>
</tr>
<tr>
<th class="conactTit01">TEL</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['tel']); ?></td>
</tr>
<tr>
<th colspan="2">FAX</th>
<td><?php echo h($input['fax']); ?></td>
</tr>
<tr>
<th class="conactTit01">メールアドレス</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php echo h($input['mail']); ?></td>
</tr>
<tr>
<th colspan="2">お問い合わせ内容</th>
<td><?php echo nl2br(h($input['message'])); ?></td>
</tr>
<tr>
<th class="conactTit01">個人情報の<br>取り扱いについて</th>
<th class="conactMust01"><span>必須</span></th>
<td><?php if ($input['agree']): ?>同意する<?php endif; ?></td>
</tr>
</table>

<div class="contactBtnBox02">
<p class="contactback01"><input type="button" value="戻る" onclick="location.href='index.php?back=1'"></p>
<p class="contactSend02"><input type="submit" value="送信する"></p>
<!-- /contactBtnBox02 --></div>

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