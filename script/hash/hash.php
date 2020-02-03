<?php
class SiteHash {
   	
   	public $hashPrefix=array();
   	public $hashPostfix=array();

   	public function __construct(){
     	//user password
     	$this->hashPrefix['userPassword']="@UsEr#@#PaSs@";
     	$this->hashPostfix['userPassword']="#O@J#";

     	$this->hashPrefix['testCase']="##@@@@@Test@@@@@CaSE";
     	$this->hashPostfix['testCase']="O#######J";
     	
 	}
 
	public function commonHashFunction($hashVal){
		return base64_encode(hash('sha256', $hashVal));
	}

	public function generateHashVal($table,$val){
		return $this->commonHashFunction($this->hashPrefix[$table].$val.$this->hashPostfix[$table]);
	}

	public function userPasswordHash($pass){
		return $this->generateHashVal("userPassword",$pass);
	}

	public function testCaseHash($testCaseId){
		return hash('sha256',$this->generateHashVal("testCase",$testCaseId));
	}


 
//end dabtabase connection
}
?>