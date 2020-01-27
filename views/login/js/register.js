document.onkeydown=function(evt){
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        if(keyCode == 13)
        {
           register();
        }
    }
function register(){
	var data = {
        'user_full_name': $("#user_full_name").val(),
        'user_email': $("#user_email").val(),
        'user_ewu_id': $("#user_ewu_id").val(),
        'user_handle': $("#user_handle").val(),
        'user_cpassword': $("#user_cpassword").val(),
        'user_password': $("#user_password").val()
    }
    btn_off("btn_register","Processing...");
    $("#register_success").hide();
    $("#register_failed").hide();
    $.post("site_enter_action.php",get_data("register",data),function(response){
       // $("#register_failed").show();
       // $("#register_failed").html(response);

        response=JSON.parse(response);
        var login_div=(response.error==0)?"register_success":"register_failed";
        $("#"+login_div).show();
        $("#"+login_div).html(response.msg);
        if(response.error==0){
            $("#user_full_name").val("");
            $("#user_email").val("");
            $("#user_ewu_id").val("");
            $("#user_handle").val("");
            $("#user_password").val("");
            $("#user_cpassword").val("");
        }
        btn_on("btn_register","Create Your Account");
    });
}

 function studentId_mask() {
            var myMask = "____-_-__-__";
            var myCaja = document.getElementById("user_ewu_id");
            var myText = "";
            var myNumbers = [];
            var myOutPut = ""
            var theLastPos = 1;
            myText = myCaja.value;
            //get numbers
            for (var i = 0; i < myText.length; i++) {
                if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
                    myNumbers.push(myText.charAt(i));
                }
            }
            //write over mask
            for (var j = 0; j < myMask.length; j++) {
                if (myMask.charAt(j) == "_") { //replace "_" by a number
                    if (myNumbers.length == 0)
                        myOutPut = myOutPut + myMask.charAt(j);
                    else {
                        myOutPut = myOutPut + myNumbers.shift();
                        theLastPos = j + 1; //set caret position
                    }
                } else {
                    myOutPut = myOutPut + myMask.charAt(j);
                }
            }
            document.getElementById("user_ewu_id").value = myOutPut;
            document.getElementById("user_ewu_id").setSelectionRange(theLastPos, theLastPos);
        }

