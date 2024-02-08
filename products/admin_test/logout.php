<?php
	require_once('./include/ProcessStart.inc');
	session_destroy();
	header('location: index.php');
	exit();
?>
