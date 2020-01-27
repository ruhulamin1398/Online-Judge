<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    				<thead>
						<tr>
							<th>#ID</th>
							<th>Problem Name</th>
							<th>Category</th>
							<th>AC/Submission</th>
                        </tr>
					</thead>

					<tbody>
					<?php for($i=1; $i<150; $i++){ ?>			
						<tr class="tr_select" onclick="go_problem_link(<?php echo $i; ?>)">
							<td><?php echo "$i"; ?></td>
							<td>System Architect</td>
							<td>Edinburgh</td>
							<td>61</td>
						</tr>
					<?php } ?>	
					</tbody>
				</table>

<script type="text/javascript">
	function go_problem_link(problem_id){
		var link="p.php?problem="+problem_id;
		window.location = link;
	}
</script>