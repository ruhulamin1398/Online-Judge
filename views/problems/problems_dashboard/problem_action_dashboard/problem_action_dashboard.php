<?php
  
    $ok=0;
    $problem_id;
    $page_action_name="";
    if(isset($_GET['problem_id'])){
        $ok=1;
        $problem_id=$_GET['problem_id'];
    }
    if($ok==0){
        include "404.php";
        return;
    }

    if(isset($_GET['action']))
        $page_action_name=$_GET['action'];

    echo "<script>
    var problem_id=$problem_id,page_action_name='$page_action_name';
    </script>";

    $path="views/problems/problems_dashboard/problem_action_dashboard/";
    include "$path/problem_dashboard_panel.php";

?>