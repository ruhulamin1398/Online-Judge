<?php
class site_enter {
 
//starting connection
 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     $this->site_hash=new site_hash();
 }

 public function check_login($info){
 	$handle=$info['handle'];
 	$password=$this->site_hash->user_password_hash($info['password']);
 	$sql="select user_id from users where user_handle='$handle' and user_password='$password'";
 	$data=$this->db->get_sql_array($sql);
 	$error=isset($data[0])?0:1;
 	if($error==0)
 		$_SESSION['oj_login_handle_id']=$data[0]['user_id'];
 	$msg=isset($data[0])?"<li>Login Sucessfully</li>":"<li>Your Handle OR Password is Wrong</li>";
 	return $this->db->make_json_msg($error,$msg);
 }

 public function register($info){
 	

 	$error=0;
 	$error_msg=array();
 	
 	array_push($error_msg, $this->full_name_validator($info['user_full_name']));
 	array_push($error_msg, $this->handle_validator($info['user_handle']));
 	array_push($error_msg, $this->email_validator($info['user_email']));
 	array_push($error_msg, $this->ewu_id_validaor($info['user_ewu_id']));
 	array_push($error_msg, $this->password_validator($info['user_password'],$info['user_cpassword']));

 	$msg="";
 	foreach ($error_msg as $key => $value) {
 		if($value!="")$msg.="<li>$value</li>";
 	}

 	if($msg!="")$error=1;

 	if($error==0){
 		unset($info['user_cpassword']);
 		$info['user_registration_date']=$this->db->get_now_time();
 		$info['user_ewu_id']=$this->get_ewu_id_json($info['user_ewu_id']);
 		$info['user_password']=$this->site_hash->user_password_hash($info['user_password']);
 		$this->db->sql_action("users","insert",$info);
 		$msg="Registration Is Sucessfully Compleated.";
 	}

 	return $this->db->make_json_msg($error,$msg);
 }

 public function password_validator($pass,$cpass){
 	
 	$len=strlen($pass);
 	if($len<6)
 		return "Password Length Must Be Minimum 6";
 	if($pass!=$cpass)return "Two Password Not Same";
 }
 public function full_name_validator($handle){
 	if($handle=="")
 		return "Enter Full Name";
 	
 }

 public function handle_validator($handle){
 	$len=strlen($handle);
 	if($len<4 || $len>14)
 		return "Handle Length Must Be (4 to 14)";

 	if(!preg_match("/^[a-zA-Z0-9\_]*$/",$handle)) 
 		return "Handle Is Not Valid";
 	
 	$sql="select user_id from users where user_handle='$handle'";
 	$data=$this->db->get_sql_array($sql);
 	if(isset($data[0]))
 		return "Handle Is Already Used.";
 }

 public function email_validator($email){

 	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
 		return "Email Is Not Valid";
 	$sql="select user_id from users where user_email='$email'";
 	$data=$this->db->get_sql_array($sql);
 	if(isset($data[0]))
 		return "Email Is Already Used";
 }

 public function ewu_id_validaor($ewu_id){
 	if($ewu_id=="")return "";
 	$info=json_decode($this->get_ewu_id_json($ewu_id),true);
 	$year=(int)$info['year'];
 	$semister=(int)$info['semister'];
 	$id=(int)$info['serial'];

 	$curr_date=$this->db->get_now_time();
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


 public function get_ewu_id_json($ewu_id){
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