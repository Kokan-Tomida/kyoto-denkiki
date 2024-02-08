<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="robots" content="index,follow" />
<title>｜京都電機器 Products ｜Admin 管理サイト</title>
<link href="<?menu_g?>" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="common/themes/base/jquery.ui.all.css">
<link href="common/css/import.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="./common/js/smartrollover.js"></script>
<script type="text/javascript" src="./common/js/gloval.js"></script>
<script type="text/javascript" src="./common/js/jsf.js"></script>
<script src="./common/jquery-1.9.1.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
<script src="./common/ui/jquery.ui.core.js"></script>
<script src="./common/ui/jquery.ui.widget.js"></script>
<script src="./common/ui/jquery.ui.datepicker.js"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
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
<script>
	$(function() {
		$( "#from" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
		$( "#datepicker" ).datepicker();
	});
</script>
<!--[if lte IE 7]>
<script type="text/javascript" src="common/js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, .search_btn, .clear_btn, .edit_btn, .delete_btn, .up_btn, .down_btn, .regist_btn');
</script>
<![endif]-->
</head>
<body>
<!-- wrapper start -->
<div id="wrapper">
  <!-- header_box start -->
  <div id="header_box">

    <div id="header" class="clearfix">
     <div class="left mg-top27 mg-left14"><img src="common/images/logo.gif" alt="Products Admin 管理サイト" width="452" height="34" /></div>
     <div class="left mg-top27">
      <div><a href="/products/power/" target="_blank"><img src="common/images/logo_po.gif" alt="Power Electronics" width="234" height="16" /></a></div>
      <div><a href="/products/opt/" target="_blank"><img src="common/images/logo_opt.gif" alt="Opt Electronics" width="234" height="18" /></a></div>
     </div>
     <div class="right mg-right11">
      <div class="pd-left60"><a href="logout.php"><img src="common/images/logout_btn.gif" alt="ログアウト" width="119" height="32" /></a></div>
      <div class="mg-top15"><a href="https://www.kdn.co.jp/" target="_blank"><img src="common/images/logo_kyoto.gif" alt="京都電機器株式会社" width="177" height="14" /></a></div>
     </div>
    </div>

  </div>
  <!-- header_box end -->

  <div id="g_menu_bg">
  <!-- g_menu_box start -->
  <div id="g_menu_box" class="clearfix">
   <div class="left g01"><a href="a1100.php"><img src="common/images/gmenu_btn01.gif" alt="製品中カテゴリ画面" width="192" height="73" /></a></div>
   <div class="left g02"><a href="a2100.php"><img src="common/images/gmenu_btn02.gif" alt="製品情報管理" width="192" height="73" /></a></div>
   <div class="left g03"><a href="a3100.php"><img src="common/images/gmenu_btn03.gif" alt="会員情報管理" width="192" height="73" /></a></div>
   <div class="left g04"><a href="a4100.php"><img src="common/images/gmenu_btn04.gif" alt="履歴情報管理" width="192" height="73" /></a></div>
   <div class="left g05"><a href="a5100.php"><img src="common/images/gmenu_btn05.gif" alt="基本情報管理" width="192" height="73" /></a></div>
 </div>
  <!-- g_menu_box end -->
  </div>
