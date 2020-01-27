
  <!-- Body start -->
 <script type="text/javascript" src="views/login/js/register.js"></script>
 <div class="row">
 	<div class="col-md-3"></div>
 	<div class="col-md-6">
 		<div class="box sm_border">
 			<div class="box_header"><i class='fas'>&#xf234;</i> Register into EWUOJ</div>
 			<div class="box_body">
 				       <div id="register_failed" class="alert alert-danger" style="display: none"></div>
                <div id="register_success" class="alert alert-success" style="display: none"></div>  
 				         <label for="username">Full Name <b style="color: #EA2027">*</b></label>
               	<input type="text" placeholder="Enter Your Handle" autocomplete="off" id="user_full_name">

                <label for="username">Handle <b style="color: #EA2027">*</b></label>
                <input type="text" placeholder="Enter Your Handle" autocomplete="off" id="user_handle">
                <div class="register_notice">
                  <li>You Can Use Character <b> (A-Z), (a-z), (_)</b></li>
                  <li>You Can Use Number <b>(0-9)</b></li>
                  <li>Handle Length Must Be <b>(4 to 14)</b></li>
                </div>

               	<label for="username">Email <b style="color: #EA2027">*</b></label>
               	<input type="text" placeholder="Enter Your Handle" autocomplete="off" id="user_email">
                
                <label for="username">Your EWU ID</label>
               	<input type="text" placeholder="Enter Your Handle" autocomplete="off" id="user_ewu_id">
                <div class="register_notice">
                  <li>Enter Valid Your EWU ID or Blank This Field</b></li>
                </div>
                                
                <label for="password">Password <b style="color: #EA2027">*</b></label><br>
                <input type="password" name="password" placeholder="Enter Your Password" id="user_password">
                <div class="register_notice">
                  <li>Password Length Must Be Minimum 6</b></li>
                </div>
                <label for="password">Confirm Password <b style="color: #EA2027">*</b></label><br>
                <input type="password" name="password" placeholder="Confirm Password" id="user_cpassword">

              	<div class="form-group" style="text-align: center;">
                  	<button id="btn_register" onclick="register()">Create Your Account</button>
              	</div>
                            
 			</div>
 		</div>
 	</div>
 </div>
