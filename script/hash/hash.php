<?php
class site_hash {
   	
   	public $hash_prefix=array();
   	public $hash_postfix=array();

   	public function __construct(){
     	//user password
     	$this->hash_prefix['user_password']="@UsEr#@#PaSs@";
     	$this->hash_postfix['user_password']="#O@J#";

     	$this->hash_prefix['test_case']="##@@@@@Test@@@@@CaSE";
     	$this->hash_postfix['test_case']="O#######J";
     	
 	}
 
	public function common_hash_function($hash_val){
		return base64_encode(hash('sha256', $hash_val));
	}

	public function generate_hash_val($table,$val){
		return $this->common_hash_function($this->hash_prefix[$table].$val.$this->hash_postfix[$table]);
	}

	public function user_password_hash($pass){
		return $this->generate_hash_val("user_password",$pass);
	}

	public function test_case_hash($test_case_id){
		return hash('sha256',$this->generate_hash_val("test_case",$test_case_id));
	}


 
//end dabtabase connection
}
?>