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

require_once('../../config/test/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class download_list extends Base{

	public function download_list(){
		parent::Base();
	}
	
	public function Show(){
		if($this->checkLoged() != true){
			header('location: index.php');
			exit;		
		}
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_OPT_DOWNLOAD);
		$this->initValue(array('contents_list'=>''));
		
		if((axts('pid',$this->m_vARGV) != '') and (axts('pname',$this->m_vARGV) != '')){
			$kdn_member_id = $this->logedin_member_info('id');
			// history
			$data = array(
				'kdn_member_id' => $kdn_member_id,
				'download_date' => date('Y-m-d'),
				'download_time' => date('H:i:s'),
				'kdn_products_id' => $this->m_vARGV['pid'],
				'contents_name' => $this->m_vARGV['pname'],
			);
			$this->Add('kdn_download_history',$data);
			
			$pinfo = $this->products_detail_info($this->m_vARGV['pid']);
			$data = array(
				'kdn_member_id' => $kdn_member_id,
				'generate_date' => date('Y-m-d'),
				'generate_time' => date('H:i:s'),
				'note1' => $this->products_note1($pinfo),
				'note2' => $this->products_note2($pinfo,$this->m_vARGV['pname']),
				'history_id' => mysql_insert_id(),
				'type' => HISTORY_TYPE4,
			);
			$this->Add('kdn_history',$data);
			
			// download
			$path = $this->products_info($this->m_vARGV['pid'],$this->m_vARGV['pname']);
			$this->header_for_download($path);
		}
		
		$this->_makeForm();
		$this->m_value['pankuzu'] = '各種データダウンロード一覧';
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		
		$type_o[4] = "<h3 id=\"led\" class=\"mg-top30\"><img src=\"images/subtitle01.gif\" alt=\"画像処理用LED照明装置\" width=\"960\" height=\"25\" /></h3>";
		$type_o[5] = "<h3 id=\"fluorescent\" class=\"mg-top30\"><img src=\"images/subtitle02.gif\" alt=\"画像処理用蛍光灯照明\" width=\"960\" height=\"25\" /></h3>";
		$type_o[6] = "<h3 id=\"xenon\" class=\"mg-top30\"><img src=\"images/subtitle03.gif\" alt=\"キセノン管ストロボ装置\" width=\"960\" height=\"25\" /></h3>";
		$type_o[7] = "<h3 id=\"other\" class=\"mg-top30\"><img src=\"images/subtitle04.gif\" alt=\"その他\" width=\"960\" height=\"25\" /></h3>";
		
		$condition = 'top_category_id=2';
		$this->Search('kdn_large_category','*',$condition,'id asc');
		$result = $this->m_objDB->getResult();
		$res = '';
		$cnt =1;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$id = $row['id'];
			$title = $type_o[$id];
			if($cnt%2==0)	$cnt++;
			list($count,$list) = $this->list_contents($id,$cnt);
			$cnt += $count;
			if($count > 0){ 
				$res .= $title.$list;
			}
		}				
		$this->m_value['contents_list'] = $res;
	}
	
	
}
new download_list();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>