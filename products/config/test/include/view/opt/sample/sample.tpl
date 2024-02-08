    <div id="pankuzu"><a href="../index.php">TOP</a> &gt; サンプル機貸し出しについて</div>
  </div>
  <!-- subheader_box end -->
  <!-- contents_box start -->
  <div id="subcontents_box">
    <h2 class="mg-top11 mg-bottom23"><img src="images/titlebar.gif" alt="サンプル機貸し出しについて" width="960" height="42" /></h2>
    <p class="fs14"><strong>ご希望の貸し出し製品を各項目に沿って入力いただき、<br />
      貸し出し期間などを入力いただきましたら追って弊社担当より、ご案内させていただきます。<br />
      型式がご不明・記入欄が不足等の場合は、備考欄にご記入ください。</strong></p>
    <p class="mg-top30">・数字は半角で、カタカナは全角で入力してください。<br />
      ・<span class="fs_crimson">※</span>印がついている項目は入力必須です。必ず入力してください。<br />
      ・<a href="images/not_text.gif" class="lytebox" data-title="">こちら</a>のような機種依存文字は使用しないでください。<br />
      ・内容によっては回答に時間がかかる場合がございますので、あらかじめご了承ください。</p>
    <div class="ie6text fs14 fs_red txtcenter pd-top16"><strong>こちらのフォームはIE7以上、もしくは他のブラウザをご利用ください。</strong></div>
    <form method="post" name="frm" action="sample.php">
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
                <th>ご担当者名 <span class="fs_crimson">※</span></th>
                <td><?charge_name?>　様</td>
              </tr>
            </table>
            <div class="mg-top24"><img src="images/line.gif" width="860" height="1" /></div>
            <div class="fs14 mg-top28 mg-bottom10"><strong>【ご希望貸し出し内容】</strong></div>
            <table width="860" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="215">照明</th>
                <td width="610"><div>1.型式・台数
                  <input class="input06 mg-left21" type="text" name="model1" id="model1" size="40" style="ime-mode: inactive" value="<?model1?>" />
                </div>
                  <div class="mg-top15">2.型式・台数
                    <input class="input06 mg-left21" type="text" name="model2" id="model2" size="40" style="ime-mode: inactive" value="<?model2?>" />
                  </div></td>
              </tr>
              <tr>
                <th>電源</th>
                <td><div>
                  <?radio_power_needs?>
                  </div>
                  <div class="mg-top10">型式のご指定がある場合は型式をご記入下さい</div>
                  <div class="mg-top6">型式・台数
                    <input class="input06 mg-left7" type="text" name="power_type" id="power_type" size="40" style="ime-mode: inactive" value="<?power_type?>" />
                  </div></td>
              </tr>
              <tr>
                <th>延長ケーブル</th>
                <td><div>
                  <input type="hidden" name="cable01" value="none" />
                  <?radio_cable_needs?>
                  <input type="radio" name="cable_needs" value="1" <?check_cable_needs1?> />
                  必要 　
                  <input class="input07" name="cable_count" type="text" id="cable_count" maxlength="3" size="3" style="ime-mode:inactive" value="<?cable_count?>" />
                  本　
                  <input type="radio" name="cable_needs" value="2" <?check_cable_needs2?> />
                  不要</div>
                  <div class="mg-top10">ケーブル長のご指定がある場合は、下記をご記入下さい</div>
                  <div class="mg-top10">
					<?checkbox_cable_length?>
                    <input class="input07" name="cable_length_other" type="text" id="cable_length_other" maxlength="3" size="3" style="ime-mode:inactive" value="<?cable_length_other?>" />
                    m </div></td>
              </tr>
              <tr>
                <th>貸し出し希望日</th>
                <td>
                  <select name="lent_start_date_year">
                  <?option_lent_start_date_year?>
                  </select>年　
                  <select name="lent_start_date_month">
                  <?option_lent_start_date_month?>
                  </select>月　
                  <select name="lent_start_date_day">
                  <option value=""> ---- </option>
                  <?option_lent_start_date_day?>
                  </select>日　
                </td>
              </tr>
              <tr>
                <th>返却予定日</th>
                <td>
                  <select name="return_date_year">
                  <?option_return_date_year?>
                  </select>年　
                  <select name="return_date_month">
                  <?option_return_date_month?>
                  </select>月　
                  <select name="return_date_day">
                  <option value=""> ---- </option>
                  <?option_return_date_day?>
                  </select>日　
                </td>
              </tr>
              <tr>
                <th>対象物ワーク</th>
                <td><input class="input05" type="text" name="target_work" id="target_work" size="30" style="ime-mode:active" value="<?target_work?>" /></td>
              </tr>
              <tr>
                <th>ワークの大きさ</th>
                <td><input class="input05" type="text" name="work_size" id="work_size" size="30" style="ime-mode:active" value="<?work_size?>" /></td>
              </tr>
              <tr>
                <th>距離</th>
                <td><div>カメラ-照明
                  <input class="input08 mg-left20" type="text" name="distance_camera" id="distance_camera" size="40" style="ime-mode: inactive" value="<?distance_camera?>" />
                </div>
                  <div class="mg-top15">照明-ワーク
                    <input class="input08 mg-left20" type="text" name="distance_light" id="distance_light" size="40" style="ime-mode: inactive" value="<?distance_light?>" />
                  </div></td>
              </tr>
              <tr>
                <th>備考（検査内容など）</th>
                <td><textarea class="textarea" name="sample_note" rows="5" wrap="hard" cols="50" style="ime-mode:active"><?sample_note?></textarea></td>
              </tr>
            </table>
          </div>
        </div>
        <div><img src="images/f_inner_bottom.png" width="926" height="39" class="png" /></div>
        <div class="clearfix mg-left264 pd-top25 pd-bottom33">
          <div class="left">
            <input type="hidden" name="mode" value="CONFIRM" />
            <input type="hidden" name="kdn_member_id" value="<?kdn_member_id?>" />
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
