<?php

 /**--------------------------------------------------------------------
  description:		Files.class.php
  ProjectName :  
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

class Files  {

	var $m_target;		// $_FILES[xxx]

	var $m_path;		// save path

	var $m_filetype;	// 1 image/ 2 pdf / 3 dxf	

	var $m_new_fname;	// new save file name (ex: 2013APR0002_2)

	public function __construct() {
	}

	private function _chkFileSize(){
		if(filesize($this->m_target['tmp_name']) > MAX_SIZE)	return false;
		return true;
	}

	private function _chkWH(){
		if($this->m_filetype == '2')	return true;
		global $ALLOW_PX_SIZE;
		$res = getimagesize($this->m_target['tmp_name']);
		if($res == false)	return false;
		// array(width,height)
		$chk = array();
		foreach($ALLOW_PX_SIZE as $k=>$wh){
			$chk[] = (($res[0] <= $wh[0]) and ($res[1] <= $wh[1])) ? true : false;
		}
		return in_array(true, $chk);
	}

	private function _getExtension(){
		$info = pathinfo($this->m_target['name']);
		$ext = axts('extension', $info, NULL);
		if(!$ext)		return false;
		return strtolower($ext);
	}

	function _chk_ext() {
		$ext = $this->_getExtension();
		if(!$ext)	return false;
		if($this->m_filetype == '1'){
			global $ALLOW_EXT1;
			return in_array($ext, $ALLOW_EXT1);
		}elseif($this->m_filetype == '2'){
			global $ALLOW_EXT2;
			return in_array($ext, $ALLOW_EXT2);
		}elseif($this->m_filetype == '3'){
			global $ALLOW_EXT3;
			return in_array($ext, $ALLOW_EXT3);
		}
	}

	private function setTarget($file){
		$this->m_target = $file;
	}

	private function setPath($new_save_path){
		$this->m_path = $new_save_path;
	}

	private function setFileType($type){
		$this->m_filetype = $type;
	}

	private function setNewFName($new_fname){
		$this->m_new_fname = $new_fname;
	}

	public function ini_setting($target,$type,$new_save_path,$new_fname){
		$this->setTarget($target);
		$this->setFileType($type);
		$this->setPath($new_save_path);
		$this->setNewFName($new_fname);
	}

	public function validate(){
		global $G_VALIDATE_MESSAGE;
		$msg = "";
		$result = "";
		//$res = array($msg, $result);
		if(!$this->_chk_ext()){
			return array($G_VALIDATE_MESSAGE['val032'], false);
		}
/*		
		if(!$this->_chkWH()){
			return array($G_VALIDATE_MESSAGE['val033'], false);
		}
		if(!$this->_chkFileSize()){
			return array($G_VALIDATE_MESSAGE['val034'], false);
		}
*/		
		$uppath = $this->upload_target(true);
		if(!$uppath)	return array($G_VALIDATE_MESSAGE['val035'], false);
		//$fs = $size = exec('stat -c %s '.$this->m_target['tmp_name']);
		//$fs = filesize($this->m_target['tmp_name']);
		return array($msg, $uppath);
	}

	function to_upload($uppath){
		if(file_exists($uppath)){
			// to
			$to_path = str_replace('file/', 'files/', $uppath);
			$out = pathinfo($to_path);			
			if(!file_exists($out['dirname']))	mkdir($out['dirname'], 0777, true);
			copy($uppath, $to_path);
			unlink($uppath);
			return $to_path;
		}
		return false;
	}

	function upload_target($base=true){
		//$based = ($base) ? UPLOAD_DIR : UPLOAD_TMPDIR;
		//$typename = ($this->m_filetype == '1') ? 'images' : 'pdf';
		//$updir = $based.DS.$this->m_path[1].DS.$this->m_path[0].DS.$typename;
		$extension = $this->_getExtension();

		$updir = $this->m_path;
		if(!file_exists($updir)){
			mkdir($updir,0777,true);
		}

		$updir .= DS.$this->m_new_fname.'.'.$extension;
				
/*			
		if(!file_exists($updir)){
			mkdir($updir,0777,true);
			$updir .= DS.$this->m_path[1].'_1.'.$extension;
		}else{
			$fs = glob(UPLOAD_DIR.DS.$this->m_path[1].DS.$this->m_path[0].DS.$typename.DS.$this->m_path[1].'_*');
			if((is_array($fs)) and (count($fs) > 0)){
				rsort($fs);
				$in = pathinfo($fs[0]);
				$p = substr($in['filename'], strripos($in['filename'],'_')+1);
				$p++;
				$updir .= DS.$this->m_path[1].'_'.$p.'.'.$extension;
			}else{
				$updir .= DS.$this->m_path[1].'_1.'.$extension;
			}
			
		}
*/
		$ret = move_uploaded_file($this->m_target['tmp_name'],$updir);
		if($ret){
			return $updir;
		}
		return false;	
	}

	function moveTmp(){
		if(file_exists($this->m_target['tmp_name'])){
			copy($this->m_target['tmp_name'],'./tmp/'.basename($this->m_target['tmp_name']));
		}
	}

	function rmTmp(){
  		if(file_exists('./tmp/'.$this->m_target['tmp_name'])){
			unlink('./tmp/'.basename($this->m_target['tmp_name']));
  		}
  	}
}
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>