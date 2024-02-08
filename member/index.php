<?php 
require_once dirname(__FILE__) . "/../common/system/application.php";

$lang = 0;
$hassocial = 1;
$h1 = "ログイン/会員登録｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>ログイン/会員登録｜京都電機器株式会社</title>
<meta name="keywords" content="ログイン/会員登録,カスタム電源,画像処理用LED照明,瞬低保護装置,京都電機器">
<meta name="description" content="ログイン/会員登録。京都電機器はインバーター電源設計、高圧電源設計を基盤とし、組込電源やカスタム電源にも対応。画像処理用LED照明や専用電源もランナップ。瞬低保護装置では国内トップシェア。">
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
<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li>ログイン/会員登録</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_member01.gif" width="54" height="47" alt="ログイン/会員登録"></span>
<span class="title01">ログイン/会員登録</span>
</h2>

<div id="contents">
<section class="section">
<div class="memberWrap01">
<span><?php echo $data['first_login_message']; ?></span>
<form action="index.php" method="post">
<div class="memberIndexBox01">
<div class="memberIndexLoginBox01">
<h3 class="memberIndexH301">会員の方</h3>												
<div class="memberIndexBoxIn01">
<table class="memberIndexTable01">
<?php echo $data['questionnaire_qa']; ?>
</table>
<!-- /memberIndexLoginBoxIn01 --></div>

<div class="memberIndexBoxIn01">
<table class="memberIndexTable02">
<tr>
<th>メールアドレス</th>
<td><input type="text" name="member_id" class="memberIndexW01" value="<?php echo h($data['member_id']); ?>"></td>
</tr>
<tr>
<th>パスワード</th>
<td><input type="password" name="member_pwd" class="memberIndexW01" value="<?php echo h($data['member_pwd']); ?>"></td>
</tr>
</table>
<span class="error"><?php echo $data['validate_msg']; ?></span>

<p class="memberLogin01"><input type="submit" name="to_login" value="ログイン"></p>
<!-- /memberIndexLoginBoxIn01 --></div>						
<!-- /memberIndexLoginBox01 --></div>

<div class="memberIndexNewBox01">
<h3 class="memberIndexH301">会員登録がお済みでない方</h3>
<div class="memberIndexBoxIn01">
<p class="memberIndexNewTxt01">無料会員登録して頂くだけで、各製品の外形図、仕様書、取扱説明書などをダウンロードして頂けます。</p>
<p class="memberLogin01 mt20"><input type="button" value="新規会員登録はこちら" onclick="location.href='addnew.php'"></p>
<!-- /memberIndexLoginBoxIn01 --></div>
<!-- /memberIndexNewBox01 --></div>
<!-- /memberIndexBox01 --></div>

<p class="memberIndexTxt01">パスワードを忘れられた方は<a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/contact/form1/index.php?ctype=3'; ?>">お問い合せフォーム</a>より、お問い合わせ種別で「パスワード再発行」を選んでご登録されましたメールアドレスで再発行をお申し込み下さい。</p>
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