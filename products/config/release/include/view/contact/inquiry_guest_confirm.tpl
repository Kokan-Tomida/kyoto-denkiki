  <div id="pankuzu"><a href="index.php">お問い合わせ</a> &gt; お問い合わせフォーム 確認</div>
  <!-- contents_box start -->
  <div id="contents_box">
    <h2 class="mg-top11 mg-bottom23"><img src="images/titlebar.gif" alt="お問い合わせ" width="960" height="42" /></h2>
    
    <p class="sample_text02 txtcenter pd-top6">入力内容に間違いが無ければ、送信ボタンを押してください。</p>
    
    <form method="post" name="frm" id="frm" action="inquiry_guest_confirm.php">
      <div class="sample_box">
        <div><img src="images/f_inner_top.png" width="926" height="31" class="png" /></div>
        <div class="sample_inner_box">
          <div class="pd-left32 pd-right34 wd-860">
            <table width="860" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="215">御社名 <span class="fs_crimson">※</span></th>
                <td width="610"><?company_name?></td>
              </tr>
              <tr>
                <th>郵便番号 <span class="sample_text01">半角数字</span> <span class="fs_crimson">※</span></th>
                <td><?zip?></td>
              </tr>
              <tr>
                <th>都道府県 <span class="fs_crimson">※</span></th>
                <td><?pref_name?></td>
              </tr>
              <tr>
                <th>ご住所 <span class="fs_crimson">※</span></th>
                <td><?address1?></td>
              </tr>
              <tr>
                <th>TEL <span class="sample_text01">半角数字</span> <span class="fs_crimson">※</span></th>
                <td><?telno?></td>
              </tr>
              <tr>
                <th>FAX <span class="sample_text01">半角数字</span></th>
                <td><?faxno?></td>
              </tr>
              <tr>
                <th>担当部署</th>
                <td><?section?></td>
              </tr>
              <tr>
                <th>ご担当者名 <span class="fs_crimson">※</span></th>
                <td><?charge_name?></td>
              </tr>
              <tr>
                <th>メールアドレス <span class="sample_text01">半角数字</span> <span class="fs_crimson">※</span></th>
                <td><?email_address?></td>
              </tr>
              <tr>
                <th>お問い合わせ種別 <span class="fs_crimson">※</span></th>
                <td><?inquiry_select_view?><br /><?inquiry_check_view?></td>
              </tr>
              <tr>
                <th>お問い合わせ内容 <span class="fs_crimson">※</span></th>
                <td><?inquiry_note_view?></td>
              </tr>
            </table>

          </div>
        </div>
        <div><img src="images/f_inner_bottom.png" width="926" height="39" class="png" /></div>
        </div>
        <div class="clearfix mg-left264 pd-top25 pd-bottom33">
<div class="left"><input type="submit" name="to_complete" id="submit" value="" class="submit_btn" /></div>
<div class="left"><input type="submit" name="to_return" id="back" value="" class="back_btn" /></div>
      </div>
    </form>
  </div>
  <!-- contents_box end -->
