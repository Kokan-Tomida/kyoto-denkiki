  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a5100.php">基本情報管理</a></div>
   
   <form method="post" action="a5100.php" name="frm">
   <div class="mg-top13">管理者ログイン用パスワード</div><div><?validate_msg1?></div>
   <div id="search_box03" class="clearfix">
    <div class="left text01 pd-top42">変更後パスワード</div>
    <div class="left pd-top35 pd-left14"><input class="txt01" type="password" name="admin_password" value=""></div>
    <div class="left pd-top33 pd-left37"><input type="button" name="to_edit1" value=" " class="henkou02_btn" onclick="changeMode('edit1');" /></div>
    <div class="left pd-top42 pd-left37 text01">パスワード 最終更新日　<?pwd_modified?></div>
   </div>
   
   <div class="mg-top18">管理者用メールアドレス</div><div><?validate_msg2?></div>
   <div id="search_box03" class="clearfix">
    <div class="left text01 pd-top42">メールアドレス</div>
    <div class="left pd-top35 pd-left14"><input class="txt01" type="text" name="admin_mail" value="<?admin_mail?>"></div>
    <div class="left pd-top33 pd-left37"><input type="button" name="to_edit2" value=" " class="henkou02_btn" onclick="changeMode('edit2');" /></div>
   </div>

	<input type="hidden" name="mode">
    </form>
  
  </div>
  <!-- contents_box end -->
