<?php
class Problem {
   
//starting connection
 	public function __construct(){
     	$this->DB=new Database();
     	$this->conn=$this->DB->conn;
 	}
 
 	public function getProblemList(){

 	}

 	public function getProblemInfo($id,$json=false){
 		$sql="select * from problems where problemId=$id";
 		$data=$this->DB->getData($sql);
 		return $json?json_encode($data[0]):$data[0];
 	}

 	public function getProblemModeratorList($problemId,$json=false){
 		$sql="select userId,userHandle,userPhoto,moderatorRoles from problem_moderator natural join users where problemId=$problemId";
 		$data=$this->processModeratorData($this->DB->getData($sql));
 		return ($json)?json_encode($data):$data;
 	}

 	public function getNonProblemModeratorList($problemId,$json=false){
		$sql="select userId,userHandle,userPhoto from users";
 		$data=$this->processModeratorData($this->DB->getData($sql));
 		return ($json)?json_encode($data):$data;
 	}

 	public function addProblemModerator($info){
 		$info['moderatorRoles']=20;
 		$this->DB->pushData("problem_moderator","insert",$info);
 	}

 	public function processModeratorData($data){
 		foreach ($data as $key => $value) {
 			$value['userPhoto']=($value['userPhoto']==null)?"avatar.jpg":$value['userPhoto'];
 			$value['userPhoto']="file/user_photo/".$value['userPhoto'];
 			$data[$key]=$value;
 		}
 		return $data;
 	}

 	public function updateProblem($info){
 		foreach ($info as $key => $value) {
 			$info[$key]=mysqli_real_escape_string($this->DB->conn, $value);
 		}
 		$this->DB->pushData("problems","update",$info);
 	}


}
?>