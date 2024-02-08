<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 0;
$h1 = "登録情報編集｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>登録情報編集｜京都電機器株式会社</title>
<meta name="keywords" content="登録情報編集,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="登録情報編集。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/colorbox.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
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
<p class="memberLocation01"><img src="images/img_member_location01.png" width="960" height="47" alt="STEP1. 必要事項の入力"></p>

<div class="memberWrap01">				
<form action="edit_confirm.php" method="post">
<div class="memberForm01Info01">
<p>会員情報編集は、下記フォームにご入力下さい。</p>						
<ul>
<li>・数字は半角で、カタカナは全角で入力してください。</li>
<li>・必須項目は必ず入力してください。</li>
<li>・<a class="single" href="/common/images/not_text.gif" title="機種依存文字">こちら</a>のような機種依存文字は使用しないでください。</li>
</ul>
<!-- /memberForm01Info01 --></div>

<div class="memberForm01">
<table class="memberFormTable01">						
<tr>
<th class="memberAddnewTit01">御社名</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td>
<input type="text" name="company_name" value="<?php echo h($data['company_name']); ?>" class="inputW05">
<span class="error"><?php echo $data['validate_msg']['company_name']; ?></span>
</td>
</tr>
<tr>
<th colspan="2">担当部署</th>
<td><input type="text" name="section" value="<?php echo h($data['section']); ?>" class="inputW05">
<span class="error"><?php echo $data['validate_msg']['section']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">ご担当者名</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><input type="text" name="charge_name" value="<?php echo h($data['charge_name']); ?>" class="inputW05">
<span class="error"><?php echo $data['validate_msg']['charge_name']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">郵便番号</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td>
<ul class="memberAddnewInputList01"><!--
--><li><input type="text" name="zip1" value="<?php echo h($data['zip1']); ?>" class="inputW01"></li><!--
--><li>-</li><!--
--><li><input type="text" name="zip2" value="<?php echo h($data['zip2']); ?>" class="inputW02"></li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['zip']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">都道府県</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td>
<select name="pref" class="selectW01">
<option value="">都道府県の選択</option>
<?php echo $data['option_pref']; ?>
</select>
<span class="error"><?php echo $data['validate_msg']['pref']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">ご住所</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><input type="text" name="address1" value="<?php echo h($data['address1']); ?>" class="inputW06">
<span class="error"><?php echo $data['validate_msg']['address1']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">TEL</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td>
<ul class="memberAddnewInputList01"><!--
--><li><input type="tel" name="tel1" value="<?php echo h($data['tel1']); ?>" class="inputW03"></li><!--
--><li>-</li><!--
--><li><input type="tel" name="tel2" value="<?php echo h($data['tel2']); ?>" class="inputW03"></li><!--
--><li>-</li><!--
--><li><input type="tel" name="tel3" value="<?php echo h($data['tel3']); ?>" class="inputW03"></li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['telno']; ?></span>
</td>
</tr>
<tr>
<th colspan="2">FAX</th>
<td>
<ul class="memberAddnewInputList01"><!--
--><li><input type="tel" name="fax1" value="<?php echo h($data['fax1']); ?>" class="inputW03"></li><!--
--><li>-</li><!--
--><li><input type="tel" name="fax2" value="<?php echo h($data['fax2']); ?>" class="inputW03"></li><!--
--><li>-</li><!--
--><li><input type="tel" name="fax3" value="<?php echo h($data['fax3']); ?>" class="inputW03"></li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['faxno']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">メールアドレス</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><input type="text" name="email_address" value="<?php echo h($data['email_address']); ?>" class="inputW05"><span class="memberAddnewAttention01"><a class="single" href="/common/images/not_mail.gif">ご注意</a></span>
<span class="error"><?php echo $data['validate_msg']['email_address']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">パスワード</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><input type="password" name="member_pwd" value="<?php echo h($data['member_pwd']); ?>" class="inputW05">
<span class="error"><?php echo $data['validate_msg']['member_pwd']; ?></span>
</td>
</tr>
<tr>
<th colspan="2" class="memberAddnewTit01">備考</th>
<td><textarea name="note" rows="5" cols="10"><?php echo h($data['note']); ?></textarea>
<span class="error"><?php echo $data['validate_msg']['note']; ?></span>
</td>
</tr>
</table>

<div class="memberAddnewBox01">
<input type="hidden" name="mode" value="CONFIRM" />
<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
<p class="memberAddnewSend01"><input type="submit" name="to_confirm" value="編集内容の確認"></p>
<!-- /memberAddnewBox01 --></div>

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