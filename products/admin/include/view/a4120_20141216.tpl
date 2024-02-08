  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a4100.php">履歴情報管理</a></div>
   
   <div class="clearfix mg-top16 pd-bottom9">
   <div class="left btn01"><a href="a4100.php">全て</a></div>
   <div class="left btn01"><a href="a4110.php">貸出履歴</a></div>
   <div class="left btn01_on"><a href="a4120.php">問い合わせ履歴</a></div>
   <div class="left btn01"><a href="a4130.php">ログイン履歴</a></div>
   <div class="left btn01"><a href="a4140.php">ダウンロード履歴</a></div>
   </div>
   
   <div id="search_box02">
   <form method="post" action="a4120.php" name="frm" onKeyPress="setOnEnterClickButton('to_search','frm');">
    <div class="text01 pd-top42">
    期間
    <input type="text" name="start_date" id="from" class="txt01" value="<?start_date?>">
    　から　
    <input type="text" name="end_date" id="to" class="txt01" value="<?end_date?>">
   　　<?radio_member?>
   </div>
   
   <div class="clearfix">
    <div class="left text01 pd-top20">法人名 <input class="txt01" type="text" name="company_name" value="<?company_name?>"></div>
    <div class="left text01 pd-top24 pd-left20">都道府県
    <select name="pref">
    <option value=""> ---- 都道府県 ---- </option>
    <?option_pref?>
    </select>
    </div>
    <div class="right pd-top15 pd-left14 pd-right20"><input type="submit" name="to_clear" value=" " class="clear_btn" /></div>
    <div class="right pd-top15"><input type="submit" name="to_search" id="to_search" value=" " class="search_btn" /></div>
    </div>

    </div>
   
   <div class="clearfix mg-top20">
   <div class="right"><input type="submit" name="to_csv" value=" " class="csv_btn" /></div>
   </div>
   <?search_result?>
   <!-- pagenavibox start -->
   <div id="pagenavibox" class="mg-top6 mg-bottom10">
    <ul>
   <?pagenavi?>
	</ul>
	</div>
   <!-- pagenavibox end -->
   
   <div class="tbbg01">
    <table width="960" border="0" cellspacing="1" cellpadding="10">
     <tr>
       <th width="30">No</th>
       <th width="120" class="txtleft">問合せ日</th>
       <th width="183" class="txtleft">法人名</th>
       <th width="120" class="txtleft">ご担当者名</th>
       <th width="120" class="txtleft">電話番号</th>
       <th width="260" class="txtleft">問合せ種別</th>
       </tr>
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
  
    <input type="hidden" name="pageno" value-"<?pageno?>">
	<input type="hidden" name="mode"> 
	</form>
 
  </div>
  <!-- contents_box end -->
