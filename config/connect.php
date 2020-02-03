<?php
class Database
{
    
    public $host = db_host;
    public $user = db_user;
    public $pass = db_pass;
    public $db = db_name;
    public $result;
    public $conn;
    public $isLoggedIn;

    //conection start
    public function __construct()
    {
        $this->connection();
        $this->setLoggedInId();
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function connection()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$this->conn) {
            echo "Conection failed";
        } else
            return 1;
    }

    public function setLoggedInId(){
        $this->isLoggedIn=(isset($_SESSION['oj_login_handle_id']))?$_SESSION['oj_login_handle_id']:0;
    } 

    public function date(){
        return $this->getNowTime();
    }

    public function getNowTime(){
        $now=date("Y-m-d H:i:s", time());
        return $now;
    }

    public function buildSqlString($string){
        return mysqli_real_escape_string($this->conn,$string);
    }
    
    public function select($query)
    {
        //$sql="select * from tavl";
        $sql=$query;
        $this->result = mysqli_query($this->conn, $query);
        return $this->result;
    }
    
    public function dateToString($date)
    {
        return date("d M Y h:i:A", strtotime($date));
    }

    public function getSelectLastId($query)
    {
        
        if (mysqli_query($this->conn, $query)) {
            return mysqli_insert_id($this->conn);
        } else
            0;
    }
    
    public function processMysqlArray($info)
    {
        $res = array();
        $c   = 0;
        foreach ($info as $key => $value) {
            if ($c % 2 == 1)
                $res[$key] = $value;
            $c++;
        }
        return $res;
    }

    public function getData($sql,$json=false){
        $data=$this->getSqlArray($sql);
        return $json?json_encode($data):$data;
    }
    
    public function getSqlArray($sql)
    {
        $info = array();
        $res  = $this->select($sql);
        while ($row = mysqli_fetch_array($res)) {
            $sub = array();
            $sub = $this->processMysqlArray($row);
            array_push($info, $sub);
        }
        return $info;
    }
    
    public function makeJsonMsg($error,$msg){
        $data=array();
        $data['error']=$error;
        $data['msg']=$msg;
        return json_encode($data);
    }

    public function buildInsertSql($arr, $table)
    {
        $sql = "";
        $sql .= "INSERT INTO " . $table;
        $sql .= " (" . implode(",", array_keys($arr)) . ") VALUES ";
        $sql .= " ('" . implode("','", array_values($arr)) . "')";
        return $sql;
    }
    
    public function buildUpdateSql($arr, $table)
    {
        $pk=$this->getPk($table);
        $sql = "";
        $sql .= "UPDATE " . $table . " SET ";
        $condition = "";
        $size      = sizeof($arr);
        $c         = 0;
        foreach ($arr as $key => $value) {
            $condition .= $key . "='" . $value . "'";
            if ($c != $size - 1)
                $condition .= ",";
            $c++;
        }
        $sql .= $condition;
        $sql .= " WHERE $pk=" . $arr[$pk];
        return $sql;
    }
    
    
    public function pushData($table, $action, $info,$json=false)
    {
        
        $flag        = 0;
        $action_name = "";
        $pk=$this->getPk($table);
        
        if ($action == "update") {
            $action_name = "Update " . $table;
            $sql         = $this->buildUpdateSql($info, $table);
        } else if ($action == "insert") {
            $action_name = "Insert New " . $table;
            $sql         = $this->buildInsertSql($info, $table);
        } else if ($action == "delete") {
            $id          = $info[$pk];
            $action_name = "Delete " . $table;
            $sql         = "DELETE FROM $table WHERE $pk=$id";
        }
        
        $res = $this->select($sql);

        //echo "$sql";
        if ($res)
            $flag = 1;
        
        $error                = array();
        $error['error']       = 0;
        $error['error_msg']   = "Successfully $action Data";
        
        if($action_name='insert' && $flag==1)
            $error['insert_id']     =  $this->conn->insert_id;
        
        if ($flag == 0) {
            $error['error']       = 1;
            $error['error_msg'] = $this->errorTypeFind(mysqli_error($this->conn));
        }
        
        return $json?json_encode($error):$error;
    }

    public function getLastInsertId(){
       return $this->conn->insert_id;
    }

    public function getPk($table_name){

        $sql="SHOW KEYS FROM $table_name WHERE Key_name = 'PRIMARY'";
        $res=$this->getData($sql);
        $pk=$res[0]['Column_name'];
        return $pk;
    }

    public function getAllPk(){
        $dbname=$this->db;
        $sql = "SHOW TABLES FROM $dbname";
        $res=$this->getData($sql);
        $pk_list=array();
        $name="Tables_in_$dbname";
        foreach ($res as $key => $value) {
            $table_name=$value[$name];
            $pk=$this->getPk($table_name);
            $pk_list[$table_name]=$pk;
        }
        return $pk_list;
    }

    public function errorTypeFind($error){
        $error_type=array();
        return $error;
        $error_type['foreign key constraint fails']="Integrity constraint violation.You Already This Data Use In Other Table.";
        foreach ($error_type as $key => $value) {
            if($this->check_substring($error, $key) == 1)return $value;
        }
        return $error;
    }

    // conection end
}
?>