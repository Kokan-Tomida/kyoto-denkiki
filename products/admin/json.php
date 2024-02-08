<?php

//require_once($_SERVER['DOCUMENT_ROOT'].'/rdy/projects/S1310_04/authority/include/ProcessStart.inc');
//require_once($_SERVER['DOCUMENT_ROOT'].'/rdy/projects/S1310_04/authority/include/env/env.inc');
require_once('./include/env/env.inc');
 
//Ajax通信ではなく、直接URLを叩かれた場合はエラーメッセージを表示
/*
if (
    !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
    && (!empty($_SERVER['SCRIPT_FILENAME']) && 'json.php' === basename($_SERVER['SCRIPT_FILENAME']))
    ) 
{
    die ('このページは直接ロードしないでください。');
}
*/

 
 
//接続文字列 (PHP5.3.6から文字コードが指定できるようになりました)
$dsn = 'mysql:dbname=dee-stage_zdt;host=mysql477.db.sakura.ne.jp;charset=utf8';
 
//ユーザ名
$user = G_USER;
 
//パスワード
$password = G_PASS;
 
try
{
    //nullで初期化
    $users = null;
     
    //DBに接続
    $dbh = new PDO($dsn, $user, $password);
     
    //'users' テーブルのデータを取得する
    $sql = 'select * from kdn_middle_category';
	if((array_key_exists('id',$_GET)) and ($_GET['id'])){
		$sql .= ' where large_category_id = '.$_GET['id'];
	}
    $stmt = $dbh->query($sql);
     
    //取得したデータを配列に格納
    while ($row = $stmt->fetchObject())
    {
        $users[] = array(
            'id'=> $row->id
            ,'middle_category_name' => $row->middle_category_name
            );
    }
     
    //JSON形式で出力する
    header('Content-Type: application/json');
    echo json_encode( $users );
    exit;
}
catch (PDOException $e)
{
    //例外処理
    die('Error:' . $e->getMessage());
}


?>