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

require_once('../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class this_registration extends Base{

	public function this_registration(){
		parent::Base();
	}
	
	public function Show(){
		
		$res = $this->_paramCheck();
		if($res == 9){
			header('location: information.php');
			exit;
		}elseif($res == 1){
			header('location: index.php');
			exit;
		}
		$id = $res['id'];
		$pwd = substr(makeRandamVariable40(),1,MEMBER_PWD_LENGTH);
		$data = array(
				'id'=>$id,
				'temporary_registration' => null,
				'validity' => null,
				'status' => MEMBERSHIP2,
				'this_registration' => date('Y-m-d H:i:s'),
				//'query_strings' => null,
				'member_id' => $res['email_address'],
				'member_pwd' =>	$pwd,		
			);
		$res['member_pwd'] = $pwd;	
		$this->Edit('kdn_member','id='.$id,$data);
		
		$mem_info = $this->logedin($res['email_address'],$pwd);
		if($mem_info != false){
			$this->m_value['member_id'] = $mem_info['member_id'];
			$this->m_value['member_pwd'] = $mem_info['member_pwd'];
			$this->setLoginHistory($mem_info['id']);
			$this->setLoginSess();
		}		
		
		// mail
		$from = $this->get_admin_mail();
		$data = $this->_makeMailData($res);
		list($subject,$body) = $this->createMailBodys('4',$data);
		$this->m_objMail->set_ini($from,$res['email_address'],$subject,$body);
		$this->m_objMail->send_user_mail();

		header('location: addnew_complete.php');
		exit;

	}
	
	private function _paramCheck(){
		if(!axts('QUERY_STRING',$_SERVER))	return 9;
		$strings = $_SERVER['QUERY_STRING'];
		if(strlen($strings) != 40 )	return 9;
		$condition = "query_strings = '".$strings."'";
		$this->Search('kdn_member','*',$condition);
		$res = $this->getOneRow();
		if(!$res)	return 9;
		if($res['status'] == MEMBERSHIP2){
			return 1;			
		}
		if(date('Y-m-d H:i:s') > $res['validity'])	return 9;
		return $res;			
	}

	private function _makeMailData($res){
		$data = array(
			'company_name' => $res['company_name'],
			'section' => $res['section'],
			'charge_name' => $res['charge_name'],
			'email_address' => $res['email_address'],
			'member_pwd' => $res['member_pwd'],
			'member_login_url' => MEMBER_LOGIN_URL,
		);
		return $data;
	}
	

	
}
new this_registration();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>