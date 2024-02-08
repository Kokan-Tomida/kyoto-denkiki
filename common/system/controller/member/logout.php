<?php
require_once(dirname(__FILE__) . '/../../include/env/env.inc');
require_once(PATH_MODULES.DS.'ProcessStart.inc');
unset($_SESSION[S_KEY11][S_KEY99]);
header('location: /member/index.php');
exit;
?>
