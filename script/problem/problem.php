<?php
class problem {
   
//starting connection
 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
 }
 
 public function get_problem_list(){

 }

 public function get_problem_info($id,$json=false){
 	$sql="select * from problems where problem_id=$id";
 	$data=$this->db->get_sql_array($sql);
 	return $json?json_encode($data[0]):$data[0];
 }

 public function update_problem($info){
 	foreach ($info as $key => $value) {
 		$info[$key]=mysqli_real_escape_string($this->db->conn, $value);
 	}
 	$this->db->sql_action("problems","update",$info);
 }


}
?>