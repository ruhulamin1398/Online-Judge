<?php
class Submission {
   
	public $submissionData;
	public $loggedIn;

 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
     	$this->loggedIn=$this->DB->isLoggedIn;
 	}

 	public function getSubmissionList($requestData,$json=false){
 		$requestData=($requestData=="")?"{}":$requestData;
 		$info=json_decode($requestData,true);
 		$sql="";
 		foreach ($info as $key => $value) {
 			$sql.=($sql!="")?" and ":"";
 			$sql.= "$key=$value";
 		}
 		$sql=($sql!="")?" where ".$sql:"";
 		$sql="select * from submissions natural join users $sql order by submissionId desc";
 		$data=$this->DB->getData($sql);
 		$data=$this->processSubmissionData($data);
 		return $json?json_encode($data):$data;
 	}

 	public function processSubmissionData($data){
 		foreach ($data as $key => $value) {
 			
 			$testCaseReady=$value['testCaseReady'];
 			$judgeComplete=$value['judgeComplete'];
 			$submissionVerdict=$value['submissionVerdict'];
 			$runOnTest=$value['runOnTest'];

 			$status="In queue";
 			if($testCaseReady==0)
 				$status="Processing";
 			else if($testCaseReady==1){
 				if($judgeComplete==0)
 					$status="Running On Test $runOnTest";
 				else
 					$status=$this->getVerdict($submissionVerdict);
 			}

 			$data[$key]['judgeStatus']=$this->getVerdictStyle($status);
 		}
 		return $data;
 	}

 	public function getVerdict($verdictId){
 		return "Accept";
 	}

 	public function getVerdictStyle($verdict){
 		return "<span style='color: #000000'>$verdict</span>";
 	}


 	public function createSubmission($info,$submissionType=2){
 		if(!$this->loggedIn)
 			return;
 		/*
 			submissionType,
 				Testing=1
 				Problem=2
 				Contest=3
 		*/
 		$info['sourceCode']=$this->DB->buildSqlString($info['sourceCode']);
 		$info['submissionType']=$submissionType;
 		$info['userId']=$this->loggedIn;
 		$info['submissionTime']=$this->DB->date();
 		$response=$this->DB->pushData("submissions","insert",$info);
 		print_r($response);
 	}

 	


 
}
?>