<?php
class Site {
   
//starting connection
 public function __construct(){
     
     $this->DB=new Database();
     $this->conn=$this->DB->conn;
 }

  public function getBackPageUrl(){

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

  public function createFile($url,$file_name,$txt){
      $new_file_name=$url.$file_name;
      $file = fopen($new_file_name, "w");
      fwrite($file, $txt);
      fclose($file);
  }

  public function readFile($path){
    $basePath=dirname(__FILE__);
    //problem for cpanel path cronjob need specefic file name otherwise its go to infinate loop
    if (!strpos($basePath, 'wamp64') !== false){
       $basePath=explode("/",$basePath);
       array_pop($basePath);
       array_pop($basePath);
       $basePath=implode('/',$basePath);
       $path=$basePath.'/'.$path;
    }
    $data="";
    $file = fopen($path, "r");
    while(!feof($file)) {
      $data.=fgets($file);
    }
    fclose($file);
    return $data;
  }
 

}
?>