<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 0;
$h1 = "新規会員登録｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>新規会員登録｜京都電機器株式会社</title>
<meta name="keywords" content="新規会員登録,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="新規会員登録。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/colorbox.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->

<script type="text/javascript" src="../contact/js/ajaxzip3.js" charset="UTF-8"></script>
<script type="text/javascript" src="../contact/js/jquery.validate.min.js" charset="UTF-8"></script>
<script type="text/javascript">
$(document).ready(function (){
	$("#form1").validate({
		groups: {
			zip: "zip1 zip2"
			,tel: "tel1 tel2 tel3"
		},
		rules: {
			company_name:{required: true}
			,charge_name:{required: true}
			,zip1:{required: true, number:true}
			,zip2:{required: true, number:true}
			,pref:{required: true}
			,address1:{required: true}
			,tel1:{required: true, number:true}
			,tel2:{required: true, number:true}
			,tel3:{required: true, number:true}
			,email_address:{required: true, email:true}
			,agree:{required: true}
	    },
	    messages: {
			 company_name:{required:'御社名を入力してください'}
			,charge_name:{required:'ご担当者名を入力してください'}
			,zip1:{required:'郵便番号を入力してください', number:'数字で入力してください'}
			,zip2:{required:'郵便番号を入力してください', number:'数字で入力してください'}
			,pref:{required:'都道府県を選択してください'}
			,address1:{required:'ご住所を入力してください'}
			,tel1:{required:'電話番号を入力してください', number:'数字で入力してください'}
			,tel2:{required:'電話番号を入力してください', number:'数字で入力してください'}
			,tel3:{required:'電話番号を入力してください', number:'数字で入力してください'}
			,email_address:{required:'メールアドレスを入力してください', email:'メールアドレスを入力してください'}
			,agree:{required:'当フォームのご利用には、同意頂くことが必要となります。'}
	    },
		errorPlacement: function(error, ele){
			var tn = ele.attr("name");
			if(tn == "zip1" || tn == "zip2") $(".zip_err").append(error);
			else if(tn == "tel1" || tn == "tel2" || tn == "tel3") $(".tel_err").append(error);
			else $("."+String( ele.attr("name") )+"_err").append(error);
		}
	});
});
</script>
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
<span class="title01">新規会員登録</span>
</h2>

<div id="contents">
<section class="section">
<p class="memberLocation01"><img src="images/img_member_location01.png" width="960" height="47" alt="STEP1. 必要事項の入力"></p>

<div class="memberWrap01">				
<form id="form1" action="addnew_confirm.php" method="post">
<div class="memberForm01Info01">
<p>会員登録は、下記フォームにご入力下さい。</p>
<p class="memberForm01InfoStyle01">登録されたメールアドレス宛に登録案内のメールが届きますので、このメールに記載しているURLにアクセスすることにより登録が完了いたします。</p>

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
<span class="error company_name_err"><?php echo $data['validate_msg']['company_name']; ?></span>
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
<span class="error charge_name_err"><?php echo $data['validate_msg']['charge_name']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">郵便番号</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td>
<ul class="memberAddnewInputList01"><!--
--><li><input type="text" name="zip1" size="4" maxlength="3" value="<?php echo h($data['zip1']); ?>" class="inputW01" placeholder="000" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','address1');"></li><!--
--><li>-</li><!--
--><li><input type="text" name="zip2" size="5" maxlength="4" value="<?php echo h($data['zip2']); ?>" class="inputW02" placeholder="0000" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','address1');"></li><!--
--></ul>
<span class="error zip_err"><?php echo $data['validate_msg']['zip']; ?></span>
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
<span class="error pref_err"><?php echo $data['validate_msg']['pref']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">ご住所</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td><input type="text" name="address1" value="<?php echo h($data['address1']); ?>" class="inputW06">
<span class="error address1_err"><?php echo $data['validate_msg']['address1']; ?></span>
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
<span class="error tel_err"><?php echo $data['validate_msg']['telno']; ?></span>
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
<td><input type="text" name="email_address" value="<?php echo h($data['email_address']); ?>" class="inputW05" placeholder="xxxxxx@kdn.co.jp"><span class="memberAddnewAttention01"><a class="single" href="/common/images/not_mail.gif">ご注意</a></span>
<span class="error email_address_err"><?php echo $data['validate_msg']['email_address']; ?></span>
</td>
</tr>
<tr>
<th colspan="2" class="memberAddnewTit01">備考</th>
<td><textarea name="note" rows="5" cols="10"><?php echo h($data['note']); ?></textarea>
<span class="error"><?php echo $data['validate_msg']['note']; ?></span>
</td>
</tr>
<tr>
<th class="memberAddnewTit01">個人情報の<br>取り扱いについて</th>
<th class="memberAddnewMust01"><span>必須</span></th>
<td>
<p class="memberAddnewAgreeTxt01">弊社の<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/site/privacy.php'; ?>" target="_blank">プライバシーポリシー</a>をお読みいただき、同意頂ける方はチェックを入れてください。<br>※当フォームのご利用には、同意頂くことが必要となります。</p>
<p class="memberAddnewAgreeTxt02"><label><input name="agree" value="1" type="checkbox" <?php if ($data['agree']): ?>checked<?php endif; ?>><span>同意する</span></label></p>
<span class="error agree_err"><?php echo $data['validate_msg']['agree']; ?></span>
</td>
</tr>
</table>

<div class="memberAddnewBox01">
<p class="memberAddnewSend01"><input type="submit" value="送信内容の確認"></p>
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