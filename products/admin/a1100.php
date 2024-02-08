<?php

/**--------------------------------------------------------------------
  ProjectName :  	Kyoto Denkiki Co.,Ltd.
  					https://www.kdn.co.jp/products/
  description :		a1100.php
  					category is indicated by list.
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');
class a1100 extends Base{

	var $m_searching = false;

	public function a1100(){
		parent::Base();
	}

	public function Show(){
		global $a1100_form;
		$template = $this->getViewHTML(get_class());
		if(is_set('to_clear', $this->m_vARGV, NULL)){
			$this->m_vARGV = array();
		}

		$this->initValue($a1100_form);
		$this->m_value['menu_g'] = G01;

		if(axts('large_category_id', $this->m_value)){
			$this->m_searching = true;
		}

		if(axts('mode', $this->m_vARGV) == 'addnew'){
			header("location: a1111.php");
			exit;
		}
		if(is_set('to_up', $this->m_vARGV, NULL)){
			$param = get_key_one($this->m_vARGV['to_up'],0);
			list($target_id,$target_order) = $this->m_objCommon->getOrderParam($param);
			$this->up_m($this->m_value['large_category_id'],$target_id,$target_order);
		}
		if(is_set('to_down', $this->m_vARGV, NULL)){
			$param = get_key_one($this->m_vARGV['to_down'],0);
			list($target_id,$target_order) = $this->m_objCommon->getOrderParam($param);
			$this->down_m($this->m_value['large_category_id'],$target_id,$target_order);
		}
		if(is_set('to_edit', $this->m_vARGV, NULL)){
			$target = get_key_one($this->m_vARGV['to_edit'],0);
			header("location: a1121.php?target=".$target);
			exit;
		}
		if(is_set('to_delete', $this->m_vARGV, NULL)){
			$target = get_key_one($this->m_vARGV['to_delete'],0);
			if($this->delete_m($target) === false){
				$template .= "<script> alert('製品が登録されているため削除できません'); </script>";
			}
		}

		$this->_makeForm();
		$this->m_value['list'] = $this->_listView();
		$this->m_value['pagenavi'] = ($this->m_searching == false) ? $this->m_objCommon->setPageNo4($this->m_value['pageno'],$this->m_value['total_count']) : '';
		$this->m_value['search_result'] = $this->m_objCommon->searchResult($this->m_value['pageno'],$this->m_value['total_count'],$this->m_searching);
		$this->m_value['y'] = axts('y',$this->m_vARGV);
		$this->m_value['x'] = axts('x',$this->m_vARGV);

		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _makeForm(){
		$select_large_category_id = $this->makeFormLargeCategory();

		if($this->m_objValidate->isNull($this->m_value['pageno'])){
			$this->m_value['pageno'] = 1;
		}
	}

	private function _list(){
		$condition = '';
		if(axts('large_category_id', $this->m_value)){
			$condition = 'large_category_id = '.$this->m_value['large_category_id'];
		}
		$fld = ' M.id,L.large_category_name,M.middle_category_name,M.series_name,M.image_path,M.order_of_row ';
		$order = ' M.large_category_id ASC,M.order_of_row ASC';
		$this->Search('kdn_middle_category M left outer join kdn_large_category L on M.large_category_id=L.id',$fld,$condition,$order);
		$result = $this->m_objDB->getResult();
		if(!$result)	return null;
		$n = $this->getNumCount();
		$this->m_value['total_count'] = $n;
		if($this->m_searching == false){
			$no = (axts('pageno', $this->m_value)) ? $this->m_value['pageno'] : 1;
			$offset = VIEW_PAR_PAGE * ($no -1);
    		$limit = $offset." , ".VIEW_PAR_PAGE;
			$this->Search('kdn_middle_category M left outer join kdn_large_category L on M.large_category_id=L.id',$fld,$condition,$order,'',$limit);
			$result = $this->m_objDB->getResult();
		}
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
		    $res .= "<tr>\n";
			$r = ($row['order_of_row'] == '0') ? '' : $row['order_of_row'];
		    $res .= "  <td class=\"txtcenter ".$classnm."\">".$r."</td>\n";
		    $res .= "  <td class=\"pd-left10 ".$classnm."\">".$row['large_category_name']."</td>\n";
		    $res .= "  <td class=\"pd-left10 ".$classnm."\">".$row['middle_category_name'].'<br />'.$row['series_name']."</td>\n";
		    $s = ($this->m_objValidate->isNull($row['image_path'])) ? "" : "○";
		    $res .= "  <td class=\"txtcenter ".$classnm."\">".$s."</td>\n";

		    $res .= "  <td ".$class.">\n";
		    $res .= "    <div class=\"clearfix pd-top10 pd-bottom7 pd-left14\">\n";
		    //$mode = "'"."edit"."'";
		    $res .= "      <div class=\"left\"><input type=\"submit\" name=\"to_edit[".$id."]\" value=\" \" class=\"edit_btn\"  /></div>\n";
		    $res .= "      <div class=\"left pd-left10\"><input type=\"submit\" name=\"to_delete[".$id."]\" value=\" \" class=\"delete_btn\" onclick=\"return confirm('指定のカテゴリを削除してもよろしいですか？');\" /></div>\n";
		    $res .= "    </div>\n";
		    $res .= "  </td>\n";

		    $res .= "  <td ".$class.">\n";
		    $p = $id.':'.$row['order_of_row'];
		    $res .= "    <div class=\"clearfix pd-top10 pd-bottom7 pd-left13\">\n";
			if($sel == ''){
			    if($i != 1){
			    	$res .= "      <div class=\"left\"><input type=\"submit\" name=\"to_up[".$p."]\" value=\" \" class=\"up_btn\" ".$sel." onclick=\"getScrollPosition();\" /></div>\n";
			    }else{
			    	$res .= "      <div class=\"left\" style=\"width:70px;\">&nbsp;</div>\n";
			    }
			    if($i != $this->m_value['total_count']){
			    	$res .= "      <div class=\"left pd-left9\"><input type=\"submit\" name=\"to_down[".$p."]\" value=\" \" class=\"down_btn\" ".$sel." onclick=\"getScrollPosition();\" /></div>\n";
			    }
			}else{
				$res .= '&nbsp;';
			}
		    $res .= "    </div>\n";
		    $res .= "  </td>\n";
		    $res .= "</tr>\n";
     		$i++;
		}
		return $res;
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}



}
$a1100 = new a1100();
$a1100->a1100();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>