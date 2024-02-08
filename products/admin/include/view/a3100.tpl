  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a3100.php">会員情報管理一覧</a></div>
   
  <div id="search_box02">
    <form method="post" action="a3100.php" name="frm" onKeyPress="setOnEnterClickButton('to_search','frm');">

    <div class="clearfix">
      <div class="left text01 pd-top25">
        登録日
        <input type="text" name="this_registration" class="txt01" id="datepicker" value="<?this_registration?>" maxlength="10" <?ime_style?> />
      </div>
      <div class="left text01 pd-top25 pd-left20">
        法人名
        <input class="txt01" type="text" name="company_name" maxlength="200" value="<?company_name?>" />
      </div>
      <div class="left text01 pd-top25 pd-left20">
        ご担当者名
        <input class="txt01" type="text" name="charge_name" maxlength="50" value="<?charge_name?>">
      </div>
    </div>
   
    <div class="clearfix">
      <div class="left text01 pd-top15">
        メールアドレス
        <input class="txt01" type="text" name="email_address" size="180" maxlength="200" value="<?email_address?>" <?ime_style?> />
      </div>
      <div class="left text01 pd-top20 pd-left20">
        都道府県
        <select name="pref">
        <option value=""> --- 都道府県 --- </option>
	    <?option_pref?>
        </select>
      </div>
      <div class="left text01 pd-top20 pd-left20">
        退会済みを含める
        <input type="checkbox" name="withdrawal" value="3" <?check_withdrawal?> />
      </div>
    </div>

    <div class="clearfix">
      <div class="right pd-top15 pd-left14 pd-right20">
        <input type="submit" name="to_clear" value=" " class="clear_btn"  />
      </div>
      <div class="right pd-top15">
        <input type="submit" name="to_search" id="to_search" value=" " class="search_btn"  />
      </div>
    </div>
    
  </div>
   
   <div class="clearfix mg-top30">
   <div class="left"><input type="submit" name="to_addnew" value=" " class="shinki_btn" onclick="changeMode('addnew');" />
    <p class="mg-top8"><?search_result?></p>
   </div> 
   <div class="right"><input type="submit" name="to_csv" value=" " class="csv_btn"  /></div>
   </div>
   
   <!-- pagenavibox start -->
   <div id="pagenavibox" class="mg-top10 mg-bottom10">
    <ul>
	<?pagenavi?>
    </ul>
   </div>
   <!-- pagenavibox end -->
   
   <div class="tbbg01">
    <table width="960" border="0" cellspacing="1" cellpadding="0">
     <tr>
       <th width="40">No</th>
       <th width="170" class="txtleft pd-left10">登録日</th>
       <th width="170" class="txtleft pd-left10">法人名/ご担当者名</th>
       <th width="140" class="txtleft pd-left10">電話番号</th>
       <th class="txtleft pd-left10" width="191">メールアドレス</th>
       <th width="80">&nbsp;</th>
       <th width="80">&nbsp;</th>
       <th width="80">&nbsp;</th>
       </tr>
        <?list?>
      </table>
    </div>
   
   <!-- pagenavibox start -->
   <div id="pagenavibox" class="mg-top20">
    <ul>
	<?pagenavi?>
    </ul>
   </div>
   <!-- pagenavibox end -->

	<input type="hidden" name="pageno">
	<input type="hidden" name="mode"> 
	</form>  
  </div>
  <!-- contents_box end -->
