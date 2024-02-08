  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a3100.php">会員情報管理 一覧</a> &gt; 新規登録</div>
   
    <form method="post" action="a3111.php" name="frm" >
    
    <div id="search_box02">
 
    <div class="clearfix pd-top20">
      <div class="left text01_120 pd-top8">法人名</div>
      <div class="left pd-left10">
        <input class="lo01" type="text" name="company_name" value="<?company_name?>"></div>
    </div>

    <div class="clearfix mg-top15">
      <div class="left text01_120 pd-top8">
        郵便番号
      </div>
      <div class="left pd-left10">
        <input class="lo01_nowidth" type="text" name="zip1" value="<?zip1?>" size="8" maxlength="3" <?ime_style?>> - <input class="lo01_nowidth" type="text" name="zip2" size="12" maxlength="4" value="<?zip2?>" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','address1');">
      </div>
    </div>

    <div class="clearfix mg-top15">
      <div class="left text01_120 pd-top8">都道府県</div>
      <div class="left pd-left10">
        <select class="dai_nowidth" name="pref" >
        <option value=""> ----- 選択 ----- </option>
        <?option_pref?>
        </select>
      </div>
    </div>
    
    <div class="clearfix mg-top20">
      <div class="left text01_120 pd-top8">住所1</div>
      <div class="left pd-left10">
        <input class="lo01" type="text" name="address1" value="<?address1?>" />
      </div>
    </div>

    <div class="clearfix mg-top20">
      <div class="left text01_120 pd-top8">住所2（建物名）</div>
      <div class="left pd-left10">
        <input class="lo01" type="text" name="address2" value="<?address2?>" />
      </div>
    </div>

    <div class="clearfix mg-top20">
     <div class="left text01_120 pd-top8">電話番号</div>
     <div class="left pd-left10">
       <input class="lo01_nowidth" type="text" name="telno" value="<?telno?>" maxlength="20" size="30" <?ime_style?> />
     </div>
    </div>
    
    <div class="clearfix mg-top20">
     <div class="left text01_120 pd-top8">FAX番号</div>
     <div class="left pd-left10">
       <input class="lo01_nowidth" type="text" name="faxno" value="<?faxno?>" maxlength="20" size="30" <?ime_style?> />
     </div>
    </div>
    
    <div class="clearfix mg-top20">
     <div class="left text01_120 pd-top8">担当部署</div>
     <div class="left pd-left10">
       <input class="lo01" type="text" name="section" value="<?section?>" />
     </div>
    </div>
    
    <div class="clearfix mg-top15">
     <div class="left text01_120 pd-top8">ご担当者名</div>
     <div class="left pd-left10">
       <input class="lo01" type="text" name="charge_name" value="<?charge_name?>" />
     </div>
    </div>
    
    <div class="clearfix mg-top15">
     <div class="left text01_120 pd-top8">メールアドレス</div>
     <div class="left pd-left10">
       <input class="lo01_nowidth" type="text" name="email_address" value="<?email_address?>" size="60" <?ime_style?>>
     </div>
    </div>
    
    <div class="clearfix mg-top15">
     <div class="left text01_120 pd-top8">パスワード</div>
     <div class="left pd-left10">
       <input class="lo01_nowidth" type="text" name="member_pwd" size="20" maxlength="10" value="<?member_pwd?>"  <?ime_style?>>
     </div>
     <div class="left pd-top7 pd-left6">※8桁の半角英数字</div>
    </div>

    <div class="clearfix mg-top15">
     <div class="left text01_120 pd-top8">備考</div>
     <div class="left pd-left10">
       <textarea class="lo01_nowidth" name="note" rows="4" cols="70"><?note?></textarea>
     </div>
    </div>

    <div class="mg-top18"><?validate_msg?></div>
    <div class="mg-top18 pd-left130"><input type="submit" name="to_regist" value=" " class="regist_btn" onclick="changeModeMsg('regist','登録します.よろしいですか？');" /></div>

    </div>
    <input type="hidden" name="mode" value="">
   </form>
  
  </div>
  <!-- contents_box end -->
