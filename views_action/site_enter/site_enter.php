<?php

	if(isset($_POST['login'])){
		echo $SiteEnter->checkLogin($_POST['login']);
	}
	else if(isset($_POST['register'])){
		echo $SiteEnter->register($_POST['register']);
	}
	


?>