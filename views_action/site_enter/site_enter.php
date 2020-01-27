<?php

	if(isset($_POST['login'])){
		echo $site_enter->check_login($_POST['login']);
	}
	else if(isset($_POST['register'])){
		echo $site_enter->register($_POST['register']);
	}
	


?>