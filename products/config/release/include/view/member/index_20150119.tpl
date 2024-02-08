<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="
瞬低,瞬時電圧低下保護装置,ＵＰＳ,瞬低補償,瞬低対策,瞬低とは,瞬停,瞬低保護装置,瞬時低下, 瞬時電断,京都電機器株式会社,KDP,ＫＤＰ" />
<meta name="Description" content="瞬時低下と瞬時電断を保護します。瞬低保護装置のエキスパート KDP series／京都電機器株式会社" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="robots" content="index,follow" />
<title>ログイン／会員登録｜パワーエレクトロニクス事業/オプトエレクトロニクス事業｜京都電機器株式会社</title>
<link href="common/css/import.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="common/css/font-medium.css" id="styleFontsize" />
<script type="text/javascript" src="common/js/smartrollover.js"></script>
<script type="text/javascript" src="common/js/gloval.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="common/js/jquery_cookie.js"></script>
<script type="text/javascript" src="common/js/font_size.js"></script>
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
<link rel="stylesheet" href="common/css/lytebox.css" type="text/css" media="screen" />
<script type="text/javascript" src="common/js/lytebox.js"></script>
<!--[if lte IE 7]>
<script type="text/javascript" src="common/js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, .login_btn');
</script>
<![endif]-->
</head>
<body>
<!-- wrapper start -->
<div id="wrapper">
  <!-- header_box start -->
  <div id="header_box">

    <div id="header" class="clearfix">
     <div class="left pd-left13 pd-top14">
      <p class="fs12">京都電機器株式会社の電源関連装置</p>
      <div class="mg-top4"><a href="<?this_root_url_power?>"><img src="common/images/logo01.png" alt="Power Electronics" width="358" height="16" class="png" /></a></div>
     </div>
     <div class="left pd-left40 pd-top14">

      <div class="clearfix">
       <div class="left fs12">京都電機器株式会社の光学機器</div>
       <div class="left lo_text pd-top3 wd-225 txtright"><?header_link?></div>
       <div class="left">
        <div class="clearfix pd-left20">
         <div class="left"><img src="common/images/h_text01.png" alt="font size" width="49" height="22" class="png" /></div>
         <div class="left"><a id="small" href="javascript:void(0);" onclick="switchFontsize('font-small'); return false;">小</a></div>
         <div class="left"><a id="medium" href="javascript:void(0);" onclick="switchFontsize('font-medium'); return false;">中</a></div>
         <div class="left"><a id="large" href="javascript:void(0);" onclick="switchFontsize('font-large'); return false;">大</a></div>
      		</div>
       </div>
      </div>

      <div class="clearfix">
       <div class="left"><a href="<?this_root_url_opt?>"><img src="common/images/logo02.png" alt="Opt Electronics" width="320" height="21" class="png" /></a></div>
       <div class="left mg-top11 pd-left38"><a href="https://www.kdn.co.jp/"><img src="common/images/h_text02.png" alt="京都電機器株式会社" width="177" height="14" class="png" /></a></div>
      </div>

     </div>

    </div>

  </div>
  <!-- header_box end -->
  <div id="pankuzu">ログイン／会員登録</div>

  <!-- contents_box start -->
    <div id="contents_box">
      <div id="contents_top">
        <h2><img src="images/titlebar01.gif" alt="ログイン／会員登録" width="960" height="42" /></h2>
          <p class="fs14 mg-top17"><strong>京都電機器株式会社サイトの会員登録を行いますと、ダウンロードコンテンツのご利用や、<br />サンプル機貸し出しなどをお申込みいただける様になります。</strong></p>
      </div><!--/#contents_top-->

      <p class="txtcenter mg-top20" style="color: #F00; font-size:14px;"><?first_login_message?>&nbsp;</p>

      <div class="clearfix mg-top30 mg-left5 mg-right5" >



      <div id="left_login">
        <div id="login_bg">
          <p class="mg-top13 txtcenter"><img src="images/member_bg .gif" alt="会員の方" width="150" height="30" class="member_login" /></p>
            <form method="post" action="index.php">
            <table width="380" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2">
              <div >
              <div>
                <?questionnaire_qa?>
              </div>
              <!--<div>-->
                <?validate_msg?>&nbsp;
              <!--</div>-->
              </div>
              </td>
            </tr>
          <tr>
            <td width="90" height="30" ><div align="right" class="pd-top18"><img src="images/login_bg_mem_e.gif"></div></td>
            <td> <input type="text" class="mg-top18 mg-left20 w01" size="30" name="member_id"></td>
          </tr>
          <tr>
            <td width="90" height="30"><div align="right" class="pd-top10"><img src="images/login_bg_mem_p.gif"></div></td>
            <td><input  type="password" class="mg-top10 mg-left20 w01" size="30" name="member_pwd"></td>
          </tr>
          </table>
          <div><input name="to_login" type="submit" class="login_btn" value=" " /></div>
          </form>
        </div><!--/#login_bg-->




        <p class="mg-top17">パスワードを忘れられた方は<a href="<?this_root_url_contact_guest?>">お問い合せフォーム</a>より、お問い合わせ種別で「パスワード再発行」を選んでご登録されましたメールアドレスで再発行をお申し込み下さい。</p>
      </div><!--/#left_login-->



      <div id="right_login">
        <div class="nomember_bg txtcenter">
          <!--<p class="mg-top13" ><img src="images/nomember_bg_2.gif" alt="会員登録がお済でない方" width="287" height="25" class="nomember_login" /></p>-->
          <a href="<?member_regist_url?>"><img src="images/contact_btn.gif" alt="お問い合わせフォーム" width="300" height="71" /></a>
        </div>
      </div>
      <!--/#login-->




  </div>
  </div>
  <!-- contents_box end -->

  <!-- footer_box start -->
  <div id="footer_box">
   <p id="pagetop"><a href="#wrapper"><img src="common/images/pagetop.png" alt="TOP↑" width="33" height="38" class="png" /></a></p>
   <div id="footer">
    <p class="txtcenter pd-top34">Copyright &copy; 2013 Kyoto Denkiki Co.,Ltd. All Rights Reserved.</p>
   </div>
 </div>
  <!-- footer_box end -->
</div>
<!-- wrapper end -->
</body>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-43913094-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">document.write(unescape("%3Cscript src='" + document.location.protocol + "//log.bb-analytics.jp/analyze.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">analyze2('WDtaQdG5EDvnCj8PyMDcAnpFByug76ib');</script>

</html>
