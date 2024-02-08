<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="robots" content="index,follow" />
<title>ログイン｜京都電機器 Products Admin 管理サイト</title>
<link href="common/css/import.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="common/js/smartrollover.js"></script>
<script type="text/javascript" src="common/js/gloval.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

//ページトップボタンにつけたid名を入れてください
 var topBtn = $('#pagetop');
 topBtn.hide();

 //スクロールが100に達したらボタン表示
 $(window).scroll(function () {
if ($(this).scrollTop() > 100) {
 topBtn.fadeIn();
 } else {
 topBtn.fadeOut();
 }
 });

 //スクロールしてトップ
 topBtn.click(function () {
 $('body,html').animate({
 scrollTop: 0
 }, 500);
 return false;
 });
});
</script>
<!--[if lte IE 7]>
<script type="text/javascript" src="common/js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.login_btn');
</script>
<![endif]-->
</head>
<body>
<!-- wrapper start -->
<div id="wrapper">
  <!-- header_box start -->
  <div id="header_box">

    <div id="header_login" class="clearfix">
     <div class="left mg-top27 mg-left14"><img src="common/images/logo.gif" alt="Products Admin 管理サイト" width="452" height="34" /></div>
     <div class="left mg-top27">
      <div><a href="/products/power/" target="_blank"><img src="common/images/logo_po.gif" alt="Power Electronics" width="234" height="16" /></a></div>
      <div><a href="/products/opt/" target="_blank"><img src="common/images/logo_opt.gif" alt="Opt Electronics" width="234" height="18" /></a></div>
     </div>
     <div class="right mg-top47 mg-right11"><a href="/" target="_blank"><img src="common/images/logo_kyoto.gif" alt="京都電機器株式会社" width="177" height="14" /></a></div>
    </div>

  </div>
  <!-- header_box end -->
  <!-- contents_box start -->
  <div id="contents_box" class="pd-bottom65">

   <div class="login_bg">
   <form method="post" action="index.php" id="frm">
    <div class="login_text01">ログイン情報</div>
    <div class="clearfix">
     <div class="left fs14 pd-top8 pd-left75">ログインID</div>
     <div class="left pd-left16"><input class="lo01" type="text" name="txt_loginid"></div>
    </div>
    <div class="clearfix pd-top30">
     <div class="left fs14 pd-top8 pd-left75">パスワード</div>
     <div class="left pd-left18"><input class="lo01" type="password" name="txt_password"></div>
    </div>
    <div class="pd-top57 pd-left240"><input type="submit" name="to_login" value=" " class="login_btn" /></div>
    <div class="pd-top10 pd-left240"><?validate_msg?></div>
   </form>
   </div>

  </div>
  <!-- contents_box end -->
  <!-- footer_box start -->
  <div id="footer_box">
   <p id="pagetop"><a href="#wrapper"><img src="common/images/pagetop.png" alt="TOP↑" width="33" height="38" class="png" /></a></p>
   <div id="footer">
    <p class="txtcenter pd-top30">Copyright &copy; 2023 Kyoto Denkiki Co.,Ltd. All Rights Reserved.</p>
   </div>
 </div>
  <!-- footer_box end -->
</div>
<!-- wrapper end -->
</body>
</html>
