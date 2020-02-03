<?php
	
	include "config/config.php";
	$DB=new Database();

	$isLoggedIn=(isset($_SESSION['oj_login_handle_id']))?1:0;

	include "script/hash/hash.php";
	$SiteHash=new SiteHash();

	include "script/site_enter/site_enter.php";
	$SiteEnter=new SiteEnter();

	include "script/site/site.php";
	$Site=new Site();

	include "script/user/user.php";
	$User=new User();

	include "script/problem/problem.php";
	$Problem=new Problem();

	include "script/problem/problem_format.php";
	$ProblemFormat=new ProblemFormat();

	include "script/test_case/test_case.php";
	$TestCase=new TestCase();

	include "script/submission/submission.php";
	$Submission=new Submission();

	include "script/judge/judge_process.php";
	$JudgeProcess=new JudgeProcess();

?>