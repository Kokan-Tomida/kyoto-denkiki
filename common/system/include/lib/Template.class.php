<?php

/**--------------------------------------------------------------------
  description :		Template.class.php
  ProjectName :  
  Created / Author :	0000/00/10 
  LastUpdated / Author : 	yyyy/mm/dd xxxx		
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/


// if文
// <!-- if( $val == val ) -->
// <!-- end if -->
// switch文
// <!-- switch( $val ) -->
// <!-- case val -->
// <!-- end switch -->
// ========================================

class Template{
	
	// ファイル ロード
	function load_file($template_file){
		return join("",file($template_file));
	}
	// テンプレートエリア
	function get_area($tp_start, $tp_end, $template){
		$cnt = preg_match_all("/$tp_start(.+?)$tp_end/s", $template, $matchlist, PREG_PATTERN_ORDER);
		$tmplist = preg_split("/$tp_start(.+?)$tp_end/s", $template);
		return array($tmplist[0], $matchlist[1][0], $tmplist[1]);
	}
	
	// テンプレートエリアを削除
	function delete_area($tp_start, $tp_end, $template){
		return preg_replace("/$tp_start(.+?)$tp_end/s", "" , $template);
	}
	
	// テンプレートエリアを置換
	function replace_area($tp_start, $tp_end, $template, $replace_string){
		return preg_replace("/$tp_start(.+?)$tp_end/s", "$replace_string", $template);
	}
	
	// テンプレートエリアを取得し、連想配列リストを元に展開、テンプレートデータを更新
	function set_valuelist($tp_start, $tp_end, $template, $list){
		list($header, $body, $footer) = $this->get_area($tp_start, $tp_end, $template);
		$tmp = "";
		foreach($list as $item){
			$tmp .= $this->set_value($body, $item);
		}
		return ($header . $tmp . $footer);
	}
	
	// テンプレートエリアを取得し、連想配列リストを元に展開、テンプレートデータを更新
	function set_valuelist_branches($tp_start, $tp_end, $template, $list){
		list($header, $body, $footer) = $this->get_area($tp_start, $tp_end, $template);
		$tmp = "";
		foreach($list as $item){
			$tmp .= $this->set_value($body, $item);
			$tmp .= $this->set_branches($body, $item);
		}
		return ($header . $tmp . $footer);
	}

	// テンプレートエリアに連想配列の値をセット
	function set_value($template, $list){
		foreach($list as $key => $value){
			if(!is_array($value)){
				$template = preg_replace("/<\?{$key}\?>/s", "$value", $template);
			}else{
				$v = get_key_one($value,0);
				$template = preg_replace("/<\?{$key}\?>/s", "$v", $template);
			}
		}
		return $template;
	}

	// テンプレートエリアに連想配列の値をセット
	function set_value2($template, $list){
		foreach($list as $key => $value){
			$template = preg_replace("/<\?{$key}\?>/s", $value, $template);
		}
		return $template;
	}

	// 値指定のタグを全て削除
	function delete_value($template){
		return preg_replace("/<\?(.+?)\?>/s", "", $template);
	}
	
	// テンプレートのif文を連想配列を元に評価
	function set_branches($template, $if_list){
		GLOBAL $global_template_if_list;
		$global_template_if_list = $if_list;
		$return = preg_replace_callback("/\<\!-- if\( \\\$(.+?) (.+?) (.+?) \) --\>(.+?)\<\!-- end if --\>/s", "template_if_callback", $template);
		$global_template_if_list = array();
		return $return;
	}

	// テンプレートのswitch文を連想配列を元に評価
	function set_switches($template, $if_list){
		GLOBAL $global_template_casevalue_list;
		$global_template_casevalue_list = $if_list;
		$return = preg_replace_callback("/\<\!-- switch\( \\\$(.+?) \) --\>(.+?)\<\!-- end switch --\>/s", "template_switch_callback", $template);
		$global_template_casevalue_list = array();
		return $return;
	}

	// テンプレートデータのシステムコメントを有効にする
	function comment_enable($template){
		return preg_replace_callback("/\<\!--\<tp-comm\>(.+?)\<\/tp-comm\>--\>/s", "template_comment_callback", $template);
	}
} // class end




	
/*  function ------*/	

// if文連想配列評価時のコールバック関数(set_branches内にてcall)

$global_template_if_list = array();

	function template_if_callback($list){
		GLOBAL $global_template_if_list;
		if(ereg("\<\!-- else --\>", $list[4]) == true){
			$tmp = $list[4];
			list($result1, $result2) = split("\<\!-- else --\>", $list[4]);
		}else{
			$result1 = $list[4];
			$result2 = "";
		}
		
		// 変数の存在を確認（変数が存在しなければ処理を終了）
		if( isset($global_template_if_list[$list[1]]) == false ){
			return $list[0];
		}
		
		// 一時的に値を保管
		$variable	= $global_template_if_list[$list[1]];
		$value		= $list[3];
		$eva		= $list[2];
		$eva_flag = false;
		switch ($eva) {
			case "==":
				if($variable == $value){
				    $eva_flag = true;
				}else{
				    $eva_flag = false;
				}
				break;
			case "!=":
				if($variable != $value){
					    $eva_flag = true;
				}else{
					    $eva_flag = false;
				}
				break;
			case ">":
				if((float)$variable > (float)$value){
				    $eva_flag = true;
				}else{
				    $eva_flag = false;
				}
				break;
			case ">=":
				if((float)$variable >= (float)$value){
					$eva_flag = true;
				}else{
					$eva_flag = false;
				}
				break;
			case "<":
				if((float)$variable < (float)$value){
					$eva_flag = true;
				}else{
					    $eva_flag = false;
				}
				break;
			case "<=":
				if((float)$variable <= (float)$value){
					$eva_flag = true;
				}else{
					$eva_flag = false;
				}
				break;
			default:
				break;
		}
		
		// 実行結果を返す

		if($eva_flag == true){
			return $result1;
		}else{
			return $result2;
		}
		return $return;
	}

	// switch文連想配列評価時のコールバック関数(set_switches内にてcall)
	$global_template_casevalue_list = array();
	$global_template_case_list = array();

	function template_switch_callback( $list ){
		GLOBAL $global_template_casevalue_list;
		GLOBAL $global_template_case_list;
		// 配列の初期化
		
		$global_template_case_list = array();

		// caseの項目からglobal_template_case_listに値配列を生成

		$dammy = preg_replace_callback("/\<\!-- case (.+?) --\>/s", "template_case_callback", $list[2]);

		// 実際に表示する項目の配列を生成

		$value_list = preg_split("/\<\!-- case (.+?) --\>/", $list[2]);

		// caseにかかれている項目から合致する値を検索する

		$cnt = 0;
		$case_num = -1;
		foreach($global_template_case_list as $case_string){
			if( $global_template_casevalue_list[$list[1]] == $case_string){
				$case_num = $cnt;
			}
			$cnt++;
		}
		
		// 検索した値から表示する項目を取得する

		$return = "";
		if( $case_num != -1 ){
		$return = $value_list[$case_num + 1];
		}
		$global_template_case_list = array();
		return $return;
	}
	
	// switch文連想配列評価時のコールバック関数(template_switch_callback内にてcall)
	function template_case_callback( $list ){
		GLOBAL $global_template_case_list;
		array_push($global_template_case_list, $list[1]);
	}

	// コメント有効化関数のコールバック関数(comment_enable内にてcall)
	function template_comment_callback( $list ){
		return $list[1];
	}

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>