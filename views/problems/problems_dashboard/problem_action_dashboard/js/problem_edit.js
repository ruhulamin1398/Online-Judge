

var constraints_editor,input_editor,output_ex_editor,description_editor,input_ex_editor,output_ex_editor;
var note_editor;
var problem_id;

function set_up_editor(){
	
	//define editor variable
	description_editor=CKEDITOR.replace( 'description_editor' );
    input_editor=CKEDITOR.replace( 'input_editor' );
    input_ex_editor=CKEDITOR.replace( 'input_ex_editor' );
    output_editor=CKEDITOR.replace( 'output_editor' );
    output_ex_editor=CKEDITOR.replace( 'output_ex_editor' );
    note_editor=CKEDITOR.replace( 'note_editor' );
    constraints_editor=CKEDITOR.replace( 'constraints_editor' );

    //set global data
    CKEDITOR.config.height = 100;
 	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
  	CKEDITOR.config.extraPlugins= 'mathjax,autogrow';
  	CKEDITOR.config.mathJaxLib = 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';   
  	CKEDITOR.config.mathJaxClass = 'equation';
  	CKEDITOR.config.codeSnippet_theme= 'pojoaque';
  	CKEDITOR.config.fontSize_defaultLabel = '12px';
  	CKEDITOR.config.disableObjectResizing = false;
	CKEDITOR.config.autoGrow_minHeight = 100;
	CKEDITOR.config.autoGrow_maxHeight = 300;

	//set eidtor toolbar function
	set_editor_toolbar();

	//set editor data
	set_up_editor_data();
}

function set_editor_toolbar(){
	 

	var toolbar_constraints_editor=[
     	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    	{ name: 'others', items: [ '-' ] },
    	{name: 'Math', items: [ 'Mathjax' ] },
    	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat' ] }
  	];

  	var toolbar_input_ex_editor=[
     	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] }
  	];

  	input_ex_editor.config.toolbar = toolbar_input_ex_editor;
  	output_ex_editor.config.toolbar = toolbar_input_ex_editor;

  	constraints_editor.config.toolbar = toolbar_constraints_editor;
  	input_editor.config.toolbar = toolbar_constraints_editor;
  	output_editor.config.toolbar = toolbar_constraints_editor;
	
}

function set_up_editor_data(){
	problem_data = window.atob(problem_data);
   	problem_data=JSON.parse(problem_data);
   	problem_id=problem_data.problem_id;
    CKEDITOR.instances.description_editor.setData(problem_data.problem_description);
    CKEDITOR.instances.input_editor.setData(problem_data.input_description);
    CKEDITOR.instances.output_editor.setData(problem_data.output_description);
    CKEDITOR.instances.input_ex_editor.setData(problem_data.input_example);
    CKEDITOR.instances.output_ex_editor.setData(problem_data.output_example);
    CKEDITOR.instances.note_editor.setData(problem_data.notes);
    CKEDITOR.instances.constraints_editor.setData(problem_data.constraint_description);
}


function get_editor_data(){
	var editor_data = {
		'problem_id': problem_id,
		'problem_description': CKEDITOR.instances.description_editor.getData(),
		'input_description': CKEDITOR.instances.input_editor.getData(),
		'output_description': CKEDITOR.instances.output_editor.getData(),
		'input_example': CKEDITOR.instances.input_ex_editor.getData(),
		'output_example': CKEDITOR.instances.output_ex_editor.getData(),
		'notes': CKEDITOR.instances.note_editor.getData(),
		'constraint_description': CKEDITOR.instances.constraints_editor.getData()
	}

	return editor_data;
}

function preview_problem(){
	modal_action("lg","Problem Preview");
	loader("modal_lg_body");
	$.get(dashboard_action_url,get_data("problem_preview",get_editor_data()),function(response){
		$("#modal_lg_body").html(response);
	});
}

function update_problem(){
	btn_off("btn_update_problem","Saving....");
	$.post(dashboard_action_url,get_data("update_problem",get_editor_data()),function(response){
		location.reload();
	});
}

function btn_fun(){
     	var val=CKEDITOR.instances.description_editor.getData();;
     	alert(val);
     }