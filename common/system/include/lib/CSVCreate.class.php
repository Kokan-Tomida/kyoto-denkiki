<?php

/**--------------------------------------------------------------------
  description:		CSVCreate.class.php
  ProjectName :  
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

class CSVCreate {

	var $m_resource;
	var $m_title;

	function CSVCreate() {
	}

	function CreateCSVFile($sc){

		mb_internal_encoding(CHARSET);

		$filename="";

		$now=date('Ymd');
		$filename1 = $sc."-".$now.".csv";
		$filename = $filename1;

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$filename.'"');

		if(count($this->m_resource) == 0)	return false;

		$retvalue = "";

		if((CSV_TITLE_OUTPUT == true) and (count($this->m_title) > 0)){
			$retvalue .= "\"";
			$retvalue .= implode('","', $this->m_title);
			$retvalue .= "\"\n";
		}

		foreach($this->m_resource as $k=>$v){
			foreach($v as $k1=>$v1){
				$line[] = "\"".$this->_cnv($v1)."\"";
			}
			$retvalue .= implode(',', $line);
			$retvalue .= "\n";
			$line = array();
		}
		$ret = mb_convert_encoding($retvalue,'SJIS');
		print $ret;
	}

	public function setResource($lists){
		$this->m_resource = $lists;
	}
	 
	public function setTitle($title){
		$this->m_title = $title;
	}
	
	private function _cnv($sr){
		//return $sr;
		$flg = false;
		for($i=0;$i<strlen($sr);$i++){
			$s = substr($sr,$i,1);
			if(ord($s) == 34){
				$flg = true;
				break;
			}					
		}
		if($flg == false)	return $sr;
		$ns = '';
		for($i=0;$i<strlen($sr);$i++){
			$s = substr($sr,$i,1);
			if((ord($s) != 10) and (ord($s) != 13))		$ns .= $s;
		}
		return $ns;
	}
}

/* COPYRIGHT(C) DeeSystem. ALL RIGHTS RESERVED. */
?>