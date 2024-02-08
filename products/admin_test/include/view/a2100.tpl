  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a2100.php">製品情報管理</a></div>
   
   <div id="search_box02">
   <form method="post" action="a2100.php" name="frm" onKeyPress="setOnEnterClickButton('to_search','frm');">
   <div class="clearfix">
    <div class="left text01 pd-top42">大カテゴリー</div>
    <div class="left pd-top35 pd-left14">
     <select class="dai" name="large_category_id" onchange="change_large();">
     <option value=""> ---------- </option>
     <?option_large_category_id?>
     </select>
    </div>
    <div class="left text01 pd-top42 pd-left30" id="top_category"><?top_category_name?></div>
    </div>
   
   <div class="clearfix">
    <div class="left text01 pd-top27">中カテゴリー</div>
    <div class="left pd-top20 pd-left14">
     <select class="cyuu" name="middle_category_id" onchange="frm.submit();">
     <option value=""> ---------- </option>
     <?option_middle_category_id?>
     </select>
    </div>
    </div>

    <div class="clearfix">
    <div class="left text01 pd-top27">製品名</div>
    <div class="left pd-top20 pd-left56"><input class="lo01" type="text" name="products_name" value="<?products_name?>"></div>
    <div class="left pd-top17 pd-left111"><input type="submit" name="to_search" value=" " id="to_search" class="search_btn"  /></div>
    <div class="left pd-top17 pd-left14"><input type="submit" name="to_clear" value=" " class="clear_btn"  /></div>
    </div>
    
   </div>
   
   <div class="clearfix mg-top30">
   <div class="left">
   <div><input type="button" name="to_addnew" value=" " class="shinki_btn" onclick="changeMode('addnew');" /></div>
   <p class="mg-top8"><?search_result?></p>
   </div>
   
   <div class="right pd-left7"><input type="submit" name="to_csv" value=" " class="csv_btn" /></div>
   <div class="right"><input type="button" name="to_numbering" value=" " class="henkou_btn" onclick="changeMode('numbering');" /></div>
   </div>
   
   <!-- pagenavibox start -->
   <div id="pagenavibox" class="mg-top6 mg-bottom10">
    <ul>
    <?pagenavi?>
    </ul>
   </div>
   <!-- pagenavibox end -->
   
   <div class="tbbg01">
    <table width="960" border="0" cellspacing="1" cellpadding="0">
     <tr>
       <th width="50" rowspan="2">表示順</th>
       <th width="249" rowspan="2">大カテゴリ/中カテゴリ</th>
       <th width="200" rowspan="2" class="txtleft pd-left10">製品名</th>
       <th colspan="2">外形図</th>
       <th width="50">仕様書</th>
       <th width="80">取扱説明書</th>
       <th width="50">その他</th>
       <th width="80" rowspan="2">&nbsp;</th>
       <th width="80" rowspan="2">&nbsp;</th>
     </tr>
     <tr>
       <th width="50">PDF</th>
       <th width="50">DXF</th>
       <th width="80">PDF</th>
       <th width="50">PDF</th>
       <th width="50">PDF</th>
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

	<input type="hidden" name="sel_middle_category_id" value="<?sel_middle_category_id?>"> 
	<input type="hidden" name="pageno">
	<input type="hidden" name="mode"> 
    </form>
  
  </div>
  <!-- contents_box end -->

