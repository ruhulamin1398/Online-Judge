<script type="text/javascript" src="style/lib/jquery/jquery.min.js"></script>
<div id='response'></div>

<script type="text/javascript">
	setInterval(function(){ 
		callServer();
	}, 1000);
//working script
	function callServer() {
  		$.get("process_server.php",function(response) { 
    		$("#response").html(response);
  		});
	}
</script>
