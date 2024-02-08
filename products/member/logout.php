<?php
		require_once('../config/release/include/env/env.inc');
		require_once(PATH_MODULES.DS.'ProcessStart.inc');
		unset($_SESSION[S_KEY11][S_KEY99]);
		header('location: '.THIS_ROOT_URL_MEMBER.DS.'index.php');
		exit;
?>
