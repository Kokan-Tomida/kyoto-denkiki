<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a4100.php 履歴一覧 all
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a4120 extends Base{

	public function a4120(){
		parent::Base();
	}
	
	public function Show(){
		global $a4100_form;
		$template = $this->getViewHTML(get_class());
		if(is_set('to_clear',$this->m_vARGV,NULL)){
			$this->m_vARGV = array();
		}	
		$this->initValue($a4100_form);
		$this->m_value['menu_g'] = G04;	
			
		if(is_set('to_update_admin_note',$this->m_vARGV,NULL)){
			$target_id = get_key_one($this->m_vARGV['to_update_admin_note'],0);
			if(!empty($target_id)){
				$this->m_value['history_admin_note'][$target_id] =  $this->m_vARGV['history_admin_note'][$target_id];
				$data = array('id'=>$target_id,'history_admin_note'=>$this->m_value['history_admin_note'][$target_id]);
				$this->Edit('kdn_history', 'id='.$target_id,$data);
			}
		}
		if(is_set('to_csv',$this->m_vARGV,NULL)){
			$res = $this->_list(true);
			
			if($this->m_value['total_count'] > 0){
				$data = $this->_csv_data($res);
				$this->m_objCSV->setResource($data);
				$this->m_objCSV->setTitle($this->_csv_title());
				$this->m_objCSV->CreateCSVFile(get_class());
				exit;
			}
		}			
		$this->_makeForm();
		$this->m_value['list'] = $this->_listView();
		$this->m_value['pagenavi'] = $this->m_objCommon->setPageNo4($this->m_value['pageno'],$this->m_value['total_count']);
		$this->m_value['search_result'] = $this->m_objCommon->searchResult($this->m_value['pageno'],$this->m_value['total_count']);

		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _list($all = false){
		$this->m_value['total_count'] = 0;
		$condition = $this->_createCondition();
		$fld = 'H.id,H.generate_date,H.generate_time,H.type,';
		$fld .= 'H.kdn_member_id,M.company_name,M.charge_name,M.pref,M.telno,M.email_address,M.status,';
		$fld .= 'IH.company_name as guest_company_name,IH.charge_name as guest_charge_name,IH.pref as guest_pref,IH.telno as guest_telno,IH.email_address as guest_email_address,';
		$fld .= 'H.note1,H.note2,H.note3,H.history_id,H.history_admin_note';
		$order = ' H.generate_date desc, H.generate_time desc';
		$table = 'kdn_history H left outer join kdn_member M on H.kdn_member_id=M.id';
		$table .= ' left outer join kdn_inquiry_history IH on H.history_id=IH.id';
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
		$result = $this->_list();
		if(!$result)	return null;
		$sel = (axts('large_category_id', $this->m_value)) ? '' : 'disabled';
		$res = '';
		$i = 1;
		//while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$id = $row['id'];
			$hid = $row['history_id'];
			$classnm = ($i%2 == 0) ? 'cellbg01' : '';
			$class = ($i%2 == 0) ? 'class="cellbg01"' : '';
			$res .= "<tr>\n";
       		$res .= "  <td class=\"txtcenter ".$classnm."\">".$row['id']."</td>\n";
       		$res .= "  <td ".$class." >".$row['generate_date'].' '.$row['generate_time']."</td>\n";
			if(axts('kdn_member_id',$row) != 0){
				$link = "a3130.php?target=".axts('kdn_member_id',$row);
				$minfo = $this->member_info(axts('kdn_member_id',$row));
				$s = (axts('company_name',$row)) ? $row['company_name'] : '';
	       		$res .= "  <td ".$class."><a href=\"".$link."\">".$s."</a></td>\n";
				$s = (axts('charge_name',$row)) ? $row['charge_name'] : '';
	       		$res .= "  <td ".$class."><a href=\"".$link."\">".$s."</a></td>\n";
	       		$res .= "  <td ".$class.">".$row['telno']."</td>\n";
			}else{
				//$ginfo = $this->inquiry_guest_info(axts('history_id',$row));
				$s = (axts('guest_company_name',$row)) ? $row['guest_company_name'] : '';
	       		$res .= "  <td ".$class.">".$s."</td>\n";
				$s = (axts('guest_charge_name',$row)) ? $row['guest_charge_name'] : '';
	       		$res .= "  <td ".$class.">".$s."</td>\n";
	       		$res .= "  <td ".$class.">".$row['guest_telno']."</td>\n";
			}

       		$res .= "  <td ".$class." valign=\"top\">".str_replace(' ','<br />',$row['note1'])."</td>\n";
       		$res .= "  <td ".$class." valign=\"top\">";
       		$res .= "<input type=\"text\" size=\"20\" name=\"history_admin_note[".$id."]\" value=\"".$row['history_admin_note']."\"><br /><input type=\"submit\" value=\" 更新 \" name=\"to_update_admin_note[".$id."]\" />";
       		$res .= "</td>";
       		
       		//$res .= "  <td ".$class." valign=\"top\">".nl2br($row['note2'])."</td>\n";
       		$res .= "<tr>\n";
    		$i++;
		}
		return $res;
	}
	
	private function _makeForm(){
		global $G_PREF_LIST,$SEAECH_MEMBER_KFN;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
		$this->m_value['radio_member'] = $this->m_objCommon->makeRadio($SEAECH_MEMBER_KFN,'member_kbn',axts('member_kbn',$this->m_value),true);

		if($this->m_objValidate->isNull($this->m_value['pageno']))	$this->m_value['pageno'] = 1;
	}

	private function _createCondition(){
		$condition = "type='".HISTORY_TYPE2."'";
	
		$kbn = (axts('member_kbn', $this->m_value) == '') ? '1' : $this->m_value['member_kbn'];

		if($kbn == '2'){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= '(H.kdn_member_id = 0 or M.status <> '.MEMBERSHIP2.')';
		}elseif($kbn == '1'){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= 'H.kdn_member_id <> 0 and M.status = '.MEMBERSHIP2;
		}
		if(axts('start_date', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " generate_date >= '".$this->m_value['start_date']."'";
		}
		if(axts('end_date', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " generate_date <= '".$this->m_value['end_date']."'";
		}
		if(axts('company_name', $this->m_value)){
			$condition .= ($condition =='') ? '' : ' and ';
			$condition .= " ((M.company_name like '%".$this->m_value['company_name']."%') or ";
			$condition .= " (IH.company_name like '%".$this->m_value['company_name']."%'))";
		}
		if(axts('pref', $this->m_value)){
			$condition .= ($condition =='') ? '' : ' and ';
			$condition .= " ((M.pref = '".$this->m_value['pref']."') or ";
			$condition .= " (IH.pref = '".$this->m_value['pref']."'))";
		}
		return $condition;
	}
	
	private function _csv_title(){
		return array(
			'履歴ID',
			'日付',
			'時間',
			'会員ID',
			'法人名(会員)',
			'担当者名(会員)',
			'都道府県(会員)',
			'電話番号(会員)',
			'E-mail(会員)',
			'ステータス',
			'法人名(guest)',
			'担当者(guest)',
			'都道府県(guest)',
			'電話番号(guest)',
			'E-mail(guest)',
			'問い合わせ種別',
			'問い合わせ内容',
			'履歴備考'
		);
	}
	private function _csv_data($res){
		global $HISTORY_TYPE_J,$G_PREF_LIST,$MEMBERSHIP;
		$data = array();
		$datas = array();
		if(!$res)  return $data;
		//while($row = mysql_fetch_array($res, MYSQL_ASSOC)){
		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			$data = array();
			foreach($row as $fld=>$v){
				if($fld == 'pref'){
					$s = axts('pref',$row) ? $G_PREF_LIST[$row['pref']] : '';
					$data[$fld] = $s;
				}elseif($fld == 'guest_pref'){
					$s = axts('guest_pref',$row) ? $G_PREF_LIST[$row['guest_pref']] : '';
					$data[$fld] = $s;
				}elseif(in_array($fld, array('history_id','note3','type'))){
					continue;
				}elseif($fld == 'kdn_member_id'){
					$data[$fld] = ((axts('kdn_member_id',$row)) and ($row['kdn_member_id'] != 0)) ? $row['kdn_member_id'] : '';
				}elseif($fld == 'status'){
					$data[$fld] = (in_array($v,array_keys($MEMBERSHIP))) ? $MEMBERSHIP[$v] : '';					
				}else{
					$data[$fld] = $v;
				}
			}
			$datas[] = $data;
		}
		return $datas;
	} 		
}
$a4120 = new a4120();
$a4120->a4120();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>