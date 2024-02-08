<?php

/**--------------------------------------------------------------------
  description :		MemberMail.class.php
  ProjectName :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

class MemberMail{

	var $m_from;
	var $m_subject;
	var $m_body;
	var $m_to;
	var $m_to_admin;
	var $m_subject_admin;
	var $m_body_admin;

	/*---------------------------------------------------------
	description : 		メール送信 text mail
	return: bool
	---------------------------------------------------------*/
	function send_user_mail(){

_log("send_user_mail--m_to-m_to_admin-m_body-m_body_admin-m_subject-m_to_subject---");
_log(var_export($this->m_to,1));
_log(var_export($this->m_to_admin,1));
_log(var_export($this->m_body,1));
_log(var_export($this->m_body_admin,1));
_log(var_export($this->m_subject,1));
_log(var_export($this->m_subject_admin,1));
_log("//send_user_mail--------");

//	if(isset($this->m_to_admin)){
//		mb_language("Japanese");
//		$headers = $this->makeHeader();
//		$ret = mb_send_mail($this->m_to_admin,"TEST",$this->m_body_admin,$headers);
//		$ret = mb_send_mail("products@kdn.co.jp",$this->m_subject_admin,$this->m_body_admin,$headers);
//		return true;
//	}

		if(($this->m_to == '') and (count($this->m_to_admin) == 0))	return false;
		mb_language("Japanese");
		$headers = $this->makeHeader();

		if(($this->m_to == '') and (count($this->m_to_admin) != 0) and ($this->m_body_admin != '') and ($this->m_subject_admin != '')) {
			// 管理者宛送信　会員送信なし[1]
			//echo "1";exit;
			foreach($this->m_to_admin as $ad){
				$ret = mb_send_mail($ad,$this->m_subject_admin,$this->m_body_admin,$headers);
				$this->checkMailResult($ret);
			}
			return true;
		}elseif(($this->m_to != '') and (count($this->m_to_admin) != 0) and ($this->m_body != '') and ($this->m_subject_admin != '')) {
			// 管理者宛送信　会員送信あり[2]
			// ユーザむけメール送信
			//echo "2";exit;
			$ret = mb_send_mail($this->m_to,$this->m_subject,$this->m_body,$headers);
			$this->checkMailResult($ret);
			foreach($this->m_to_admin as $ad){
				$ret = mb_send_mail($ad,$this->m_subject_admin,$this->m_body_admin,$headers);
				$this->checkMailResult($ret);
			}
			return true;
		}elseif(($this->m_to != '') and (count($this->m_to_admin) == 0) and ($this->m_body != '')) {
			// 会員宛メール送信、管理者宛マスターのアドレス送信　２通[3]
			//$subject = mb_convert_encoding($arg_subject , "SJIS" , mb_detect_encoding($arg_subject) );
			// ユーザむけメール送信
			//echo "3";exit;
			$ret = mb_send_mail($this->m_to,$this->m_subject,$this->m_body,$headers);
			$this->checkMailResult($ret);
			// ADMINむけメール送信
			$ret1 = mb_send_mail($this->m_from,$this->m_subject,$this->m_body,$headers);
			$this->checkMailResult($ret1);
			if ($ret == false ) return false;
			return true;
		}else{
			return false;
		}
	} // sendMail


	function makeHeader(){
		$header = "";
		global $YOYAKU_ADMIN_MAIL , $MAIL_FROM_NAME;

		$fromName = mb_encode_mimeheader (mb_convert_encoding(MAIL_FROM_NAME,"ISO-2022-JP","AUTO"));
		$header = "Content-Type: Text/Plain; charset=iso-2022-jp\n".
				"From: \"".$fromName."\"<".$this->m_from.">\n".
				"Reply-To: ".$YOYAKU_ADMIN_MAIL;
/*
		$header = "Content-Type: Text/Plain; charset=iso-2022-jp\n".
				"From: \"".$MAIL_FROM."\"\n".
				"Reply-To: ".$MAIL_FROM;
*/
		return $header;
	}

	function set_ini($from,$to,$subject,$body,$to_admin=array(),$subject_admin='',$body_admin=''){
		$this->m_from = $from;
		$this->m_to = $to;
		$this->m_subject = $subject;
		$this->m_body = $body;
		if((is_array($to_admin)) and (count($to_admin) > 0)){
			$this->m_to_admin = $to_admin;
		}
		$this->m_subject_admin = $subject_admin;
		$this->m_body_admin = $body_admin;
	}


	// メールが送信できない場合、エラーページに遷移
	function checkMailResult($result) {
		//if ($result === false) {
		//	_log("send mail error");
		//	header("Location: " . ERROR_MAIL_PAGE);
		//	exit;
		//}
		return true;
	}

}
/* COPYRIGHT(C) 2008 DeeSystem. ALL RIGHTS RESERVED. */
?>