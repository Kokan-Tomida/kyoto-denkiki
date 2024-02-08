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
    const MESSAGE_EQUAL = '同じ値を入力して下さい。';

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

        // if ( $checkList['Hiragana'] ) {
        //     if ( $omitCheckNone && !$this->checkHiragana($data) ) {
        //         $message = $this->getMessage($itemName, self::MESSAGE_HIRAGANA);
        //         return $message;
        //     }
        // }
        // if ( $checkList['Number'] ) {
        //     if ( !$omitCheckNone && !$this->checkNumber($data) ) {
        //         $message = $this->getMessage($itemName, self::MESSAGE_NUMBER);
        //         return $message;
        //     }
        // }
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
        $regex = '/^\d{1,}$/';
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

    // 韓国の郵便番号形式のときtrue
    public function checkZipKr($data) {
        if (empty($data)) {
            return true;
        }
        $regex = "/^\d{3}-?\d{3}$/";
        if (preg_match($regex, $data)) {
            return true;
        }
        return false;
    }
}
?>