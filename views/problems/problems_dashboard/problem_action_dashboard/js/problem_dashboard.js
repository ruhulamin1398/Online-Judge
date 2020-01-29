var dashboard_action_url="problem_dashboard_action.php";

// page ready event ------------------------------------------

$( document ).ready(function() {
    display_page();
});


//site info---------------------------------

function display_page(){
	if(page_action_name!="edit")
		change_option(page_action_name);
}

function change_url(action_name,page_name=""){
	url="problems_dashboard.php?problem_id="+problem_id+"&action="+action_name;
	var obj = { Title: page_name, Url: url };
    history.pushState(obj, obj.Title, obj.Url);
}

function set_header_name(header_name){
	$("#box_dashboard_header").html(header_name);
}

function change_option(option_name){
	if(option_name=="test_case"){
		change_url("test_case");
		set_header_name("Test Case");
		load_test_case_page();
	}
	else if(option_name=='edit'){
		change_url("edit");
		location.reload();
	}
	else if(option_name=='moderators'){
		change_url("moderators");
		set_header_name("Moderators");
		load_moderators_page();
	}
	else{
		change_url("overview");
		set_header_name("Problem Overview");
		load_overview_page();
	}

}

//=======================================================

//start overview page 

function load_overview_page(){
	loader("option_box_body");
	$.get(dashboard_action_url,get_data("load_overview_page"),function(response){
		$("#option_box_body").html(response);
	});
}

//===========================================================

//start overview page


function load_moderators_page(){
	loader("option_box_body");
	$.get(dashboard_action_url,get_data("load_moderators_page",problem_id),function(response){
		$("#option_box_body").html(response);
	});
}

function search_moderators(){
	var obj=[
		{ "handle":"AmirHamza", "id":24},
		{ "handle":"Alise", "id":24},
		{ "handle":"Bob", "id":24},
		{ "handle":"Zarry", "id":24}
	];
	$('#suggestion_box').html("");
	var search_val=$("#search_moderators").val();
	$.each(obj, function() {
		if (this.handle.toLowerCase().includes(search_val.toLowerCase())==true && search_val.length>=1){
			$('#suggestion_box').append(
        		"<li class='list-group-item moderators_suggestion_li'>"+
        		"<img class='img-thumbnail moderators_suggestion_li_img' src='https://hrcdn.net/s3_pub/hr-avatars/2655d5c2-7594-47b7-969a-c2f16daccc87/150x150.png'> "
        		+this.handle+
        		"</li>"
    		);
		}
    	
	});
}

//===========================================================

//start test case function

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

//===========================================================