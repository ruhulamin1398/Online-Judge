<?php

	if(isset($_GET['problem_preview'])){
		$problem_format->build_problem_format($_GET['problem_preview']);
	}
	if(isset($_POST['update_problem'])){
		$problem->update_problem($_POST['update_problem']);
	}

	if(isset($_GET['load_test_case_page'])){
		echo "working";
	}

?>