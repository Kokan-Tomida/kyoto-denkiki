<?php

/**--------------------------------------------------------------------
  ProjectName :  	
  description :		a1111.php  中カテゴリ新規登録
  Created / Author :	
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once('./include/class/base.class.php');

class completion extends Base{

	public function completion(){
		parent::Base();
	}
	
	public function Show(){
		global $complate_form;
		$template = $this->getViewHTML(get_class());
		$this->initValue($complate_form);
		
		$this->_makeForm();

		return $this->m_objTemplate->set_value($template, $this->m_value);
	}
	
	private function _makeForm(){
		global $G_INFO_MESSAGE;
		$this->pushValueFromARGV();
		$this->m_value['g_link'] = '';
		if(axts('mn',$this->m_value)){
			if(strlen($this->m_value['mn']) == 3){
				$mn = $this->m_value['mn'];
				if((substr($mn,0,1) == 'G') and (in_array(substr($mn,2,1),array('1','2','3','4','5')))){
					$css = $this->choiceLink($mn);			
					$this->m_value['g_link'] = "<link href=\"".$css."\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />";
				}
			}
		}

		$this->m_value['complete_message'] = $G_INFO_MESSAGE['inf003'];
		if(axts('ms',$this->m_value)){
			$ms = $this->m_value['ms'];
			$inf = array_keys($G_INFO_MESSAGE);
			if(in_array($ms,$inf)){
				$this->m_value['complete_message'] = $G_INFO_MESSAGE[$ms];
			}
		}
	}

}
new completion();

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>