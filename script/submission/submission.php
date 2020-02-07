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

 			$status=$this->getVerdict(0);
 			if($testCaseReady==0)
 				$status=$this->getVerdict(1);
 			else if($testCaseReady==1){
 				if($judgeComplete==0)
 					$status=$this->getVerdict(2,$runOnTest);
 				else
 					$status=$this->getVerdict($submissionVerdict);
 			}

 			$data[$key]['judgeStatus']=$status;
 		}
 		return $data;
 	}

 	public function getVerdict($verdictId,$testCaseRun=-1){

 		$verdictClass="danger";
 		$verdictName="";
 		if($verdictId==0){
 			$verdictName="In Queue";
 			$verdictClass="default";
 		}
 		else if($verdictId==1){
 			$verdictName="Processing";
 			$verdictClass="info";
 		}
 		else if($verdictId==2){
 			$verdictName="Running On Test $testCaseRun";
 			$verdictClass="primary";
 		}
 		else if($verdictId==3){
 			$verdictName="Accepted";
 			$verdictClass="success";
 		}
 		else if($verdictId==4)$verdictName="Wrong answer";
 		else if($verdictId==5)$verdictName="Time limit exceeded";
 		else $verdictName="Compailer Error";
        
 		$verdictClass="label label-$verdictClass";

 		return "<span class='$verdictClass'>$verdictName</span>";
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
 		$info['sourceCode']=base64_decode($info['sourceCode']);
 		$info['sourceCode']=$this->DB->buildSqlString($info['sourceCode']);
 		$info['submissionType']=$submissionType;
 		$info['userId']=$this->loggedIn;
 		$info['submissionTime']=$this->DB->date();
 		$response=$this->DB->pushData("submissions","insert",$info);
 		print_r($response);
 	}

 	


 
}
?>