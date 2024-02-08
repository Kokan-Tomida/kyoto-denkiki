<?php 
	require_once dirname(__FILE__) . "/../../../common/system/application.php";
$lang = 0;
$hassocial = 0;
$h1 = "サンプル機貸し出し依頼｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>サンプル機貸し出し依頼｜京都電機器株式会社</title>
<meta name="keywords" content="サンプル機貸し出し依頼,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="サンプル機貸し出し依頼。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/colorbox.css" media="all">
<script type="text/javascript" src="../../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../../common/js/common.js"></script>
<script type="text/javascript" src="../../js/jquery.colorbox-min.js"></script>
<!--[if lt IE 9]><script src="../../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../../common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="../../../common/js/member_contact_form.js"></script>
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
<h2 class="h2_basic01">
<span class="icon01"><img src="../../../common/images/h2_contact02.gif" width="54" height="47" alt="お問い合わせ"></span>
<span class="title01">サンプル機貸し出し依頼</span>
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
<th colspan="2">御社名</th>
<td><?php echo h($data['company_name']); ?></td>
</tr>
<tr>
<th colspan="2">ご担当者名</th>
<td><?php echo h($data['charge_name']); ?> 様</td>
</tr>
</table>


<table class="contactFormTable02 mt20">												
<tr>
<th colspan="2" rowspan="2">照明</th>
<td>
<ul class="conactInputList02"><!--
--><li class="txtW01">1. 型式</li><!--
--><li class="txtW02"><input name="model1" value="<?php echo h($data['model1']); ?>" type="text" class="inputW09"></li><!--										
--></ul>
</td>
</tr>
<tr>
<td>
<ul class="conactInputList02"><!--
--><li class="txtW01">2. 型式</li><!--
--><li class="txtW02"><input name="model2" value="<?php echo h($data['model2']); ?>" type="text" class="inputW09"></li><!--										
--></ul>
</td>
</tr>
<tr>
<th colspan="2" rowspan="2">電源</th>
<td>
<ul class="conactRadio02"><!--
--><li><label><input type="radio" name="power_needs" value="1" <?php if ($data['power_needs'] == 1): ?>checked<?php endif; ?>><span>必要</span></label></li><!--
--><li><label><input type="radio" name="power_needs" value="2" <?php if ($data['power_needs'] == 2): ?>checked<?php endif; ?>><span>不要</span></label></li><!--
--></ul>
</td>
</tr>
<tr>
<td>
<p>型式のご指定がある場合は入力してください。</p>
<ul class="conactInputList02 mt05"><!--
--><li class="txtW01">型式</li><!--
--><li class="txtW02"><input name="power_type" value="<?php echo h($data['power_type']); ?>" style="ime-mode: disabled;" type="text" class="inputW09"></li><!--										
--></ul>
</td>
</tr>
<tr>
<th colspan="2" rowspan="2">延長ケーブル</th>
<td>
<ul class="conactRadio02"><!--
--><li><label>
<input type="radio" name="cable_needs" value="1" <?php if ($data['cable_needs'] == 1): ?>checked<?php endif; ?>><span>必要</span>
</label>&nbsp;
<input class="input07" name="cable_count" type="text" id="cable_count" maxlength="3" size="3" style="ime-mode:disabled;" value="<?php echo h($data['cable_count']); ?>" />
本
</li><!--
--><li><label><input type="radio" name="cable_needs" value="2" <?php if ($data['cable_needs'] == 2): ?>checked<?php endif; ?>><span>不要</span></label></li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['cable_count']; ?></span>
</td>
</tr>
<tr>
<td>
<p>長さのご指定がある場合は入力してください。</p>
<ul class="conactRadio02 mt10"><!--
<?php if (empty($data['cable_length'])) {$data['cable_length'] = array();} ?>
--><li><label><input type="checkbox" name="cable_length[]" value="2" <?php if (in_array("2", $data['cable_length'])): ?>checked<?php endif; ?>><span>2m</span></label></li><!--
--><li><label><input type="checkbox" name="cable_length[]" value="3" <?php if (in_array("3", $data['cable_length'])): ?>checked<?php endif; ?>><span>3m</span></label></li><!--
--><li><label><input type="checkbox" name="cable_length[]" value="4" <?php if (in_array("4", $data['cable_length'])): ?>checked<?php endif; ?>><span>4m</span></label></li><!--
--><li><label>
<input type="checkbox" name="cable_length[]" value="9" <?php if (in_array("9", $data['cable_length'])): ?>checked<?php endif; ?>><span>その他</span>
</label><input type="text" name="cable_length_other" style="ime-mode: disabled;" value="<?php echo h($data['cable_length_other']); ?>" class="inputW07">m</li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['cable_length']; ?></span>
<span class="error"><?php echo $data['validate_msg']['cable_length_other']; ?></span>
</td>
</tr>
<tr>
<th colspan="2">貸し出し希望日</th>
<td>
<?php $years = $data['usable_years']; ?>
<ul class="conactSelectList01"><!--
--><li>
<select name="lent_start_date_year">
<option value="" >------</option>
<?php foreach($years as $year): ?>
<option value="<?php echo $year; ?>" <?php if ($data['lent_start_date_year'] == $year): ?>selected<?php endif; ?>><?php echo $year; ?></option>
<?php endforeach; ?>
</select> 
</li><!--
--><li class="contactDate01">年</li><!--
--><li>
<select name="lent_start_date_month">
<option value="" selected>------</option>
<?php for($month = 1; $month <= 12; $month++): ?>
<option value="<?php echo sprintf("%02d", $month); ?>" <?php if ($data['lent_start_date_month'] == $month): ?>selected<?php endif; ?>><?php echo $month; ?></option>
<?php endfor; ?>
</select> 
</li><!--
--><li class="contactDate01">月</li><!--
--><li>
<select name="lent_start_date_day">
<option value="" selected>------</option>
<?php for($day = 1; $day <= 31; $day++): ?>
<option value="<?php echo sprintf("%02d", $day); ?>" <?php if ($data['lent_start_date_day'] == $day): ?>selected<?php endif; ?>><?php echo $day; ?></option>
<?php endfor; ?>
</select>
</li><!--
--><li class="contactDate01">日</li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['lent_start_date']; ?></span>
</td>
</tr>
<tr>
<th colspan="2">返却予定日</th>
<td>
<ul class="conactSelectList01"><!--
--><li>
<select name="return_date_year">
<option value="" selected>------</option>
<?php foreach($years as $year): ?>
<option value="<?php echo $year; ?>" <?php if ($data['return_date_year'] == $year): ?>selected<?php endif; ?>><?php echo $year; ?></option>
<?php endforeach; ?>
</select> 
</li><!--
--><li class="contactDate01">年</li><!--
--><li>
<select name="return_date_month">
<option value="" selected>------</option>
<?php for($month = 1; $month <= 12; $month++): ?>
<option value="<?php echo sprintf("%02d", $month); ?>" <?php if ($data['return_date_month'] == $month): ?>selected<?php endif; ?>><?php echo $month; ?></option>
<?php endfor; ?>
</select> 
</li><!--
--><li class="contactDate01">月</li><!--
--><li>
<select name="return_date_day">
<option value="" selected>------</option>
<?php for($day = 1; $day <= 31; $day++): ?>
<option value="<?php echo sprintf("%02d", $day); ?>" <?php if ($data['return_date_day'] == $day): ?>selected<?php endif; ?>><?php echo $day; ?></option>
<?php endfor; ?>
</select>
</li><!--
--><li class="contactDate01">日</li><!--
--></ul>
<span class="error"><?php echo $data['validate_msg']['return_date']; ?></span>
</td>
</tr>
<tr>
<th colspan="2">対象物ワーク</th>
<td><input name="target_work" value="<?php echo h($data['target_work']); ?>" type="text" class="inputW08"></td>
</tr>
<tr>
<th colspan="2">ワークの大きさ</th>
<td><input name="work_size" value="<?php echo h($data['work_size']); ?>" type="text" class="inputW08"></td>
</tr>
<tr>
<th colspan="2" rowspan="2">距離</th>
<td>
<ul class="conactInputList03"><!--
--><li class="txtW01">カメラ - 照明</li><!--
--><li class="txtW02"><input name="distance_camera" value="<?php echo h($data['distance_camera']); ?>" type="text" class="inputW08"></li><!--										
--></ul>
</td>
</tr>
<tr>
<td>
<ul class="conactInputList03"><!--
--><li class="txtW01">照明 - ワーク</li><!--
--><li class="txtW02"><input name="distance_light" value="<?php echo h($data['distance_light']); ?>" type="text" class="inputW08"></li><!--										
--></ul>
</td>
</tr>
<tr>
<th colspan="2">検査内容</th>
<td><textarea name="sample_note" rows="5" cols="10" class="textareaW01"><?php echo h($data['sample_note']); ?></textarea></td>
</tr>
</table>


<div class="contactBtnBox01">
<p class="contactSend01"><input name="to_confirm" type="submit" value="送信内容の確認"></p>
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