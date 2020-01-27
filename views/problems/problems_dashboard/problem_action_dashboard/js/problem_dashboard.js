var dashboard_action_url="problem_dashboard_action.php";

function load_test_case_page(){

	loader("option_box_body");
	$.get(dashboard_action_url,get_data("load_test_case_page"),function(response){
		$("#option_box_body").html(response);
	});
}