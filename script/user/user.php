<?php
class User {
   
//starting connection
 public function __construct(){
     
     $this->db=new Database();
     $this->conn=$this->db->conn;
 }
 
 public function getUserInfo(){

 	$sql="select * from users";
 	$data=$this->db->getData($sql);
 	print_r($data);
 }

 public function getSingleUserInfo($userId){
 	$sql="select * from users where userId=$userId";
 	$data=$this->db->getData($sql);
 	return $data;
 }

 public function updateUserStatus(){
 	if($this->db->isLoggedIn){
 		$data['userId']=$this->db->isLoggedIn;
 		$data['userLastLoginInfo']=mysqli_real_escape_string($this->db->conn, $this->getUserStatus());
 		$this->db->pushData("users","update",$data);
 	}
 }

 public function getUserStatus(){
 	$info=array();
 	
 	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    	$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
    	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else
    	$ip_address = $_SERVER['REMOTE_ADDR'];

 	$info['ip']=$ip_address;
 	$info['url']=$_SERVER['REQUEST_URI'];
 	$info['time']=$this->db->date();

 	return json_encode($info);
 }

}
?>