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

require_once(dirname(__FILE__) . '/../../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class index extends Base{

	public function index(){
		parent::Base();
	}

	public function Show(){
		if($this->checkLoged() == false){
			header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
			exit;
		}
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
				'history_id' => $this->m_objDB->mDB->lastInsertId(),
				'type' => HISTORY_TYPE4,
			);
			$this->Add('kdn_history',$data);

			// mail
			$this->_send_download_mail($data['note1'],$data['note2']);

			// download
			$path = $this->products_info($this->m_vARGV['pid'],$this->m_vARGV['pname']);
			$this->header_for_download($path);
		}

		$this->_makeForm();
		$this->m_value['pankuzu'] = '各種データダウンロード一覧';
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _send_download_mail($note1,$note2){
		$from = $this->get_admin_mail();
		$to = $this->logedin_member_info('email_address');
		$to = '';
		$subject = '';
		$body = '';
		$pref = $this->logedin_member_info('pref');
		$to_admin = $this->setFromAddress(MAIL_TYPE10,$pref);
		$body_admin = $this->makeMailDataMemberInfo();
		$subject_admin = $this->createMailSubject(MAIL_TYPE10,$pref,'','',$note1);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject_admin,$note1."\n".$note2."\n".MAIL_BODY_SEPARETION.$body_admin);
		$this->m_objMail->send_user_mail();
	}

	private function _makeForm(){

		$condition = 'top_category_id=2';
		$this->Search('kdn_large_category','*',$condition,'id asc');
		$result = $this->m_objDB->getResult();
		$res = '';
		$cnt =1;
		$contentCounts = array();
		foreach ($result as $row) {
			$id = $row['id'];
			if($cnt%2==0)	$cnt++;
			list($count,$data) = $this->list_contents($id,$cnt);
			$cnt += $count;
			if($count>0){
				for ($dcount = 0; $dcount < count($data); $dcount++) {
					$str = $dcount + 1;
					$this->m_value["content_list{$id}-" . $str] = $data[$dcount];
					$contentCounts[$id] = $str;
				}
			}
		}
		$this->m_value["content_count"] = $contentCounts;
	}


}
$cl = new index();
$optidx = $cl->index();
$data = $cl->m_value;
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>