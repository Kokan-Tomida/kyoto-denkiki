  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a2100.php">製品情報管理一覧</a> &gt; 新規登録</div>
   
   <form method="post" action="a2111.php" name="frm" enctype="multipart/form-data">
   <div id="search_box02">
   
    <div class="clearfix">
    <div class="left text01 pd-top42">大カテゴリー</div>
    <div class="left pd-top35 pd-left14">
     <select class="dai" name="large_category_id" onchange="frm.submit();">
     <option value=""> ---------- </option>
     <?option_large_category_id?>
     </select>
     </div>
    <div class="left text01 pd-top42 pd-left30" id="top_category" ><?top_category_name?></div>
    </div>
    
    <div class="clearfix mg-top20">
     <div class="left text01 pd-top8">中カテゴリ名</div>
     <div class="left pd-left14">
     <select class="cyuu" name="middle_category_id" id="middle_category_id">
     <option value=""> ---------- </option>
     <?option_middle_category_id?>
     </select>
     </div>
    </div>
    
    <div class="clearfix mg-top20">
     <div class="left text01 pd-top8">製品名</div>
     <div class="left pd-left56">
     <input class="lo01" type="text" name="products_name" value="<?products_name?>"></div>
    </div>
    
    <div class="mg-top18">
     <div class="text01 pd-top6">1 外形図PDF</div>
     <div class="pd-left15">
     <input type="file" size="30" class="pdf"  name="contents10" /></div>
    </div>
    
    <div>
     <div class="text01 pd-top6">　外形図DXF</div>
     <div class="pd-left15"><input type="file" size="30" class="pdf"  name="contents11" /></div>
    </div>
    
    <div class="mg-top11">
     <div class="text01 pd-top6">2 仕様書PDF</div>
     <div class="pd-left15"><input type="file" size="30" class="pdf"  name="contents20" /></div>
    </div>
    
    <div class="mg-top11">
     <div class="text01 pd-top6">3 取扱説明書PDF</div>
     <div class="pd-left15"><input type="file" size="30" class="pdf"  name="contents30" /></div>
    </div>
    
    <div class="mg-top11">
     <div class="text01 pd-top6">4 その他PDF</div>
     <div class="pd-left15"><input type="file" size="30" class="pdf"  name="contents40" /></div>
    </div>
    
    <div class="mg-top18"><?validate_msg?></div>
    <div class="mg-top18 pd-left96"><input type="submit" name="to_addnew" value=" " class="regist_btn" onclick="changeModeMsg('addnew','登録してよろしいですか？');" /></div>
    
   </div>
   
   <input type="hidden" name="contents10_status" value="<?contants10_status?>">
   <input type="hidden" name="contents11_status" value="<?contants11_status?>">
   <input type="hidden" name="contents20_status" value="<?contants20_status?>">
   <input type="hidden" name="contents30_status" value="<?contants30_status?>">
   <input type="hidden" name="contents40_status" value="<?contants40_status?>">
   <input type="hidden" name="top_category_name" value="<?top_category_name?>">
   <input type="hidden" name="mode">
   </form>
  
  </div>
  <!-- contents_box end -->

