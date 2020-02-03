<?php
	include "config/config.php";
	include "script/judge/judge.php";
	$Judge=new Judge(0);
	$Judge->judgeSubmission();
?>