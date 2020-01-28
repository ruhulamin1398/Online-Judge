<?php
class test_case {
   
//starting connection
 	public function __construct(){
     	$this->db=new database();
     	$this->conn=$this->db->conn;
     	$this->site_hash=new site_hash();
     	$this->site=new site();
 	}
 	
 	public function get_test_case_list($problem_id,$json=false){
 		$sql="select test_case_id,user_handle,test_case_added_date,test_case_id_hash from test_case 
 		natural join users
 		where problem_id=$problem_id";
 		$data=$this->db->get_sql_array($sql);
 		foreach ($data as $key => $value) {
 			$hash_id=$value['test_case_id_hash'];
 			$value['input_url']="test_case/input/".$hash_id.'.txt';
 			$value['output_url']="test_case/output/".$hash_id.'.txt';
 			$value['input_file_size']=filesize($value['input_url']);
 			$value['output_file_size']=filesize($value['output_url']);
 			$data[$key]=$value;
 		}

 		return $json?json_encode($data):$data;
 	}

 	public function delete_test_case($hash_id){
 		if($this->db->isLoggedIn==0)return;
 		$sql="select test_case_id from test_case where test_case_id_hash='$hash_id'";
 		$data=$this->db->get_sql_array($sql);
 		if(!isset($data[0]))return;
 		$data=$data[0];
 		$this->db->sql_action("test_case","delete",$data);
 		unlink("test_case/input/".$hash_id.'.txt');
 		unlink("test_case/output/".$hash_id.'.txt');
 		
 	}

 	public function get_test_case_data($hash_id){
 		$data=array();
 		$data['input']='';
 		$data['output']='';
 		$file = fopen("test_case/input/".$hash_id.'.txt', "r");
		while(!feof($file)) {
 		 	$data['input'].=fgets($file);
		}
		fclose($file);
		
		$file = fopen("test_case/output/".$hash_id.'.txt', "r");
		while(!feof($file)) {
 		 	$data['output'].=fgets($file);
		}
		fclose($file);
		
		return $data;
 	}


 	public function update_test_case($info){
 		$hash_id=$info['hash_id'];
 		file_put_contents("test_case/input/$hash_id.txt", $info['input']);
 		file_put_contents("test_case/output/$hash_id.txt", $info['output']);
 	}


 	public function add_test_case($info){
 		if($this->db->isLoggedIn==0){
 			echo "User Is Not Logged In";
 			return;
 		}

 		$data=array();
 		$data['problem_id']=$info['problem_id'];
 		$data['test_case_added_date']=$this->db->date();
 		$data['user_id']=$this->db->isLoggedIn;
 		$responce=$this->db->sql_action("test_case","insert",$data);
 		if($responce['error']==0){
 			$this->add_input_output($this->get_test_case_hash_id($responce['insert_id']),$info['input'],$info['output']);
 			$hash_data=array();
 			$hash_data['test_case_id_hash']=$this->get_test_case_hash_id($responce['insert_id']);
 			$hash_data['test_case_id']=$responce['insert_id'];
 			$this->db->sql_action("test_case","update",$hash_data);
 		}
 		print_r($responce);
 	}

 	public function add_input_output($test_case_hash_id,$input,$output){
 		$file_name=$test_case_hash_id.".txt";
 		echo "$file_name";
 		$this->site->create_file("test_case/input/",$file_name,$input);
 		$this->site->create_file("test_case/output/",$file_name,$output);
 	}

 	public function get_test_case_hash_id($test_case_id){
 		return $this->site_hash->test_case_hash($test_case_id);
 	}
}
?>