<?php 

    // メール設定を取得
    function getMailConfig(){
        // baseクラスの読み込み
        $baseClassPath = dirname(__FILE__) . "/../../../common/system/include/class/base.class.php";
        require_once $baseClassPath;
        $base = new Base();
        // setting_areaクラスの読み込み
        $settingAreaPath = dirname(__FILE__) . "/../../../common/system/include/const/setting_area.inc";
        require_once $settingAreaPath;
        global $G_ADMIN_WEST_MAIL, $G_ADMIN_EAST_MAIL;
        $conf = array();
        $conf['fromName'] = "京都電機器株式会社";
        $conf['from'] = $base->get_admin_mail();
        $conf['admin'] = "{$G_ADMIN_WEST_MAIL},{$G_ADMIN_EAST_MAIL}";
        return $conf;
    }

    // フォーム設定を取得
    function getFormConfig(){
        $fconfig = array(
            'ctype' => array(
                'itemName' => 'お問い合わせ種別',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'company_name' => array(
                'itemName' => '御社名',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'person_name' => array(
                'itemName' => 'ご担当者名',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'zip' => array(
                'itemName' => '郵便番号',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                    'Zipcode'  => '1',
                ),
            ),
            'pref' => array(
                'itemName' => '都道府県',  
                'checkList' => array(
                    'MustSelect'  => '1',
                ),
            ),
            'address' => array(
                'itemName' => 'ご住所',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                ),
            ),
            'tel' => array(
                'itemName' => '電話番号',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                    'Tel'  => '1',
                ),
            ),
            'fax' => array(
                'itemName' => 'FAX',  
                'checkList' => array(
                    'Fax'  => '1',
                ),
            ),
            'mail' => array(
                'itemName' => 'メールアドレス',  
                'checkList' => array(
                    'NotEmpty'  => '1',
                    'Mail'  => '1',
                ),
            ),
            'agree' => array(
                'itemName' => '同意',  
                'checkList' => array(
                    'Agree'  => '1',
                ),
            ),
        );
        return $fconfig;
    }

    // 都道府県名取得
    function getPrefName($id = null) {
        $list = getPrefList();
        $name = "";
        if ($id > 0) {
            $name = $list[$id];
        }
        return $name;
    }

    // 種別名称
    function getTypeName($key, $val) {
        $types = array(
            'ctype' => array(
                1 => '見積依頼',
                2 => '製品に関するお問い合わせ',
                3 => '会員用パスワード再発行',
            ),
        );


        return $types[$key][$val];
    }

    // 都道府県一覧
    function getPrefList() {
        $prefs = array(
            "1" => "北海道",
            "2" => "青森県",
            "3" => "岩手県",
            "4" => "宮城県",
            "5" => "秋田県",
            "6" => "山形県",
            "7" => "福島県",
            "8" => "茨城県",
            "9" => "栃木県",
            "10" => "群馬県",
            "11" => "埼玉県",
            "12" => "千葉県",
            "13" => "東京都",
            "14" => "神奈川県",
            "15" => "新潟県",
            "16" => "富山県",
            "17" => "石川県",
            "18" => "福井県",
            "19" => "山梨県",
            "20" => "長野県",
            "21" => "岐阜県",
            "22" => "静岡県",
            "23" => "愛知県",
            "24" => "三重県",
            "25" => "滋賀県",
            "26" => "京都府",
            "27" => "大阪府",
            "28" => "兵庫県",
            "29" => "奈良県",
            "30" => "和歌山県",
            "31" => "鳥取県",
            "32" => "島根県",
            "33" => "岡山県",
            "34" => "広島県",
            "35" => "山口県",
            "36" => "徳島県",
            "37" => "香川県",
            "38" => "愛媛県",
            "39" => "高知県",
            "40" => "福岡県",
            "41" => "佐賀県",
            "42" => "長崎県",
            "43" => "熊本県",
            "44" => "大分県",
            "45" => "宮崎県",
            "46" => "鹿児島県",
            "47" => "沖縄県",
        );
        return $prefs;
    }

?>
