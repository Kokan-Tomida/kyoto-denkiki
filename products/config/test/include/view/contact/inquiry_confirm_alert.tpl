  <div id="pankuzu"><a href="index.php">お問い合わせ</a> &gt; お問い合わせフォーム 確認</div>
  <!-- contents_box start -->
  <div id="contents_box">
    <h2 class="mg-top11 mg-bottom23"><img src="images/titlebar.gif" alt="お問い合わせ" width="960" height="42" /></h2>
    
    <p class="sample_text02 txtcenter pd-top6">入力内容に間違いが無ければ、送信ボタンを押してください。</p>
    
    <form method="post" name="frm" id="frm" action="inquiry_confirm.php">
      <div class="sample_box">
        <div><img src="images/f_inner_top.png" width="926" height="31" class="png" /></div>
        <div class="sample_inner_box">
          <div class="pd-left32 pd-right34 wd-860">
            <table width="860" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="215">御社名</th>
                <td width="610"><?company_name?></td>
              </tr>
              <tr>
                <th>ご担当者名</th>
                <td><?charge_name?></td>
              </tr>
              <tr>
                <th>お問い合わせ種別</th>
                <td><?inquiry_select?><br /><?inquiry_check?></td>
              </tr>
              <tr>
                <th>お問い合わせ内容</th>
                <td><?inquiry_note?></td>
              </tr>
            </table>

          </div>
        </div>
        <div><img src="images/f_inner_bottom.png" width="926" height="39" class="png" /></div>
        </div>
        <input type="hidden" name="mode" value="CONFIRM_NEXT">
<div class="mg-left339 pd-top25 pd-bottom33">
<input type="button" name="back" id="back" value=" " onclick="history.back()" class="back_btn" />
</div>
      </div>
    </form>
  </div>
  <!-- contents_box end -->
