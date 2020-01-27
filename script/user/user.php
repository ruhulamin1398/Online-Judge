<?php
class user {
   
//starting connection
 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
 }
 
//end dabtabase connection

 public function get_user_info(){

 	$sql="select * from users";
 	$data=$this->db->get_sql_array($sql);
 	print_r($data);

 }
}
?>