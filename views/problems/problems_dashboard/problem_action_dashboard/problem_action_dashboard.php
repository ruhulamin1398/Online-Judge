<?php
  
    $ok=0;
    $problem_id;
    $page_action_name="";
    if(isset($_GET['problemId'])){
        $ok=1;
        $problem_id=$_GET['problemId'];
    }
    if($ok==0){
        include "404.php";
        return;
    }

    if(isset($_GET['action']))
        $page_action_name=$_GET['action'];

    echo "<script>
    var problemId=$problem_id,pageActionName='$page_action_name';
    </script>";

    $path="views/problems/problems_dashboard/problem_action_dashboard/";
    include "$path/problem_dashboard_panel.php";

?>