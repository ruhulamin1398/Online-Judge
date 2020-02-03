<?php
class TestCase {
   
//starting connection
 	public function __construct(){
     	$this->db=new Database();
     	$this->conn=$this->db->conn;
     	$this->SiteHash=new SiteHash();
     	$this->Site=new Site();
 	}
 	
 	public function getInputFileName($hashId){

 	}

 	public function getTestCaseList($problemId,$json=false){
 		$sql="select testCaseId,userHandle,testCaseAddedDate,testCaseIdHash from test_case 
 		natural join users
 		where problemId=$problemId";
 		$data=$this->db->getData($sql);
 		foreach ($data as $key => $value) {
 			$hashId=$value['testCaseIdHash'];
 			$value['inputUrl']="test_case/input/".$hashId.'.txt';
 			$value['outputUrl']="test_case/output/".$hashId.'.txt';
 			$value['inputFileSize']=filesize($value['inputUrl']);
 			$value['outputFileSize']=filesize($value['outputUrl']);
 			$data[$key]=$value;
 		}

 		return $json?json_encode($data):$data;
 	}

 	public function deleteTestCase($hashId){
 		if($this->db->isLoggedIn==0)return;
 		$sql="select testCaseId from test_case where testCaseIdHash='$hashId'";
 		$data=$this->db->getData($sql);
 		if(!isset($data[0]))return;
 		$data=$data[0];
 		$this->db->pushData("test_case","delete",$data);
 		unlink("test_case/input/".$hashId.'.txt');
 		unlink("test_case/output/".$hashId.'.txt');
 		
 	}

 	public function getTestCaseData($hashId){
 		$data=array();
 		$data['input']=$this->Site->readFile("test_case/input/".$hashId.'.txt');
 		$data['output']=$this->Site->readFile("test_case/output/".$hashId.'.txt');
		return $data;
 	}


 	public function updateTestCase($info){
 		$hashId=$info['hashId'];
 		file_put_contents("test_case/input/$hashId.txt", $info['input']);
 		file_put_contents("test_case/output/$hashId.txt", $info['output']);
 	}


 	public function addTestCase($info){
 		if($this->db->isLoggedIn==0){
 			echo "User Is Not Logged In";
 			return;
 		}
 		
 		$data=array();
 		$data['problemId']=$info['problemId'];
 		$data['testCaseAddedDate']=$this->db->date();
 		$data['userId']=$this->db->isLoggedIn;
 		$responce=$this->db->pushData("test_case","insert",$data);
 		if($responce['error']==0){
 			
 			$this->addInputOutput($this->getTestCaseHashId($responce['insert_id']),$info['input'],$info['output']);
 			$hash_data=array();
 			$hash_data['testCaseIdHash']=$this->getTestCaseHashId($responce['insert_id']);
 			$hash_data['testCaseId']=$responce['insert_id'];
 			$this->db->pushData("test_case","update",$hash_data);
 		}
 		print_r($responce);
 	}

 	public function addInputOutput($test_case_hashId,$input,$output){
 		$file_name=$test_case_hashId.".txt";
 		echo "$file_name";
 		$this->Site->createFile("test_case/input/",$file_name,$input);
 		$this->Site->createFile("test_case/output/",$file_name,$output);
 	}

 	public function getTestCaseHashId($testCaseId){
 		return $this->SiteHash->testCaseHash($testCaseId);
 	}
}
?>