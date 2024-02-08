  <div id="pankuzu"><a href="index.php">ログイン／会員登録</a> &gt; 会員登録フォーム</div>
  <!-- contents_box start -->
  <div id="contents_box">
    <h2 class="mg-top11"><img src="images/titlebar02.gif" alt="会員登録について" width="960" height="42" /></h2>

    <div class="pd-bottom17 pd-top20"><img src="images/text01.gif" alt="会員登録フォーム" width="133" height="16" /></div>
    <p>会員登録は、下記フォームにご入力下さい。<br /><span class="fs_winered">登録されたメールアドレス宛に登録案内のメールが届きますので、このメールに記載しているURLにアクセスすることにより登録が完了いたします。</span></p>
    <p class="mg-top30">・数字は半角で、カタカナは全角で入力してください。<br />
      ・<span class="fs_crimson">※</span>印がついている項目は入力必須です。必ず入力してください。<br />
      ・<a href="images/not_text.gif" class="lytebox" data-title="">こちら</a>のような機種依存文字は使用しないでください。<br />
      ・内容によっては回答に時間がかかる場合がございますので、あらかじめご了承ください。</p>

    <div class="ie6text fs14 fs_red txtcenter pd-top16"><strong>こちらのフォームはIE7以上、もしくは他のブラウザをご利用ください。</strong></div>

    <form method="post" name="frm" id="frm" action="addnew.php">
      <div class="sample_box">
        <div><img src="images/f_inner_top.png" width="926" height="31" class="png" /></div>
        <div class="sample_inner_box">
          <div class="pd-left32 pd-right34 wd-860">
            <table width="860" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="215">個人情報保護方針 <span class="fs_crimson">※</span></th>
                <td width="610">
                  <input type="checkbox" name="privacy" value="1" <?check_privacy?> />
                  <a href="/privacy/index.html">こちら</a>の個人情報保護方針に同意する</td>
              </tr>
              <tr>
                <th>御社名 <span class="fs_crimson">※</span></th>
                <td><input class="input01" type="text" name="company_name" id="company_name" size="30" value="<?company_name?>" style="ime-mode:active" /></td>
              </tr>
              <tr>
                <th>郵便番号 <span class="sample_text01">半角数字</span> <span class="fs_crimson">※</span></th>
                <td><input class="input02" name="zip1" type="text" id="zip1" maxlength="3" size="3" style="ime-mode:inactive" value="<?zip1?>" />
                  －
                  <input class="input03" name="zip2" type="text" id="zip2" maxlength="4" size="4" style="ime-mode:inactive" value="<?zip2?>" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','pref','address1');" /></td>
              </tr>
              <tr>
                <th>都道府県 <span class="fs_crimson">※</span></th>
                <td><select name="pref" class="text-box" id="pref">
                  <option value="" >都道府県を選択</option>
                  <?option_pref?>
                </select></td>
              </tr>
              <tr>
                <th>ご住所 <span class="fs_crimson">※</span></th>
                <td><input class="input04" type="text" name="address1" id="address1" size="60" style="ime-mode:active" value="<?address1?>" /></td>
              </tr>
              <tr>
                <th>TEL <span class="sample_text01">半角数字</span> <span class="fs_crimson">※</span></th>
                <td><input class="input02" name="tel1" type="text" id="tel1" maxlength="4" size="4" style="ime-mode: inactive" value="<?tel1?>" />
                  －
                  <input class="input02"  name="tel2" type="text" id="tel2" maxlength="4" size="4" style="ime-mode: inactive" value="<?tel2?>" />
                  －
                  <input class="input02"  name="tel3" type="text" id="tel3" maxlength="4" size="4" style="ime-mode: inactive" value="<?tel3?>" />
                  <span class="pd-left20">例：0774-25-7711</span></td>
              </tr>
              <tr>
                <th>FAX <span class="sample_text01">半角数字</span></th>
                <td><input class="input02" name="fax1" type="text" id="fax1" maxlength="4" size="4" style="ime-mode: inactive" value="<?fax1?>" />
                  －
                  <input class="input02" name="fax2" type="text" id="fax2" maxlength="4" size="4" style="ime-mode: inactive" value="<?fax2?>" />
                  －
                  <input class="input02" name="fax3" type="text" id="fax3" maxlength="4" size="4" style="ime-mode: inactive" value="<?fax3?>" />
                  <span class="pd-left20">例：0774-25-7712</span></td>
              </tr>
              <tr>
                <th>担当部署</th>
                <td><input class="input05" type="text" name="section" id="section" size="30" style="ime-mode:active" value="<?section?>" /></td>
              </tr>
              <tr>
                <th>ご担当者名 <span class="fs_crimson">※</span></th>
                <td><input class="input05" type="text" name="charge_name" id="charge_name" size="30" style="ime-mode:active" value="<?charge_name?>" /></td>
              </tr>
              <tr>
                <th>メールアドレス <span class="sample_text01">半角数字</span> <span class="fs_crimson">※</span></th>
                <td><input class="input06" type="text" name="email_address" id="email_address" size="40" style="ime-mode: inactive" value="<?email_address?>" />
                  <span class="pd-left10"><a href="mail.html" class="lytebox" data-title="" data-lyte-options="width:650 height:216 scrollbars:no">ご注意</a></span></td>
              </tr>
              <tr>
                <th>備考</th>
                <td><textarea class="textarea" name="note" rows="5" wrap="hard" cols="50" style="ime-mode:active"><?note?></textarea></td>
              </tr>
            </table>

          </div>
        </div>
        <div><img src="images/f_inner_bottom.png" width="926" height="39" class="png" /></div>
        <div class="clearfix mg-left264">
          <?validate_msg?>
		</div>
        <div class="clearfix mg-left264 pd-top25 pd-bottom33">
          <div class="left">
            <input type="hidden" name="mode" value="CONFIRM" />
            <input type="submit" name="to_confirm" value=" " class="conf_btn" />
          </div>
          <div class="left">
            <input type="submit" name="to_reset" value=" " class="reset_btn" />
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- contents_box end -->

