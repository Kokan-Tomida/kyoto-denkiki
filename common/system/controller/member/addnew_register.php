<?php

/**--------------------------------------------------------------------
  ProjectName :
  description : 新規会員登録の「本登録」を行う
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once(dirname(__FILE__) . '/../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class this_registration extends Base{

	public function this_registration(){
		parent::Base();
	}

	public function Show(){

		$res = $this->_paramCheck();
		if($res == 9){
			// 本登録有効期限切れ
			header('location: index.php?first=9');
			exit;
		}elseif($res == 2){
			// 無効なURL
			header('location: index.php?first=2');
			exit;
		}
		// 会員本登録
		$id = $res['id'];
		$pwd = substr(makeRandamVariable40(),1,MEMBER_PWD_LENGTH);
		$data = array(
				'id'=>$id,
				//'temporary_registration' => null,//
				//'validity' => null,
				'status' => MEMBERSHIP2,
				'this_registration' => date('Y-m-d H:i:s'),
				//'query_strings' => null,
				'member_id' => $res['email_address'],
				'member_pwd' =>	$pwd,
			);
		$res['member_pwd'] = $pwd;
		$this->Edit('kdn_member','id='.$id,$data);

		// mail
		$from = $this->get_admin_mail();
		$data = $this->_makeMailData($res);
		list($subject,$body) = $this->createMailBodys('4',$data);
		$pref = $res['pref'];
		$to_admin = $this->setFromAddress(MAIL_TYPE4,$pref);
		$this->m_objMail->set_ini($from,$res['email_address'],$subject,$body,$to_admin,$subject,$body);
		$this->m_objMail->send_user_mail();// 分岐2

		header('location: index.php?first=1');
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
			return 2;
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
$cl = new this_registration();
$cl->this_registration();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>