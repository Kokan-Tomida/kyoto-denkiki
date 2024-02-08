  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a1100.php">製品中カテゴリ管理 一覧</a> &gt; 編集</div>
   
   <form method="post" action="a1121.php" name="frm" enctype="multipart/form-data">
   <div id="search_box02">
   
    <div class="clearfix">
    <div class="left text01 pd-top42">大カテゴリー</div>
    <div class="left pd-top35 pd-left14">
     <select class="dai" name="large_category_id" onchange="getTopCategory(this);">
     <option value=""> ---------- </option>
     <?option_large_category_id?>
     </select>
    </div>
    <div class="left text01 pd-top42 pd-left30" id="top_category"><?top_category_name?></div>
    </div>
    
    <div class="clearfix mg-top20">
     <div class="left text01 pd-top8">中カテゴリ名</div>
     <div class="left pd-left14"><input class="lo01" type="text" name="middle_category_name" value="<?middle_category_name?>"></div>
    </div>
    
    <div class="clearfix mg-top20">
     <div class="left text01 pd-top8">シリーズ名</div>
     <div class="left pd-left28"><input class="lo01" type="text" name="series_name" value="<?series_name?>"></div>
    </div>
    
    <div class="clearfix mg-top18">
     <div class="left text01 pd-top6">画像</div>
     <div class="left pd-left70"><input type="file" size="30" maxlength="30" class="gazo" name="image_path" /></div>　<div><?image_path_status?></div>
    </div>
    <div class="pd-left96">70×70pix JPEG</div>
       
    <div class="mg-top18"><?validate_msg?></div>
    <div class="mg-top18 pd-left96"><input type="submit" name="to_edit" value=" " class="regist_btn" onclick="changeModeMsg('edit','更新します.よろしいですか？');" /></div>
    
   </div>
    <input type="hidden" name="top_category" value="<?top_category_type?>">
    <input type="hidden" name="order_of_row" value="<?order_of_row?>">
    <input type="hidden" name="target" value="<?target?>">
    <input type="hidden" name="mode" value="">
   </form>
  
  </div>
  <!-- contents_box end -->
