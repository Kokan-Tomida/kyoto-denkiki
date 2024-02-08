<?php

$currentDir = dirname(__FILE__);
$scriptName = $_SERVER['SCRIPT_NAME'];

// コントローラ呼び出し
switch ($scriptName) {
    case '/member/index.php':
        require_once $currentDir . "/controller/member/index.php";
        break;
    case '/member/menu.php':
        require_once $currentDir . "/controller/member/menu.php";
        break;
    case '/member/logout.php':
        require_once $currentDir . "/controller/member/logout.php";
        break;
    // 編集
    case '/member/edit.php':
        require_once $currentDir . "/controller/member/edit.php";
        break;
    case '/member/edit_confirm.php':
        require_once $currentDir . "/controller/member/edit_confirm.php";
        break;
    // 新規登録
    case '/member/addnew.php':
        require_once $currentDir . "/controller/member/addnew.php";
        break;
    case '/member/addnew_confirm.php':
        require_once $currentDir . "/controller/member/addnew_confirm.php";
        break;
    case '/member/addnew_register.php':
        require_once $currentDir . "/controller/member/addnew_register.php";
        break;
    // 退会
    case '/member/withdraw.php':
        require_once $currentDir . "/controller/member/withdraw_confirm.php";
        break;
    // お問い合わせ
    case '/member/contact/form1/index.php':
        require_once $currentDir . "/controller/member/contact/form1/index.php";
        break;
    case '/member/contact/form1/confirm.php':
        require_once $currentDir . "/controller/member/contact/form1/confirm.php";
        break;
    // サンプル機貸出
    case '/member/contact/form2/index.php':
        require_once $currentDir . "/controller/member/contact/form2/index.php";
        break;
    case '/member/contact/form2/confirm.php':
        require_once $currentDir . "/controller/member/contact/form2/confirm.php";
        break;
    // ダウンロード
    case '/download/power/index.php':
        require_once $currentDir . "/controller/download/power/index.php";
        break;
    case '/download/opt/index.php':
        require_once $currentDir . "/controller/download/opt/index.php";
        break;
    default:
        require_once $currentDir . "/controller/common.php";
        break;
}
?>
