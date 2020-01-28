<?php
	
	include "config/config.php";
	$db=new database();

	$isLoggedIn=(isset($_SESSION['oj_login_handle_id']))?1:0;

	include "script/hash/hash.php";
	$site_hash=new site_hash();

	include "script/site_enter/site_enter.php";
	$site_enter=new site_enter();

	include "script/site/site.php";
	$site=new site();

	include "script/user/user.php";
	$user=new user();

	include "script/problem/problem.php";
	$problem=new problem();

	include "script/problem/problem_format.php";
	$problem_format=new problem_format();

	include "script/test_case/test_case.php";
	$test_case=new test_case();

?>

