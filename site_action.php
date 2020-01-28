<?php
	include "script.php";
	if(isset($_POST['update_site_status'])){
		$user->update_user_status();
		//echo "ok";
	}


?>