<?php

/*
 * ログイン履歴データ取得　開始年月日
 */
 
define('BEGIN_ACCULATION','2014-01-01');


/*
 * ログイン履歴　削除日の設定
 * 単位　月
 * 実行日より指定の月以前のログイン履歴を削除
 *   Ex: cron実行日　2014/01/06
 *       設定値　「6」の場合　define('LOGIN_HISTORY_DELETE', 6);
 *       2014/01/06より6ヶ月以前のログイン履歴を削除
 */
 
 define('LOGIN_HISTORY_DELETE', 6);
 
?>
