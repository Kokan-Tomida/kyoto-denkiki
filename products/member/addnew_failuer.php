<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a4100.php 履歴一覧 all
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('../config/release/include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class addnew_failuer extends Base{

	public function addnew_failuer(){
		parent::Base();
	}
	
	public function Show(){
		global $addnew_complete_form;
		$template = $this->getViewHTML(get_class(),PATH_TEMPLATE_MEMBER);
		$this->initValue($addnew_complete_form);

		if(axts('QUERY_STRING',$_SERVER) == 1){
			$this->m_value['message'] = 'すでに会員登録がお済です';
		}else{
			$this->m_value['message'] = '本登録のための期限が過ぎているか、処理に失敗しました。';
		}

		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	

	

	
}
new addnew_failuer();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>