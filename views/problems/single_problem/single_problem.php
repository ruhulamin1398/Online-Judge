
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: ""
	},
	axisY: {
		title: ""
	},
	data: [{        
		type: "column",  
		showInLegend: false, 
		legendMarkerColor: "grey",
		legendText: "AC = Accepted",
		dataPoints: [      
			{ y: 300878, label: "AC" },
			{ y: 266455,  label: "WA" },
			{ y: 169709,  label: "TLE" },
			{ y: 158400,  label: "MLE" },
			{ y: 142503,  label: "RE" },
			{ y: 101500, label: "CE" }
		]
	}]
});
chart.render();

}
</script>
<div class="row">
	<div class="col-md-9">
		<div class="box sm_border">
			<div class="box_header"><span class="glyphicon glyphicon-arrow-right"></span> Hello</div>
			<div class="box_body">
				 <?php include "views/problems/single_problem/problem_stat.php"; ?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box none_border">
			<div class="box_header">Problem Info</div>
			<div class="box_body">
				<table width="100%">
					<tr>
						<td class="problem_info_td"><span class="glyphicon glyphicon-time"></span> Time Limit</td>
						<td class="problem_info_td1">120 s</td>
					</tr>
					<tr>
						<td class="problem_info_td"><span class="glyphicon glyphicon-inbox"></span> Memory Limit</td>
						<td class="problem_info_td1">120 s</td>
					</tr>
					<tr>
						<td class="problem_info_td"><span class="glyphicon glyphicon-user"></span> Problem Setter</td>
						<td class="problem_info_td1">Amir Hamza</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="box none_border">
			<div class="box_header">Statistics</div>
			<div class="box_body">
				<div id="chartContainer" style="height: 150px; width: 100%;"></div>
			</div>
		</div>
		<div class="box none_border">
			<div class="box_header">Submit</div>
			<div class="box_body" style="text-align: center;">
				<button>Submit Your Solution</button>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.problem_info_td{
		border: 1px solid #CCCCCC;
		padding: 4px;
		font-size: 12px;
		width: 50%;
	}
	.problem_info_td1{
		border: 1px solid #CCCCCC;
		padding: 4px;
		font-size: 12px;
	}
</style>