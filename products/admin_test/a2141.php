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

class a2141 extends Base{
	
	var $m_searching;

	public function a2141(){
		parent::Base();
	}
	
	public function Show(){
		global $a2141_form,$G_VALIDATE_MESSAGE;
		$template = $this->getViewHTML(get_class());
		$this->initValue($a2141_form);
		$this->m_value['total_count'] = 0;		
		
		//if(is_set('to_choice', $this->m_vARGV, NULL)){
		//	$this->m_searching = true;
		//}
		
		$this->_makeForm();
		
		if(is_set('to_up', $this->m_vARGV, NULL)){
			$this->m_searching = true;
			$param = get_key_one($this->m_vARGV['to_up'],0);
			list($target_id,$target_order) = $this->m_objCommon->getOrderParam($param);
			$this->up_p($this->m_value['large_category_id'],$this->m_value['middle_category_id'],$target_id,$target_order);
		}
		if(is_set('to_down', $this->m_vARGV, NULL)){
			$this->m_searching = true;
			$param = get_key_one($this->m_vARGV['to_down'],0);
			list($target_id,$target_order) = $this->m_objCommon->getOrderParam($param);
			$this->down_p($this->m_value['large_category_id'],$this->m_value['middle_category_id'],$target_id,$target_order);
		}
		
		$this->m_value['list'] = $this->_listView();
		if((axts('large_category_id', $this->m_value) == '') or (axts('middle_category_id', $this->m_value) == '')){
			$this->m_value['search_result'] = $G_VALIDATE_MESSAGE['val044'];
		}else{
			$this->m_value['search_result'] = $this->m_objCommon->searchResult(1,$this->m_value['total_count'],false);
		}
		$this->m_value['y'] = axts('y',$this->m_vARGV);
		$this->m_value['x'] = axts('x',$this->m_vARGV);
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		$select_large_category_id = $this->makeFormLargeCategory();
		$condition = ($select_large_category_id != '') ? 'large_category_id='.$select_large_category_id : '';
		$order = 'order_of_row asc';	
		$list = $this->makeList_middle_series('kdn_middle_category', array('id','middle_category_name','series_name'), $condition,$order);
		$select_middle_category_id = axts('middle_category_id',$this->m_value,'');
		$this->m_value['option_middle_category_id'] = $this->m_objCommon->makeOption($list,$select_middle_category_id);
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	
	private function _list(){
		//if($this->m_searching == false)		return null;
		$condition = '';
		if(axts('large_category_id', $this->m_value)){
			$condition .= "large_category_id = ".$this->m_value['large_category_id'];
_log(var_export(axts('middle_category_id', $this->m_value),1)); _log("81");
			if(axts('middle_category_id', $this->m_value)){
				$this->Search('kdn_middle_category','*','large_category_id='.$this->m_value['large_category_id'].' and id='.$this->m_value['middle_category_id']);
				if($this->getNumCount() == 0){
					$this->m_value['middle_category_id'] = '';
					return null;
				}
			}else{
				return null;
			}
		}else{
			return null;
		}
		if(axts('middle_category_id', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= "middle_category_id = ".$this->m_value['middle_category_id'];
		}
		$fld = ' P.* ';
		$order = ' P.large_category_id ASC,P.middle_category_id ASC,P.order_of_row ASC';
		$table = 'kdn_products P ';
		$this->Search($table,$fld,$condition,$order);
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		$n = $this->getNumCount();
		$this->m_value['total_count'] = $n;
		return $result;		
	}
	
	private function _listView(){
		$res = '';
		$result = $this->_list();
		if(!$result)	return $res;
		$sel = (axts('large_category_id', $this->m_value)) ? '' : 'disabled';
		$i = 1;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$id = $row['id'];
			$classnm = ($i%2 == 0) ? 'cellbg01' : '';
			$class = ($i%2 == 0) ? 'class="cellbg01"' : '';
			$r = ($row['order_of_row'] == '0') ? '' : $row['order_of_row'];		    
			$res .= "<tr>\n";
       		$res .= "<td class=\"txtcenter ".$classnm."\">".$r."</td>\n";
       		$res .= "<td class=\"pd-left10 ".$classnm."\">".$row['products_name']."</td>\n";
       		$res .= "<td ".$class.">\n";
         	$res .= "<div class=\"clearfix pd-top10 pd-bottom7 pd-left13\">\n";
         	$s = $id.':'.$row['order_of_row'];
         	if($i != 1){
           		$res .= "<div class=\"left\"><input type=\"submit\" name=\"to_up[".$s."]\" value=\" \" class=\"up_btn\" onclick=\"getScrollPosition();\" /></div>\n";
         	}else{
           		$res .= "<div class=\"left\" style=\"width:70px;\">&nbsp;</div>\n";
         	}
         	if($i != $this->m_value['total_count']){
           		$res .= "<div class=\"left pd-left9\"><input type=\"submit\" name=\"to_down[".$s."]\" value=\" \" class=\"down_btn\" onclick=\"getScrollPosition();\" /></div>\n";
		    }
           	$res .= "</div>\n";
			$res .= "</td>\n";
     		$res .= "</tr>\n";
     		$i++;
		}
		return $res;
	}
}
new a2141();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>