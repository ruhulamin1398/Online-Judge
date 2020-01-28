function get_data(key_name,val=0){
  var data={};
  data[key_name]=val;
  return data;
}

function btn_off(btn_id,txt=""){
	$("#"+btn_id).attr("disabled", true);
	$("#"+btn_id).html("<i class='fa fa-refresh fa-spin fa-1x fa-fw'></i> "+txt);
}

function btn_on(btn_id,txt=""){
	$("#"+btn_id).removeAttr("disabled");
	if(txt!="")
		$("#"+btn_id).html(txt);
}

function loader(div_id,size=130){
	img_size="";
  	if(size!=0)img_size="height: "+size+"px; width:"+size+"px";
  	img_url="src='file/site_metarial/loader.gif'";
  	img_style="style='margin-top:35px"+img_size+"'";
  	img="<center><img "+img_style+img_url+" /></center>";
  	$("#"+div_id).html(img);
}

function update_site_status(){
  $.post('site_action.php',get_data("update_site_status"),function(response){
    
  });
}

