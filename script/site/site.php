<?php
class site {
   
//starting connection
 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
 }

 public function get_back_page_url(){

 	$main_url=$_SERVER['REQUEST_URI'];

  	$url=explode('/', $main_url);
  	$len=count($url);
  	$page_name=$url[$len-1];

  	//check if login or register page then its back url is always same
  	if (strpos($main_url,'login.php') !== false) 
        return (isset($_GET['back']))?$_GET['back']:"index.php";
    if (strpos($main_url,'register.php') !== false) 
        return (isset($_GET['back']))?$_GET['back']:"index.php";

  	return  base64_encode($page_name==""?"index.php":$page_name);
  }
 

}
?>