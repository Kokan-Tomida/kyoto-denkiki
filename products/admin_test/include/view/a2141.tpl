  <script type="text/javascript">
  <!--
  window.onload = function(){ window.scroll(<?x?>,<?y?>); }
  //-->
  </script>
  
  <!-- contents_box start -->
  <div id="contents_box">

    <div id="pankuzu"><a href="a2100.php">製品情報管理一覧</a> &gt; 表示順変更</div>

    <form method="post" action="a2141.php" name="frm">
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
      <div class="clearfix">
        <div class="left text01 pd-top27">中カテゴリー</div>
        <div class="left pd-top20 pd-left14">
            <select class="cyuu" name="middle_category_id" id="middle_category_id" onchange="frm.submit()">
            <option value=""> ---------- </option>
            <?option_middle_category_id?>
            </select>
        </div>
 
        <div class="left pd-top17 pd-left111"><!--<input type="submit" name="to_choice" value=" " class="choose_btn" onclick="return chk_category2();" />--></div>
     </div>

    </div>

    <p class="mg-top10"><?search_result?></p>
        
    <div class="tbbg01 mg-top20" id="numbering">
      <table width="960" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <th width="54">表示順</th>
        <th width="729" class="txtleft pd-left10">製品名</th>
        <th width="173">表示順変更</th>
      </tr>
      <?list?>
      </table>
    </div>

   <input type="hidden" name="sel_middle_category_id" value="<?sel_middle_category_id?>">
   <input type="hidden" name="x" id="x">
   <input type="hidden" name="y" id="y">
   <input type="hidden" name="mode">
   <input type="hidden" name="top_category_name" value="<?top_category_name?>">
   </form>

  </div>
  <!-- contents_box end -->
