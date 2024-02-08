  <script type="text/javascript">
  <!--
  window.onload = function(){ window.scroll(<?x?>,<?y?>); }
  //-->
  </script>  
  <!-- contents_box start -->
  <div id="contents_box">
  
   <div id="pankuzu"><a href="a1100.php">製品中カテゴリー管理一覧</a></div>
   
   <div id="search_box01" class="clearfix">
   <form method="post" action="a1100.php" name="frm">
    <div class="left text01 pd-top42">大カテゴリー</div>
    <div class="left pd-top35 pd-left14">
     <select class="dai" name="large_category_id" onchange="getTopCategory(this); frm.submit();">
     <option value=""> ---------- </option>
     <?option_large_category_id?>
     </select>
    </div>
    <div class="left text01 pd-top42 pd-left30" id="top_category"><?top_category_name?></div>
    <div class="right pd-top33 pd-left14 pd-right30"><input type="submit" name="to_clear" value=" " class="clear_btn" /></div>
    <div class="right pd-top33"><!--<input type="submit" name="to_search" value=" " class="search_btn" />--></div>
   </div>
   
   <div class="mg-top30"><input type="button" name="to_addnew" value=" " class="shinki_btn" onclick="changeMode('addnew');" /></div>
   <p class="mg-top8"><?search_result?></p>

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
       <th width="70">表示順</th>
       <th width="240">大カテゴリ</th>
       <th width="240">中カテゴリ</th>
       <th width="41">画像</th>
       <th width="173">変更</th>
       <th width="189">表示順変更</th>
     </tr>
     <?list?>
    </table>
   </div>
   
   <!-- pagenavibox start -->
   <div id="pagenavibox" class="mg-top10 mg-bottom15">
    <ul>
   <?pagenavi?>
	</ul>
	</div>
   <!-- pagenavibox end -->
  
   <input type="hidden" name="x">
   <input type="hidden" name="y">
   <input type="hidden" name="pageno" value="<?pageno?>">
    <input type="hidden" name="mode">
    </form>
  </div>
  <!-- contents_box end -->
