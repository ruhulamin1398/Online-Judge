<script src="https://cdn.ckeditor.com/4.13.1/standard-all/ckeditor.js"></script>
<?php

	$problem_data=$Problem->getProblemInfo(1,true);
	//$problem_format->add_math_script();

	$problem_data=base64_encode($problem_data);
	
?>


<div id="ret"></div>
<style type="text/css">
	.option_name{
		font-size: 17px;
		font-weight: bold;
		margin-top: 15px;
		margin-bottom: 15px;
		color: #57424E;
	}
	.footer_save{
		background-color: #ffffff;
		height: 18px;
		width: 100%;
		border: 1px solid #C2C7D0;
		border-width: 1px 0px 0px 0px;
		padding: 10px 10px 55px 55px;
		text-align: right;
	}
	.option_devide{
		margin-bottom: 15px;
		border: 1px solid #f5f5f5;
		border-width: 0px 0px 1px 0px;
		padding-bottom: 15px;
	}
</style>
<div>

<div id="preview_problem"></div>
<div class="option_devide">
	<div class="row">
		<div class="col-md-3"><div class="option_name">Problem Description</div></div>
		<div class="col-md-9"><textarea name="descriptionEditor"></textarea></div>
	</div>
</div>

<div class="option_devide">
	<div class="row">
		<div class="col-md-3"><div class="option_name">Input</div></div>
		<div class="col-md-9"><textarea name="inputEditor"></textarea></div>
	</div>
</div>

<div class="option_devide">
	<div class="row">
		<div class="col-md-3"><div class="option_name">Output</div></div>
		<div class="col-md-9"><textarea name="outputEditor"></textarea></div>
	</div>
</div>

<div class="option_devide">
	<div class="row">
		<div class="col-md-3"><div class="option_name">Constraints</div></div>
		<div class="col-md-9"><textarea name="constraintsEditor"></textarea></div>
	</div>
</div>

<div class="option_devide">
	<div class="row">
		<div class="col-md-3"><div class="option_name">Input Example</div></div>
		<div class="col-md-9"><textarea name="inputExEditor"></textarea></div>
	</div>
</div>

<div class="option_devide">
	<div class="row">
		<div class="col-md-3"><div class="option_name">Output Example</div></div>
		<div class="col-md-9"><textarea name="outputExEditor"></textarea></div>
	</div>
</div>

<div class="option_devide">
	<div class="row">
		<div class="col-md-3"><div class="option_name">Note</div></div>
		<div class="col-md-9"><textarea name="noteEditor"></textarea></div>
	</div>
</div>

</div>

<div class="footer navbar-fixed-bottom footer_save">
	<button onclick="previewProblem()">Preview Challenge</button>
	<button id="btn_update_problem" onclick="updateProblem()">Save Changes</button>
</div>

<script type="text/javascript">
	var problemData='<?php echo $problem_data; ?>';
</script>

<script type="text/javascript" src="views/problems/problems_dashboard/problem_action_dashboard/js/problem_edit.js"></script>

<script type="text/javascript">
	setUpEditor();
</script>
