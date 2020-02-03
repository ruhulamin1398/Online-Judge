<?php
	
	if(!$isLoggedIn){
		include "404.php";
		return;
	}

	
	if(isset($_POST['previewProblem'])){
		$ProblemFormat->buildProblemFormat($_POST['previewProblem']);
	}

	else if(isset($_POST['updateProblem'])){
		$Problem->updateProblem($_POST['updateProblem']);
	}

	else if(isset($_POST['addTestCase'])){
		$TestCase->addTestCase($_POST['addTestCase']);

	}
	else if(isset($_POST['deleteTestCase'])){
		$TestCase->deleteTestCase($_POST['deleteTestCase']);
	}

	if(isset($_POST['updateTestCase'])){
		$TestCase->updateTestCase($_POST['updateTestCase']);
	}

	if(isset($_POST['createSubmission'])){
		$Submission->createSubmission($_POST['createSubmission'],1);
	}
	else if(isset($_POST['getModeratorsList'])){
		echo $Problem->getNonProblemModeratorList($_POST['getModeratorsList'],true);
	}

	else if(isset($_POST['addProblemModerator'])){
		$Problem->addProblemModerator($_POST['addProblemModerator']);
	}

	else 
		include "views_action/problem_dashboard/problem_dashboard_ui.php";

?>