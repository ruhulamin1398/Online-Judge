<?php
class user {
   
//starting connection
 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
 }
 
 public function get_user_info(){

 	$sql="select * from users";
 	$data=$this->db->get_sql_array($sql);
 	print_r($data);
 }

 public function update_user_status(){
 	if($this->db->isLoggedIn){
 		$data['user_id']=$this->db->isLoggedIn;
 		$data['user_last_login_info']=mysqli_real_escape_string($this->db->conn, $this->get_user_status());
 		$this->db->sql_action("users","update",$data);
 	}
 }

 public function get_user_status(){
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