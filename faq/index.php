<?php
require_once dirname(__FILE__) . "/../common/system/application.php";
$lang = 0;
$hassocial = 1;
$h1 = "よくあるご質問｜京都電機器株式会社";
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>よくあるご質問｜京都電機器株式会社</title>
<meta name="keywords" content="よくあるご質問,瞬時電圧低下保護装置,瞬低保護装置,直流電源,京都電機器">
<meta name="description" content="よくあるご質問をご紹介しています。京都電機器オプトエレクトロニクス事業では、画像処理LEDの照明などの画像処理分野を中心に、その周辺機器などを取り扱っています。">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_layout.css" media="all">
<link rel="stylesheet" type="text/css" href="../common/css/cmn_style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script type="text/javascript" src="../common/js/jquery.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]><script src="../common/js/html5shiv-printshiv.min.js"></script><![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]><script src="../common/js/selectivizr-min.js"></script><![endif]-->
<script type="text/javascript" src="../common/js/jquery-lineup.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$('.lineUpH01').lineUp();
});
</script>
</head>

<body id="g03">

<!-- header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/header01.php'); ?>
<!-- /header -->

<div id="wrapper">
<div id="wrapperIn">
<ul id="breadcrumb">
<li class="home"><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/'; ?>">ホーム</a></li>
<li>よくあるご質問</li>
</ul>

<h2 class="h2_basic01">
<span class="icon01"><img src="../common/images/h2_faq01.gif" width="54" height="47" alt="よくあるご質問"></span>
<span class="title01">よくあるご質問</span>
</h2>

<div id="contents">
<section class="section">
<ul class="faqTabTitle">
<li><a class="active" href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/faq/'; ?>">瞬時電圧低下保護装置</a></li>
<li><a href="<?php echo $TJF_HTTP.$WEB_SERVER_NAME.'/faq/led.php'; ?>">画像処理用LED照明</a></li>
</ul>

<div class="faqAnchorBox01">
<div class="faqAnchorBoxIn01">
<ul class="scroll">
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor01"><span class="txt2">UPSと何が違うのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor02"><span class="txt2">瞬低とはどういう状況をいうのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor03"><span class="txt2">KDPのメリットを教えてください。</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor04"><span class="txt2">容量選定が解らないのですが、どうすればよいですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor05"><span class="txt2">製品の寿命はどの位なのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor06"><span class="txt2">コンデンサーを使用しているのにどうして寿命が長いのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor07"><span class="txt2">効率はどれくらいなのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor08"><span class="txt2">突入電流を考慮しないといけないのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor09"><span class="txt2">万が一KDPが故障したらどうなるのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor10"><span class="txt2">切り替え時間はどれくらいかかりますか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor11"><span class="txt2">瞬低発生状況を後から確認できますか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor12"><span class="txt2">どの程度電圧が降下した時に瞬低と判断しているのですか？</span></a></div></li>
<li><div class="lineUpH01"><span class="txt1">Q.</span><a href="#anchor13"><span class="txt2">1秒以上は保護できないのですか？</span></a></div></li>
</ul>
<!-- /faqAnchorBoxIn01 --></div>
<!-- /faqAnchorBox01 --></div>


<div id="anchor01" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">UPSと何が違うのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">保護対象が1秒以内であればKDP、1秒以上であればUPSと言うのが一般的ですが、国内のインフラ整備の効果で、1秒以上の瞬低（=停電）は飛躍的に減少しております。<br>逆に1秒以下の瞬低は異常気象などの影響で増えており、KDPで十分カバーできます。</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor02" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">瞬低とはどういう状況をいうのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">系統電圧低下が1秒以内・・・瞬低/瞬断<br>
系統電圧低下が1秒以上・・・停電</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor03" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">KDPのメリットを教えてください。</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">・ファンレス・バッテリーレス ⇒ メンテナンス不要<br>
・バイパス回路内蔵で突入電流回避 ⇒ 突入電流に影響されない容量選定が可能<br>
・本体故障時 ⇒ UPSは電力供給停止/KDPはバイパス回路から供給継続<br>
・省スペース化<br>等があります。</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor04" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">容量選定が解らないのですが、どうすればよいですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">ご要求に対して、容量測定にお伺いする事も可能ですし、具体的な負荷のリストを頂ければアドバイスをさせて頂く事は可能です。</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor05" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">製品の寿命はどの位なのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">15年を目標に設計しております。（保証値ではありません）</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor06" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">コンデンサーを使用しているのにどうして寿命が長いのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">コンデンサーは一般的には充放電を繰り返して使用すると、発熱等により寿命が短くなると言われています。<br>
その点KDPでは、自然放電分を充電するという充放電サイクルのみなので発熱が少なく、長寿命化が実現できております。</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor07" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">効率はどれくらいなのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">常時商用方式を採用している為高効率98％を実現しています。</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor08" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">突入電流を考慮しないといけないのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">内部にバイパススイッチを設けており、電源投入時の突入電流を回避しています。</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor09" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">万が一KDPが故障したらどうなるのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">故障時には、内部の自己診断監視機能により、瞬時にバイパス回路に切り替わり、入力は出力へバイパスされますので出力供給は継続されます。</span></p>
</div>
<!-- /faqDetailBox01 --></div>


<div id="anchor10" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">切り替え時間はどれくらいかかりますか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">瞬低発生時・・・最大0.5サイクル (1部機種は1サイクルとなります。) <br>
復旧運転時・・・無瞬断で切り替わります。</span></p>
</div>
<!-- /faqDetailBox01 --></div>

<div id="anchor11" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">瞬低発生状況を後から確認できますか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">瞬低発生回数の累計をカウントしておりますので、モニターにて確認できます。</span></p>
</div>
<!-- /faqDetailBox01 --></div>

<div id="anchor12" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">どの程度電圧が降下した時に瞬低と判断しているのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">系統電圧が11%低下した時に瞬低と判断しております。設定値はマニュアルで変更できます。</span></p>
</div>
<!-- /faqDetailBox01 --></div>

<div id="anchor13" class="faqDetailBox01">
<div class="faqQuestionBox01">
<p><span class="txt1">Q.</span><span class="txt2">1秒以上は保護できないのですか？</span></p>
</div>
<div class="faqAnswerBox01">
<p><span class="txt1">A.</span><span class="txt2">負荷率を減らすことで最大6秒まで保護時間を延ばすことができます。</span></p>
</div>
<!-- /faqDetailBox01 --></div>
<!-- /section --></section>
<!-- /contents --></div>
<!-- /wrapperIn --></div>
<!-- /wrapper --></div>

<!-- footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/include/footer01.php'); ?>
<!-- /footer -->

</body>
</html>