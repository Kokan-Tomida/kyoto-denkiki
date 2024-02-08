<?php

/**--------------------------------------------------------------------
  ProjectName :
  description :		index.php
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a3130 extends Base{

	public function a3130(){
		parent::Base();
	}

	public function Show(){
		global $a3130_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a3130_form);
		$this->m_value['menu_g'] = G03;
		if(!axts('target',$this->m_value)){
			header('location: a3100.php');
			exit;
		}
		if(is_set('to_update_admin_note',$this->m_vARGV,NULL)){
			$target_id = get_key_one($this->m_vARGV['to_update_admin_note'],0);
			if(!empty($target_id)){
				$this->m_value['history_admin_note'][$target_id] =  $this->m_vARGV['history_admin_note'][$target_id];
				$data = array('id'=>$target_id,'history_admin_note'=>$this->m_value['history_admin_note'][$target_id]);
				$this->Edit('kdn_history', 'id='.$target_id,$data);
			}
		}

		$this->_makeForm();
		if(is_set('to_csv',$this->m_vARGV,NULL)){
			$res = $this->_list(true);
			if($this->m_value['total_count'] > 0){
				$data = $this->_csv_data2($res);
				$this->m_objCSV->setResource($data);
				$this->m_objCSV->setTitle(array());
				$this->m_objCSV->CreateCSVFile(get_class());
				exit;
			}
		}

		$this->m_value['list'] = $this->_listView();
		$this->m_value['pagenavi'] = $this->m_objCommon->setPageNo4($this->m_value['pageno'],$this->m_value['total_count']);
		$this->m_value['search_result'] = $this->m_objCommon->searchResult($this->m_value['pageno'],$this->m_value['total_count']);

		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _list($all = false){
		$this->m_value['total_count'] = 0;
		$condition1 = (axts('target',$this->m_value) != "") ? "H.kdn_member_id=".$this->m_value['target'] : "";
		$condition2 = (axts('type',$this->m_value) != "") ? "  H.type='".$this->m_value['type']."'" : "";
		$condition = "";
		if(($condition1 != "") and ($condition2 != "")){
			$condition = $condition1.' and '.$condition2;
		}
		if(($condition1 == "") and ($condition2 != "")){
			$condition = $condition2;
		}
		if(($condition1 != "") and ($condition2 == "")){
			$condition = $condition1;
		}
		$fld = 'H.id, H.type, H.kdn_member_id, M.company_name, M.charge_name, H.generate_date, H.generate_time, H.note1, H.note2, H.note3, H.history_id ,H.history_admin_note';
		$order = ' H.generate_date desc, H.generate_time desc';
		$table = 'kdn_history H left outer join kdn_member M on H.kdn_member_id=M.id';
		$this->Search($table,$fld,$condition,$order);
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		$n = $this->getNumCount();
		$this->m_value['total_count'] = $n;
		if($all == true)	return $result;
		$no = (axts('pageno', $this->m_value)) ? $this->m_value['pageno'] : 1;
		$offset = VIEW_PAR_PAGE * ($no -1);
		$limit = $offset." , ".VIEW_PAR_PAGE;
		$this->Search($table,$fld,$condition,$order,'',$limit);
		$result = $this->m_objDB->getResult();
		return $result;
	}

	private function _listView(){
		global $HISTORY_TYPE_J;
		$result = $this->_list();
		if(!$result)	return null;
		$sel = (axts('large_category_id', $this->m_value)) ? '' : 'disabled';
		$res = '';
		$i = 1;
		//while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$id = $row['id'];
			$classnm = ($i%2 == 0) ? 'cellbg01' : '';
			$class = ($i%2 == 0) ? 'class="cellbg01"' : '';
			$res .= "<tr>\n";
       		$res .= "  <td class=\"txtcenter ".$classnm."\">".$row['id']."</td>\n";
       		$res .= "  <td ".$class." >".$row['generate_date'].' '.$row['generate_time']."</td>\n";
			$s = axts('type',$row) ? $HISTORY_TYPE_J[$row['type']] : '';
      		$res .= "  <td ".$class." >".$s."</td>\n";
      		if($row['type'] == HISTORY_TYPE2){
      			$res .= "<td colspan=\"3\" ".$class.">\n";
      			$res .= "<table border=\"0\">\n";
      			$res .= "<tr>\n";
       			$res .= "  <td ".$class." valign=\"top\">".$row['note1']."</td>\n";
				// 	$res .= "  <td ".$class." valign=\"top\">&nbsp;</td>\n";
				// 	$res .= "  <td ".$class." valign=\"top\">&nbsp;</td>\n";
      		}elseif($row['type'] == HISTORY_TYPE3){
      			$res .= "<td colspan=\"3\" ".$class.">\n";
      			$res .= "<table border=\"0\">\n";
      			$res .= "<tr>\n";
       			$res .= "  <td ".$class." valign=\"top\">".nl2br($row['note1'])."&nbsp;</td>\n";
       			//$res .= "  <td ".$class." valign=\"top\">&nbsp;</td>\n";
       			//$res .= "  <td ".$class." valign=\"top\">&nbsp;</td>\n";
      		}elseif($row['type'] == HISTORY_TYPE4){
      			$res .= "<td colspan=\"3\" ".$class.">\n";
      			$res .= "<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
      			$res .= "<tr>\n";
       			$res .= "  <td ".$class." valign=\"top\" width=\"70%\">".$row['note1']."</td>\n";
       			$res .= "  <td ".$class." valign=\"top\" width=\"30%\">".$row['note2']."</td>\n";
				//$res .= "  <td ".$class." valign=\"top\">&nbsp;</td>\n";
      		}else{
      			$res .= "<td colspan=\"3\" ".$class.">\n";
      			$res .= "<table border=\"0\">\n";
      			$res .= "<tr>\n";
       			$res .= "  <td ".$class." valign=\"top\" width=\"40%\">".$row['note1']."</td>\n";
       			$res .= "  <td ".$class." valign=\"top\" width=\"30%\">".$row['note2']."</td>\n";
       			$res .= "  <td ".$class." valign=\"top\" width=\"30%\">".$row['note3']."</td>\n";
      		}
   			$res .= "</tr>\n";
   			$res .= "</table>\n";
			$res .= "</td>\n";
			if((axts('type',$this->m_value) == 'sample') or (axts('type',$this->m_value) == 'inquiry')){
    		$res .= "<td ".$class." valign=\"top\">";
    		$res .= "<input type=\"text\" name=\"history_admin_note[".$id."]\" value=\"".$row['history_admin_note']."\">\n";
    		$res .= "<input type=\"submit\" name=\"to_update_admin_note[".$id."]\" value=\"更新\">\n";
			$res .= "</td>\n";
			}
      		$res .= "<tr>\n";
    		$i++;
		}

		$tl = '';
		if(axts('type',$this->m_value) == 'sample'){
			$tl .= "<tr>";
			$tl .= "  <th width=\"30\">No</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">年月日時</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">履歴種別</th>";
			$tl .= "  <th width=\"465\" colspan=\"3\" class=\"txtleft\">内容</th>";
			$tl .= "  <th width=\"200\" class=\"txtleft\">履歴備考</th>";
			$tl .= "</tr>";
		}elseif(axts('type',$this->m_value) == 'inquiry'){
			$tl .= "<tr>";
			$tl .= "  <th width=\"30\">No</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">年月日時</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">履歴種別</th>";
			$tl .= "  <th width=\"465\" colspan=\"3\" class=\"txtleft\">内容</th>";
			$tl .= "  <th width=\"200\" class=\"txtleft\">履歴備考</th>";
			$tl .= "</tr>";
		}elseif(axts('type',$this->m_value) == 'login'){
			$tl .= "<tr>";
			$tl .= "  <th width=\"30\">No</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">年月日時</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">履歴種別</th>";
			$tl .= "  <th width=\"665\" colspan=\"3\" class=\"txtleft\">内容</th>";
			$tl .= "</tr>";
		}elseif(axts('type',$this->m_value) == 'download'){
			$tl .= "<tr>";
			$tl .= "  <th width=\"30\">No</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">年月日時</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">履歴種別</th>";
			$tl .= "  <th width=\"465\" colspan=\"3\" class=\"txtleft\">内容</th>";
			$tl .= "</tr>";
		}else{
			$tl .= "<tr>";
			$tl .= "  <th width=\"30\">No</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">年月日時</th>";
			$tl .= "  <th width=\"90\" class=\"txtleft\">履歴種別</th>";
			$tl .= "  <th width=\"665\" colspan=\"3\" class=\"txtleft\">内容</th>";
			$tl .= "</tr>";
		}
		return $tl.$res;
	}

	private function _makeForm(){
		global $G_PREF_LIST;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
		if($this->m_objValidate->isNull($this->m_value['pageno']))	$this->m_value['pageno'] = 1;
		if(axts('target',$this->m_value)){
			$minfo = $this->member_info($this->m_value['target']);
			foreach($minfo as $f=>$v){
				$this->m_value[$f] = $v;
			}
			//$this->m_value['this_registration'] = $minfo['this_registration'];
			//$this->m_value['company_name'] = $minfo['company_name'];
			//$this->m_value['charge_name'] = $minfo['charge_name'];
			//$this->m_value['email_address'] = $minfo['email_address'];
			//$this->m_value['telno'] = $minfo['telno'];
		}
		if(axts('type',$this->m_value) != ""){
			if(HISTORY_TYPE1 == $this->m_value['type']){
				$this->m_value['btn0'] = '';
				$this->m_value['btn1'] = '_on';
				$this->m_value['btn2'] = '';
				$this->m_value['btn3'] = '';
				$this->m_value['btn4'] = '';
			}elseif(HISTORY_TYPE2 == $this->m_value['type']){
				$this->m_value['btn0'] = '';
				$this->m_value['btn1'] = '';
				$this->m_value['btn2'] = '_on';
				$this->m_value['btn3'] = '';
				$this->m_value['btn4'] = '';
			}elseif(HISTORY_TYPE3 == $this->m_value['type']){
				$this->m_value['btn0'] = '';
				$this->m_value['btn1'] = '';
				$this->m_value['btn2'] = '';
				$this->m_value['btn3'] = '_on';
				$this->m_value['btn4'] = '';
			}elseif(HISTORY_TYPE4 == $this->m_value['type']){
				$this->m_value['btn0'] = '';
				$this->m_value['btn1'] = '';
				$this->m_value['btn2'] = '';
				$this->m_value['btn3'] = '';
				$this->m_value['btn4'] = '_on';
			}else{
				$this->m_value['btn0'] = '_on';
				$this->m_value['btn1'] = '';
				$this->m_value['btn2'] = '';
				$this->m_value['btn3'] = '';
				$this->m_value['btn4'] = '';
			}
		}else{
			$this->m_value['btn0'] = '_on';
			$this->m_value['btn1'] = '';
			$this->m_value['btn2'] = '';
			$this->m_value['btn3'] = '';
			$this->m_value['btn4'] = '';
		}
		$this->m_value['admin_note'] = axts('admin_note',$this->m_value) ? nl2br($this->m_value['admin_note']) : '';
	}

	private function _csv_title(){
		$fld = 'H.id,,H.type,H.kdn_member_id,,M.company_name,M.charge_name,H.generate_date,H.generate_timeH.note1,H.note2,H.note3,H.history_id';
		return array(
				'履歴ID',
				'履歴種別',
				'会員ID',
				'法人名',
				'担当者お名前',
				'日付',
				'時間',
				'履歴内容1',
				'履歴内容2',
				'履歴内容3',
				'履歴備考'
			);
	}
	private function _csv_data($res){
		global $HISTORY_TYPE_J;
		$data = array();
		if(!$res)  return $data;
		//while($row = mysql_fetch_array($res, MYSQL_ASSOC)){
		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			$data = array();
			foreach($row as $fld=>$v){
				if($fld == 'type'){
					$s = axts('type',$row) ? $HISTORY_TYPE_J[$row['type']] : '';
					$data[$fld] = $s;
				}elseif($fld == 'history_id'){
					continue;
				}else{
					$data[$fld] = $v;
				}
			}
			if((axts('type',$row) == HISTORY_TYPE1) or (axts('type',$row) == HISTORY_TYPE4)){
	       		$data['note1'] = $row['note1'];
	       		$data['note2'] = $row['note2'];
       		}elseif(axts('type',$row) == HISTORY_TYPE3){
	       		$data['note1'] = '';
	       		$data['note2'] = '';
       		}elseif(axts('type',$row) == HISTORY_TYPE2){
	       		$data['note1'] = $row['note1'];
	       		$data['note2'] = $row['note2'];
			}
			$datas[] = $data;
		}
		return $datas;
	}
	private function _csv_data2($res){
		global $HISTORY_TYPE_J,$G_PREF_LIST;
		$data = array();
		if(!$res)  return $data;

		//$data

		$c = 0;
		//while($row = mysql_fetch_array($res, MYSQL_ASSOC)){
		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			$data = array();
			$type =  axts('type',$this->m_value);
			if($c == 0){
				$datas[0]['f1'] = '御社名';
				$datas[0]['f2'] = $this->m_value['company_name'];
				$datas[0]['f3'] = '';
				$datas[0]['f4'] = '';
				$datas[0]['f5'] = '';
				$datas[0]['f6'] = '';
				$datas[1]['f1'] = '郵便番号1';
				$datas[1]['f2'] = $this->m_value['zip1'];
				$datas[1]['f3'] = '';
				$datas[1]['f4'] = '';
				$datas[1]['f5'] = '';
				$datas[1]['f6'] = '';
				$datas[2]['f1'] = '郵便番号2';
				$datas[2]['f2'] = $this->m_value['zip2'];
				$datas[2]['f3'] = '';
				$datas[2]['f4'] = '';
				$datas[2]['f5'] = '';
				$datas[2]['f6'] = '';
				$datas[3]['f1'] = '都道府県';
				$datas[3]['f2'] = (($this->m_value['pref']) and (in_array($this->m_value['pref'],array_keys($G_PREF_LIST)))) ? $G_PREF_LIST[$this->m_value['pref']] : '';
				$datas[3]['f3'] = '';
				$datas[3]['f4'] = '';
				$datas[3]['f5'] = '';
				$datas[3]['f6'] = '';
				$datas[4]['f1'] = 'ご住所';
				$datas[4]['f2'] = $this->m_value['address1'];
				$datas[4]['f3'] = '';
				$datas[4]['f4'] = '';
				$datas[4]['f5'] = '';
				$datas[4]['f6'] = '';
				$datas[5]['f1'] = '電話番号';
				$datas[5]['f2'] = $this->m_value['telno'];
				$datas[5]['f3'] = '';
				$datas[5]['f4'] = '';
				$datas[5]['f5'] = '';
				$datas[5]['f6'] = '';
				$datas[6]['f1'] = 'FAX番号';
				$datas[6]['f2'] = $this->m_value['faxno'];
				$datas[6]['f3'] = '';
				$datas[6]['f4'] = '';
				$datas[6]['f5'] = '';
				$datas[6]['f6'] = '';
				$datas[7]['f1'] = '所属部署';
				$datas[7]['f2'] = $this->m_value['section'];
				$datas[7]['f3'] = '';
				$datas[7]['f4'] = '';
				$datas[7]['f5'] = '';
				$datas[7]['f6'] = '';
				$datas[8]['f1'] = 'ご担当者名';
				$datas[8]['f2'] = $this->m_value['charge_name'];
				$datas[8]['f3'] = '';
				$datas[8]['f4'] = '';
				$datas[8]['f5'] = '';
				$datas[8]['f6'] = '';
				$datas[9]['f1'] = 'メールアドレス';
				$datas[9]['f2'] = $this->m_value['email_address'];
				$datas[9]['f3'] = '';
				$datas[9]['f4'] = '';
				$datas[9]['f5'] = '';
				$datas[9]['f6'] = '';
				$datas[10]['f1'] = '本登録日';
				$datas[10]['f2'] = $this->m_value['this_registration'];
				$datas[10]['f3'] = '';
				$datas[10]['f4'] = '';
				$datas[10]['f5'] = '';
				$datas[10]['f6'] = '';
				$datas[11]['f1'] = '管理備考';
				$admin_note = (strpos($this->m_value['admin_note'],'<br />') !== false) ? str_replace('<br />','',$this->m_value['admin_note']) : $this->m_value['admin_note'];
				$datas[11]['f2'] = $admin_note;
				$datas[11]['f3'] = '';
				$datas[11]['f4'] = '';
				$datas[11]['f5'] = '';
				$datas[11]['f6'] = '';
				$datas[12]['f1'] = '';
				$datas[12]['f2'] = '';
				$datas[12]['f3'] = '';
				$datas[12]['f4'] = '';
				$datas[12]['f5'] = '';
				$datas[12]['f6'] = '';
				$datas[13]['f1'] = '履歴種別';
				$datas[13]['f2'] = '日付';
				$datas[13]['f3'] = '時間';
				switch($type){
				case HISTORY_TYPE1:
					$datas[13]['f4'] = '照明';
					$datas[13]['f5'] = '電源';
					$datas[13]['f6'] = '対象物ワーク';
					$datas[13]['f7'] = '備考（検査内容など）';
					$datas[13]['f8'] = '履歴管理';
					break;
				case HISTORY_TYPE2:
					$datas[13]['f4'] = '問い合わせ種別';
					$datas[13]['f5'] = '';
					$datas[13]['f6'] = '';
					$datas[13]['f7'] = '';
					$datas[13]['f8'] = '履歴管理';
					break;
				case HISTORY_TYPE3:
					$datas[13]['f4'] = 'アンケート';
					$datas[13]['f5'] = '';
					$datas[13]['f6'] = '';
					break;
				case HISTORY_TYPE4:
					$datas[13]['f4'] = 'カテゴリ/製品';
					$datas[13]['f5'] = 'ファイル';
					$datas[13]['f6'] = '';
					break;
				default:
					$datas[13]['f4'] = '履歴内容1';
					$datas[13]['f5'] = '履歴内容2';
					$datas[13]['f6'] = '履歴内容3';
					$datas[13]['f7'] = '履歴内容4';
					$datas[13]['f8'] = '履歴管理';
				}
			}
			$s = axts('type',$row) ? $HISTORY_TYPE_J[$row['type']] : '';
			$data['type'] = $s;
       		$data['generate_date'] = $row['generate_date'];
       		$data['generate_time'] = $row['generate_time'];
			if(axts('type',$row) == HISTORY_TYPE1){
	       		$data['note1'] = $row['note1'];
	       		$data['note2'] = $row['note2'];
	       		$data['note3'] = $row['note3'];
				if($row['history_id'] != 0){
					$this->Search('kdn_sample_history','sample_note','id='.$row['history_id']);
					$re = $this->getOneRow();
					$note = axts('sample_note',$re);
					$data['sample_note'] = $note;
				}else{
					$data['sample_note'] = '';
				}

			}elseif(axts('type',$row) == HISTORY_TYPE4){
	       		$data['note1'] = $row['note1'];
	       		$data['note2'] = $row['note2'];
	       		$data['note3'] = '';
	       		$data['note4'] = '';
       		}elseif(axts('type',$row) == HISTORY_TYPE3){
	       		$data['note1'] = $row['note1'];
	       		$data['note2'] = '';
	       		$data['note3'] = '';
	       		$data['note4'] = '';
       		}elseif(axts('type',$row) == HISTORY_TYPE2){
	       		$data['note1'] = $row['note1'];
	       		$data['note2'] = $row['note2'];
	       		$data['note3'] = '';
	       		$data['note4'] = '';
			}
       		$data['history_admin_note'] = $row['history_admin_note'];
			$n = 14+$c;
			$datas[$n] = $data;
			$c++;
		}
		return $datas;
	}

}
$a3130 = new a3130();
$a3130->a3130();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>