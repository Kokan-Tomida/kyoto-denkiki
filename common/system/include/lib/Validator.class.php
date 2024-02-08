<?php
/**
 *
 * バリデーションクラス
 *
 */
class Validator {

    const MESSAGE_NOT_EMPTY = '必須項目です';
    const MESSAGE_HIRAGANA = '%%%NAME%%%をひらがなで入力して下さい。';
    const MESSAGE_NUMBER = '%%%NAME%%%を数値で入力して下さい。';
    const MESSAGE_TEL = '電話番号を確認して下さい。';
    const MESSAGE_FAX = 'FAX番号を確認して下さい。';
    const MESSAGE_MAIL = 'メールアドレスを確認して下さい。';
    const MESSAGE_ZIP = '郵便番号を確認して下さい。';
    const MESSAGE_DATE = '日付を確認して下さい。';
    const MESSAGE_FUTURE_DATE = '未来の日付を入力して下さい。';
    const MESSAGE_EQUAL = '同じ値を入力して下さい。';

    const MESSAGE_RETURNLATERTHAN = '返却予定日は貸し出し希望日より後の日付を設定して下さい。';

    /**
    *
    * バリデーションを実行してエラーメッセージを返す
    *
    */
    public function check($param) {
        $data = $param['data'];
        $checkList = $param['checkList'];
        $itemName = $param['itemName'];
        $sessionName = $param['sessionName'];

        if ( $checkList['NotEmpty'] ) {
            if ( empty($data) ) {
                $message = $this->getMessage($itemName, self::MESSAGE_NOT_EMPTY);
                return $message;
            }
        }

        // チェックボックスの値によりバリデーションするかを決める項目のフラグをセット
        $omitCheckNone = false;
        if ( $checkList['NotEmptyNone'] ) {
            $target = $_SESSION[ $sessionName ][ $checkList['NotEmptyNone'] ];
            if ( empty($target) && empty($data) ) {
                // NotEmptyの空チェックでまず検出するのでチェック不要
                $omitCheckNone = true;
            }
            if ( !empty($target) ) {
                // NotEmptyNone対象入力値の値が1なのでチェック不要
                $omitCheckNone = true;
            }
        }

        if ( $checkList['Number'] ) {
            if ( !$omitCheckNone && !$this->checkNumber($data) ) {
                $message = $this->getMessage($itemName, self::MESSAGE_NUMBER);
                return $message;
            }
        }
        if ( $checkList['Tel'] ) {
            if ( (!$checkList['NotEmptyNone'] || !$omitCheckNone) 
                && !$this->checkTel($data) ) {
                $message = $this->getMessage($itemName, self::MESSAGE_TEL);
                return $message;
            }
        }
        if ( $checkList['Fax'] ) {
            if ( (!$checkList['NotEmptyNone'] || !$omitCheckNone) 
                && !$this->checkTel($data) ) {
                $message = $this->getMessage($itemName, self::MESSAGE_FAX);
                return $message;
            }
        }
        if ( $checkList['Mail'] ) {
            if ( (!$checkList['NotEmptyNone'] || !$omitCheckNone) 
                && !$this->checkMail($data) ) {
                $message = $this->getMessage($itemName, self::MESSAGE_MAIL);
                return $message;
            }
        }
        if ( $checkList['Zipcode'] ) {
            if ( (!$checkList['NotEmptyNone'] || !$omitCheckNone) 
                && !$this->checkZip($data) ) {
                $message = $this->getMessage($itemName, self::MESSAGE_ZIP);
                return $message;
            }
        }
        if ( $checkList['Date'] ) {
            // yyyymmddを作成
            $input = $_SESSION[ $sessionName ]['input'];

            //  ***がなくて、***_y、***_m、***_dがあるとき用のチェック
            $tmps = array($input[ $param['formName'] . '_year']
                , $input[ $param['formName'] . '_month']
                , $input[ $param['formName'] . '_day']);
            if (implode("", $tmps) != "") {
                $data = $tmps;
                if ( !$this->checkDateArray($data) ) {
                    $message = $this->getMessage($itemName, self::MESSAGE_DATE);
                    return $message;
                }
            }
        }
        if ( $checkList['Future'] ) {
            // yyyymmddを作成
            $input = $_SESSION[ $sessionName ]['input'];

            //  ***がなくて、***_y、***_m、***_dがあるとき用のチェック
            $tmps = array($input[ $param['formName'] . '_year']
                , $input[ $param['formName'] . '_month']
                , $input[ $param['formName'] . '_day']);
            if (implode("", $tmps) != "") {
                $data = $tmps;
                if ( $this->checkDateArray($data) && !$this->checkFutureDateArray($data) ) {
                    $message = $this->getMessage($itemName, self::MESSAGE_FUTURE_DATE);
                    return $message;
                }
            }
        }
        if ( $checkList['ReturnLaterThan'] ) {
            // yyyymmddを作成
            $input = $_SESSION[ $sessionName ]['input'];

            //  ***がなくて、***_y、***_m、***_dがあるとき用のチェック
            $data = array($input[ $param['formName'] . '_year']
                , $input[ $param['formName'] . '_month']
                , $input[ $param['formName'] . '_day']);
            $targ = array($input[ $checkList['ReturnLaterThan'] . '_year']
                , $input[ $checkList['ReturnLaterThan'] . '_month']
                , $input[ $checkList['ReturnLaterThan'] . '_day']);
            $dataStr = implode("", $data);
            $targStr = implode("", $targ);
            if ( (int)$dataStr < 20000000 || (int)$targStr < 20000000 ) {
                // YMD全て選択されているかチェック
                return;
            }
            if ( !$this->checkDateArray($data) || !$this->checkDateArray($targ) ) {
                // 日付形式で引っかかっていないかチェック
                return;
            }
            $dif = $dataStr - $targStr;
            if ( $dif < 0 ) {
                $message = $this->getMessage($itemName, self::MESSAGE_RETURNLATERTHAN);
                return $message;
            }
        }
        if ( $checkList['Equal'] ) {
            $target = $_SESSION[ $sessionName ][ $checkList['Equal'] ];
            if ( !empty($data) && $data !== $target ) {
                $message = $this->getMessage($itemName, self::MESSAGE_EQUAL);
                return $message;
            }
        }
        if ( $checkList['NotEmptyNone'] ) {
            $target = $_SESSION[ $sessionName ][ $checkList['NotEmptyNone'] ];
            if ( empty($target) && empty($data) ) {
                $message = $this->getMessage($itemName, self::MESSAGE_NOT_EMPTY);
                return $message;
            }
        }
    }

    /**
    *
    * エラーメッセージを返す
    *
    */
    public function getMessage($itemName, $beforeMessage) {
        $message = str_replace('%%%NAME%%%', $itemName, $beforeMessage);
        return $message;
    }

    // ひらがな+空白のときtrue
    public function checkHiragana($data) {
        $data = mb_convert_kana($data, "s");
        $data = trim($data);
        $regex = "^([ぁ-ん]+|(ー))+$";
        if (mb_ereg($regex, $data)) {
            return true;
        }
        return false;
    }

    // 数値形式のときtrue
    public function checkNumber($data) {
        $data = mb_convert_kana($data, 'n');
        if (empty($data) && $data != '0') {
            return true;
        }
        $regex = '/^[\d\.]{1,}$/';
        if (preg_match($regex, $data)) {
            return true;
        }
        return false;
    }

    // メール形式のときtrue
    public function checkMail($data) {
        $regex = "/^([*+!.&#$|\"\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})$/i";
        if (preg_match($regex, $data)) {
            return true;
        }
        return false;
    }

    // 電話番号形式のときtrue
    public function checkTel($data) {
        if (empty($data)) {
            return true;
        }
        $regex = '/^[\d-]{10,15}$/';
        if (preg_match($regex, $data)) {
            return true;
        }
        return false;
    }

    // 郵便番号形式のときtrue
    public function checkZip($data) {
        if (empty($data)) {
            return true;
        }
        $regex = "/^\d{3}-?\d{4}$/";
        if (preg_match($regex, $data)) {
            return true;
        }
        return false;
    }

    // 日付形式のときtrue
    public function checkDateArray($data) {
        if (empty($data)) {
            return true;
        }
        if (!checkdate($data[1], $data[2], $data[0])) {
            return false;
        }
        return true;
    }

    // 現在の日付より未来のときtrue
    public function checkFutureDateArray($data) {
        if (empty($data)) {
            return true;
        }
        $dataYmd = "{$data[0]}-{$data[1]}-{$data[2]}";
        $dataYmdStr = strtotime($dataYmd);
        $todayYmdStr = strtotime("today");
        if ($dataYmdStr < $todayYmdStr) {
            return false;
        }
        return true;
    }
}
?>