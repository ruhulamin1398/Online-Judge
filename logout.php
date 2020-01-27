<?php
	session_start();
	if(isset($_SESSION['oj_login_handle_id']))
		unset($_SESSION['oj_login_handle_id']);
	session_destroy();
	$page=(isset($_GET['back']))?base64_decode($_GET['back']):"index.php";
	header("Location: $page");

?>