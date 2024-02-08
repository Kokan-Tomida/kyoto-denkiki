<?php

/**--------------------------------------------------------------------
  ProjectName :	  京都電機器様
					http://kdn-products.com
  description :	  index.php login
  Created / Author :
  LastUpdated / Author :	 yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd	 xxxxxx	xxxxx
---------------------------------------------------------------------*/

//require_once('./include/class/base.class.php');
require_once('./include/ProcessStart.inc');
class index extends Base{

	public function index(){
		parent::Base();
	}

	public function Show(){
		global $G_VALIDATE_MESSAGE, $index_form;
		session_unset();
		$template = $this->getViewHTML(get_class());
		$this->initValue($index_form);

		if(is_set('to_login', $this->m_vARGV, NULL)){
			$res = $this->_validate();
			if($res != false){
				$this->to_session();
//var_export($_SESSION);		
//var_export("index_334__");		
				
				header("location: a1100.php");
				exit;
			}else{
				$msg = $G_VALIDATE_MESSAGE['val020'];
				$this->m_value['validate_msg'] = $this->m_objCommon->set_eMsg($msg);
			}
		}
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

	private function _validate(){
		if((!axts('txt_loginid', $this->m_vARGV)) or (!axts('txt_password', $this->m_vARGV))){
			return false;
		}
		return  $this->_searchAuth();
	}

	private function to_session(){
		make_array_key($_SESSION, S_KEY11, S_KEY99);
		$_SESSION[S_KEY11][S_KEY99]['admin_id'] = $this->m_value['txt_loginid'];
		$_SESSION[S_KEY11][S_KEY99]['admin_pass'] = $this->m_value['txt_password'];
		$_SESSION[S_KEY11][S_KEY99]['login_datetime'] = date("Y/m/d H:i:s");
	}

	private function _searchAuth(){
		$condition = "admin_id = BINARY '".$this->m_vARGV['txt_loginid']."' and admin_password = BINARY '".$this->m_vARGV['txt_password']."'";
		$this->Search('kdn_baseinfo','*',$condition);
		$result = $this->m_objDB->getResult();
		if(!$result)	return false;
		$count = $this->getNumCount();
		if($count == 1){
			$res = array();
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
				foreach($row as $k=>$v){
					if(!in_array($k, array('id','created','modified'))){
						$res[$k] = $v;
					}
				}
			}
			return $res;
		}
		return false;
	}

}
new index();
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>