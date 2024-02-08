<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a3100.php 会員情報一覧　検索
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/ProcessStart.inc');

class a3100 extends Base{

	public function a3100(){
		parent::Base();
	}
	
	public function Show(){
		global $a3100_form;
		$template = $this->getViewHTML(get_class());
		if(is_set('to_clear', $this->m_vARGV, NULL)){
			$this->m_vARGV = array();
		}
		$this->initValue($a3100_form);
		$this->m_value['menu_g'] = G03;
		
		if(axts('mode', $this->m_vARGV) == 'addnew'){
			header('location: a3111.php');
			exit;
		}
		if(is_set('to_history', $this->m_vARGV, NULL)){
			$target_id = get_key_one($this->m_vARGV['to_history'],0);
			header('location: a3130.php?target='.$target_id);
			exit;
		}
		if(is_set('to_edit', $this->m_vARGV, NULL)){
			$target_id = get_key_one($this->m_vARGV['to_edit'],0);
			header('location: a3121.php?target='.$target_id);
			exit;
		}
		if(is_set('to_withdrawal', $this->m_vARGV, NULL)){
			$target_id = get_key_one($this->m_vARGV['to_withdrawal'],0);
			$this->change_withdrawal($target_id);
		}
		
		if(is_set('to_csv', $this->m_vARGV, NULL)){
			$result = $this->_list(true);
			if($this->m_value['total_count'] > 0){
				$data = $this->_csv_data($result);
				$this->m_objCSV->setResource($data);
				$this->m_objCSV->setTitle($this->_csv_title());
				$this->m_objCSV->CreateCSVFile(get_class());
				$this->m_value['mode'] = '';
				exit;
			}
		}

		$this->_makeForm();
		$this->m_value['list'] = $this->_listView();
		$this->m_value['pagenavi'] = $this->m_objCommon->setPageNo4($this->m_value['pageno'],$this->m_value['total_count']);
		$this->m_value['search_result'] = $this->m_objCommon->searchResult($this->m_value['pageno'],$this->m_value['total_count']);
		
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $G_PREF_LIST;
		// option_pref
		$this->m_value['option_pref'] = $this->m_objCommon->makeOption($G_PREF_LIST,axts('pref',$this->m_value));
		// check_withdrawal
		$this->m_value['check_withdrawal'] = (axts('withdrawal',$this->m_value) == MEMBERSHIP3) ? ' checked' : '';
		if($this->m_objValidate->isNull($this->m_value['pageno']))	$this->m_value['pageno'] = 1;
	}

	private function _validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = array();
		$res = (count($msg) > 0) ? implode('<br />',$msg) : '';
		return $res;
	}
	
	private function _createCondition(){
		$condition = '';
		if(axts('this_registration', $this->m_value)){
			$condition .= " DATE(this_registration) = '".$this->m_value['this_registration']."'";
		}
		if(axts('company_name', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " company_name like '%".$this->m_value['company_name']."%'";
		}
		if(axts('charge_name', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " charge_name like '%".$this->m_value['charge_name']."%'";
		}
		if(axts('email_address', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " email_address like '%".$this->m_value['email_address']."%'";
		}
		if(axts('pref', $this->m_value)){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " pref = '".$this->m_value['pref']."'";
		}
		if(axts('withdrawal', $this->m_value) == MEMBERSHIP3){
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " status in ('".MEMBERSHIP1."','".MEMBERSHIP2."','".MEMBERSHIP3."')";
		}else{
			$condition .= ($condition=='') ? '' : ' and ';
			$condition .= " status in ('".MEMBERSHIP1."','".MEMBERSHIP2."')";
		}
		return $condition;
	}
	
	private function _list($all = false){
		$this->m_value['total_count'] = 0;
		$condition = $this->_createCondition();
		$fld = ' *';
		$order = ' id desc';
		$table = 'kdn_member';
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
		global $MEMBERSHIP;
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
			$res .= "<tr>\n";
			$res .= "<td class=\"txtcenter\">".$id."</td>\n";
			$s = '';
			if($row['status'] == MEMBERSHIP1){
				$s = $row['temporary_registration'].'<br />'.$MEMBERSHIP[MEMBERSHIP1];
			}elseif($row['status'] == MEMBERSHIP2){
				$s = $row['this_registration'].'<br />'.$MEMBERSHIP[MEMBERSHIP2];
			}elseif($row['status'] == MEMBERSHIP3){
				$s = $row['withdrawal_registration'].'<br />'.$MEMBERSHIP[MEMBERSHIP3];
			}
			$res .= "<td class=\"pd-left10\">".$s."</td>\n";
			$s = $row['company_name'].'<br />'.$row['charge_name'];
			$res .= "<td class=\"pd-left10\">".$s."</td>\n";
			$res .= "<td class=\"pd-left10\">".$row['telno']."</td>\n";
			$res .= "<td class=\"pd-left10\">".$row['email_address']."</td>\n";
			$res .= "<td ".$class."><div class=\"pd-top7 pd-bottom7 pd-left7\"><input type=\"submit\" name=\"to_history[".$id."]\" value=\" \" class=\"history_btn\"  /></div></td>\n";
			$res .= "<td ".$class."><div class=\"pd-top7 pd-bottom7 pd-left7\"><input type=\"submit\" name=\"to_edit[".$id."]\" value=\" \" class=\"edit_btn\" /></div></td>\n";
			$res .= "<td ".$class."><div class=\"pd-top7 pd-bottom7 pd-left7\"><input type=\"submit\" name=\"to_withdrawal[".$id."]\" value=\" \" class=\"withdraw_btn\" onclick=\"return confirm('退会処理を行ってもよろしいですか？');\" /></div></td>\n";
			$res .= "</tr>\n";
    		$i++;
		}
		return $res;
	}
	
	private function _csv_title(){
		return array(
			'ID',
			'法人名',
			'郵便番号1',
			'郵便番号2',
			'都道府県',
			'住所１',
			'電話番号',
			'FAX番号',
			'所属部署',
			'担当者名',
			'E-Mail',
			'備考',
			'ステータス',
			'本登録日時',
			'パスワード',
		);
	}

	private function _csv_data($result){
		if(!$result)	return null;
		global $G_PREF_LIST,$MEMBERSHIP;
		$data = array();
		$ar = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$ar = array();
			foreach($row as $fld=>$val){
				if(in_array($fld,array('company_kana','url','query_strings','temporary_registration','validity','withdrawal_registration','member_id','created','modified','address2')))	continue;
				if($fld == 'pref'){
					if(in_array($val,array_keys($G_PREF_LIST))){
						$ar[$fld] = $G_PREF_LIST[$val];
					}else{
						$ar[$fld] = '';
					}
				}elseif($fld == 'status'){
					if(in_array($val,array_keys($MEMBERSHIP))){
						$ar[$fld] = $MEMBERSHIP[$val];
					}else{
						$ar[$fld] = '';
					}
				}else{
					$ar[$fld] = $val;
				}	
			}
			$data[] = $ar;
		}
		return $data;
	}
	
}
new a3100();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>