var constraintsEditor, inputEditor, outputExEditor, descriptionEditor, inputExEditor, outputExEditor;
var noteEditor;

function setUpEditor() {

  //define editor variable
  descriptionEditor = CKEDITOR.replace('descriptionEditor');
  inputEditor = CKEDITOR.replace('inputEditor');
  inputExEditor = CKEDITOR.replace('inputExEditor');
  outputEditor = CKEDITOR.replace('outputEditor');
  outputExEditor = CKEDITOR.replace('outputExEditor');
  noteEditor = CKEDITOR.replace('noteEditor');
  constraintsEditor = CKEDITOR.replace('constraintsEditor');

  //set global data
  CKEDITOR.config.height = 100;
  CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
  CKEDITOR.config.extraPlugins = 'mathjax,autogrow';
  CKEDITOR.config.mathJaxLib = 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
  CKEDITOR.config.mathJaxClass = 'equation';
  CKEDITOR.config.codeSnippet_theme = 'pojoaque';
  CKEDITOR.config.fontSize_defaultLabel = '12px';
  CKEDITOR.config.disableObjectResizing = false;
  CKEDITOR.config.autoGrow_minHeight = 100;
  CKEDITOR.config.autoGrow_maxHeight = 300;

  //set eidtor toolbar function
  setEditorToolbar();

  //set editor data
  setUpEditorData();
}

function setEditorToolbar() {

  var toolbarConstraintsEditor = [{
      name: 'clipboard',
      groups: ['clipboard', 'undo'],
      items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
    },
    {
      name: 'editing',
      groups: ['find', 'selection', 'spellchecker'],
      items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
    },
    {
      name: 'others',
      items: ['-']
    },
    {
      name: 'Math',
      items: ['Mathjax']
    },
    {
      name: 'basicstyles',
      groups: ['basicstyles', 'cleanup'],
      items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat']
    }
  ];

  var toolbarInputExEditor = [{
    name: 'clipboard',
    groups: ['clipboard', 'undo'],
    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
  }];

  inputExEditor.config.toolbar = toolbarInputExEditor;
  outputExEditor.config.toolbar = toolbarInputExEditor;

  constraintsEditor.config.toolbar = toolbarConstraintsEditor;
  inputEditor.config.toolbar = toolbarConstraintsEditor;
  outputEditor.config.toolbar = toolbarConstraintsEditor;

}

function setUpEditorData() {
  problemData = window.atob(problemData);
  problemData = JSON.parse(problemData);
  problemId = problemData.problemId;
  CKEDITOR.instances.descriptionEditor.setData(problemData.problemDescription);
  CKEDITOR.instances.inputEditor.setData(problemData.inputDescription);
  CKEDITOR.instances.outputEditor.setData(problemData.outputDescription);
  CKEDITOR.instances.inputExEditor.setData(problemData.inputExample);
  CKEDITOR.instances.outputExEditor.setData(problemData.outputExample);
  CKEDITOR.instances.noteEditor.setData(problemData.notes);
  CKEDITOR.instances.constraintsEditor.setData(problemData.constraintDescription);
}


function getEditorData() {

  var editorData = {
    'problemId': problemId,
    'problemDescription': CKEDITOR.instances.descriptionEditor.getData(),
    'inputDescription': CKEDITOR.instances.inputEditor.getData(),
    'outputDescription': CKEDITOR.instances.outputEditor.getData(),
    'inputExample': CKEDITOR.instances.inputExEditor.getData(),
    'outputExample': CKEDITOR.instances.outputExEditor.getData(),
    'notes': CKEDITOR.instances.noteEditor.getData(),
    'constraintDescription': CKEDITOR.instances.constraintsEditor.getData()
  }

  return editorData;
}

function previewProblem() {
  modal_action("lg", "Problem Preview");
  loader("modal_lg_body");
  $.post(dashboard_action_url, buildData("previewProblem", getEditorData()), function (response) {
    $("#modal_lg_body").html(response);
  });
}

function updateProblem() {
  btnOff("btn_update_problem", "Saving....");
  $.post(dashboard_action_url, buildData("updateProblem", getEditorData()), function (response) {
    location.reload();
  });
}
