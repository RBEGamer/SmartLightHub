<!DOCTYPE html><html><head>
  <title>RBNetworks SMART HOME</title>
<meta http-equiv='content-type' content='text/html; charset=utf-8'>
<meta charset='utf-8'> 
  <link href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css' rel=stylesheet />
  <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
  <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js'></script>
  <link rel="stylesheet" type="text/css" href="toggleswitch.css">
   
    
    <link rel="stylesheet" href="metro-bootstrap.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.widget.min.js"></script>
        <script src="js/mmetro.min.js"></script>
        
<style> body {  } #red, #green, #blue { margin: 10px; } #red { background: #f00; } #green { background: #0f0; } #blue { background: #00f; } </style>
  <script>
    function changeRGB(event, ui) { jQuery.ajaxSetup({timeout: 110}); /*not to DDoS the Arduino, you might have to change this to some threshold value that fits your setup*/ var id = $(this).attr('id'); if (id == 'red') $.post('/rgb', { red: ui.value } ); if (id == 'green') $.post('/rgb', { green: ui.value } ); if (id == 'blue') $.post('/rgb', { blue: ui.value } ); } 
    $(document).ready(function(){ $('#red, #green, #blue').slider({min: 0, max:255, change:changeRGB, slide:changeRGB}); });
  </script>
<style>
html, body {
	background: #F2F2F2;
	width: 100%;
	height: 100%;
	margin: 0px;
	padding: 0px;
	font-family: 'Verdana';
	font-size: 16px;
	color: #404040;
	}
img {
	border: 0px;
}
span.title {
	display: block;
	color: #000000;
	font-size: 30px;
}
span.subtitle {
	display: block;
	color: #000000;
	font-size: 20px;
}
.sidebar {
	background: #FFFFFF;
	width: 250px;
	min-height: 100%;
	height: 100%;
	height: auto;
	position: fixed;
	top: 0px;
	left: 0px;
	border-right: 1px solid #D8D8D8;
}
.logo {
	padding: 25px;
	text-align: center;
	border-bottom: 1px solid #D8D8D8;
}
.menu {
	padding: 25px 0px 25px 0px;
	border-bottom: 1px solid #D8D8D8;
}
.menu a {
	padding: 15px 25px 15px 25px;
	display: block;
	color: #000000;
	text-decoration: none;
	transition: all 0.25s;
}
.menu a:hover {
	background: #0088CC;
	color: #FFFFFF;
}
.right {
	margin-left: 250px;
	padding: 50px;
}
.content {
	background: #FFFFFF;
	padding: 25px;
	border-radius: 5px;
	border: 1px solid #D8D8D8;
}


select.icon_list option {
background-repeat:no-repeat;
background-position:bottom left;
padding-left:30px;
}

</style>

</head>



<script type="text/javascript">
function load_all(){
	get_group();
load_devices();	
//	setTimeout(load_devices, 200);
}

function test(id, group, channel, isanalog, minvalue, maxvalue){
	new_value = 0;
	ioname = id + "_" + group + "_" + channel;


//if(isanalog == "1"){

	if(isanalog != "1"){
new_value = document.getElementById(ioname).value;
//alert("set analog value to :" + new_value);	
}else{	
	if(document.getElementById(ioname).checked){
		new_value = maxvalue;	
	}else{
		new_value = minvalue;
	}
	
}
		


//hier ajax ausführen
	if (window.XMLHttpRequest){
               xmlhttp4=new XMLHttpRequest();
               }else{
        xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
		}
    xmlhttp4.onreadystatechange=function(){
        if (xmlhttp4.readyState==4 && xmlhttp4.status==200){ 
        if(xmlhttp4.responseText != ""){
	       // alert(xmlhttp4.responseText); 
        }  
        }
    }
xmlhttp4.open("POST","/smarthome_v2/dashboard/set_value.php",true);
xmlhttp4.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp4.send("channel="+channel+"&value="+new_value + "&group_id=" + group);


	}


















function get_group()
{
       if (window.XMLHttpRequest){
               xmlhttp1=new XMLHttpRequest();
               }else{
        xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
		}
    xmlhttp1.onreadystatechange=function(){
        if (xmlhttp1.readyState==4 && xmlhttp1.status==200){   
            document.getElementById("group_input_div").innerHTML=xmlhttp1.responseText + "<input type='button' onclick='load_devices();' id='btn' value='LIST DEVICES' />";
        
        }
    }
xmlhttp1.open("POST","/smarthome_v2/dashboard/list_groups.php",true);
xmlhttp1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp1.send("");
}

function load_devices(){
	if (window.XMLHttpRequest){
               xmlhttp2=new XMLHttpRequest();
               }else{
        xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
		}
    xmlhttp2.onreadystatechange=function(){
        if (xmlhttp2.readyState==4 && xmlhttp2.status==200){   
            document.getElementById("devices_list_div").innerHTML=xmlhttp2.responseText;
        
        }
    }
xmlhttp2.open("POST","/smarthome_v2/dashboard/load_devices.php",true);
xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp2.send("group_id=" +  document.getElementById("device_group").value);
	
	
}

</script>
<body style='font-size:62.5%;' onload="load_all();">
<div class='sidebar'>
<div class='logo'>
<span class='title'>SmartLightHub</span>
<span class='subtitle'>- Backend -</span>
</div>
<div class='menu'>
<?php include("../menu_device_management_include.php"); ?>

</div>
</div>
<div class='right'>
<div class='content'>



<b> Add Device</b><br><br>

<form action='add_device_process.php' method='post'>
<table>
<tr><td>DEVICE NAME</td> <td><input type='text' width='64' maxlength='64' id='device_name' name='device_name' placeholder='DEVICE_NAME'/></td></tr>
<tr><td>ZONE</td> <td><?php include("../dashboard/list_groups.php") ?></td></tr>
<tr><td>ICON</td> <td><?php include("../dashboard/list_icons.php") ?></td></tr>
<tr><td></td> <td><input type='submit' /></td> <td></td></tr>
</table>
</form>


</div>
</div>
</body>
</html>
