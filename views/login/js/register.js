document.onkeydown=function(evt){
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        if(keyCode == 13)
        {
           register();
        }
    }
function register(){
	var data = {
        'userFullName': $("#userFullName").val(),
        'userEmail': $("#userEmail").val(),
        'userEwuId': $("#userEwuId").val(),
        'userHandle': $("#userHandle").val(),
        'userCpassword': $("#userCpassword").val(),
        'userPassword': $("#userPassword").val()
    }
    btnOff("btn_register","Processing...");
    $("#register_success").hide();
    $("#register_failed").hide();
    $.post("site_enter_action.php",buildData("register",data),function(response){
       
        // debug----------------
        //$("#register_failed").show();
        //$("#register_failed").html(response);

        response=JSON.parse(response);
        var login_div=(response.error==0)?"register_success":"register_failed";
        $("#"+login_div).show();
        $("#"+login_div).html(response.msg);
        if(response.error==0){
            $("#userFullName").val("");
            $("#userEmail").val("");
            $("#userEwuId").val("");
            $("#userHandle").val("");
            $("#userCpassword").val("");
            $("#userPassword").val("");
        }
        btnOn("btn_register","Create Your Account");
    });
}
