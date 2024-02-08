<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a4140 extends Base{

	public function a4140(){
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
		$fld = 'H.id,H.generate_date,H.generate_time,H.kdn_member_id,M.company_name,M.charge_name,H.note1,H.note2,H.note3';
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
			$minfo = $this->member_info(axts('kdn_member_id',$row));
			$res .= "<tr>\n";
       		$res .= "  <td class=\"txtcenter ".$classnm."\">".$row['id']."</td>\n";
       		$res .= "  <td ".$class." >".$row['generate_date'].' '.$row['generate_time']."</td>\n";
			$s = (axts('company_name',$row)) ? $row['company_name'] : '';
			$s .= '<br />';
			$s .= (axts('charge_name',$row)) ? $row['charge_name'] : '';
			$link = "a3130.php?target=".axts('kdn_member_id',$row);
       		$res .= "  <td ".$class."><a href=\"".$link."\">".$s."</a></td>\n";
       			if(strpos($row['note1'],'/') !== false){
       				$pro = explode('/',$row['note1']);
       				if(count($pro) == 5){
       					$note = substr($pro[1],0,1).' '.substr($pro[1],2).'/'.$pro[2].'/'.$pro[3];
						$note .= '<br />&nbsp;&nbsp;&nbsp;'.$pro[4];
       				}else{
       					$note = $row['note1'];
       				}
   				}else{
   					$note = $row['note1'];
       			}
			$res .= "  <td ".$class." valign=\"top\">".$note."</td>\n";

//       		$res .= "  <td ".$class." valign=\"top\">".$row['note1']."</td>\n";
       		$res .= "  <td ".$class." valign=\"top\">".$row['note2']."</td>\n";
       		$res .= "<tr>\n";
    		$i++;
		}
		return $res;
	}
	
	private function _makeForm(){
		global $G_PREF_LIST;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
		if($this->m_objValidate->isNull($this->m_value['pageno']))	$this->m_value['pageno'] = 1;
	}

	private function _createCondition(){
		$condition = "type='".HISTORY_TYPE4."'";
	
		if(axts('start_date', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " generate_date >= '".$this->m_value['start_date']."'";
		}
		if(axts('end_date', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " generate_date <= '".$this->m_value['end_date']."'";
		}
		if(axts('company_name', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " M.company_name like '%".$this->m_value['company_name']."%'";
		}
		if(axts('pref', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " M.pref = '".$this->m_value['pref']."'";
		}
		return $condition;
	}
	private function _csv_title(){
		return array(
			'履歴ID',
			'日付',
			'時間',
			'会員ID',
			'法人名',
			'担当者お名前',
			'カテゴリ/製品名',
			'ファイル',
		);
	}
	private function _csv_data($res){
		$fld = 'H.id,H.generate_date,H.generate_time,H.kdn_member_id,M.company_name,M.charge_name,H.note1,H.note2,H.note3';
		$data = array();
		if(!$res)  return $data;
		//while($row = mysql_fetch_array($res, MYSQL_ASSOC)){
		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			foreach($row as $fld=>$v){
				if(in_array($fld,array('type','history_id','note3'))){
					continue;
				}else{
					$data[$fld] = $v;
				}
			}
			$datas[] = $data;
		}
		return $datas;
	}
}
$a4140 = new a4140();
$a4140->a4140();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>