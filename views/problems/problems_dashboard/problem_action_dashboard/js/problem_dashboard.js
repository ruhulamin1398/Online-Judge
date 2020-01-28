var dashboard_action_url="problem_dashboard_action.php";
var problem_id=1;

//test case function--------------------------

function load_test_case_page(){

	loader("option_box_body");
	$.get(dashboard_action_url,get_data("load_test_case_page"),function(response){
		$("#option_box_body").html(response);
	});
}

function load_add_test_case_page(){
	modal_action("md","Add Test Case");
	loader("modal_md_body");
	$.get(dashboard_action_url,get_data("load_add_test_case_page"),function(response){
		$("#modal_md_body").html(response);
	});
}



function add_test_case(){
	var data = {
		'input': $('#input_value').val(),
		'output': $('#output_value').val(),
		'problem_id': problem_id
	}

	loader("modal_md_body");
	$.post(dashboard_action_url,get_data("add_test_case",data),function(response){
		load_test_case_page();
		modal_action("md","Add Test Case","close");
	});
}

function delete_test_case(btn_sl){
	var ok=confirm('Are You Want To Delete This Test Case.');
	if(!ok)return;
	var hash_id=$("#btn_del_"+btn_sl).val();
	loader("option_box_body");
	$.post(dashboard_action_url,get_data("delete_test_case",hash_id),function(response){
		load_test_case_page();
	});
}

function load_edit_test_case_page(btn_sl){
	modal_action("md","Edit Test Case");
	var hash_id=$("#btn_edit_"+btn_sl).val();
	loader("modal_md_body");
	$.get(dashboard_action_url,get_data("load_edit_test_case_page",hash_id),function(response){
		$("#modal_md_body").html(response);
	});
}

function update_test_case(){
	var data = {
		'input': $('#input_value').val(),
		'output': $('#output_value').val(),
		'hash_id': $("#btn_update").val()
	}

	loader("modal_md_body");
	$.post(dashboard_action_url,get_data("update_test_case",data),function(response){
		//$("#modal_md_body").html(response);
		load_test_case_page();
		modal_action("md","Add Test Case","close");
	});
}

//end test case function----------------