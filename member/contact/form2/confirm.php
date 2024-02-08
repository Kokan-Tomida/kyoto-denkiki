<?php 
require_once dirname(__FILE__) . "/../../../common/system/application.php";
$lang = 0;
$hassocial = 0;
$h1 = "確認画面｜サンプル機貸し出し依頼｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>確認画面｜サンプル機貸し出し依頼｜京都電機器株式会社</title>
<meta name="keywords" content="確認画面,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="確認画面。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../../../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
<script type="text/javascript" src="../../../common/js/jquery.js"></script>
<script type="text/javascript" src="../../../common/js/common.js"></script><!--[if lt IE 9]>
<script src="../../../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../../../common/js/selectivizr-min.js"></script><![endif]-->
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

<p class="contactLocation01"><img src="../images/img_contact_location02.png" width="960" height="47" alt="STEP2. 入力内容のご確認"></p>						

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
<p class="contactFormTxt01">入力内容をご確認いただき、間違いがなければ「送信する」ボタンで送信してください。</p>

<form action="confirm.php" method="post">
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


<table class="contactFormTable02  mt20">												
<tr>
<th colspan="2" rowspan="2">照明</th>
<td>
<ul class="conactInputList04"><!--
--><li class="txtW01">1. 型式</li><!--
--><li class="txtW02"><?php echo h($data['model1']); ?></li><!--										
--></ul>
</td>
</tr>
<tr>
<td>
<ul class="conactInputList04"><!--
--><li class="txtW01">2. 型式</li><!--
--><li class="txtW02"><?php echo h($data['model2']); ?></li><!--										
--></ul>
</td>
</tr>
<tr>
<th colspan="2" rowspan="2">電源</th>
<td><?php echo h($data['power_needs_view']); ?></td>
</tr>
<tr>
<td><?php echo h($data['power_type']); ?></td>
</tr>
<tr>
<th colspan="2" rowspan="2">延長ケーブル</th>
<td><?php echo h($data['cable_needs_view']); ?> <?php echo h($data['cable_count_view']); ?></td>
</tr>
<tr>
<td><?php echo h($data['cable_length_view']); ?> <?php echo h($data['cable_length_other_view']); ?></td>
</tr>
<tr>
<th colspan="2">貸し出し希望日</th>
<td><?php echo h($data['lent_start_date_view']); ?></td>
</tr>
<tr>
<th colspan="2">返却予定日</th>
<td><?php echo h($data['return_date_view']); ?></td>
</tr>
<tr>
<th colspan="2">対象物ワーク</th>
<td><?php echo h($data['target_work']); ?></td>
</tr>
<tr>
<th colspan="2">ワークの大きさ</th>
<td><?php echo h($data['work_size']); ?></td>
</tr>
<tr>
<th colspan="2" rowspan="2">距離</th>
<td>
<ul class="conactInputList05"><!--
--><li class="txtW01">カメラ - 照明</li><!--
--><li class="txtW02"><?php echo h($data['distance_camera']); ?></li><!--										
--></ul>
</td>
</tr>
<tr>
<td>
<ul class="conactInputList05"><!--
--><li class="txtW01">照明 - ワーク</li><!--
--><li class="txtW02"><?php echo h($data['distance_light']); ?></li><!--										
--></ul>
</td>
</tr>
<tr>
<th colspan="2">検査内容</th>
<td><?php echo nl2br( h($data['sample_note']) ); ?>
</td>
</tr>
</table>


<div class="contactBtnBox02">
<p class="contactback01"><input type="button" value="戻る" onclick="location.href='index.php?back=1'"></p>
<p class="contactSend02"><input name="to_complete" type="submit" value="送信する"></p>
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