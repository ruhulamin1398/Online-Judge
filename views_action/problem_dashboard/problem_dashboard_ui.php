<?php
	if(isset($_POST['loadTestCasePage'])){
		$problemId=$_POST['loadTestCasePage'];
		echo "<div style='text-align: right; margin-bottom: 10px;'><button onclick='loadAddTestCasePage()'><span class='glyphicon glyphicon-plus'></span> Add Test Case</button></div>";
		echo "<table width='100%'>";
		echo "<tr>
			<td class='td1'>Order</td>
			<td class='td1'>Input File</td>
			<td class='td1'>Output File</td>
			<td class='td1'>Added Date</td>
			<td class='td1'>Added By</td>
			<td class='td1'></td>
			</tr>";
		$info=$TestCase->getTestCaseList(1);
		$c=0;
		foreach ($info as $key => $value) {
			$c++;
			$date=$value['testCaseAddedDate'];
			$handle=$value['userHandle'];
			$inputUrl=$value['inputUrl'];
			$inputSize=$value['inputFileSize'];
			$outputUrl=$value['outputUrl'];
			$outputSize=$value['outputFileSize'];
			$hashId=$value['testCaseIdHash'];
			echo "<tr>
			<td class='td2'>$c</td>
			<td class='td2'><a href='$inputUrl' target='_blank'>input-$c.txt ($inputSize Bytes)</a></td>
			<td class='td2'><a href='$outputUrl' target='_blank'>output-$c.txt ($outputSize Bytes)</a></td>
			<td class='td2'>$date</td>
			<td class='td2'>$handle</td>
			<td class='td2'> 
				<button value='$hashId' class='btn-sm' id='btn_edit_$c' onclick='loadEditTestCasePage($c)'><span class='glyphicon glyphicon-pencil'></span></button>
				<button id='btn_del_$c' onclick='deleteTestCase($c)' value='$hashId' class='btn-sm'><span class='glyphicon glyphicon-trash'></span></button>
			</td>
			</tr>";
		}
		echo "</table>";
	}

	else if(isset($_POST['loadAddTestCasePage'])){
		echo "<b style='font-size: 17px;'>Input</b><br/><textarea class='dashboard_input_text_area' id='inputValue'></textarea><br/>";
		echo "<b style='font-size: 17px;'>Output</b><br/><textarea class='dashboard_input_text_area' id='outputValue'></textarea><br/>";
		echo "<center><button onclick='addTestCase()'>Add Test Case</button></center>";
	}

	else if(isset($_POST['loadEditTestCasePage'])){
		$hashId=$_POST['loadEditTestCasePage'];
		$info=$TestCase->getTestCaseData($hashId);
		$input=$info['input'];
		$output=$info['output'];
		echo "<b style='font-size: 17px;'>Input</b><br/><textarea class='dashboard_input_text_area' id='inputValue'>$input</textarea><br/>";
		echo "<b style='font-size: 17px;'>Output</b><br/><textarea class='dashboard_input_text_area' id='outputValue'>$output</textarea><br/>";
		echo "<center><button onclick='updateTestCase()' id='btnUpdate' value='$hashId'>Update Test Case</button></center>";
	}

	else if(isset($_POST['loadOverviewPage'])){
		echo "<div class='ui-widget'>
  			<label for='tags'>Tags: </label>
  			<input id='tags'>
	</div>";
	}

	else if(isset($_POST['loadModeratorsPage'])){
		$problemId=$_POST['loadModeratorsPage'];
		$moderatorList=$Problem->getProblemModeratorList($problemId,false);
		
		echo "
		<div class='row'>	
			<div class='col-md-7'>
				<div class='box none_border'>
				<div class='box_body'>
		";
		foreach ($moderatorList as $key => $value) {
			$userPhoto=$value['userPhoto'];
			$userHandle=$value['userHandle'];
			$userId=$value['userId'];
			$moderatorRoles=$value['moderatorRoles'];

			echo "<div class='row userListCard'>
				<div class='col-md-2 col-sm-2'>
					<img class='img-thumbnail userListImg' src='$userPhoto'>
				</div>
				<div class='col-md-10 col-sm-10'>
					<div class='userListBody'>
						<div class='pull-right'>
							<button class='btn btn-sm btn-danger'>Delete</button>
						</div>
						<a href=''>$userHandle</a><br/>
						<span class='userPermission'>Admin</span>
					</div>
				</div>
			</div>";
		}	

		echo "</div></div></div>
			<div class='col-md-5'>
				<div class='box none_border'>
				<div class='box_header'>Add Moderator</div>
				<div class='box_body'>
					<input type='text' onkeyup='search_moderators()' autocomplete='off' class='form-control' id='search_moderators' placeholder='Enter Moderator Handle'>
					<div id='suggestion_box' class='moderators_suggestion_box'>
					</div>
				</div>
				</div>
				</div>
		</div>";
	}


	if(isset($_POST['loadTestingPage'])){
		$problemId=$_POST['loadTestingPage'];
		echo "<div style='text-align: right; margin-bottom: 10px;'><button onclick='loadCreateSubmissionPage()'><span class='glyphicon glyphicon-plus'></span> Create Submission</button></div>";

		echo "<div class='table-responsive'><table width='100%'>";
		echo "<tr>
			<td class='td1'>#</td>
			<td class='td1'>When</td>
			<td class='td1'>Who</td>
			<td class='td1'>Lang</td>
			<td class='td1'>Verdict</td>
			<td class='td1'>Time</td>
			<td class='td1'>Memory</td>
			</tr>";
		$info=$Submission->getSubmissionList('{"problemId":'.$problemId.'}');
		foreach ($info as $key => $value) {
			$submissionId=$value['submissionId'];
			$languageId=$value['languageId'];
			$userId=$value['userId'];
			$userHandle=$value['userHandle'];
			$submissionTime=$value['submissionTime'];
			$judgeStatus=$value['judgeStatus'];
			$time=$value['maxTimeLimit'];
			$memory=$value['maxMemoryLimit'];
			
			echo "<tr>
			<td class='td2'>$submissionId</td>
			<td class='td2'>$submissionTime</td>
			<td class='td2'>$userHandle</td>
			<td class='td2'>$languageId</td>
			<td class='td2'>$judgeStatus</td>
			<td class='td2'>$time s</td>
			<td class='td2'>$memory kb</td>
			</tr>";
		}
		echo "</table></div>";
	}

	if(isset($_POST['loadCreateSubmissionPage'])){
		echo "<textarea id='sourceCodeEditor' style='height: 250px; width: 100%;'></textarea>";
		echo "<center><button onclick='createSubmission()'>Submit</button></center>";
	}



?>
<style type="text/css">
	.userListCard{
		background-color: #ffffff;
		border: 1px solid #eeeeee;
		padding: 10px 0px 10px 0px;
	}

	.userListImg{
		height: 100%;
		width: 100%;
	}
	.userListBody{
	}
	.userListBody a{
		font-weight: bold;
		font-size: 16px;
	}

	.userPermission{
		font-size: 13px;
		color: #363636;
		font-family: serif;
	}

</style>
								