<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<link rel="canonical" href="https://www.kdn.co.jp/products/opt/technical/led/index3.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="LED技術資料,画像処理用LED,LED,照明,画像処理,蛍光灯照明,キセノン管ストロボ装置,電源,京都電機器,オプトエレクトロニクス">
<meta name="description" content="点灯電源の選定・I/O回路の機能説明についてご紹介しています。京都電機器オプトエレクトロニクス事業では、画像処理LEDの照明などの画像処理分野を中心に、その周辺機器などを取り扱っています。">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="robots" content="index,follow">
<title>LED技術資料｜京都電機器株式会社</title>
<link href="../../common/css/import.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="../../common/css/font-medium.css" id="styleFontsize" />
<script type="text/javascript" src="../../common/js/smartrollover.js"></script>
<script type="text/javascript" src="../../common/js/gloval.js"></script>
<link rel="stylesheet" href="../../common/css/jquery.megamenu.css" type="text/css" media="screen" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="../../common/js/jquery_cookie.js"></script>
<script type="text/javascript" src="../../common/js/font_size.js"></script>
<script type="text/javascript" src="../../common/js/jquery.megamenu.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".MegaMenuLink").megamenu(
		".MegaMenuContent",{
		width: "495px"
	});
});
</script>
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
<style type="text/css">
div#g_menu li#second{
	background-image:url(../../common/images/gmenu_btn02_on.jpg);
	background-repeat:no-repeat;
}
</style>
<!--[if lte IE 6]>
<script type="text/javascript" src="../../common/js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png, #MegaMenuContent, #MegaMenuContentShadow');
</script>
<![endif]-->
</head>

<body>

 <!-- wrapper start -->
 <div id="subwrapper">
  
  <!-- subheader_box start -->
  <div id="subheader_box">
   <div id="subheader" class="clearfix">
    <div class="left pd-left10 mg-top18 wd-716">
    
    <div class="clearfix">
     <div class="left"><h1>LED技術資料｜京都電機器株式会社<</h1></div>
     <div class="right lo_text txtright"><?header_link?></div>
    </div>
    
    <div class="clearfix">
     <div class="left mg-top6"><a href="../../index.php"><img src="../../common/images/logo.png" alt="Opt Electronics　オプトエレクトロニクス事業" width="537" height="24" class="png" /></a></div>
     <div class="left">
     <div class="clearfix pd-top4 pd-left60">
      <div class="left"><img src="../../common/images/h_text01.png" alt="font size" width="49" height="22" class="png" /></div>
      <div class="left"><a id="small" href="javascript:void(0);" onclick="switchFontsize('font-small'); return false;">小</a></div>
      <div class="left"><a id="medium" href="javascript:void(0);" onclick="switchFontsize('font-medium'); return false;">中</a></div>
      <div class="left"><a id="large" href="javascript:void(0);" onclick="switchFontsize('font-large'); return false;">大</a></div>
     </div>
     </div>
    </div>
    
    </div>
    
    <div class="left mg-top16 mg-left20 wd-205">
     <div class="txtright"><a href="http://www.kdn.co.jp/"><img src="../../common/images/h_text02.png" alt="京都電機器株式会社" width="167" height="15" class="png" /></a></div>
     <form action="<?this_root_url_opt?>/search/index.php" id="cse-search-box">
     <div id="search" class="clearfix">
      <div class="left wd-152">
      <input type="hidden" name="cx" value="015627675974521514563:d2vtuz4buym" />
      <input type="hidden" name="cof" value="FORID:11" />
      <input type="hidden" name="ie" value="UTF-8" />
      <input type="text" name="q" size="30" class="search_form" />
      </div>
      <div class="left wd-53">
      <input type="submit" name="sa" value="" class="search_btn"/>
      </div>
     </div>
     </form>
     <script type="text/javascript">
   (function() { var f = document.getElementById('cse-search-box'); if (!f) { f = document.getElementById('searchbox_demo'); } if (f && f.q) { var q = f.q; var n = navigator; var l = location; if (n.platform == 'Win32') { q.style.cssText = ''; } var b = function() { if (q.value == '') { q.style.background = '#ffffff url(https:\x2F\x2Fwww.google.com\x2Fcoop\x2Fintl\x2Fja\x2Fimages\x2Fgoogle_custom_search_watermark.gif) left no-repeat'; } }; var f = function() { q.style.background = 'ffffff'; }; q.onfocus = f; q.onblur = b; if (!/[&?]q=[^&]/.test(l.search)) { b(); } } })();
   </script>
    </div>
   </div>
   
   <!-- g_menu start -->
   <div id="g_menu" class="clearfix MegaMenu">
    <ul>
     <li id="first">
     <a class="MegaMenuLink" href="javascript:;">製品情報</a>
     <div class="MegaMenuContent">
      <ul>
      <li id="m1"><a href="../../products/led/index.php">画像処理用LED照明</a></li>
      <li id="m2"><a href="../../products/fluorescent/index.php">画像処理用蛍光灯照明</a></li>
      <li id="m3"><a href="../../products/xenon/index.php">キセノン管ストロボ装置</a></li>
      </ul>
     </div>
     </li>
     <li id="second">
     <a class="MegaMenuLink" href="javascript:;">技術情報</a>
     <div class="MegaMenuContent">
      <ul>
      <li id="m4"><a href="../led/index.php">LED技術資料</a></li>
      <li id="m5"><a href="../fluorescent/index.php">蛍光灯技術資料</a></li>
      <li id="m6"><a href="../xenon/index.php">キセノンストロボ技術資料</a></li>
      </ul>
     </div>
     </li>
     <li id="third"><a href="../../equipment/index.php">設備・サポート</a></li>
     <li id="fourth"><a href="<?this_root_url_contact?>">お問い合わせ</a></li>
     <li id="fifth"><a href="https://commerce.kdn.co.jp/webedi/member/members.php" target="_blank"><span class="ttl_01">WEB EDI</span><span class="ttl_02">電子商取引</span></a></li>
    </ul>
   </div>
   <!-- g_menu end -->
   
   <div id="pankuzu"><a href="../../index.php">TOP</a> &gt; LED技術資料</div>
   
   </div>
   <!-- subheader_box end -->
   
   <!-- contents_box start -->
   <div id="subcontents_box">
   
    <h2 class="mg-top11"><img src="images/titlebar.gif" alt="LED技術資料　LED Technical document" width="960" height="42" /></h2>
   
   <!-- box03 -->
   <div id="t_l_box03">
    
    <div class="clearfix mg-top25">
     <div class="left pd-left132"><a href="index.php"><img src="images/btn01_off.gif" alt="LED素子の特性について" width="232" height="67" /></a></div>
     <div class="left"><a href="index2.php"><img src="images/btn02_off.gif" alt="点灯電源の調光について" width="230" height="67" /></a></div>
     <div class="left"><img src="images/btn03.gif" alt="点灯電源の選定・I/O回路の機能説明" width="233" height="67" /></div>
    </div>
    
    <h3 class="mg-top30"><img src="images/subtitle03.gif" alt="点灯電源の選定・I/O回路の機能説明" width="388" height="32" /></h3>
    <div class="clearfix">
     <div class="left"><a href="#l06"><img src="images/btn09_off.gif" alt="点灯電源の選定について" width="253" height="65" /></a></div>
     <div class="left"><a href="#l07"><img src="images/btn10_off.gif" alt="点灯電源I/O回路の機能説明" width="707" height="65" /></a></div>
    </div>
    
    <div class="technical_led_box03">
    
    <div class="clearfix">
      <div class="left wd-340">
      <p id="l06" class="technical_text01">点灯電源の選定について</p>
      <p class="mg-top11">点灯電源選定には、LED照明の消費電力の算出が必要不可欠です。<br />正しい点灯電源の選定をいただきご使用下さい。</p>
      </div>
      <div class="left wd-490 pd-left35">
       <p class="technical_text02">Selection of lighting power supply</p>
       <p class="mg-top11">The power consumption of LED lighting is indispensable for the selection of a suitable lighting power supply.Be sure to use a correct lighting power supply.</p>
      </div>
     </div>
     
     <div class="mg-top16"><img src="images/line05.gif" width="898" height="1" /></div>
     
     <p class="mg-top18"><strong>・照明に合った出力の電源を選定下さい。<br />・Select a power supply output suitable for the lighting fixture.</strong></p>
     
     <div class="mg-top46"><img src="images/item08.jpg" alt="点灯電源の選定について" width="898" height="269" /></div>
     
     <div class="mg-top40"><img src="images/line05.gif" width="898" height="1" /></div>
     
     <p class="mg-top38"><strong>・抵抗BOXとセットで使用する照明は抵抗BOXの消費電力を加味して下さい。
<br />・When using an LED lighting fixture and resistance box in combination, add the power consumption of the resistance box.</strong></p>

     <div class="mg-top26"><img src="images/item09.jpg" alt="点灯電源の選定について" width="898" height="115" /></div>
     
     <div class="clearfix mg-top38">
      <div class="left fs_turquoise wd-450">注意）<br />
点灯電源選定時、必ず接続するLED照明の消費電力を算出してから選定下さい。<br />
点灯電源の消費電力を超えるような選定はしないようお願いします。<br />
不明点等ありましたら当社までお問い合わせ下さい。</div>
      <div class="right fs_turquoise wd-430">Note:<br />When selecting a lighting power supply, be sure to calculate the power consumption of the LED lighting to be connected.<br />Do not select a LED lighting fixture in excess of the power consumption of the lighting power supply.<br />Contact us if you have any inquiries.
      </div>
     </div>

    </div>
    <div class="technical_led_box03">
    
     <div class="clearfix">
      <div class="left wd-380">
      <p id="l07" class="technical_text01">点灯電源I/O回路の機能説明</p>
      <p class="mg-top11">当社の点灯電源のI/Oコネクタのピン内容の機能について説明します。</p>
      </div>
      <div class="right wd-480">
       <p class="technical_text02">Functional Description I / O circuits supply lighting</p>
       <p class="mg-top11">Describes the features of what pin I / O connector of the power of our lights</p>
      </div>
     </div>
     
     <div class="tablebg01 mg-top21">
       <table width="898" border="0" cellspacing="1" cellpadding="6">
        <tr>
          <td width="180"><div class="pd-left5">Pin Detail</div></td>
          <td width="100"><div class="pd-left5">I/O</div></td>
          <td width="270"><div class="pd-left5">Function</div></td>
          <td width="295"><div class="pd-left5">Specification<br />
          </div></td>
          </tr>
        </table>
      </div>
      
      <div class="tablebg02">
       <table width="898" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td width="192"><div class="pd-left10"><strong>DIG. Bit</strong></div></td>
          <td width="112"><div class="pd-left10">INPUT</div></td>
          <td width="282"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">DIGITAL信号（8bitや10bit）を入力して調光する<br />
            Digital signal (10bit or 8bit) to enter the dimming.</div></td>
          <td width="307"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">『LOW』レベルで "光量UP"<br />全bit可変で調光0-100%可変<br />"LOW" level "UP light" <br />Variable bit more variable 0-100% dimming.
</div></td>
        </tr>
        <tr>
          <td class="cell01"><div class="pd-left10"><strong>ANA. 5V (ANA. 0V)</strong></div></td>
          <td class="cell01"><div class="pd-left10">INPUT</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">ANALOG信号（0-5V）を入力して調光する<br />
Analog signal (0-5V) and enter the dimming.</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">0-5V入力で調光0-100%可変<br />Adjustable from 0-100% dimming 0-5V input.</div></td>
        </tr>
        <tr>
          <td width="192"><div class="pd-left10"><strong>LIGHT INT./EXT.</strong></div></td>
          <td width="112"><div class="pd-left10">INPUT</div></td>
          <td><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">内部調光と外部調光を切り替える<br />Switch between internal dimming and external dimming.</div></td>
          <td width="307"><div class="pd-left10">『LOW』レベルで "外部調光"<br />"LOW" level "external dimming"</div></td>
        </tr>
        <tr>
          <td class="cell01"><div class="pd-left10"><strong>LIGHT ANA./DIG.</strong></div></td>
          <td class="cell01"><div class="pd-left10">INPUT</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">ANALOG調光とDIGITAL調光を切り替える<br />Switch between analog dimming and digital dimming.</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">『LOW』レベルで "ANALOG調光"<br />"LOW" level "dimming ANALOG"</div></td>
        </tr>
        <tr>
          <td width="192"><div class="pd-left10"><strong>ON/OFF</strong></div></td>
          <td width="112"><div class="pd-left10">INPUT</div></td>
          <td><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">照明の点灯と消灯を切り替える<br />Switch between lighting and off.<br />
          </div></td>
          <td width="307"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">『LOW』レベルで "点灯"<br />"LOW" level "lights"</div></td>
        </tr>
        <tr>
          <td class="cell01"><div class="pd-left10"><strong>ON-OFF INT./EXT.</strong></div></td>
          <td class="cell01"><div class="pd-left10">INPUT</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">内部ON/OFFと外部ON/OFFを切り替える<br />Switch between internal ON-OFF and external ON-OFF.</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">『LOW』レベルで "外部ON/OFF"<br />"LOW" level "ON / OFF" External.</div></td>
        </tr>
        <tr>
          <td width="192"><div class="pd-left10"><strong>Ch SELECT</strong></div></td>
          <td width="112"><div class="pd-left10">INPUT</div></td>
          <td><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">データを書き込むチャンネルを指定する<br />Write data to specify the channel.</div></td>
          <td width="307"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">『LOW』レベルでチャンネルを指定<br />※"LOW" level specified channel.</div></td>
        </tr>
        <tr>
          <td class="cell01"><div class="pd-left10"><strong>DATA SET</strong></div></td>
          <td class="cell01"><div class="pd-left10">INPUT</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">書き込みデータの変更／確定を切り替える<br />Switch between change write data and determine write data.</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">『LOW』レベルで "データ変更可能"<br />"LOW" level "can change the data"</div></td>
        </tr>
        <tr>
          <td width="192"><div class="pd-left10"><strong>ALARM</strong></div></td>
          <td width="112"><div class="pd-left10">OUTPUT</div></td>
          <td><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">電源異常発生時に信号を出力する<br />Outputs a signal in the event of power failure.</div></td>
          <td width="307"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">オープンコレクタ信号異常時『LOW』信号出力<br />Open collector signal. <br />Abnormal "LOW" signal output.<br />
          </div></td>
        </tr>
        <tr>
          <td class="cell01"><div class="pd-left10"><strong>COMMON</strong></div></td>
          <td class="cell01"><div class="pd-left10">―</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">各信号共通のGND<br />Common GND signals.</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">―</div></td>
        </tr>
        </table>
      </div>
      <p class="mg-top7">※チャンネル指定については、各点灯電源の取扱説明書をご覧下さい。<br />※Please read the operation manual of a lighting power supply about channel specification. </p>
      
      <p class="mg-top35"><strong>〈 ストロボ電源LFAだけの機能 〉〈 The function of only the LFA 〉</strong></p>
      
      <div class="tablebg01 mg-top6">
       <table width="898" border="0" cellspacing="1" cellpadding="6">
        <tr>
          <td width="180"><div class="pd-left5">Pin Detail</div></td>
          <td width="100"><div class="pd-left5">I/O</div></td>
          <td width="270"><div class="pd-left5">Function</div></td>
          <td width="295"><div class="pd-left5">Specification<br />
          </div></td>
          </tr>
        </table>
      </div>
      
      <div class="tablebg02">
       <table width="898" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td rowspan="2" class="cell01"><div class="pd-left10"><strong>DIG. Bit</strong></div></td>
          <td rowspan="2" class="cell01"><div class="pd-left10">INPUT</div></td>
          <td width="282"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">DIGITAL信号を入力して調光する<br />Dimming and DIGITAL signal is input.</div></td>
          <td><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">0-5V入力で調光0-100%可変<br />Adjustable from 0-100% dimming 0-5V input.</div></td>
        </tr>
        <tr>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">DIGITAL信号を入力して点灯時間を可変する<br />Time varying input signal and lighting DIGITAL.<br />
          </div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">『LOW』レベルで "点灯時間UP"<br />"LOW" level "UP lighting time"</div></td>
        </tr>
        <tr>
          <td width="192"><div class="pd-left10"><strong>LIGHTING TIME</strong></div></td>
          <td width="112"><div class="pd-left10">INPUT</div></td>
          <td><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">ストロボ点灯時間の設定を可能にする<br />Set time to enable strobe lights.</div></td>
          <td width="307"><div class="pd-left10">『LOW』レベルで "設定可能"<br />"LOW" level "can be set"</div></td>
        </tr>
        <tr>
          <td class="cell01"><div class="pd-left10"><strong>TRIGGER SIGNAL</strong></div></td>
          <td class="cell01"><div class="pd-left10">INPUT</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">ストロボ用のTRIGGER信号を入力する<br />TRIGGER signal input for flash.</div></td>
          <td class="cell01"><div class="pd-left10 pd-right10 pd-top5 pd-bottom5">TRIGGER信号を入力することで点灯<br />By entering the TRIGGER signal lights.</div></td>
        </tr>
        </table>
      </div>
     
    </div>
    
    <div class="clearfix mg-top35">
     <div class="left pd-left132"><a href="index.php"><img src="images/btn01_off.gif" alt="LED素子の特性について" width="232" height="67" /></a></div>
     <div class="left"><a href="index2.php"><img src="images/btn02_off.gif" alt="点灯電源の調光について" width="230" height="67" /></a></div>
     <div class="left"><img src="images/btn03.gif" alt="点灯電源の選定・I/O回路の機能説明" width="233" height="67" /></div>
    </div>
    
   </div>
   <!-- /box03 -->
    
   </div>
   <!-- contents_box end -->
   
   <!-- footer_box start -->
   <div id="footer_box">
   
    <div id="footer" class="clearfix">
     <div class="left wd-700">
      <p><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><strong><a href="../../index.php">ホーム</a></strong></p>
      <p class="f_space01"><img src="../../common/images/ico02.gif" width="6" height="12" class="icotext-middle pd-right5" /><strong><a href="../../products/led/index.php">画像処理用LED 照明</a></strong></p>
      
      <div class="clearfix">
       <div class="left f_space02">
        <ul>
         <li><a href="../../products/led/kdpl/index.php">パワーライン照明</a></li>
         <li><a href="../../products/led/kddb2/index.php">バー型照明</a></li>
         <li><a href="../../products/led/kddb2_q/index.php">４方向バー型照明</a></li>
         <li><a href="../../products/led/kddl3/index.php">反射集光型ライン照明</a></li>
         <li><a href="../../products/led/kddr_p/index.php">パワーダイレクトリング照明</a></li>
         <li><a href="../../products/led/kddr2/index.php">ダイレクトリング照明</a></li>
         <li><a href="../../products/led/kddr2_la/index.php">ローアングルリング照明</a></li>
         <li><a href="../../products/led/kdfv2/index.php">擬似同軸落射照明</a></li>
         <li><a href="../../products/led/kddd2/index.php">ドーム照明</a></li>
        </ul>
       </div>
       <div class="left f_space02">
        <ul>
         <li><a href="../../products/led/kdhm2/index.php">フラット面照明</a></li>
         <li><a href="../../products/led/kdfl2/index.php">導光型面照明</a></li>
         <li><a href="../../products/led/pl_plh2_plh3/index.php">マクロ同軸照明</a></li>
         <li><a href="../../products/led/pls2_pls3_plsf/index.php">スポット照明</a></li>
         <li><a href="../../products/led/lfm-15w/index.php">ファイバー引き出し型照明</a></li>
         <li><a href="../../products/led/luv/index.php">UV スポット照明</a></li>
         <li><a href="../../products/led/kduv-l/index.php">UV ライン照明</a></li>
         <li><a href="../../products/led/ir/index.php">IR 照明</a></li>
         <li><a href="../../products/led/uv/index.php">UV 照明</a></li>
        </ul>
       </div>
       <div class="left f_space02 f_space15">
        <ul>
         <li><a href="../../products/led/r_box/index.php">抵抗BOX</a></li>
         <li><a href="../../products/led/lek/index.php">PWM 制御点灯電源</a></li>
         <li><a href="../../products/led/lda/index.php">定電流制御点灯電源</a></li>
         <li><a href="../../products/led/lfa/index.php">ストロボ制御点灯電源</a></li>
         <li><a href="../../products/led/lla/index.php">高出力型定電流制御点灯電源</a></li>
         <li><a href="../../products/led/leb_lec/index.php">LED 照明用点灯電源</a></li>
         <li><a href="../../products/led/lei_lee/index.php">生産中止予定品</a></li>
        </ul>
       </div>
       <div class="left f_space15">
        <ul>
         <li><a href="../../products/led/cable/index.php">照明用延長ケーブル</a></li>
         <li><a href="../../products/led/plate/index.php">拡散板</a></li>
         <li><a href="../../products/led/plate02/index.php">偏光板</a></li>
         <li><a href="../../products/led/laser/index.php">レーザークラスについて</a></li>
        </ul>
       </div>
      </div>
      
      <div class="f_space03"><img src="../../common/images/f_line.gif" width="700" height="1" /></div>
      <p class="f_space04"><img src="../../common/images/ico03.gif" width="6" height="12" class="icotext-middle pd-right5" /><strong><a href="../../products/fluorescent/index.php">画像処理用蛍光灯照明</a></strong></p>
      
      <div class="clearfix">
       <div class="left f_space02">
        <ul>
         <li><a href="../../products/fluorescent/lst/index.php">蛍光灯灯具（LST）</a></li>
         <li><a href="../../products/fluorescent/lsts/index.php">蛍光灯灯具（LSTS）</a></li>
         <li><a href="../../products/fluorescent/ulst/index.php">蛍光灯灯具（ULST）</a></li>
         <li><a href="../../products/fluorescent/hlst/index.php">蛍光灯灯具（HLST）</a></li>
        </ul>
       </div>
       <div class="left f_space02">
        <ul>
         <li><a href="../../products/fluorescent/fp/index.php">フラット面照明</a></li>
         <li><a href="../../products/fluorescent/lsj/index.php">高周波蛍光灯点灯電源（LSJ）</a></li>
         <li><a href="../../products/fluorescent/lsh/index.php">高周波蛍光灯点灯電源（LSH）</a></li>
         <li><a href="../../products/fluorescent/lsfc/index.php">高周波蛍光灯点灯電源（LSFC）</a></li>
        </ul>
       </div>
       <div class="left f_space02">
        <ul>
         <li><a href="../../products/fluorescent/lsf/index.php">高周波蛍光灯点灯電源（LSF）</a></li>
         <li><a href="../../products/fluorescent/lsc/index.php">高周波蛍光灯点灯電源（LSC）</a></li>
         <li><a href="../../products/fluorescent/lsc_da1/index.php">８bit D/A 変換装置</a></li>
         <li><a href="../../products/fluorescent/lsc_sn1/index.php">光量一定制御用センサーボード</a></li>
        </ul>
       </div>
       <div class="left">
        <ul>
         <li><a href="../../products/fluorescent/cable/index.php">ケーブル</a></li>
        </ul>
       </div>
      </div>
      
      <div class="f_space03"><img src="../../common/images/f_line.gif" width="700" height="1" /></div>
      <p class="f_space04"><img src="../../common/images/ico04.gif" width="6" height="12" class="icotext-middle pd-right5" /><strong><a href="../../products/xenon/index.php">キセノン管ストロボ装置</a></strong></p>
      
      <div class="clearfix">
       <div class="left f_space05">
        <ul>
         <li><a href="../../products/xenon/kfs_10_15f1/index.php">10・15W ビルトインタイプ</a></li>
         <li><a href="../../products/xenon/kfs_30f1/index.php">30W ビルトインタイプ</a></li>
        </ul>
       </div>
       <div class="left f_space05">
        <ul>
         <li><a href="../../products/xenon/kfs_60f1/index.php">60W ビルトインタイプ</a></li>
         <li><a href="../../products/xenon/kfs_l/index.php">セパレートタイプ</a></li>
        </ul>
       </div>
       <div class="left f_space05">
        <ul>
         <li class="f_space14"><a href="../../products/xenon/kfs/index.php">セパレートタイプ ランプハウス</a></li>
        </ul>
       </div>
       <div class="left">
        <ul>
         <li><a href="../../products/xenon/flashlamp/index.php">キセノンフラッシュランプ</a></li>
         <li><a href="../../products/xenon/cable/index.php">ケーブル</a></li>
        </ul>
       </div>
      </div>
      
     </div>
     <div class="right wd-240 mg-top30">
     
      <p class="f_space07 mg-left18"><img src="../../common/images/ico02.gif" width="6" height="12" class="icotext-middle pd-right5" /><strong><a href="index.php">LED技術資料</a></strong></p>
      
      <div class="f_space08 mg-left18">
       <ul>
        <li><a href="index.php">LED素子の特性について</a></li>
        <li><a href="index2.php">点灯電源の調光について</a></li>
        <li><a href="index3.php">点灯電源の選定・I/O回路の機能説明</a></li>
       </ul>
      </div>
      
      <p class="f_space09 mg-left18"><img src="../../common/images/ico03.gif" width="6" height="12" class="icotext-middle pd-right5" /><strong><a href="../fluorescent/index.php">蛍光灯技術資料</a></strong></p>
      
      <p class="f_space10 mg-left18"><img src="../../common/images/ico04.gif" width="6" height="12" class="icotext-middle pd-right5" /><strong><a href="../xenon/index.php">キセノンストロボ技術資料</a></strong></p>
      
      <div class="f_space11 mg-left18">
       <ul>
        <li><a href="../xenon/index.php">制御信号について</a></li>
        <li><a href="../xenon/index2.php">用語説明</a></li>
       </ul>
      </div>
      
      <div><img src="../../common/images/f_line02.gif" width="240" height="1" /></div>
      
      <div class="f_space12 mg-left18">
       <ul class="ful">
        <li><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="../../download/index.php">各種データダウンロード</a></li>
        <li><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="<?this_root_url_member?>">ログイン／会員登録</a></li>
        <li><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="../../information/index.php">インフォメーション</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="../../equipment/index.php">設備・サポート</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="../../products/custom/index.php">カスタム照明</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="../../products/stop/index.php">生産中止製品について</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="<?this_root_url_contact?>">お問い合わせ</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="<?this_root_url_opt_sample?>">サンプル機貸し出し依頼</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="../../sitemap/index.php">サイトマップ</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="http://www.kdn.co.jp/privacy/index.html">プライバシーポリシー</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="http://www.kdn.co.jp/corporate/index.html">企業情報</a></li>
        <li class="f_space13"><img src="../../common/images/ico01.gif" width="7" height="7" class="pd-right5" /><a href="https://commerce.kdn.co.jp/webedi/member/members.php" target="_blank">WEB EDI</a><img src="../../common/images/ico05.gif" width="11" height="10" class="pd-left5" /></li>
       </ul>
      </div>
      
     </div>

    </div>
         <p id="pagetop"><a href="#wrapper"><img src="../../common/images/pagetop.png" alt="TOP↑" width="33" height="38" class="png" /></a></p>
    
    <div class="copyright">Copyright &copy; 2013 Kyoto Denkiki Co.,Ltd. All Rights Reserved.</div>
    
   </div>
   <!-- footer_box end -->
 
 </div>
 <!-- wrapper end -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-43913094-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">document.write(unescape("%3Cscript src='" + document.location.protocol + "//log.bb-analytics.jp/analyze.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">analyze2('WDtaQdG5EDvnCj8PyMDcAnpFByug76ib');</script>

</body>
</html>
