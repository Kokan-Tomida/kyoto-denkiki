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
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/colorbox.css" media="all">
<script type="text/javascript" src="../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../common/js/common.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<!--[if lt IE 9]><script src="../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../common/js/selectivizr-min.js"></script><![endif]-->

<script type="text/javascript" src="../../common/js/contact_form.js"></script>
<script type="text/javascript" src="../js/ajaxzip3.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js" charset="UTF-8"></script>
<script type="text/javascript">
$(document).ready(function (){
	$("#form1").validate({
		groups: {
			zip: "zip1 zip2"
			,tel: "tel1 tel2 tel3"
		},
		rules: {
			company_name:{required: true}
			,person_name:{required: true}
			,zip1:{required: true, number:true}
			,zip2:{required: true, number:true}
			,pref:{required: true}
			,address:{required: true}
			,tel1:{required: true, number:true}
			,tel2:{required: true, number:true}
			,tel3:{required: true, number:true}
			,mail:{required: true, email:true}
			,agree:{required: true}
	    },
	    messages: {
			 company_name:{required:'御社名を入力してください'}
			,person_name:{required:'ご担当者名を入力してください'}
			,zip1:{required:'郵便番号を入力してください', number:'数字で入力してください'}
			,zip2:{required:'郵便番号を入力してください', number:'数字で入力してください'}
			,pref:{required:'都道府県を選択してください'}
			,address:{required:'ご住所を入力してください'}
			,tel1:{required:'電話番号を入力してください', number:'数字で入力してください'}
			,tel2:{required:'電話番号を入力してください', number:'数字で入力してください'}
			,tel3:{required:'電話番号を入力してください', number:'数字で入力してください'}
			,mail:{required:'メールアドレスを入力してください', email:'メールアドレスを入力してください'}
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

<p class="contactLocation01"><img src="../images/img_contact_location01.png" width="960" height="47" alt="STEP1. 必要事項の入力"></p>

<?php if ($product): ?>
<div class="contactProduct01">
<div class="contactProductIn01">
<figure><img src="<?php echo h($product['image']); ?>" width="194" height="98" alt="<?php echo h($product['name']).' '.h($product['series']); ?>"></figure>
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
<form id="form1" action="confirm.php" method="post">
<div class="contactForm01Info01">
<p>下記フォームに必要事項をご入力のうえ送信してください。弊社担当より折り返しご連絡させて頂きます。</p>

<ul>
<li>・数字は半角で、カタカナは全角で入力してください。</li>
<li>・必須項目は必ず入力してください。</li>
<li>・<a class="single" href="/common/images/not_text.gif" title="機種依存文字">こちら</a>のような機種依存文字は使用しないでください。</li>
<li>・内容によっては回答に時間がかかる場合がございますので、あらかじめご了承ください。</li>
</ul>
<!-- /contactForm01Info01 --></div>

<div class="contactForm01">
<table class="contactFormTable01">
<tr>
<th class="conactTit01">お問い合わせ種別</th>
<th class="conactMust01"><span>必須</span></th>
<td>
<ul class="conactRadio01"><!--
--><li><label><input type="radio" name="ctype" value="1" <?php if ($input['ctype'] == 1): ?>checked<?php endif; ?>><span>見積希望</span></label></li><!--
--><li><label><input type="radio" name="ctype" value="2" <?php if ($input['ctype'] == 2): ?>checked<?php endif; ?>><span>製品に関するお問い合わせ</span></label></li><!--
--><li><label><input type="radio" name="ctype" value="3" <?php if ($input['ctype'] == 3): ?>checked<?php endif; ?>><span>会員用パスワード再発行</span></label></li><!--
--></ul>
<span id="ctype_error" class="error"><?php echo $error['ctype']; ?></span>
</td>
</tr>						
<tr>
<th class="conactTit01">御社名</th>
<th class="conactMust01"><span>必須</span></th>
<td><input type="text" name="company_name" class="inputW05" value="<?php echo h($input['company_name']); ?>">
<span class="error company_name_err"><?php echo $error['company_name']; ?></span></td>
</tr>
<tr>
<th colspan="2">担当部署</th>
<td><input type="text" name="section_name" class="inputW05" value="<?php echo h($input['section_name']); ?>">
<span class="error"><?php echo $error['section_name']; ?></span></td>
</tr>
<tr>
<th class="conactTit01">ご担当者名</th>
<th class="conactMust01"><span>必須</span></th>
<td><input type="text" name="person_name" class="inputW05" value="<?php echo h($input['person_name']); ?>">
<span class="error person_name_err"><?php echo $error['person_name']; ?></span></td>
</tr>
<tr>
<th class="conactTit01">郵便番号</th>
<th class="conactMust01"><span>必須</span></th>
<td>
<ul class="conactInputList01"><!--
--><li>
<input type="text" name="zip1" size="4" maxlength="3" value="<?php echo h($input['zip1']); ?>" class="inputW01" placeholder="000" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','address');">
-
<input type="text" name="zip2" size="5" maxlength="4" value="<?php echo h($input['zip2']); ?>" class="inputW02" placeholder="0000" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','address');">
<span class="error zip_err"><?php echo $error['zip']; ?></span></li><!--
--></ul>
</td>
</tr>
<tr>
<th class="conactTit01">都道府県</th>
<th class="conactMust01"><span>必須</span></th>
<td>
<select name="pref" class="selectW01">
<option value="">都道府県の選択</option>
<?php $prefList = getPrefList(); foreach($prefList as $prefKey => $prefName): ?>
<option value="<?php echo $prefKey; ?>" <?php if ($prefKey == $input['pref']): 
?>selected<?php endif; ?>><?php echo $prefName; ?></option>
<?php endforeach; ?>
</select>
<span class="error pref_err"><?php echo $error['pref']; ?></span>
</td>
</tr>
<tr>
<th class="conactTit01">ご住所</th>
<th class="conactMust01"><span>必須</span></th>
<td><input type="text" name="address" class="inputW06" value="<?php echo h($input['address']); ?>">
<span class="error address_err"><?php echo $error['address']; ?></span></td>
</tr>
<tr>
<th class="conactTit01">TEL</th>
<th class="conactMust01"><span>必須</span></th>
<td>
<ul class="conactInputList01"><!--
--><li><input type="tel" name="tel1" class="inputW03" value="<?php echo h($input['tel1']); ?>">
-
<input type="tel" name="tel2" class="inputW03" value="<?php echo h($input['tel2']); ?>">
-
<input type="tel" name="tel3" class="inputW03" value="<?php echo h($input['tel3']); ?>">
<span class="error tel_err"><?php echo $error['tel']; ?></span></li><!--
--></ul>
</td>
</tr>
<tr>
<th colspan="2">FAX</th>
<td>
<ul class="conactInputList01"><!--
--><li><input type="tel" name="fax1" class="inputW03" value="<?php echo h($input['fax1']); ?>">
-
<input type="tel" name="fax2" class="inputW03" value="<?php echo h($input['fax2']); ?>">
-
<input type="tel" name="fax3" class="inputW03" value="<?php echo h($input['fax3']); ?>">
<span class="error"><?php echo $error['fax']; ?></span></li><!--
--></ul>
</td>
</tr>
<tr>
<th class="conactTit01">メールアドレス</th>
<th class="conactMust01"><span>必須</span></th>
<td><input type="text" name="mail" class="inputW05" value="<?php echo h($input['mail']); ?>" placeholder="xxxxxx@kdn.co.jp"><span class="conactAttention01"><a class="single" href="/common/images/not_mail.gif">ご注意</a></span>
<span class="error mail_err"><?php echo $error['mail']; ?></span></td>
</tr>
<tr>
<th colspan="2">お問い合わせ内容</th>
<td><textarea name="message" rows="5" cols="10"><?php echo h($input['message']); ?></textarea>
<span class="error"><?php echo $error['message']; ?></span>
</td>
</tr>
<tr>
<th class="conactTit01">個人情報の<br>取り扱いについて</th>
<th class="conactMust01"><span>必須</span></th>
<td>
<p class="conactAgreeTxt01">弊社の<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/site/privacy.php'; ?>" target="_blank">プライバシーポリシー</a>をお読みいただき、同意頂ける方はチェックを入れてください。<br>※当フォームのご利用には、同意頂くことが必要となります。</p>
<p class="conactAgreeTxt02"><label><input name="agree" type="checkbox" value="1" <?php if ($input['agree'] == 1): ?>checked<?php endif; ?>><span>同意する</span></label></p>
<span class="error agree_err"><?php echo $error['agree']; ?></span>
</td>
</tr>
</table>

<div class="contactBtnBox01">
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