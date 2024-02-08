<?php

/**--------------------------------------------------------------------
  description :		SystemInfo.class.php
  ProjectName :
  Created / Author :	0000/00/10 
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/


class SystemInfo{

	var $version;
	var $file_name;
	var $file_ext;
	var $file_path;
	var $dir_name;
	var $webdir_name;
	var $currentdir_name;
	var $time;
	var $year;
	var $month;
	var $day;
	var $week;
	var $hour;
	var $minutes;
	var $seconds;

	function SystemInfo(){
		$tmp = PHP_VERSION;
		$tmp = str_replace(".","",$tmp);
		if(strlen($tmp) < 3)	{ $tmp .= "0"; }
		$this->version = $tmp;
		
		$file_info = pathinfo($_SERVER["PHP_SELF"]);
		$this->file_name = ereg_replace(".".$file_info["extension"]."$","",$file_info["basename"]);
		$this->file_ext = $file_info["extension"];
		$this->dir_name = $file_info["dirname"];
		$this->webdir_name = ereg_replace("/".$file_info["basename"]."$","",getenv("REQUEST_URI"));
		$this->set_date();
		$this->currentdir_name = end(explode('/',$file_info["dirname"]));
	}
	function set_date(){
		list($this->seconds,$this->minutes,$this->hour,$this->day,$this->month,$this->year) = localtime(strtotime(gmdate("d F Y H:i:s",time()+(3600*9))));
		$this->year += 1900;
		$this->month++;
		$this->week = gmdate("w",time()+(3600*9));
	}
	function get_date($dimiliter){
		return $this->year.$dimiliter.$this->month.$dimiliter.$this->day;
	}
	function get_time($dimiliter){
		return $this->hour.$dimiliter.$this->minutes.$dimiliter.$this->seconds;
	}

}
/* COPYRIGHT(C) DeeSystem. ALL RIGHTS RESERVED. */
?>