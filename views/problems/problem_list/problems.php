<?php include "style/lib/data_table/data_table_lib.php"; ?>

<script type="text/javascript">
	$(document).ready(function() {
    $('#datatable').dataTable();
    
     $("[data-toggle=tooltip]").tooltip();
    
} );

</script>
<div class="row">
	<div class="col-md-8">
		<div class="box">
			<div class="box_header">
				<span class="glyphicon glyphicon-list-alt"></span> Problems</div>
			<div class="box_body">
				<?php include "views/problems/problem_list/problem_list.php"; ?>
			</div>
		</div>
		
	</div>
	<div class="col-md-4">
		<div class="box">
			<div class="box_header">Last Submission</div>
			<div class="box_body"></div>
		</div>
	</div>
</div>
