<?php
    $path="views/problems/problems_dashboard/problem_action_dashboard/";
?>

<script type="text/javascript" src="views/problems/problems_dashboard/problem_action_dashboard/js/problem_dashboard.js"></script>
<div class="row">
	<div class="col-md-3 sidebar">
    <div style="margin-top: 50px;"></div>
    <div class="list-group">
        <span href="#" class="list-group-item active" style="background-color: var(--bg-color)">
            Problem Dashboard
        </span>
        <a href="#" class="list-group-item">
            <i class="fa fa-comment-o"></i> OverView
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-search"></i> Edit
        </a>
        <li onclick="load_test_case_page()"  class="list-group-item">
            <i class="fa fa-user"></i> Test Case
        </li>
        <a href="#" class="list-group-item">
            <i class="fa fa-user"></i> Contributors
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-user"></i> Testing
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-user"></i> Statics
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-user"></i> Submission
        </a>
       
    </div>        
    </div>
    <div class="col-md-9">
        <div class="box">
            <div class="box_header">Problem Edit</div>
            <div class="box_body" id="option_box_body">
                <?php
                    include "$path/problem_edit.php";
                ?>
            </div>
        </div>
    </div>
</div>

