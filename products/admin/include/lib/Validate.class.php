<?php

/**--------------------------------------------------------------------
  description :		Validate.class.inc
  ProjectName :
  Created / Author :	0000/00/00
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

class Validate {

	/* 入力不正文字のエスケープ */
	function escape($aVal) {
		$ret = $aVal;
		$ret = chop($ret);
		$ret = stripslashes($ret);
		return $ret;
	}

	/* 入力不正文字のエスケープ TAG除去 */
	function escapeTag($aVal) {
		$ret = $aVal;
		$ret = chop($ret);
		$ret = stripslashes($ret);
		$ret = strip_tags($ret);
		return $ret;
	}

	/* 配列値のエスケープ  タグ除去  */
	function escapeTagAll($value, $returnvalue = null, $tag_strip_flg = false ) {
		$retvalue = ($returnvalue != null) ? $returnvalue: array();
		if((is_array($value)) and (count( $value ) > 0)){
			//while( list( $key , $val) = each( $value ) ){
			foreach ($value as $key => $val) {
				$ret = $val;
				if( is_array($val) ){
					//while( list( $key1 , $val1 ) = each( $val ) ){
					foreach ($val as $key1 => $val1) {
						$ret1 = $val1;
						$ret1 = chop($ret1);
						$ret1 = stripslashes($ret1);
						//$ret1 = htmlspecialchars_decode($ret1);
						//$ret1 = htmlspecialchars($ret1);
						//if ( $tag_strip_flg !== true )	$ret1 = strip_tags($ret1);
						$ret1 = mb_convert_kana($ret1, "KV", "utf-8");
						$retvalue[$key][$key1] = $ret1;
					}
				}else{
					$ret = chop($ret);
					$ret = stripslashes($ret);
					//$ret = htmlspecialchars_decode($ret);
					//$ret = htmlspecialchars($ret);
					$ret = htmlspecialchars($ret);
					//$ret = str_replace('&','&amp;',$ret);
					//if ( $tag_strip_flg !== true )	$ret = strip_tags($ret);
					$ret = mb_convert_kana($ret, "KV", "utf-8");
					$retvalue[$key] = $ret;
				}
			}
		}

		return $retvalue;
	}

	/*--------------------------------------------------------
	* @description:		NULL判定
	* @param:			$value 検査する値
	* @return:			値がnullならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isNull($value) {
		return ((string)$value == (string)"" || $value === null);
	}

	/*--------------------------------------------------------
	* @description :	数字 判定
	* @param:			$value 検査する値
	* @return:			値が数字ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isNumber($value) {
		return preg_match("/^[0-9]+$/", $value);
	}

	/*--------------------------------------------------------
	@description :		英数字　判定
						英数および、半角スペースを通す。
	@param:				$value 検査する値
	@return:			値が英数ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isAscii($value) {
		return preg_match("/^[0-9a-zA-Z]+$/", $value);
	}

	/*--------------------------------------------------------*
	* @description:		全角平仮名　判定。
	* @param:			$value 検査する値
	* @return:			値が全角平仮名ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isZenHira($value) {
		//mb_regex_encoding("SJIS");
		//return mb_ereg("^[ぁ-んー!)]+$", cnvi($value));
return preg_match("/^(\xe3\x81[\x81-\xbf]|\xe3\x82[\x80-\x9e])+$/",$value);
		//return ereg("^(\xA4[\xA1-\xF3]|\xA1\xBC|\xA1\xA6|\xA1\xA1|\x20)+$", $value);
	}

	/*--------------------------------------------------------*
	* @description:		全角カタカナ　判定。
	* @param:			$value
	* @return:			値が全角カタカナならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isZenKana($value) {
//		 return ereg("^(\xA5[\xA1-\xF6]|\xA1\xBC|\xA1\xA6|\xA1\xA1|\x20)+$", $value);
return  preg_match("/^[ァ-ヶー]+$/u", $value);
		//return mb_ereg('^[ァ-ヶー]+$' , $value);
	} // isZenKana

	/*--------------------------------------------------------
	* @description:		値が指定されたバイト数以下　判定。
	* @param:			$value
	* @return:			値が指定バイト数超えていたらTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isOverLength($value, $max) {
		return (strlen($value) > $max);
	}

	/*--------------------------------------------------------
	* @description:		値が指定されたバイト数以上および以下かを判定
	* @param:			$value
	* @return:			条件に一致　True、それ以外ならFalse
	--------------------------------------------------------*/
	function isOverLengthRange( $value, $min , $max ) {
		return ( (strlen($value) >= $min) and (strlen($value) <= $max));
	}

	/*--------------------------------------------------------
	@description:	値が指定された文字数以下　判定。
			文字数は２バイト文字は１文字としてカウント
	@param:  		$value
	@return:  	値が指定文字数超えていたらTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isOverCharLength($value, $max, $enc = "utf-8") {
		return (mb_strlen($value, $enc) > $max);
	}

	/*--------------------------------------------------------
	* @description :	値が指定されたバイト数か 判定。
	* @oaram1:			$value 検査する値
	* @param2:			$count 指定文字数
	* @return:			値が指定バイト数ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isCorrectLength($value, $count) {
		return (strlen($value) == $count);
	}

	/*--------------------------------------------------------
	値が指定された文字数か 判定。
	文字数は２バイト文字は１文字としてカウント
	* @param:  		$value 検査する値
	* @param:
	* @param:
	* @return:   	値が指定文字数ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isCorrectCharLength($value, $count, $enc = "utf-8") {
		return (mb_strlen($value, $enc) == $count);
	}

	/*--------------------------------------------------------
	* @description : 	値の書式がURL形式か
	* @arg1:  		$value 検査する値
	* @return :  	値がURL形式ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isUrl($value) {
		return preg_match("/s?https?:\/\/[-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+/i", $value);
	}

	/*--------------------------------------------------------
	* @description:	値チェック　英数、ハイフン、アンダーバー
	* @param1:	$value 検査する値
	* @return:		論理値　値が数字ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isLogNumber($value) {
		return preg_match("/^[0-9a-zA-Z_-]+$/", $value);
	}

	/*--------------------------------------------------------
	* @description:	値がマイナス値も含む数字かチェック
	* @param1:	$value 検査する値
	* @return:		論理値　値が数字ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isSignedNumber($value) {
		return preg_match("/^-?[0-9]+$/", $value);
	}

	/*--------------------------------------------------------
	* @description:	値が有効日付かをチェック
	* @param1:	$aYear
	* @param2:	$aMonth
	* @param3:	$aDay
	* @return:		論理値　値が日付ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isDate($aYear,$aMonth,$aDay) {
		return checkdate($aMonth, $aDay, $aYear);
	}

	/*--------------------------------------------------------
	* @description:	値が半角かどうか。
	* @param1:  	$value
	* @return:   	論理値　値が半角文字ならTrue、それ以外ならFalse
	--------------------------------------------------------*/
	function isSingleByteCharLength($value, $enc = "utf-8") {
		$ret = mb_convert_kana($value, "KV", mb_detect_encoding($value));
		return (mb_strlen($ret, mb_detect_encoding($value)) == strlen($value));
	}

	/*--------------------------------------------------------
	* @description:	半角カナを含むかどうか
	* @param1:  	$value
	* @return:   	論理値　含まない　True、それ以外ならFalse
	--------------------------------------------------------*/
	function isSingleByteKana( $value, $enc = "utf-8" ) {
		$ret = mb_convert_kana($value, "KV", mb_detect_encoding($value));
		return ( strlen( $ret ) == strlen( $value ) );
	}

	/*--------------------------------------------------------
	* @description:	メールアドレス　妥当性
	* @param1:  	$value 検査する値
	* @return:   論理値　値が正しいメールアドレスの場合True、それ以外ならFalse
	--------------------------------------------------------*/
	function isMailAddressValid($value){
		if($this->isNUll($value))	return false;
		if(!preg_match("/^[\da-zA-Z\-\.\(\)\+\*\[\]#<>_]+@[\da-zA-Z\-\.\(\)\+\*\[\]#<>_]+$/", $value )) {
			return false;
		}
		return true;
	}

	/*---------------------------------------------------------
	* @description :	メールアドレスのチェック
	* @arg: E-mail address
	* @return: bool
	---------------------------------------------------------*/
	function chk_email($ret_email){
		$flg=false;
		$retvalue=true;

		if(!$ret_email)		return false;
		if(!strpos($ret_email,"@"))	return false;
		if(strpos($ret_email,"@")!=strrpos($ret_email,"@"))	return false;

		$m=strpos($ret_email,"@");
		$ret1=substr($ret_email,0,$m);
		$ret2=substr($ret_email,$m+1,strlen($ret_email)-$m-1);
		if(($ret1) and ($ret2)){
			for ($i=0; $i<strlen($ret1); $i++){
				$re=substr($ret1,$i,1);
				if (preg_match("/([a-zA-Z0-9._+-])/",$re) === 0){
					$retvalue=false;
					break;
				}
			}
			for ($i=0; $i<strlen($ret2); $i++){
				$re=substr($ret2,$i,1);
				if (preg_match("/([a-zA-Z0-9._-])/",$re) === 0){
					$retvalue=false;
					break;
				}
			}
		}else{
			$retvalue=false;
		}
		return $retvalue;
	}

	/*---------------------------------------------------------
	* @description :	メールアドレスのチェック 携帯かどうか判定
	* @param: 		mail address domain
	* @return:	 	携帯　true	 / 携帯ではない false
	---------------------------------------------------------*/
	function chk_emailMobile($aMailAddress){
		$domain = "";
		$domain = $this->getDomainFromMail( $aMailAddress );
		$retvalue = false;
		if ( $domain != "" ){
			if( ( strpos( $domain , "docomo.ne.jp") !== false ) or
				( strpos( $domain , "ezweb.ne.jp") !== false) or
				( strpos( $domain , "softbank.ne.jp") !== false) or
				( strpos( $domain , "vodafone.ne.jp") !== false) or
				( strpos( $domain , "pdx.ne.jp") !== false) ){
					$retvalue = true;
			}
		}
		return $retvalue;
	}

	/*---------------------------------------------------------
	* @description :	ドメイン名取得
	* @param: 		mail address
	* @return: 		string
	---------------------------------------------------------*/
	function getDomainFromMail($arg_email){
		$retdomain = "";
		if ( strlen($arg_email) == 0 ) 	return $retdomain;
		$pos =  strpos($arg_email, "@");
		if ( $pos === false ) 			return $retdomain;
		if( $pos == strlen($arg_email) + 1 )	return $retdomain;
		$ret = explode ("@" , $arg_email);
		if( count( $ret ) != 2 )	return $retdomain;
		return $ret[1];
	}

	/* ----------------------------------------------------------
	* @description:	半角数字 + ハイフン 　判定　 電話／FAX・郵便番号
	* @param: 		電話／FAX NO
	* @return: 		bool
	---------------------------------------------------------- */
	function chkNo($retval){
		$retvalue = false;
		for ($i=0; $i<strlen($retval); $i++){
			$ret=substr($retval,$i,1);
			if ((( ord($ret) >= 48 ) and ( ord($ret) <= 57 )) or ( ord($ret) == 45 )){
				$retvalue=true;
			}else{
				$retvalue=false;
				break;
			}
		}
		if(!$this->chkNoInt(substr(strrev($retval),0,4))){
			$retvalue=false;
		}
		return $retvalue;
	}

	/* -------------------------------------------------------
	* @description :	半角数字 かどうかの判定
	* @arg	 :	NO	(string)
	* @return : 	bool
	------------------------------------------------------- */
	function chkNoInt($retval){
		$retvalue = false;
		for ($i=0; $i<strlen($retval); $i++){
			$re=substr($retval,$i,1);
			if((ord($re) >= 48) and (ord($re) <= 57)){
				$retvalue=true;
			}else{
				$retvalue=false;
				break;
			}
		}
		return $retvalue;
	}

	function chkTel($value){
		if(empty($value))	return false;
		$str = mb_convert_kana($value,"a");
		if($str != $value)		return false;
		$str2 = str_replace('-','',$value);
		if (preg_match("/^([0-9]{2,4})\-([0-9]{2,4})\-([0-9]{4})$/", $value) &&
      strlen($str2)>=10 && strlen($str2)<=11) {
    		return true;
    	}else{
      		return false;
      	}


	}

}
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>