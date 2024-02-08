  <div id="pankuzu"><a href="index.php">ログイン／会員登録</a> &gt; 会員登録のご確認</div>
  <!-- contents_box start -->
  <div id="contents_box">
    <h2 class="mg-top11 mg-bottom23"><img src="images/titlebar03.gif" alt="会員登録のご確認" width="960" height="42" /></h2>
    
    <p class="sample_text02 txtcenter pd-top6">入力内容に間違いが無ければ、送信ボタンを押してください。</p>
    
    <form method="post" name="frm" id="frm" action="addnew_confirm.php">
      <div class="sample_box">
        <div><img src="images/f_inner_top.png" width="926" height="31" class="png" /></div>
        <div class="sample_inner_box">
          <div class="pd-left32 pd-right34 wd-860">
            <table width="860" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="215">個人情報保護方針</th>
                <td width="610"><?privacy?></td>
              </tr>
              <tr>
                <th width="215">御社名</th>
                <td width="610"><?company_name?></td>
              </tr>
              <tr>
                <th>郵便番号 <span class="sample_text01">半角数字</span></th>
                <td><?zipno?></td>
              </tr>
              <tr>
                <th>都道府県</th>
                <td><?pref?></td>
              </tr>
              <tr>
                <th>ご住所</th>
                <td><?address1?></td>
              </tr>
              <tr>
                <th>TEL <span class="sample_text01">半角数字</span></th>
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
                <th>ご担当者名</th>
                <td><?charge_name?></td>
              </tr>
              <tr>
                <th>メールアドレス <span class="sample_text01">半角数字</span></th>
                <td><?email_address?></td>
              </tr>
              <tr>
                <th>備考</th>
                <td><?note_view?></td>
              </tr>
            </table>

          </div>
        </div>
        <div><img src="images/f_inner_bottom.png" width="926" height="39" class="png" /></div>
        
<div class="mg-left339 pd-top25 pd-bottom33">
<input type="button" name="back" id="back" value=" " onclick="history.back()" class="back_btn" />
</div>
        
      </div>
    </form>
  </div>
  <!-- contents_box end -->
