  <!-- contents_box start -->
  <div id="contents_box">
    <h2 class="mg-top28 mg-bottom30"><img src="images/titlebar.gif" alt="お問い合わせ" width="960" height="42" /></h2>
    
    <div class="clearfix pd-bottom30">
     <div class="left">
      <div><img src="images/text01.gif" alt="電話でのお問い合わせ" width="158" height="16" /></div>
      <p class="mg-top17"><strong>〈受付時間〉<br />9:00～17:45<br />(定休日/土日祝)</strong></p>
     </div>
     <div class="left pd-left18"><img src="images/item01.gif" alt="電話でのお問い合わせ" width="302" height="86" /></div>
     <div class="left pd-left27">
      <div><img src="images/text02.gif" alt="FAXでのお問い合わせ" width="160" height="16" /></div>
      <p class="mg-top17"><strong>〈受付時間〉<br />24時間年中無休</strong></p>
     </div>
     <div class="left pd-left18"><img src="images/item02.gif" alt="FAXでのお問い合わせ" width="275" height="86" /></div>
    </div>
    
    <div class="pd-bottom17 pd-top29 btop02"><img src="images/text03.gif" alt="メールでのお問い合わせ" width="181" height="16" /></div>
    <p>京都電機器株式会社へのお問い合わせは、下記フォームにご入力下さい。弊社担当より折り返し、ご連絡させて頂きます。</p>
    <p class="mg-top30">・数字は半角で、カタカナは全角で入力してください。<br />
      ・<span class="fs_crimson">※</span>印がついている項目は入力必須です。必ず入力してください。<br />
      ・<a href="images/not_text.gif" class="lytebox" data-title="">こちら</a>のような機種依存文字は使用しないでください。<br />
      ・内容によっては回答に時間がかかる場合がございますので、あらかじめご了承ください。</p>
      
    <div class="ie6text fs14 fs_red txtcenter pd-top16"><strong>こちらのフォームはIE7以上、もしくは他のブラウザをご利用ください。</strong></div>
      
    <form method="post" name="frm" id="frm" action="inquiry.php">
      <div class="sample_box">
        <div><img src="images/f_inner_top.png" width="926" height="31" class="png" /></div>
        <div class="sample_inner_box">
          <div class="pd-left32 pd-right34 wd-860">
            <table width="860" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th>御社名</th>
                <td><?company_name?></td>
              </tr>
              <tr>
                <th>ご担当者名</th>
                <td><?charge_name?>　様</td>
              </tr>
              <tr>
                <th>お問い合わせ種別 <span class="fs_crimson">※</span></th>
                <td><select name="inquiry_select" id="inquiry_select">
                  <option value=""> -- 項目を選択して下さい -- </option>
                  <?option_inquiry_select?>
                  </select>
                  <div class="mg-top10">
                  <?checkbox_inquiry_check?> 
				</div>
                  </td>
              </tr>
              <tr>
                <th>お問い合わせ内容 <span class="fs_crimson">※</span></th>
                <td><textarea class="textarea" name="inquiry_note" rows="5" wrap="hard" cols="50" style="ime-mode:active"><?inquiry_note?></textarea></td>
              </tr>
            </table>

          </div>
        </div>
        <div><img src="images/f_inner_bottom.png" width="926" height="39" class="png" /></div>
        <div class="clearfix mg-left264 pd-top10">
        <?validate_msg?>
		</div>
        <div class="clearfix mg-left264 pd-top25 pd-bottom33">
          <div class="left">
            <input type="hidden" name="mode" value="CONFIRM" />
            <input type="hidden" name="id" value="<?id?>" />
            <input type="hidden" name="company_name" value="<?company_name?>" />
            <input type="hidden" name="charge_name" value="<?charge_name?>" />
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

