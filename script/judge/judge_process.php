<?php
class JudgeProcess {
   
   	public $threadId;
   	public $submissionProcessId;
   	public $submissionProblemId;
   	public $testCaseReady;
   	public $submissionInfo=array();
   	public $testCaseList=array();
 	
 	public function __construct(){
     	$this->DB=new Database();
     	$this->Site=new Site();
     	$this->conn=$this->DB->conn;
     	$this->setThreadId();
 	}

 	public function setThreadId(){

 		/*******************************************************************************
		*	@ create thread id by using randome function and range of this function is 0 to 100000
 		********************************************************************************/

 		$this->threadId=rand(1,100000);
 	}

 	public function processSingleSubmission(){

 		/*******************************************************************************
		*	@ process a single submission
 		********************************************************************************/
 		
 		$this->getSubmissionInQueue();
 		if($this->submissionProcessId!=-1){
 			$this->setSubmissionProcessThread();
 			$this->setTestCase();
 			$this->resetSubmissionProcessThread();
 			$this->clearData();
 		}
 	}

 	public function processMultipleSubmission($totalProcess=1){

 		/*******************************************************************************
		*	@ process multiple submission. total submission execute in this function is 50
		* 	@ 50 times call single submission function 
 		********************************************************************************/

 		$this->processSingleSubmission();
	    
	    if($totalProcess<=50){
	        sleep(1);
	        $this->processMultipleSubmission($totalProcess+1);
	    }

	    return;
 	}

 	public function getSubmissionInQueue(){

 		/*******************************************************************************
		*	@ get submission Id whose test case is not ready.so we call testCaseReady = -1;
		*		-> -1 =	not ready because no token genate in this submission test case
		*		-> 0 = processing this submission
		*		-> 1 = ready for judge
 		********************************************************************************/

 		$sql="select * from submissions natural join problems where testCaseReady=-1 LIMIT 1";
 		$info=$this->DB->getData($sql);
 		if(isset($info[0])){
 			$info=$info[0];
 			$this->submissionInfo=$info;
 			$this->submissionProcessId=$info['submissionId'];
 		}
 		else $this->submissionProcessId=-1;
 	}

 	public function setSubmissionProcessThread(){

 		/*******************************************************************************
		*	@ set submission table testCaseReady = 0
		*		-> -1 =	not ready because no token genate in this submission test case
		*		-> 0 = processing this submission
		*		-> 1 = ready for judge
		*	@ use testCaseReady = 0 when this submission processing because
		*	  when this submission processing in this moment other cronjob script execute
		*	  this script again work this submissionId but if we set submission Processing
		*	  feature then this thread know this submission is already processing and
		*	  this time this thread search another submission for ready.
 		********************************************************************************/

 		$data=array();
 		$data['submissionId']=$this->submissionProcessId;
 		$data['testCaseReady']=0;
 		$data['threadId']=$this->threadId;
 		$this->DB->pushData("submissions","update",$data);
 	}

 	public function setTestCase(){

 		/*******************************************************************************
		*	@ generate all test case list for this submission 
		*	@ store #testCaseList this submission all test case
		*	@ each test case send curl request in api
		*		if test case sucessfully submit in api
		*			-> then continue store this #sendRequestToken;
		*		otherwise
		*			-> stop storing test case , break a loop , set #testCaseReady=0 
 		********************************************************************************/

 		$problemId=$this->submissionInfo['problemId'];
 		$sql="select testCaseIdHash from test_case where problemId=$problemId order by testCaseId ASC";
 		$info=$this->DB->getData($sql);
 		
 		$this->testCaseReady=1;

 		$testCaseList=array();

 		foreach ($info as $key => $value) {
 			$token=$this->sendTestCasePostRequest($value['testCaseIdHash']);
 			if($token==""){
 				$this->testCaseReady=0;
 				break;
 			}
 			array_push($testCaseList, $token);
 		}
 		$this->testCaseList=$testCaseList;
 	}


 	public function sendTestCasePostRequest($testCaseHashId){
 		
 		/*******************************************************************************
		*	@ get source code, input, output and convert base64 for processing api call.
 		********************************************************************************/

 		$data=array();
 		
    	$data['source_code']=base64_encode($this->submissionInfo['sourceCode']);
 		$data['stdin']=base64_encode($this->Site->readFile("test_case/input/".$testCaseHashId.'.txt'));
 		$data['expected_output']=base64_encode($this->Site->readFile("test_case/output/".$testCaseHashId.'.txt'));

 		$data['language_id']=$this->submissionInfo['languageId'];
 		$data['cpu_time_limit']=$this->submissionInfo['cpuTimeLimit'];
 		$data['memory_limit']=$this->submissionInfo['memoryLimit'];
        
        //$token=$this->sendCurlRequest(json_encode($data));
 		$token="asfsdafsa0";

 		return $token;
 	}


 	public function sendCurlRequest($data){
 		
 		/*******************************************************************************
		*	@ this function use for only send post request api for token.
 		********************************************************************************/

        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.judge0.com/submissions/?base64_encoded=true&wait=false",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		if ($err) return "";
		$token=json_decode($response,true);
		if(!isset($token['token']))
			return "";	
		return $token['token'];
 	}

 	public function saveDatabaseTestCase(){

 		/*******************************************************************************
		*	@ store all test case in database
 		********************************************************************************/
 		
 		if($this->testCaseReady==0)
 			return;
 		$data = array();
 		$submissionId=$this->submissionProcessId;
 		$sql="select threadId from submissions where submissionId=$submissionId";
 		$info=$this->DB->getData($sql);
 		if($info['0']['threadId']!=$this->threadId)
 		    return;
 		$data['submissionId'] = $this->submissionProcessId;
 		$c=0;
 		foreach ($this->testCaseList as $key => $value) {
 			$c++;
 			$data['testCaseSerialNo']=$c;
 			$data['testCaseToken']=$value;
 			$res=$this->DB->pushData("submissions_on_test_case","insert",$data);
 		}
 	}

 	public function resetSubmissionProcessThread(){
 		
 		/*******************************************************************************
		*	@ again set status of submission.
		*	@ if submission is ready then
		*		-> testCaseReady = 1
		*	  other wise
		*	  	-> testCase again go not ready state and set testCaseReady = -1
		*	@ if this submission problem has no test case then this submission direct
		*	  set accept verdict and id of accept verdict = 3
 		********************************************************************************/

 		$data = array();
 		$data['submissionId'] = $this->submissionProcessId;
 		$data['testCaseReady'] = $this->testCaseReady?1:-1;
 		
 		if($this->testCaseReady==1){
 			$data['totalTestCase']=count($this->testCaseList);

 			//handle if total test case is zero then its return AC;
 			if($data['totalTestCase']==0){
 				$data['submissionVerdict']=3;
 				$data['judgeComplete']=1;
 			}
		}
		print_r($data);
 		$this->DB->pushData("submissions","update",$data);
 	}

 	public function clearData(){

 		/*******************************************************************************
		*	@ when function is finished then our need to clear all global data
			  for avoid previous storing.
 		********************************************************************************/
 		
 		unset($this->testCaseList);
 		unset($this->submissionInfo);
 	}



 	
 
}
?>
