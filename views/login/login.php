<script type="text/javascript" src="views/login/js/login.js"></script>
<div style="margin-top: 50px;"> </div>
<!-- Body start -->

 <div class="row">
 	<div class="col-md-4"></div>
 	<div class="col-md-4">
 		<div class="box sm_border">
 			<div class="box_header"><span class="glyphicon glyphicon-log-in"></span> Login into EWUOJ</div>
 			<div class="box_body">
 				<div id="login_failed" class="alert alert-danger" style="display: none"></div>
 				<div id="login_success" class="alert alert-success" style="display: none"></div>         <label for="username">Handle</label>
               	<input type="text" placeholder="Enter Your Handle" autocomplete="off" id="handle">
                <label for="password">Password</label><br>
                <input type="text" placeholder="Enter Your Password" id="password">
              	<div class="form-group" style="text-align: center;">
                  	<button id="btn_login" onclick="login()">Login Your ID</button>
              	</div>                            
 			</div>
 		</div>
 	</div>
 </div>