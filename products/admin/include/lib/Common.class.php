<?php

/*-------------------------------------------------
@description:		Common.inc (共通処理)
--------------------------------------------------*/

class Common{

	/*---------------------------------------------------------
	* @description:		ErrorMsg
	* @param:
	* @return:
	---------------------------------------------------------*/
	function set_eMsg($msg){
		$ret = "";
		if($msg){
			$ret .= "<font size=\"2\" color=\"red\">";
			$ret .= $msg."</font>";
		}
		return $ret;
	}
	
	/*---------------------------------------------------------
	* @description:		InfoMsg
	* @param:
	* @return:
	---------------------------------------------------------*/
	function set_iMsg($msg){
		$ret = "";
		if($msg){
			$ret .= "<font size=\"2\" color=\"blue\">";
			$ret .= $msg."</font>";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:		ErrorMsg
	* @param:
	* @return:
	---------------------------------------------------------*/
	function set_alertMsg($msg){
		$ret = "";
		if($msg){
			$ret .= "<div class=\"bg_msg\">";
			$ret .= $msg."</div>";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:
	* @param:
	* @return:
	---------------------------------------------------------*/
	function selYear($arg_selected, $start = 1950, $firstflg=false,$range=3){
		$ret = "";
		if($firstflg == true){
			$ret .= "<option value=\"\"> ----- </option>";
		}
		for($i = $start ; $i <= (date("Y")+$range) ; $i++ ){
			$sel = ($i == $arg_selected) ? 'selected' : '';
			$ret .= "<option value=\"".$i."\" ".$sel.">$i</option>";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:
	* @param:
	* @return:
	---------------------------------------------------------*/
	function selYearWithWareki($arg_selected){
		global $G_YEAR_WITH_WAREKI;
		$ret = "";
		foreach ($G_YEAR_WITH_WAREKI as $k=>$v){
			$sel = ($k == $arg_selected) ? 'selected' : '';
			$ret .="<option value=\"".$k."\" ".$sel.">$v</option>";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:
	* @param:
	* @return:	string
	---------------------------------------------------------*/
	function selMonth($arg_selected, $firstflg=false){
		$ret = "";
		if($firstflg == true){
			$ret .= "<option value=\"\"> ----- </option>";
		}
		for ($i=1 ; $i<13 ; $i++){
			$sel = ($i == $arg_selected) ? 'selected' : '';
			$ii = (strlen($i) == 1) ? '0'.$i : $i;
			$ret .="<option value=\"".$ii."\" ".$sel.">$i</option>";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:
	* @param:
	* @return:	string
	---------------------------------------------------------*/
	function selDay($arg_selected, $year = '', $month = ''){
		$ret = "";
		$date_year = ($year != '') ? $year : date("Y");
		$date_month = ($month != '') ? $month : date("m");
		 
		$daycount = date("t", mktime( 0, 0, 0, $date_month, 1, $date_year));
		for ( $i=1 ; $i < $daycount+1 ; $i++ ){
			$sel = ($i == $arg_selected) ? 'selected' : '';
			$ii = (strlen($i) == 1) ? '0'.$i : $i;
			$ret .= "<option value=\"".$ii."\" ".$sel.">$i</option>";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:
	* @param:		array
	* @param:		selected value
	* @return:		string
	---------------------------------------------------------*/
	function makeOption($choices, $arg_selected= ""){
		$ret = "";
		if(!is_array($choices)){
			return $ret;
		}
		foreach($choices as $k=>$v){
			$selected = ($k == $arg_selected) ? 'selected' : '';
			$ret .= "<option value=\"".$k."\" ".$selected.">".$v."</option>";
		}
		return $ret;	
	}
	
	/*---------------------------------------------------------
	* @description:
	* @param:		array
	* @param:		array
	* @param:		selected value
	* @return:		string
	---------------------------------------------------------*/
	function makeOptionWithGroup($choices, $grp, $arg_selected= ""){
		$ret = "";
		if((!is_array($choices)) or (!is_array($grp))){
			return $ret;
		}
		foreach($grp as $k1=>$v1){
			$option = "<optgroup label = \"".$v1."\">";
			foreach($choices as $k2=>$v2){
				$selected = ($k2 == $arg_selected) ? 'selected' : '';
				if($k1 == $v2[1]){
					$option .= "<option value=\"".$k2."\" ".$selected.">".$v2[0]."</option>";
				}
			}
			$option .= "</optgroup>";
			$ret .= $option;
		}	
		return $ret;	
	}

	/*---------------------------------------------------------
	* @description:
	* @param:		array
	* @param:		selected value
	* @param:		初期状態で一番最初のradioにチェックするかどうか
	* @return:		string
	---------------------------------------------------------*/
	function makeRadio($choices, $name, $arg_selected= "", $defaultcheck = true){
		$ret = "";
		if(!is_array($choices)){
			return $ret;
		}
		$i= 0;
		foreach($choices as $k=>$v){
			$selected = (($defaultcheck == true) and ($i == 0))? 'checked' : (($k == $arg_selected) ? 'checked' : '');
			$ret .= "<input type=\"radio\" name=\"".$name."\" value=\"".$k."\" ".$selected.">".$v." ";
			$i++;
		}
		return $ret;	
	}
	
	/*---------------------------------------------------------
	* @description:
	* @param:		array
	* @param:		string  control name
	* @param:		array   selected value
	* @param:		$sep int		$sep毎　出力し改行	
	* @return:		string
	---------------------------------------------------------*/
	function makeCheckbox($choices, $name, $arg_selected= array(), $sep=2){
		$ret = "";
		if((!is_array($choices)) or (!is_array($arg_selected))){
			return $ret;
		}
		$i= 1;
		foreach($choices as $k=>$v){
			$selected = (in_array($k,$arg_selected)) ? 'checked' : '';
			$ret .= "<input type=\"checkbox\" name=\"".$name."[".$k."]\" value=\"".$k."\" ".$selected.">".$v."　　";
			if($i%$sep == 0)	$ret.= '<br />';
			$i++;
		}
		return $ret;	
	}

	/*---------------------------------------------------------
	* 編集用時間(H:M:S)
	* @param: 
	* @return: H:M
	---------------------------------------------------------*/
	function func_editTime($arg){
		if(!$arg)	return;
		$times = explode(':', $arg);
		if(count($times) != 3)	return;
		return ((strlen($times[0]) == 2) and (strlen($times[1]) == 2)) ? $times[0].':'.$times[1] : '';
	}

	/*---------------------------------------------------------
	* 与えられた値がなければ指定の文字を返す
	* @param: 
	* @return: 
	---------------------------------------------------------*/
	function retBlank($arg, $ret = '&nbsp;'){
		$retvalue = (strlen($arg) > 0) ? $arg : $ret;
		$retvalue = (($arg == "") or (is_null($arg))) ? $ret : '';
		return $retvalue;
	}

	/*---------------------------------------------------------
	* @param: 
	* @return: 
	---------------------------------------------------------*/
	function retCheckOne($sel , $ctl , $value ){
		$chk = ($sel == $value ) ? ' checked' : '';
		return "<input type=\"checkbox\" name=\"".$ctl."\"  value=\"".$value."\" ".$chk."/>";
	}

	/*---------------------------------------------------------
	* @description:	 日付表示用編集
	* @param:
	* @return:
	---------------------------------------------------------*/
	function editDate($indate, $ymd = "ymd"){
		if( (!$indate) or (strlen(str_replace("/","",$indate))+2 != (strlen($indate))) ){
			return "";
		}
		global $G_AD_WAREKI;
		$date_ar = explode("/", $indate);
		if(count($date_ar) != 3)	return "";
		$yy = $date_ar[0];
		$mm = $date_ar[1];
		$dd = $date_ar[2];
		$ret = "";
		switch ($ymd){
			case "ymd":
				$ret = $yy."年".$mm."月".$dd."日"; 
				break;
			case "wymd":
				$ret = (strlen($yy) == 4) ? $G_AD_WAREKI[$yy].$mm."月".$dd."日" : ""; 
				break;
			case "ym":
				$ret = $yy."年".$mm."月"; 
				break;
			case "md":
				$ret = $mm."月".$dd."日"; 
				break;
			case "d":
				$ret = $dd."日"; 
				break;
			case "m":
				$ret = $mm."月"; 
				break;
			case "y":
				$ret = $yy."年"; 
				break;
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @param: 
	* @return: 
	---------------------------------------------------------*/
	function isValue($key, $aArray){
		if(is_array($aArray) == false){
			return NULL;
		}

		if(is_array($key) == true){
			$ret = "";
			if (count($key) == 0)	return ret;
			foreach($key as $k=>$v){
				if(array_key_exists($k, $aArray) ){
					$ret .= $aArray[$k]."  ";
				}
			}
			return $ret;
		}else{
			if(array_key_exists($key, $aArray)){
				return $aArray[$key];
			}else{
				return NULL;
			}
		}		
	}

	/*---------------------------------------------------------
	* @param: 	array('date1'=>, 'date2'=>, 'date3'=>)
	* @return: 	array
	---------------------------------------------------------*/
	function setDefaultDate( $aPosted ){
		// year
		$ret1 = "";
		$sel = "";
		$yy = date("Y");
		if ( $aPosted['d1'] == $yy )	$sel=" selected";
		$ret1 = "<option value=".$yy." ".$sel.">".$yy."</option>";
		$sel = "";
		$yy = $yy +1;
		if ( $aPosted['d1'] == $yy )	$sel=" selected";
		$ret1 .= "<option value=".$yy." ".$sel.">".$yy."</option>";
		// month
		$ret2 = "";
		$sel = "";
		for ( $i=1;$i<13;$i++){
			$p=$i;
			if(strlen($i) == 1) $p = "0".$i;
			if ( $aPosted['d2'] == $p )	$sel=" selected";
			$ret2 .= "<option value=".$p." ".$sel.">".$p."</option>";
			$sel = "";
		}			
		// day
		$ret3 = "";
		$sel = "";
		for ( $i=1;$i<32;$i++){
			$p = $i;
			if(strlen($i) == 1) $p = "0".$i;
			if ( $aPosted['d3'] == $p )	$sel=" selected";
			$ret3 .= "<option value=".$p." ".$sel.">".$p."</option>";
			$sel = "";
		}			
		return array( $ret1, $ret2,  $ret3 );
	}

	/*---------------------------------------------------------
	* @param: 
	* @return: 
	---------------------------------------------------------*/
	function setDefaultTime($aPosted){
		$ret1 = "";
		$sel = "";
		if (  $aPosted['t1'] != "" ){
			$val = $aPosted['t1'];
		}		 
		for ( $i=9;$i<21;$i++){
			if ( $aPosted['t1'] == $i )	$sel=" selected";
			$h = $i;
			if(strlen($i) == 1) $h = "0".$i;
			$ret1 .= "<option value=".$h." ".$sel.">".$h."</option>";
			$sel = "";
		}			
		$ret2 = "";
		$sel = "";
		if ( $aPosted['t2'] == "00" )	$sel=" selected";
		$ret2 = "<option value=\"00\" ".$sel.">00</option>";
		$sel = "";
		if ( $aPosted['t2'] == "15" )	$sel=" selected";
		$ret2 .= "<option value=\"15\" ".$sel.">15</option>";
		$sel = "";
		if ( $aPosted['t2'] == "30" )	$sel=" selected";
		$ret2 .= "<option value=\"30\" ".$sel.">30</option>";
		$sel = "";
		if ( $aPosted['t2'] == "45" )	$sel=" selected";
		$ret2 .= "<option value=\"45\" ".$sel.">45</option>";
		return array($ret1, $ret2);
	}

	/*---------------------------------------------------------
	* @description:		page no submit
	* @param1			現在のページ数
	* @param2:			総データ件数
	* @param3:
	* @return:			string	
	---------------------------------------------------------*/
	function setPageNo2($no,$cnt){
		$ret = "";

		// 表示するページNO数
		$PageString = 5;
		
		//VIEW_PAR_PAGE		 // １ページに表示するデータ数

		if($cnt%VIEW_PAR_PAGE==0){
			$PageSet=$cnt/VIEW_PAR_PAGE;
		}else{
			$PageSet=floor($cnt/VIEW_PAR_PAGE)+1;
		}
		if($PageSet>$PageString){
			$ret .= "[  "; 
			$ret .= "<a href=\"javascript:sendpage(1);\"> 先頭ページ </a> "." ] ";
		}
		$ret .= " [";
		if($no==1){
			for($j=1;$j<$PageString+3;$j++){
				$jj=$j+1;
				if($j>=$cnt/VIEW_PAR_PAGE+1) break;
				if($j==$no){
					$ret .= "<font color=red>".$j.". </font>";
				}else{
					$ret .= "<a href=\"javascript:sendpage($j);\">".$j."</a>".". ";
				}
			}
		}else{	
			$s=floor($no/$PageString)*$PageString;
			if($s<1) $s=2;
			for($j=$s-1;$j<$PageString+$s+1;$j++){
				// $j=$PageString*($no-1)+1;
				$jj=$j+1;
				if($j>=$cnt/VIEW_PAR_PAGE+1) break;
				if($j==$no){
					$ret .= "<font color=red>".$j.". </font>";
				}else{
					$ret .= "<a href=\"javascript:sendpage($j);\"> ".$j." </a> ".". ";
				}
			}
		}
		$ret .= " ]";
		if($PageSet>$PageString){
			$ret .= "	[	<a href=\"javascript:sendpage($PageSet);\"> 最後のページ </a> ";
			$ret .= " ]";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:		page no submit
	* @param1			現在のページ数
	* @param2:			総データ件数
	* @param3:
	* @return:			string	
	---------------------------------------------------------*/
	function setPageNo4($pno,$cnt){
		$ret = "";
		
		//VIEW_PAGENO		// 表示するページNO数
		//VIEW_PAR_PAGE		// １ページに表示する件数
		
		if($cnt == 0)	return $ret;
		
		$no = ($pno != "") ? $pno : 1;

		if($cnt%VIEW_PAR_PAGE == 0){
			$maxpage = $cnt/VIEW_PAR_PAGE;
		}else{
			$maxpage = floor($cnt/VIEW_PAR_PAGE) + 1;
		}
		//$st = ($no <= VIEW_PAGENO) ? 1 : ceil($no/VIEW_PAGENO)+1;
		if($no <= VIEW_PAGENO){
			$st = 1;
		}else{
			$st = ceil($no/VIEW_PAGENO)*5 - VIEW_PAGENO + 1;
		}
				
		$ret .= "<li><a href=\"javascript:sendpage(1);\"><img src=\"common/images/head_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";
		$pre = ($no==1) ? 1 : $no-1;
		$ret .= "<li class=\"pd-left10\"><a href=\"javascript:sendpage(".$pre.");\"><img src=\"common/images/previous_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";

		for($i = $st; $i < VIEW_PAGENO+$st; $i=$i+VIEW_PAGENO){
			for($j = $i; $j < VIEW_PAGENO+$i; $j++){
				if($j > $maxpage) break;
				if($j==$no){
					$ret .= "<li class=\"pagenavi_on\"><a href=\"#\">".$j."</a></li>";
				}else{
					$ret .= "<li class=\"pagenavi_off\"><a href=\"javascript:sendpage($j);\">".$j."</a></li>";
				}
			}
		}
		
		$ne = (($no + 1) >= $maxpage) ? $maxpage : $no+1;
        $ret .= "<li class=\"pd-left10\"><a href=\"javascript:sendpage($ne);\"><img src=\"common/images/next_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";
        $ret .= "<li class=\"pd-left10\"><a href=\"javascript:sendpage($maxpage);\"><img src=\"common/images/last_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";
		return $ret;
	}

	/*---------------------------------------------------------
	* @description:		page no submit
	* @param1			現在のページ数
	* @param2:			総データ件数
	* @param3:
	* @return:			string	
	---------------------------------------------------------*/
	function setPageNo3($pno,$cnt){
		$ret = "";
		if($cnt == 0)	return $ret;
		//VIEW_PAGENO		// 表示するページNO数
		//VIEW_PAR_PAGE		// １ページに表示する件数
		
		$no = ($pno != "") ? $pno : 1;

		if($cnt%VIEW_PAR_PAGE == 0){
			$maxpage = $cnt/VIEW_PAR_PAGE;
		}else{
			$maxpage = floor($cnt/VIEW_PAR_PAGE) + 1;
		}
//		$st = ($no <= VIEW_PAGENO) ? 1 : ceil($no/VIEW_PAGENO)+1;
		if($no <= VIEW_PAGENO){
			$st = 1;
		}else{
			$st = ceil($no/VIEW_PAGENO)*5 - VIEW_PAGENO + 1;
		}	
		
		$ret .= "<li><a href=\"javascript:sendpage_location(1);\"><img src=\"common/images/head_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";
		$pre = ($no==1) ? 1 : $no-1;
		$ret .= "<li class=\"pd-left10\"><a href=\"javascript:sendpage_location(".$pre.");\"><img src=\"common/images/previous_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";
		for($i = $st; $i < VIEW_PAGENO+$st; $i=$i+VIEW_PAGENO){
			for($j = $i; $j < VIEW_PAGENO+$i; $j++){
				if($j > $maxpage) break;
				if($j==$no){
					$ret .= "<li class=\"pagenavi_on\"><a href=\"#\">".$j."</a></li>";
				}else{
					$ret .= "<li class=\"pagenavi_off\"><a href=\"javascript:sendpage_location($j);\">".$j."</a></li>";
				}
			}
		}
		
		$ne = (($no + 1) >= $maxpage) ? $maxpage : $no+1;
        $ret .= "<li class=\"pd-left10\"><a href=\"javascript:sendpage_location($ne);\"><img src=\"common/images/next_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";
        $ret .= "<li class=\"pd-left10\"><a href=\"javascript:sendpage_location($maxpage);\"><img src=\"common/images/last_arrow.gif\" width=\"26\" height=\"23\" border=\"0\" /></a></li>";
		return $ret;
	}


	/*---------------------------------------------------------
	* @description:		page no submit
	* @param1:			現在のページ数
	* @param2: 			総データ件数
	* @param3:
	* @return:			string	
	---------------------------------------------------------*/
	function setPageNoSendHistory($no,$cnt){
		$ret = "";

		// 表示するページNO数
		$PageString = 5;

		// １ページに表示するデータ数
		$PAR_PAGE = 100;

		if($cnt%VIEW_PAR_PAGE==0){
			 // total Pageno
			 
			$PageSet=$cnt/$PAR_PAGE;
		}else{
			$PageSet=floor($cnt/$PAR_PAGE)+1;
		}
		if($PageSet>$PageString){
			$ret .= "[ "; 
			$ret .= "<a href=\"javascript:sendpage2(1);\"> 先頭ページ </a>"." ] ";
		}
		$ret .= " [";
		if($no==1){
			for($j=1;$j<$PageString+3;$j++){
				$jj=$j+1;
				if($j>=$cnt/$PAR_PAGE+1) break;
				if($j==$no){
					$ret .= "<font color=red>".$j.". </font>";
				}else{
					$ret .= "<a href=\"javascript:sendpage2($j);\">".$j."</a>".". ";
				}
			}
		}else{	
			$s=floor($no/$PageString)*$PageString;
			if($s<1) $s=2;
			for($j=$s-1;$j<$PageString+$s+1;$j++){
				// $j=$PageString*($no-1)+1;
				$jj=$j+1;
				if($j>=$cnt/$PAR_PAGE+1) break;
				if($j==$no){
					$ret .= "<font color=red>".$j.". </font>";
				}else{
					$ret .= "<a href=\"javascript:sendpage2($j);\">".$j."</a>".". ";
				}
			}
		}
		$ret .= " ]";
		if($PageSet>$PageString){
			$ret .= "	[	<a href=\"javascript:sendpage2($PageSet);\"> 最後のページ </a>";
			$ret .= " ]";
		}
		return $ret;
	}

	/*---------------------------------------------------------
	* @param: 
	* @return: 
	---------------------------------------------------------*/
	function setSessionFromExternal($external,$clear=true){
		if(!is_array($external)){
			return;	
		}
		if($clear == true)	$_SESSION[S_KEY10][S_KEY20] = array();
		foreach($external as $key=>$val ){
			$_SESSION[S_KEY10][S_KEY20][$key] = $val;
		}	
	}
	
	public function searchResult1($total_count){
		$res = '';
		if($total_count == 0){
			$res = '検索の結果、該当するデータがありません.';
		}else{
			$res = '検索の結果'.$total_count.'件が該当しました.';
		}
		return $res;
	}

	public function searchResult2($pno,$total_count){
		$res = '';
		if($total_count == 0)	return $res;
		if($total_count%VIEW_PAR_PAGE == 0){
			$maxpage = $total_count/VIEW_PAR_PAGE;
		}else{
			$maxpage = floor($total_count/VIEW_PAR_PAGE) + 1;
		}
		if(($pno == 1) or ($pno == $maxpage)){
			if($pno*VIEW_PAR_PAGE > $total_count){
				//$now = $total_count - ($pno-1)*VIEW_PAR_PAGE;
				$now = $total_count;
			}else{
				$now = $pno*VIEW_PAR_PAGE;
			}
		}else{
				$now = $pno*VIEW_PAR_PAGE;
		}
		$res = '['.$now.'件を表示/'.$total_count.'件中]';
		return $res;			
	}
	
	public function searchResult($pno,$total_count,$searching_flg = false){
		$res = '';
		$res .= $this->searchResult1($total_count);
		if($searching_flg == false){
			$res .= $this->searchResult2($pno,$total_count);
		}
		return $res;
	}
	
	public function getOrderParam($param){
		$res = array(null,null);
		if(strlen($param) < 3)	return $res;
		if(strpos($param,':') === false)	return $res;
		$re = explode(':',$param);
		return array($re[0],$re[1]);
	}
	
	function setSessionFormState($class_name,$index,$param){
		//if(aexists2(S_KEY10,S_KEY30,$_SESSION)){
			$_SESSION[S_KEY10][S_KEY30][$class_name][$index] = $param;
		//}
	}

	function setSessionFormState2($key,$index,$param){
		$_SESSION[S_KEY10][S_KEY30][$key][$index] = $param;
	}
	
	function judgeFormState($key,$index,$param){
		global $FORM_STATE;
		if(!aexists2(S_KEY10,S_KEY30,$_SESSION))				return false;
		if(!aexists2($key,$index,$_SESSION[S_KEY10][S_KEY30]))	return false;
		if(!in_array($index,array_keys($FORM_STATE)))			return false;
		if($_SESSION[S_KEY10][S_KEY30][$key][$index] != $FORM_STATE[$index])	return false;
		return true;
	}

	function unsetSessionFormState($key,$index){
		if(!aexists2(S_KEY10,S_KEY30,$_SESSION))				return null;
		if(!aexists2($key,$index,$_SESSION[S_KEY10][S_KEY30]))	return null;
		unset($_SESSION[S_KEY10][S_KEY30][$key][$index]);
	}

	/*---------------------------------------------------------
	* @param: 
	* @return: 
	---------------------------------------------------------*/
	function setExternalFromSession($external){
		if(!is_array($_SESSION[S_KEY10][S_KEY20])){
			return;	
		}
		foreach($_SESSION[S_KEY10][S_KEY20] as $key=>$val ){
			$external[$key] = $val;
		}
		return $external;
	}

	/*---------------------------------------------------------
	* @param: 
	* @return: 
	---------------------------------------------------------*/
	function getYobi($external){
		global $G_YOBI;
		if( ( $external['d1'] != "") and ( $external['d2'] != "") and ( $external['d3'] != "") ){
			$y = date("w", mktime( 0, 0, 0, $external['d2'], $external['d3'] , $external['d1']) );
			$yobi = $G_YOBI[$y];
		}else{
			$yobi = " ";
		}
		return $yobi;		
	}
	
	/*
	 * @param $hour この時間が経過した年月日と時間
	 */
	function getProgressDateTime($hour){
		$date1 = date('Y年m月d日 H:i',mktime(date('H')+$hour,date('i'),date('s'),date('m'),date('d'),date('Y')));
		$date2 = date('Y-m-d H:i',mktime(date('H')+$hour,date('i'),date('s'),date('m'),date('d'),date('Y')));
		return array($date1,$date2);
	}
	
	function assignSystemUserNo($max_user_no){
		if($max_user_no == "")	return "T00001";
		if(strlen($max_user_no) != 6)	return;
		if(substr($max_user_no,0,1) != "T")	return;
		$no = intval(substr($max_user_no,1));
		$no++;
		$newno = str_pad($no, 5, "0", STR_PAD_LEFT);
		return "T".$newno;
	}

}
/* COPYRIGHT(C) DeeSystem. ALL RIGHTS RESERVED. */
?>