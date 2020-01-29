<?php
	
	if(!$isLoggedIn){
		include "404.php";
		return;
	}

	
	if(isset($_GET['problem_preview'])){
		$problem_format->build_problem_format($_GET['problem_preview']);
	}

	else if(isset($_POST['update_problem'])){
		$problem->update_problem($_POST['update_problem']);
	}

	else if(isset($_POST['add_test_case'])){
		$test_case->add_test_case($_POST['add_test_case']);

	}
	else if(isset($_POST['delete_test_case'])){
		$test_case->delete_test_case($_POST['delete_test_case']);
	}

	if(isset($_POST['update_test_case'])){
		$test_case->update_test_case($_POST['update_test_case']);
	}

	else 
		include "views_action/problem_dashboard/problem_dashboard_ui.php";

?>