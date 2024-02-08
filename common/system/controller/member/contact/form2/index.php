<?php

/**--------------------------------------------------------------------
  ProjectName :
  description :
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once(dirname(__FILE__) . '/../../../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');


class index extends Base{

	public function index(){
		parent::Base();
	}

	public function Show(){
		global $inquiry_form,$FORM_STATE,$INQUIRY_SELECT_MEMBER,$INQUIRY_CHECKBOX;
		$this->_sessionName = "member_contact_form2";
        $this->_sessionStartParamName = 'member_contact_form2_start_param';

		if($this->checkLoged() != true){
            // 非会員用お問い合わせに遷移
            $requestUri = $_SERVER['REQUEST_URI'];
            $url = str_replace("/member", "", $requestUri);
			header('location: ' . $url);
			exit;
		}

		$this->initValue($inquiry_form);
        $this->_setStartParams();
        // 商品データを取得
        $productData = $this->_getProductData($_SESSION[$this->_sessionStartParamName]['pcode']);
		
		$this->m_value['validate_msg'] = array();
        if ($_GET['back']) {
        	$this->m_value = $_SESSION[$this->_sessionName]['input'];
        	$this->m_value['validate_msg'] = $_SESSION[$this->_sessionName]['error'];
        } else {
            // 初期表示
			$this->m_value = $this->m_objCommon->setExternalFromSession($this->m_value);
			$this->m_objCommon->unsetSessionFormState(get_class(),1);

            // 初期表示
            $startParam = $_SESSION[$this->_sessionStartParamName];
            if ($startParam['ctype'] == 1 || $startParam['ctype'] == 2) {
            	$this->m_value['inquiry_check'] = $startParam['ctype'];
            }

            if ($productData) {
                $productStr = $this->_getProductStr($startParam, $productData);
                $this->m_value['sample_note'] = $productStr;
            }
        }
        $this->m_value['product'] = $productData;
        
		$mem_info = $this->logedin_member_info();

		$this->_makeForm($mem_info);
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

    // 対象製品文字列を作成
    private function _getProductStr($input, $product) {
        $cname = "のサンプル機貸し出し依頼";
        $cname2 = "サンプル機貸し出し依頼";
        //$str = "{$product['series']}{$cname}（このタイトルの下から検査内容を入力してください）\n";
        //$str .= "※違う製品について{$cname2}をされる場合は、上記タイトルの製品名を直接修正してください。\n";
        $str = "";
        return $str;
    }

    // 商品データを取得
    private function _getProductData($pcode) {
        $csvUrl = AP_ROOT . "/common/csv/product.csv";
        $fp = fopen($csvUrl, "r");
        while($row = fgetcsv($fp)) {
            $rowCnt = count($row);
            if ($row[0] == "code") continue;// 1行目は処理しない
            for($cnt = 0; $cnt < $rowCnt; $cnt++) {
                $tmp = $this->_getProductDataLine($pcode, $row);
                if ($tmp !== false) {
                    $data = $tmp;
                    break;
                }
            }
        }
        return $data;
    }

    // 商品データを配列で取得（pcodeに一致する行の時）
    private function _getProductDataLine($pcode, $row) {

        // PCODEが一致するかチェック
        if ($row[0] != $pcode) {
            return false;
        }
        $data = array();
        $data['code'] = $row[0];
        $data['name'] = $row[1];
        $data['series'] = $row[2];
        $data['image'] = $row[3];
        $data['description'] = $row[4];
        return $data;
    }

    // 製品画面から受け取ったURLパラメータをセッションにセット
    private function _setStartParams() {
        $params = array();
        if (!$_GET['back']) {
            // 商品コード
            $pcode = $_GET['pcode'];
            // 半角英数字、ハイフン、アンダースコアが使用可能
            if ( preg_match("/^[\dA-z-_]+$/", $pcode) ) {
                $params['pcode'] = $pcode;
            }

            // お問い合せ種別
            $ctype = $_GET['ctype'];
            if ($ctype >= 1 && $ctype <= 3) {
                $params['ctype'] = $ctype;
            }
            $_SESSION[$this->_sessionStartParamName] = $params;
        }
    }

	private function _makeForm($member_info){
		global $CABLE_LENGTH,$NEEDS;
		//$this->m_value['radio_power_needs'] = $this->m_objCommon->makeRadio($NEEDS,'power_needs',axts('power_needs',$this->m_value),true);
		$cable_length = (axts('cable_length',$this->m_value)) ? $this->m_value['cable_length'] : array();
		$sep = count($CABLE_LENGTH) + 1;
		$this->m_value['checkbox_cable_length'] = $this->m_objCommon->makeCheckbox($CABLE_LENGTH,'cable_length',$cable_length,$sep);
		$this->m_value['company_name'] = $member_info['company_name'];
		$this->m_value['charge_name'] = $member_info['charge_name'];
		$this->m_value['kdn_member_id'] = $member_info['id'];
		$this->m_value['check_cable_needs1'] = ($this->m_value['cable_needs'] != '2') ? 'checked="checked"' : '';
		$this->m_value['check_cable_needs2'] = ($this->m_value['cable_needs'] == '2') ? 'checked="checked"' : '';
		$this->m_value['check_privacy'] = ($this->m_value['privacy'] == '1') ? 'checked="checked"' : '';

		$this->m_value['usable_years'] = $this->_getUsableYears();

		//option_return_date_year,month,day
		// $this->m_value['option_return_date_year'] =  $this->m_objCommon->selYear(axts('return_date_year',$this->m_value),date('Y'),true );
		// $this->m_value['option_return_date_month'] =  $this->m_objCommon->selMonth(axts('return_date_month',$this->m_value),true );
		// $this->m_value['option_return_date_day'] =  $this->m_objCommon->selDay(axts('return_date_day',$this->m_value),axts('return_date_month',$this->m_value,''),axts('return_date_day',$this->m_value,''));
		// //option_lent_start_date_year,month,day
		// $this->m_value['option_lent_start_date_year'] =  $this->m_objCommon->selYear(axts('lent_start_date_year',$this->m_value),date('Y'),true );
		// $this->m_value['option_lent_start_date_month'] =  $this->m_objCommon->selMonth(axts('lent_start_date_month',$this->m_value),true );
		// $this->m_value['option_lent_start_date_day'] =  $this->m_objCommon->selDay(axts('lent_start_date_day',$this->m_value),axts('lent_start_date_month',$this->m_value,''),axts('lent_start_date_day',$this->m_value,''));
	
	}

	// 選択可能な年範囲を取得
	private function _getUsableYears() {
        $thisYear = date('Y');
        $endYear = date('Y', strtotime('+3 year'));
        $years = range($thisYear, $endYear);
        return $years;
	}

}
$cl = new index();
$data = $cl->m_value;
/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>