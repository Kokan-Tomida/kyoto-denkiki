<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a2100.php 製品情報一覧　検索
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a2100 extends Base{

	public function a2100(){
		parent::Base();
	}
	
	public function Show(){
		global $a2100_form;
		$template = $this->getViewHTML(get_class());
		if(is_set('to_clear', $this->m_vARGV,NULL)){
			$this->m_vARGV = array();
		}
		
		$this->initValue($a2100_form);
		$this->m_value['menu_g'] = G02;
			
		if(axts('mode', $this->m_vARGV) == 'addnew'){
			header("location: a2111.php");
			exit;
		}
		if(axts('mode', $this->m_vARGV) == 'numbering'){
			header("location: a2141.php");
			exit;
		}

		if(is_set('to_up', $this->m_vARGV, NULL)){
			$param = get_key_one($this->m_vARGV['to_up'],0);
			list($target_id,$target_order) = $this->m_objCommon->getOrderParam($param);
			$this->up_p($this->m_value['large_category_id'],$this->m_value['middle_category_id'],$target_id,$target_order);
		}
		if(is_set('to_down', $this->m_vARGV, NULL)){
			$param = get_key_one($this->m_vARGV['to_down'],0);
			list($target_id,$target_order) = $this->m_objCommon->getOrderParam($param);
			$this->down_p($this->m_value['large_category_id'],$this->m_value['middle_category_id'],$target_id,$target_order);
		}
		if(is_set('to_edit', $this->m_vARGV, NULL)){
			$target = get_key_one($this->m_vARGV['to_edit'],0);
			header("location: a2121.php?target=".$target);
			exit;
		}
		if(is_set('to_delete', $this->m_vARGV, NULL)){
			$target = get_key_one($this->m_vARGV['to_delete'],0);
			$this->delete_p($target);
		}

		$this->_makeForm();
		$this->m_value['list'] = $this->_listView();
		if(is_set('to_csv', $this->m_vARGV, NULL)){
			$result = $this->_list(true);
			if($this->getNumCount() > 0){
				$data = array();
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
					$dt = array();
					foreach($row as $f=>$v){
						if(in_array($f,array('contents10','contents11','contents20','contents30','contents40'))){
							$dt[$f] = (strlen($v) != 0)	? '○' : '';							
						}else{
							$dt[$f] = $v;
						}
					}
					$data[] = $dt;
				}
				$this->m_objCSV->setResource($data);
				$this->m_objCSV->setTitle($this->_csvTitles());
				$this->m_objCSV->CreateCSVFile(get_class());
				exit;
			}
		}

		$this->m_value['pagenavi'] = $this->m_objCommon->setPageNo4($this->m_value['pageno'],$this->m_value['total_count']);
		$this->m_value['search_result'] = $this->m_objCommon->searchResult($this->m_value['pageno'],$this->m_value['total_count']);
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		//$this->makeFormLargeCategory();
		if($this->m_objValidate->isNull($this->m_value['pageno'])){
			$this->m_value['pageno'] = 1;
		}
		$select_large_category_id = $this->makeFormLargeCategory();

		$condition = ($select_large_category_id != '') ? 'large_category_id='.$select_large_category_id : '';
		$order = 'order_of_row asc';	
		$list = $this->makeList_middle_series('kdn_middle_category', array('id','middle_category_name','series_name'), $condition,$order);
		$select_middle_category_id = axts('middle_category_id',$this->m_value,'');
		$this->m_value['option_middle_category_id'] = $this->m_objCommon->makeOption($list,$select_middle_category_id);
		
	}

	private function _list($csv_flg=false){
		$condition = '';
		if(axts('large_category_id', $this->m_value)){
			$condition .= "P.large_category_id = ".$this->m_value['large_category_id'];
//			if(axts('middle_category_id', $this->m_value)){
//				$this->Search('kdn_middle_category','*','large_category_id='.$this->m_value['large_category_id'].' and id='.$this->m_value['middle_category_id']);
//				if($this->getNumCount() == 0)	$this->m_value['middle_category_id'] = '';
//			}

		}
		if(axts('middle_category_id', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= "P.middle_category_id = ".$this->m_value['middle_category_id'];
		}
		if(strlen(axts('products_name', $this->m_value)) != 0){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= "products_name like '%".$this->m_value['products_name']."%'";
		}
		//$fld = ' P.*,L.large_category_name,M.middle_category_name,M.series_name ';
		$fld = ' P.id, P.large_category_id, L.large_category_name,';
		$fld .= 'P.middle_category_id, M.middle_category_name, M.series_name,';
		$fld .= 'P.products_name, P.order_of_row, P.contents10, P.contents11, ';
		$fld .= 'P.contents20, P.contents30, P.contents40 ';
		$order = ' P.large_category_id ASC,P.middle_category_id ASC,P.order_of_row ASC';
		$table = 'kdn_products P left outer join kdn_middle_category M on P.middle_category_id=M.id';
		$table .= ' left outer join kdn_large_category L on P.large_category_id=L.id';
		$this->Search($table,$fld,$condition,$order);
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		if($csv_flg == true)	return $result;
		$n = $this->getNumCount();
		$this->m_value['total_count'] = $n;
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
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$id = $row['id'];
			$classnm = ($i%2 == 0) ? 'cellbg01' : '';
			$class = ($i%2 == 0) ? 'class="cellbg01"' : '';
			$res .= "<tr>\n";
			$r = ($row['order_of_row'] == '0') ? '' : $row['order_of_row'];		    
			$res .= "<td class=\"txtcenter ".$classnm."\">".$r."</td>\n";
			$s = $row['large_category_name'].'<br />'.$row['middle_category_name'].' '.$row['series_name'];
			$res .= "<td class=\"pd-left10 ".$classnm."\">".$s."</td>\n";
			$res .= "<td class=\"pd-left10 ".$classnm."\">".$row['products_name']."</td>\n";
			$s = ($row['contents10']) ? '○' : '';
			$res .= "<td class=\"txtcenter ".$classnm."\">".$s."</td>\n";
			$s = ($row['contents11']) ? '○' : '';
			$res .= "<td class=\"txtcenter ".$classnm."\">".$s."</td>\n";
			$s = ($row['contents20']) ? '○' : '';
			$res .= "<td class=\"txtcenter ".$classnm."\">".$s."</td>\n";
			$s = ($row['contents30']) ? '○' : '';
			$res .= "<td class=\"txtcenter ".$classnm."\">".$s."</td>\n";
			$s = ($row['contents40']) ? '○' : '';
			$res .= "<td class=\"txtcenter ".$classnm."\">".$s."</td>\n";
			$res .= "<td class=\"txtcenter ".$classnm."\"><div class=\"pd-top10 pd-bottom7 pd-left7\"><input type=\"submit\" name=\"to_edit[".$id."]\" value=\" \" class=\"edit_btn\"  /></div></td>\n";
			$res .= "<td class=\"txtcenter ".$classnm."\"><div class=\"pd-top10 pd-bottom7 pd-left7\"><input type=\"submit\" name=\"to_delete[".$id."]\" value=\" \" class=\"delete_btn\" onclick=\"return confirm('指定の製品を削除してもよろしいですか？');\" /></div></td>\n";
			$res .= "</tr>\n";
    		$i++;
		}
		return $res;
	}
	
	private function _csvTitles(){
		return array(
			'ID',
			'大カテゴリID',
			'大カテゴリ名',
			'中カテゴリID',
			'中カテゴリ名',
			'シリーズ名',
			'製品名',
			'表示順',
			'外形図PDF',
			'外形図DXF',
			'仕様書PDF',
			'取扱説明書PDF',
			'その他PDF',
		);
	}
	
}
new a2100();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>