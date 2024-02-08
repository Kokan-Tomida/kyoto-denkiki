<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 0;
$h1 = "確認画面｜登録情報編集｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>確認画面｜登録情報編集｜京都電機器株式会社</title>
<meta name="keywords" content="確認画面,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="確認画面。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
</head>

<body id="gDef" class="lDef">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_member01.gif" width="54" height="47" alt="ログイン/会員登録"></span>
<span class="title01">登録情報編集</span>
</h2>

<div id="contents">
<section class="section">
<p class="memberLocation01"><img src="images/img_member_location02.png" width="960" height="47" alt="STEP2. 入力内容のご確認"></p>

<div class="memberWrap01">				
<form action="edit_confirm.php" method="post">
<p class="memberForm01InfoTxt01">編集内容をご確認いただき、間違いがなければ「編集する」ボタンを押してください。</p>

<div class="memberForm01">
<table class="memberFormTable01">						
<tr>
<th class="memberAddnewTit01">御社名</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><?php echo h($data['company_name']); ?></td>
</tr>
<tr>
<th colspan="2">担当部署</th>
<td><?php echo h($data['section']); ?></td>
</tr>
<tr>
<th class="memberAddnewTit01">ご担当者名</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><?php echo h($data['charge_name']); ?></td>
</tr>
<tr>
<th class="memberAddnewTit01">郵便番号</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><?php echo h($data['zip']); ?></td>
</tr>
<tr>
<th class="memberAddnewTit01">都道府県</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><?php echo h($data['pref_name']); ?></td>
</tr>
<tr>
<th class="memberAddnewTit01">ご住所</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><?php echo h($data['address1']); ?></td>
</tr>
<tr>
<th class="memberAddnewTit01">TEL</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><?php echo h($data['telno']); ?></td>
</tr>
<tr>
<th colspan="2">FAX</th>
<td><?php echo h($data['faxno']); ?></td>
</tr>
<tr>
<th class="memberAddnewTit01">メールアドレス</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><?php echo h($data['email_address']); ?></td>
</tr>
<tr>
<th class="memberAddnewTit01">パスワード</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><p class="memberAddnewAgreeTxt03"><?php if ($data['member_pwd']): ?>******<?php endif; ?></p></td>
</tr>
<tr>
<th colspan="2" class="memberAddnewTit01">備考</th>
<td><?php echo nl2br(h($data['note'])); ?></td>
</tr>
</table>

<div class="memberAddnewBox02">
<p class="memberAddnewback01"><input type="button" value="戻る" onclick="location.href='edit.php?back=1'"></p>
<p class="memberAddnewSend02"><input type="submit" name="to_complete" value="編集する"></p>
<!-- /memberAddnewBox02 --></div>

<!-- /memberForm01 --></div>
</form>
<!-- /memberWrap01 --></div>
<!-- /section --></section>
<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer --> 

</body>
</html>