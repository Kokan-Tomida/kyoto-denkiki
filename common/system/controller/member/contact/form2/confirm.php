<?php

/**--------------------------------------------------------------------
  ProjectName :
  description :		サンプル機貸出　「確認」と「送信」処理
  Created / Author :
  LastUpdated / Author : 	yyyy/mm/dd xxxx
  =====================================================
  UpdatedHistory :
  Date			name		summary
  yyyy/mm/dd 	xxxxxx	xxxxx
---------------------------------------------------------------------*/

require_once(dirname(__FILE__) . '/../../../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');
require_once(PATH_MODULES."/lib/Validator.class.php");


class confirm extends Base{

	var $m_password = false;

	public function confirm(){
		parent::Base();
	}

	public function Show(){
		global $inquiry_form;
		$this->_sessionName = "member_contact_form2";
        $this->_sessionStartParamName = 'member_contact_form2_start_param';
		if($this->checkLoged() != true){
            // 未ログインのとき、ログインページに遷移
            $url = "/member/";
            header('location: ' . $url);
			exit;
		}

		$this->initValue($inquiry_form);
        // 商品データを取得
        $productData = $this->_getProductData($_SESSION[$this->_sessionStartParamName]['pcode']);

		if(is_set('to_complete', $this->m_vARGV, NULL)){
            // 送信
			$this->m_value = $_SESSION[$this->_sessionName]['input'];
			$this->m_value['lent_start_date'] = $this->m_value['lent_start_date_db'];
			$this->m_value['return_date'] = $this->m_value['return_date_db'];
			$this->m_value['cable_length'] = $this->m_value['cable_length_name'];
			$this->_to_regist();
		}
        // 確認
        $input = $_POST;
        $input = $this->_formatInput($input);
        $this->m_value = $input;
        $_SESSION[$this->_sessionName]['input'] = $input;
        $_SESSION[$this->_sessionName]['error'] = array();
        $error = $this->_validate($input);
        if (!empty($error)) {
            // エラー時、入力画面に遷移
	        $_SESSION[$this->_sessionName]['error'] = $error;
        	header("location: index.php?back=1");
        	exit;
        }

        $this->m_value['product'] = $productData;

        $this->_makeForm();
		$this->m_value['header_link'] = $this->loged_header();
		return $this->m_objTemplate->set_value($template, $this->m_value);
	}

    // 商品データを取得
    private function _getProductData($pcode) {
        $csvUrl = AP_ROOT . "/common/csv/product.csv";
        $lines = file($csvUrl);
        array_shift($lines);
        if ($lines) {
            foreach ($lines as $line) {
                $tmp = $this->_getProductDataLine($pcode, $line);
                if ($tmp !== false) {
                    $data = $tmp;
                    break;
                }
            }
        }
        return $data;
    }

    // 商品データを配列で取得（pcodeに一致する行の時）
    private function _getProductDataLine($pcode, $line) {

        // 引用符を除去
        $line = ltrim($line, '"');
        $line = rtrim($line, '"');
        $line = str_replace('","', ',', $line);

        $columns = explode(",", $line);
        if ($columns[0] != $pcode) {
            return false;
        }
        $data = array();
        $data['code'] = $columns[0];
        $data['name'] = $columns[1];
        $data['series'] = $columns[2];
        $data['image'] = $columns[3];
        $data['description'] = $columns[4];
        return $data;
    }

	// 入力値整形
	private function _formatInput($input){
        global $G_PREF_LIST;

        if ($input['cable_needs'] == "2") {
            // 延長ケーブル不要の時、本数を消去
            $input['cable_count'] = "";
        }
        if (is_array($input['cable_length'])) {
            if ( !in_array("9", $input['cable_length']) ) {
                // その他が選択されていない時、その他mを消去
                $input['cable_length_other'] = "";
            }
        }

        /** 表示名取得 **/
        $input['power_needs_view'] = $this->_getTypeName('power_needs', $input['power_needs']);
        $input['cable_needs_view'] = $this->_getTypeName('cable_needs', $input['cable_needs']);
        if ($input['cable_count'] != '') {
            $input['cable_count_view'] = $input['cable_count'] . '本';
        } else {
            $input['cable_count_view'] = "";
        }
        $cableLength = "";
        if ($input['cable_length']) {
            foreach($input['cable_length'] as $inputLen) {
                if ($cableLength != "") {
                    $cableLength .= ", ";
                }
                $cableLength .= $this->_getTypeName('cable_length', $inputLen);
            }
        }
        $input['cable_length_view'] = $cableLength;
        if ($input['cable_length_other'] != '') {
            $input['cable_length_other_view'] = $input['cable_length_other'] . 'm';
        } else {
            $input['cable_length_other_view'] = "";
        }
        // 日付フォーマット
        if ($input['lent_start_date_year'] && $input['lent_start_date_month'] && $input['lent_start_date_day']) {
            $input['lent_start_date_view'] = date("Y年m月d日", strtotime($input['lent_start_date_year'].$input['lent_start_date_month'].$input['lent_start_date_day']));
            $input['lent_start_date_db'] = date("Y-m-d", strtotime($input['lent_start_date_year'].$input['lent_start_date_month'].$input['lent_start_date_day']));
        } else {
            $input['lent_start_date_view'] = "";
        }
        if ($input['return_date_year'] && $input['return_date_month'] && $input['return_date_day']) {
            $input['return_date_view'] = date("Y年m月d日", strtotime($input['return_date_year'].$input['return_date_month'].$input['return_date_day']));
            $input['return_date_db'] = date("Y-m-d", strtotime($input['return_date_year'].$input['return_date_month'].$input['return_date_day']));
        } else {
            $input['return_date_view'] = "";
        }
		return $input;
	}

	// バリデーション
	private function _validate($input){
        global $G_VALIDATE_MESSAGE;

        $formConfig = $this->_getFormConfig();
        // 引数チェック
        if ( count($input) < 1 || count($formConfig) < 1 ) {
            // error=trueを返す
            return true;
        }
        // エラーチェック バリデーションクラス１Validator
        $error = array();
        $validator = new Validator();
        foreach ($formConfig as $formName => $config) {
           // 入力値をバリデーション用にセット
            $config["data"] = $input[ $formName ];
            $config["formName"] = $formName;
            $config["sessionName"] = $this->_sessionName;

            $validResult = $validator->check($config);
            if ($validResult) {
                $error[ $formName ] = $validResult;
            }
        }
        // 追加
        if ($input['cable_needs'] == "1" && $input['cable_count'] == "") {
            $error["cable_count"] = "延長ケーブル：必要を選んだ場合は、本数をご入力下さい。";
        }
        if (is_array($input['cable_length'])) {
            if (in_array("9", $input["cable_length"]) && $input["cable_length_other"] == "") {
                $error["cable_length_other"] = "ケーブル長：その他を選んだ場合は、長さをご入力下さい。";
            }
        }
        return $error;
	}

    // 種別名称
    private function _getTypeName($key, $val) {
        $types = array(
            'power_needs' => array(
                1 => '必要',
                2 => '不要',
            ),
            'cable_needs' => array(
                1 => '必要',
                2 => '不要',
            ),
            'cable_length' => array(
                2 => '2m',
                3 => '3m',
                4 => '4m',
                9 => 'その他',
            ),
        );


        return $types[$key][$val];
    }

	// バリデーション設定
	private function _getFormConfig(){
        $fconfig = array(
            // サンプル機情報
            'cable_count' => array(
                'itemName' => '本数',  
                'checkList' => array(
                    'Number'  => '1',
                ),
            ),
            'cable_length_other' => array(
                'itemName' => '長さ',  
                'checkList' => array(
                    'Number'  => '1',
                ),
            ),
            'lent_start_date' => array(
                'itemName' => '貸出',  
                'checkList' => array(
                    'Date'  => '1',
                    'Future'  => '1',
                ),
            ),
            'return_date' => array(
                'itemName' => '返却',  
                'checkList' => array(
                    'Date'  => '1',
                    'Future'  => '1',
                    'ReturnLaterThan' => 'lent_start_date',
                ),
            ),
        );
        return $fconfig;
	}


	private function _makeForm(){
		$mem_info = $this->logedin_member_info();
		$this->m_value['company_name'] = $mem_info['company_name'];
		$this->m_value['charge_name'] = $mem_info['charge_name'];
	}

	private function _to_regist(){
		$this->m_value['kdn_member_id'] = $this->logedin_member_info('id');
		$this->m_value['sample_note'] = htmlspecialchars_decode($this->m_value['sample_note']);
        $this->m_value['cable_length'] = $this->m_value['cable_length_view'];
        $sampleHistory = $this->m_value;

        // DB登録用に消去
        if (!$sampleHistory['cable_count']) {
            unset($sampleHistory['cable_count']);
        }
        if (!$sampleHistory['lent_start_date']) {
            unset($sampleHistory['lent_start_date']);
        }
        if (!$sampleHistory['return_date']) {
            unset($sampleHistory['return_date']);
        }
		$this->Add('kdn_sample_history',$sampleHistory);
	
		//mysql_insert_id()
		$note1 = '照明 -1.型式・台数: '.axts('model1',$this->m_value).' 照明 -2.型式・台数: '.axts('model2',$this->m_value);
		$note2 = '電源: '.$this->m_value['power_needs_view'].'  型式・台数: '.axts('power_type',$this->m_value);
		$note3 = '対象物ワーク: '.axts('target_work',$this->m_value);
		//$note3 = '貸し出し希望日: '.axts('lent_start_date_view',$this->m_value).' 返却予定日: '.axts('return_date_view',$this->m_value);
		$data = array(
			'kdn_member_id' => $this->logedin_member_info('id'),
			'generate_date' => date('Y-m-d'),
			'generate_time' => date('H:i:s'),
			'note1' => $note1,
			'note2' => $note2,
			'note3' => $note3,
			'history_id' => $this->m_objDB->mDB->lastInsertId(),
			'type' => HISTORY_TYPE1 
		);
		$this->Add('kdn_history',$data);

		$from = $this->get_admin_mail();
		$to = $this->logedin_member_info('email_address');

        $mailBodyData = $this->_makeMailData();
		list($subject,$body) = $this->createMailBodys(MAIL_TYPE2,$mailBodyData);
		$pref = $this->logedin_member_info('pref');
		$to_admin = $this->setFromAddress(MAIL_TYPE2,$pref);
		$body_admin = $this->makeMailDataMemberInfo();
		$subject_admin = $this->createMailSubject(MAIL_TYPE2,$pref);
		$this->m_objMail->set_ini($from,$to,$subject,$body,$to_admin,$subject_admin,$body."\n".MAIL_BODY_SEPARETION.$body_admin);
		$this->m_objMail->send_user_mail();// 分岐2

		$this->m_value = array();
		$this->clearSession(S_KEY10, S_KEY20);
		$this->clearSession(S_KEY10, S_KEY30);
		header('location: thanks.php');
		exit;
	}

	private function _makeMailData(){
        $data = $this->m_value;
        $mem_info = $this->logedin_member_info();
		$data['company_name'] = $mem_info['company_name'];
		$data['section'] = $mem_info['section'];
		$data['charge_name'] = $mem_info['charge_name'];
		return $data;
	}

}
$cl = new confirm();
$data = $cl->m_value;

/* COPYRIGHT(C)  DeeSystem. ALL RIGHTS RESERVED. */
?>