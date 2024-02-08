  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a3100.php">会員情報管理一覧</a> &gt; 履歴照会</div>
   
   <div id="search_box02">
   
   <div class="clearfix">
    <div class="left text01 pd-top20">登録日:　<span class="l_text"><?this_registration?></span></div>
    <div class="left text01 pd-top20 pd-left40">法人名:　<span class="l_text"><?company_name?></span></div>
    <div class="left text01 pd-top20 pd-left40">ご担当者名:　<span class="l_text"><?charge_name?></span></div>
    </div>
   
   <div class="clearfix">
    <div class="left text01 pd-top10">メールアドレス:　<span class="l_text"><?email_address?></span></div>
    <div class="left text01 pd-top10 pd-left40">電話番号:　<span class="l_text"><?telno?></span></div>
    </div>

    <div class="clearfix">
      <div class="left text01 pd-top10">管理備考:</div>
      <div class="left text01 pd-top10 wd-860 pd-left15"><span class="l_text"><?admin_note?></span></div>
    </div>
    
   </div>
   
   <form name="frm" action="a3130.php" method="post">
   <div class="clearfix mg-top20">
   <div class="left btn01<?btn0?>"><a href="a3130.php?target=<?target?>">全て</a></div>
   <div class="left btn01<?btn1?>"><a href="a3130.php?type=sample&target=<?target?>">貸出履歴</a></div>
   <div class="left btn01<?btn2?>"><a href="a3130.php?type=inquiry&target=<?target?>">問い合わせ履歴</a></div>
   <div class="left btn01<?btn3?>"><a href="a3130.php?type=login&target=<?target?>">ログイン履歴</a></div>
   <div class="left btn01<?btn4?>"><a href="a3130.php?type=download&target=<?target?>">ダウンロード履歴</a></div>
   <div class="right"><input type="submit" name="to_csv" value=" " class="csv_btn" /></div>
   </div>
   <div class="mg-top10">
   <?search_result?>
   </div>
   <!-- pagenavibox start -->
   <div id="pagenavibox" class="mg-top10 mg-bottom10">
    <ul>
    <?pagenavi?>
    </ul>
   </div>
   <!-- pagenavibox end -->
   
   <div class="tbbg01">
    <table width="960" border="0" cellspacing="1" cellpadding="10">
       <?list?>
     </table>
   </div>
   
   <!-- pagenavibox start -->
   <div id="pagenavibox" class="mg-top10">
    <ul>
    <?pagenavi?>
    </ul>
   </div>
   <!-- pagenavibox end -->

     <input type="hidden" name="mode">
     <input type="hidden" name="type" value="<?type?>">
     <input type="hidden" name="target" value="<?target?>">
     <input type="hidden" name="pageno" value="<?pageno?>">
     </form>
  
  </div>
  <!-- contents_box end -->
