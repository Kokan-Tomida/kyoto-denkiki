    <div id="pankuzu"><a href="../index.php">TOP</a> &gt; <a href="index.php">サンプル機貸し出しについて</a> &gt; サンプル機貸し出しフォーム 確認</div>
  </div>
  <!-- subheader_box end -->
  <!-- contents_box start -->
  <div id="subcontents_box">
    <h2 class="mg-top11 mg-bottom23"><img src="images/titlebar.gif" alt="サンプル機貸し出しについて" width="960" height="42" /></h2>
    <p class="sample_text02 txtcenter pd-top6">入力内容に間違いが無ければ、送信ボタンを押してください。</p>
    <form method="post" name="frm" action="sample_confirm.php">
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
            </table>
            <div class="mg-top24"><img src="images/line.gif" width="860" height="1" /></div>
            <div class="fs14 mg-top28 mg-bottom10"><strong>【ご希望貸し出し内容】</strong></div>
            <table width="860" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="215">照明</th>
                <td width="610"><div>1.型式・台数　<?model1?></div>
                  <div class="mg-top15">2.型式・台数　<?model2?></div></td>
              </tr>
              <tr>
                <th>電源</th>
                <td><div><?power_needs?></div>
                  <div class="mg-top10">型式・台数　<?power_type?></div></td>
              </tr>
              <tr>
                <th>延長ケーブル</th>
                <td><div><?cable_needs?>　<?cable_count?></div>
                  <div class="mg-top10"><?cable_length?>　<?cable_length_other?>  </div></td>
              </tr>
              <tr>
                <th>貸し出し希望日</th>
                <td><?lent_start_date?></td>
              </tr>
              <tr>
                <th>返却予定日</th>
                <td><?return_date?> </td>
              </tr>
              <tr>
                <th>対象物ワーク</th>
                <td><?target_work?></td>
              </tr>
              <tr>
                <th>ワークの大きさ</th>
                <td><?work_size?></td>
              </tr>
              <tr>
                <th>距離</th>
                <td><div>カメラ-照明　<?distance_camera?></div>
                  <div class="mg-top15">照明-ワーク　<?distance_light?></div></td>
              </tr>
              <tr>
                <th>備考（検査内容など）</th>
                <td><?sample_note?></td>
              </tr>
            </table>
          </div>
        </div>
        <div><img src="images/f_inner_bottom.png" width="926" height="39" class="png" /></div>
        <!--<?php echo $sfm_submit; ?>-->
<div class="mg-left339 pd-top25 pd-bottom33">
<input type="button" name="back" id="back" value=" " onclick="history.back()" class="back_btn" />
</div>
        </div>
      </div>
    </form>
  </div>
  <!-- contents_box end -->
