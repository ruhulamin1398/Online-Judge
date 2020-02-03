<?php
class Judge {
   
	public $serverNo;
	public $submissionData=array();
	public $isPending;
	public $apiData;
	public $isQueue;
	public $analysisData=array();
	public $saveSubmissionData=array();
	public $saveSubmissionTestData=array();

 	public function __construct($serverNo){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
     	$this->setServer($serverNo);
 	}

 	public function setServer($serverNo){
 		$this->serverNo=$serverNo;
 	}

 	public function getSubmissionTestCase(){
 		$serverNo1=$this->serverNo;
 		$serverNo2=$serverNo1+3;
 		$serverNo3=$serverNo1+6;
 		$sql="select * from submissions natural join submissions_on_test_case where
 		(submissionId % 9 = $serverNo1 or submissionId % 9 = $serverNo2 or submissionId % 9 = $serverNo3 ) and runOnTest = testCaseSerialNo and judgeStatus = -1 and testCaseReady = 1 and judgeComplete=0";
 		$data=$this->DB->getData($sql);
 		if(isset($data[0])){
 			$this->submissionData=$data[0];
 			$this->isPending=1;
 		}
 		else $this->isPending=0;
 	}

 	public function setProcessingSubmissionTestCase(){
 		$data=array();
 		$data['judgeStatus']=0;
 		$data['submissionTestCaseId']=$this->submissionData['submissionTestCaseId'];
 		//$this->DB->submissionTestCaseId("submissions_on_test_case","update",$data);
 	}

 	public function resetProcessingSubmissionTestCase(){
 		$data=array();
 		$data['judgeStatus']=($this->isQueue==1)?-1:1;
 		$data['submissionTestCaseId']=$this->submissionData['submissionTestCaseId'];
 		//$this->DB->submissionTestCaseId("submissions_on_test_case","update",$data);
 	}

	public function sendCurlRequest($url){
		$data=file_get_contents($url);
  		return $data;

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

 	public function getApiData(){
 		if($this->isPending==0)
 			return;
 		//$tokenId=$this->submissionData['testCaseToken'];

 		$tokenId="87499552-56fd-4bb4-8bbc-cc24fa4ccc61";
 		$url="https://api.judge0.com/submissions/$tokenId";
 		$data=$this->sendCurlRequest($url);
 		$this->apiData=($data=="")?"{}":$data;
 	}

 	public function analysisApiData(){
 		if($this->isPending==0)
 			return;
 		$data=json_decode($this->apiData,true);
 		if(!isset($data['status'])){
 			$this->analysisData['verdict']=6;
 			$this->analysisData['memory']=0;
 			$this->analysisData['time']=0;
 			return;
 		}

 		$this->analysisData['verdict']=$data['status']['id'];
 		$this->analysisData['memory']=$data['memory'];
 		$this->analysisData['time']=$data['time'];

 		$this->isQueue=0;
 		if($this->analysisData['verdict']<=2)
 			$this->isQueue=1;

 	}

 	public function processData(){
 		if($this->isQueue==1 || $this->isPending==0)
 			return;
 		if($this->submissionData['totalTestCase']==$this->submissionData['runOnTest'] || $this->analysisData['verdict']!=3){
 			$this->saveSubmissionData['judgeComplete']=1;
 			$this->saveSubmissionData['submissionVerdict']=$this->analysisData['verdict'];
 			
 		}
 		else{
 			$this->saveSubmissionData['runOnTest']=$this->submissionData['runOnTest']+1;
 		}

 		$this->saveSubmissionData['submissionId']=$this->submissionData['submissionId'];
 		$this->saveSubmissionData['maxTimeLimit']=max($this->analysisData['time'],$this->submissionData['runOnMaxTime']);
 		$this->saveSubmissionData['maxMemoryLimit']=max($this->analysisData['memory'],$this->submissionData['maxMemoryLimit']);

 		$this->saveSubmissionTestData['verdict']=$this->analysisData['verdict'];
 		$this->saveSubmissionTestData['totalTime']=$this->analysisData['time'];
 		$this->saveSubmissionTestData['totalMemory']=$this->analysisData['memory'];
 		$this->saveSubmissionTestData['responseData']=$this->apiData;
 		$this->saveSubmissionTestData['judgeStatus']=1;
 	}

 	public function saveData(){
 		if($this->isQueue==1 || $this->isPending==0)
 			return;
 		echo "<pre>";
 		print_r($this->saveSubmissionData);
 		echo "</pre><pre>";
 		print_r($this->saveSubmissionTestData);
 		echo "</pre>";
 		//$this->DB->pushData("submissions_on_test_case","update",$this->saveSubmissionData);
 		//$this->DB->pushData("submissions","update",$this->saveSubmissionTestData);
 		
 	}

 	public function judgeSubmission(){
 		$this->getSubmissionTestCase();
 		$this->setProcessingSubmissionTestCase();
 		$this->getApiData();
 		$this->analysisApiData();
 		$this->processData();
 		$this->saveData();
 		$this->resetProcessingSubmissionTestCase();
 	}



 
}
?>