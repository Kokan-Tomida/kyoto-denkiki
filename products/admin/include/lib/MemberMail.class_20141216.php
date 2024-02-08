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

	/*---------------------------------------------------------
	description : 		メール送信 text mail
	return: bool
	---------------------------------------------------------*/
	function send_user_mail(){

		if($this->m_to == '') 	return false;
		if(($this->m_to) and ($this->m_body)) {
			mb_language("Japanese");
			//$subject = mb_convert_encoding($arg_subject , "SJIS" , mb_detect_encoding($arg_subject) );

			$headers = $this->makeHeader();
			// ユーザむけメール送信
			$ret = mb_send_mail($this->m_to,$this->m_subject,$this->m_body,$headers);
			// ADMINむけメール送信 
			$ret1 = mb_send_mail($this->m_from,$this->m_subject,$this->m_body,$headers);
			if ($ret == false ) return false;
			return true;
		}else{
			return false;
		}
	} // sendMail


	function makeHeader(){
		$header = "";
		global $YOYAKU_ADMIN_MAIL , $MAIL_FROM_NAME; 
		$header = "Content-Type: Text/Plain; charset=iso-2022-jp\n".
				"From: \"".MAIL_FROM_NAME."\"<".$this->m_from.">\n".
				"Reply-To: ".$YOYAKU_ADMIN_MAIL;
/*
		$header = "Content-Type: Text/Plain; charset=iso-2022-jp\n".
				"From: \"".$MAIL_FROM."\"\n".
				"Reply-To: ".$MAIL_FROM;
*/
		return $header;		
	}
	
	function set_ini($from,$to,$subject,$body){
		$this->m_from = $from;
		$this->m_to = $to;
		$this->m_subject = $subject;
		$this->m_body = $body;
	}

	
}
/* COPYRIGHT(C) 2008 DeeSystem. ALL RIGHTS RESERVED. */
?>