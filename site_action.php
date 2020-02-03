<?php
	include "script.php";
	if(isset($_POST['update_site_status'])){
		$User->updateUserStatus();
		//echo $DB->isLoggedIn;
		echo "<pre>";
		print_r($User->getSingleUserInfo($DB->isLoggedIn));
		echo "</pre>";
	}


?>