
<?php

include "script_lib.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <?php

        $page_name=$site->get_page_name();   

    ?>


    <!-- Bootstrap -->
    <link href="style/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css' integrity='sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns' crossorigin='anonymous'>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- custom css files -->
    <link rel="stylesheet" type="text/css" href="layouts/css/header_style.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/home_panel.css">
	  <link rel="stylesheet" type="text/css" href="layouts/css/post.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/footer.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/contest_style.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/login.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/registration.css">
    <script type="text/javascript" src="js/site_script.js"></script>
    <script type="text/javascript" src="include/problem/js_script/submit_problem.js"></script>
    <link rel="stylesheet" type="text/css" href="layouts/css/login.css">
    <!-- custom css files end -->

    <?php include 'compailer_lib.php'; ?>
    <?php include "data_table/data_table_lib.php"; ?>


  

</head>

