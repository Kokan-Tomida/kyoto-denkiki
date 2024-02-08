<?php 

require_once dirname(__FILE__) . "/../../../common/system/include/env/env.inc";
require_once dirname(__FILE__) . "/../../../common/system/include/ProcessStart.inc";
// コントローラ
class Controller {
    // コンストラクタ
    public function __construct() {
        $this->basePath = realpath(dirname(__FILE__).'/../');

        mb_language('japanese');
        mb_detect_encoding('utf8,ascii');
        mb_internal_encoding('utf8');

        error_reporting(E_ALL & ~E_NOTICE);

        session_start();

        $this->sessionStartParamName = 'start_param';
        $this->sessionInputName = 'contact_input';
        $this->sessionErrorName = 'contact_error';
    }

    // アクション
    public function action() {
        $action = $this->getActionId();

        switch ($action) {
            case 'index':
                $this->inputAction();
                break;
            case 'confirm':
                $this->confirmAction();
                break;
            case 'finish':
                $this->finishAction();
                break;
            default:
                break;
        }
    }

    // アクション
    public function getActionId() {
        $file = basename($_SERVER['SCRIPT_NAME']);
        $info = pathinfo($file);
        $id = $info['filename'];
        return $id;
    }

    // 入力
    public function inputAction() {
        $data = array();

        $this->setStartParams();
        // 商品データを取得
        $productData = $this->getProductData($_SESSION[$this->sessionStartParamName]['pcode']);

        if ($_GET['back']) {
            // 確認画面から戻った時、セッションから入力値、エラーを取り出し
            $data['input'] = $_SESSION[$this->sessionInputName];
            $data['error'] = $_SESSION[$this->sessionErrorName];
        } else {
            // 初期表示
            if ( checkLoged() ) {// include/class/member.php
                // ログイン時は会員用お問い合わせに遷移
                $requestUri = $_SERVER['REQUEST_URI'];
                $url = "/member" . $requestUri;
                header('location: ' . $url);
                exit;
            }

            $param = $_SESSION[$this->sessionStartParamName];
            $input = array();
            if ($param['ctype']) {
                $input['ctype'] = $param['ctype'];
            }
            if ($productData) {
                $productStr = $this->getProductStr($input, $productData);
                $input['message'] = $productStr;
            }
            $data['input'] = $input;
        }

        $data['product'] = $productData;
        $this->setData($data);
    }

    // 対象製品文字列を作成
    public function getProductStr($input, $product) {
        if ($input['ctype'] == "1") {
            $cname = "の見積希望";
        } else {
            $cname = "に関するお問い合わせ";
        }
        $str = "{$product['series']}{$cname}\n";
        $str .= "製品の型式を入力してください。（※上記以外の製品の型式を入力いただいても構いません。）\n";
        return $str;
    }

    // 商品データを取得
    public function getProductData($pcode) {
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $csvUrl = "../../common/csv/product.csv";
        $fp = fopen($csvUrl, "r");
        while($row = fgetcsv($fp)) {
            $rowCnt = count($row);
            if ($row[0] == "code") continue;// 1行目は処理しない
            for($cnt = 0; $cnt < $rowCnt; $cnt++) {
                $tmp = $this->getProductDataLine($pcode, $row);
                if ($tmp !== false) {
                    $data = $tmp;
                    break;
                }
            }
        }
        return $data;
    }

    // 商品データを配列で取得（pcodeに一致する行の時）
    public function getProductDataLine($pcode, $row) {

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
    public function setStartParams() {
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
            $_SESSION[$this->sessionStartParamName] = $params;
        }
    }

    // 確認
    public function confirmAction() {
        // 入力値をセッションにセット
        //$tmp = $_POST;
        $input = $this->getFormatInputOnConfirm($_POST);
        $_SESSION[$this->sessionInputName] = $input;
        
        // エラーをセッションにセット
        $error = $this->validate($input);
        $_SESSION[$this->sessionErrorName] = $error;

        if ($error) {
            // 入力エラーが有るとき入力に戻る
            header("Location:index.php?back=1");
            exit();
        }

        $data = array();
        $data['input'] = $input;
        $data['error'] = $error;

        // 商品データを取得
        $productData = $this->getProductData($_SESSION[$this->sessionStartParamName]['pcode']);
        $data['product'] = $productData;
        $this->setData($data);
    }

    // 確認画面に遷移時、POSTされた入力値を整形
    public function getFormatInputOnConfirm($post) {

        $input = $post;
        if ($input['zip1'] || $input['zip2']) {
            $input['zip'] = $input['zip1'] . '-' . $input['zip2'];
        }
        if ($input['tel1'] || $input['tel2'] || $input['tel3']) {
            $input['tel'] = $input['tel1'] . '-' . $input['tel2'] . '-' . $input['tel3'];
        }
        if ($input['fax1'] || $input['fax2'] || $input['fax3']) {
            $input['fax'] = $input['fax1'] . '-' . $input['fax2'] . '-' . $input['fax3'];
        }
        $input['pref_name'] = getPrefName($input['pref']);
        $input['ctype_name'] = getTypeName("ctype", $input['ctype']);
        return $input;
    }

    // 完了
    public function finishAction() {

        // 入力値を取得
        $input = $_SESSION[$this->sessionInputName];

        // エラーをセッションにセット
        $error = $this->validate($input);
        $_SESSION[$this->sessionErrorName] = $error;

        if ($error) {

            // エラーが有るときエラーページに遷移
            header("Location:" . ERROR_MAIL_PAGE);
            exit();
        }

        _log(var_export($input,true));
        $send = $this->_sendMail($input);

        // セッションを消去
        unset($_SESSION[$this->sessionStartParamName]);
        unset($_SESSION[$this->sessionInputName]);
        unset($_SESSION[$this->sessionErrorName]);
        if ($send) {
            // 送信成功
            header("Location:thanks.php");
            exit();
        } else {
            // 送信失敗
            _log("send mail error");
            header("Location:" . ERROR_MAIL_PAGE);
            exit();
        }
    }

    // メール送信
    public function _sendMail($input) {
        $config = $this->_getMailConfig($input);
        $send = $this->_sendCustomerMail($input, $config);
        if ($send) {
            $send = $this->_sendAdminMail($input, $config);
        }
        return $send;
    }

    // 顧客にメール送信
    public function _sendCustomerMail($input, $config) {

        $to = $input['mail'];
        $fromName = $config['fromName'];
        $fromName = mb_encode_mimeheader (mb_convert_encoding($fromName,"ISO-2022-JP","AUTO"));
        $from = $config['from'];
        // subject:【お問い合わせ種別】会社名 様（都道府県名）
        $title = "【{$input['ctype_name']}】{$input['company_name']}様({$input['pref_name']})";
        $title = mb_convert_kana($title,'KV');
        $body = $this->getMailBody($input, 'customer');

        if (!$body) {
            return false;
        }

        $header = "From:{$fromName}<{$from}>";
        $param = "-f{$from}";
        
        $send = mb_send_mail($to, $title, $body, $header, $param);
        return $send;
    }

    // 管理者にメール送信
    public function _sendAdminMail($input, $config) {

        $to = $config['admin'];
        $to = implode(",", $to);
        $fromName = $config['fromName'];
        $fromName = mb_encode_mimeheader (mb_convert_encoding($fromName,"ISO-2022-JP","AUTO"));
        $from = $config['from'];
        // subject:【お問い合わせ種別】会社名様（都道府県名）
        $title = "【{$input['ctype_name']}】{$input['company_name']}様({$input['pref_name']})";
        $title = mb_convert_kana($title,'KV');
        $body = $this->getMailBody($input, 'admin');
        if (!$body) {
            return false;
        }

        $header = "From:{$fromName}<{$from}>";
        $param = "-f{$from}";

        $send = mb_send_mail($to, $title, $body, $header, $param);
        return $send;
    }

    private function _getMailConfig($input) {

        $conf = array();
        $conf['fromName'] = "京都電機器株式会社";
        $conf['from'] = get_admin_mail();// include/class/member.php
        $conf['admin'] = get_toadmin_mail(MAIL_TYPE8, $input['pref'], $conf['from']);// include/class/member.php
        return $conf;
    }

    // メール本文作成
    public function getMailBody($input, $type) {
        $path = $this->basePath . '/tpl/' . $type . '_mail.tpl';
        
        if ( !file_exists($path)) {
            return false;
        }
        $txt = file_get_contents($path);

        // {$hensu}を $input['hensu']に変換
        preg_match_all("/[{][$]([\w_]+)[}]/s", $txt, $matches);
        $vars = $matches[1];
        $target = $matches[0];
        if ($vars) {
            foreach ($vars as $k => $var) {
                $txt = str_replace($target[ $k ], $input[ $var ], $txt);
            }
        }
        return $txt;
    }

    // バリデーションチェック
    public function validate( $input ) {
        require_once($this->basePath . "/system/Validator.php");

        $formConfig = getFormConfig();
        // 引数チェック
        if ( count($input) < 1 || count($formConfig) < 1 ) {
            // error=trueを返す
            return true;
        }
        // エラーチェック
        $error = array();
        $validator = new Validator();

        foreach ($formConfig as $formName => $config) {
           // 入力値をバリデーション用にセット
            $config["data"] = $input[ $formName ];
            $config["sessionName"] = $this->sessionInputName;

            $validResult = $validator->check($config);
            if ($validResult) {
                $error[ $formName ] = $validResult;
            }
        }
        
        return $error;
      
    }

    // データセット
    public function setData($data) {
        $this->data = $data;
    }
    // データ取得
    public function getData() {
        return $this->data;
    }
    // データ取得
    public function getInput() {
        return $this->data['input'];
    }
    // データ取得
    public function getError() {
        return $this->data['error'];
    }
    // データ取得
    public function getProduct() {
        return $this->data['product'];
    }

}

?>