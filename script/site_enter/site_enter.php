<?php
class SiteEnter {
 
//starting connection
 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     $this->Hash=new SiteHash();
 }

 public function checkLogin($info){
 	$handle=$info['handle'];
 	$password=$this->Hash->userPasswordHash($info['password']);
 	$sql="select userId from users where userHandle='$handle' and userPassword='$password'";
 	$data=$this->db->getData($sql);
 	$error=isset($data[0])?0:1;
 	if($error==0)
 		$_SESSION['oj_login_handle_id']=$data[0]['userId'];
 	$msg=isset($data[0])?"<li>Login Sucessfully</li>":"<li>Your Handle OR Password is Wrong</li>";
 	return $this->db->makeJsonMsg($error,$msg);
 }

 public function register($info){
 	

 	$error=0;
 	$error_msg=array();
 	
 	array_push($error_msg, $this->fullNameValidator($info['userFullName']));
 	array_push($error_msg, $this->handleValidator($info['userHandle']));
 	array_push($error_msg, $this->emailValidator($info['userEmail']));
 	array_push($error_msg, $this->ewuIdValidaor($info['userEwuId']));
 	array_push($error_msg, $this->passwordValidator($info['userPassword'],$info['userCpassword']));

 	$msg="";
 	foreach ($error_msg as $key => $value) {
 		if($value!="")$msg.="<li>$value</li>";
 	}

 	if($msg!="")$error=1;

 	if($error==0){
 		unset($info['userCpassword']);
 		$info['userRegistrationDate']=$this->db->date();
 		$info['userEwuId']=$this->getEwuIdJson($info['userEwuId']);
 		$info['userPassword']=$this->Hash->userPasswordHash($info['userPassword']);
 		$this->db->pushData("users","insert",$info);
 		$msg="Registration Is Sucessfully Compleated.";
 	}

 	return $this->db->makeJsonMsg($error,$msg);
 }

 public function passwordValidator($pass,$cpass){
 	
 	$len=strlen($pass);
 	if($len<6)
 		return "Password Length Must Be Minimum 6";
 	if($pass!=$cpass)return "Two Password Not Same";
 }
 public function fullNameValidator($handle){
 	if($handle=="")
 		return "Enter Full Name";
 	
 }

 public function handleValidator($handle){
 	$len=strlen($handle);
 	if($len<4 || $len>14)
 		return "Handle Length Must Be (4 to 14)";

 	if(!preg_match("/^[a-zA-Z0-9\_]*$/",$handle)) 
 		return "Handle Is Not Valid";
 	
 	$sql="select userId from users where userHandle='$handle'";
 	$data=$this->db->getData($sql);
 	if(isset($data[0]))
 		return "Handle Is Already Used.";
 }

 public function emailValidator($email){

 	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
 		return "Email Is Not Valid";
 	$sql="select userId from users where userEmail='$email'";
 	$data=$this->db->getData($sql);
 	if(isset($data[0]))
 		return "Email Is Already Used";
 }

 public function ewuIdValidaor($ewu_id){
 	if($ewu_id=="")return "";
 	$info=json_decode($this->getEwuIdJson($ewu_id),true);
 	$year=(int)$info['year'];
 	$semister=(int)$info['semister'];
 	$id=(int)$info['serial'];

 	$curr_date=$this->db->date();
 	$curr_year=date('Y', strtotime($curr_date));
 	$curr_semister=date('m', strtotime($curr_date));
 	$curr_semister=(int)$curr_semister;
 	$curr_semister=ceil($curr_semister/4);

 	if($year==$curr_semister && $semister<=$curr_semister && ($id>=1 && $id<=500))
 		return "";

 	if(($year>=2010 && $year<$curr_year) && ($semister>=1 && $semister<=3) && ($id>=1 && $id<=500) && count($info)==4)
 		return "";

 	return "EWU ID Formate Is Not Correct";
 }


 public function getEwuIdJson($ewu_id){
 	if($ewu_id=="")return "";
 	$ewu_id=explode('-', $ewu_id);
 	$info=array();
 	$info['year']=(int)isset($ewu_id[0])?$ewu_id[0]:0;
 	$info['semister']=(int)isset($ewu_id[1])?$ewu_id[1]:0;
 	$info['department']=(int)isset($ewu_id[2])?$ewu_id[2]:0;
 	$info['serial']=(int)isset($ewu_id[3])?$ewu_id[3]:0;
 	if(count($ewu_id)>4)
 		$info['error']=1;
 	foreach ($info as $key => $value) {
 		$info[$key]=(int)$value;
 	}
 	$info=json_encode($info);
 	return $info;
 }

}
?>