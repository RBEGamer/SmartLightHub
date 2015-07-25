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


<script type="text/javascript">

function refresh_table(){
	
	//hier ajax ausführen
	if (window.XMLHttpRequest){
               xmlhttp4=new XMLHttpRequest();
               }else{
        xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
		}
	xmlhttp4.open("POST","/smarthome_v2/management/list_device_channels.php",true);
xmlhttp4.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	xmlhttp4.send("device_id="+ document.getElementById("device_list").value);
	
  xmlhttp4.onreadystatechange=function(){
        if (xmlhttp4.readyState==4 && xmlhttp4.status==200){ 
        if(xmlhttp4.responseText != ""){
	    document.getElementById("ch_list").innerHTML =    xmlhttp4.responseText 
        }  
        }
    }

	}



function add_channel(){
	
	
	//hier ajax ausführen
	if (window.XMLHttpRequest){
               xmlhttp4=new XMLHttpRequest();
               }else{
        xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
		}
  
xmlhttp4.open("POST","/smarthome_v2/management/add_channel_process.php",true);
xmlhttp4.setRequestHeader("Content-type","application/x-www-form-urlencoded");

if(document.getElementById("nch_is").checked){
	xmlhttp4.send("nch_name="+ document.getElementById("nch_name").value + "&nch_is=1" + "&nch_ch="+ document.getElementById("nch_ch").value + "&nch_min="+ document.getElementById("nch_min").value + "&nch_max="+ document.getElementById("nch_max").value + "&nch_device="+ document.getElementById("device_list").value + "&nch_icon=" + document.getElementById("icon_list"));
	}else{
		xmlhttp4.send("nch_name="+ document.getElementById("nch_name").value + "&nch_is=0" + "&nch_ch="+ document.getElementById("nch_ch").value + "&nch_min="+ document.getElementById("nch_min").value + "&nch_max="+ document.getElementById("nch_max").value +  "&nch_device="+ document.getElementById("device_list").value+ "&nch_icon=" + document.getElementById("icon_list"));
		}


  xmlhttp4.onreadystatechange=function(){
        if (xmlhttp4.readyState==4 && xmlhttp4.status==200){ 
        if(xmlhttp4.responseText != ""){
	        alert(xmlhttp4.responseText); 
			refresh_table();
        }  
        }
    }




	}

</script>
</head>




<body style='font-size:62.5%;' onload="refresh_table();">
<div class='sidebar'>
<div class='logo'>
<span class='title'>SmartLightHub</span>
<span class='subtitle'>- Backend -</span>
</div>
<div class='menu'>
<?php include("../menu_links_include.php"); ?>

</div>
</div>
<div class='right'>
<div class='content'>



<b> Add Channel</b><br><br>

<table>

<tr><td>SELECT DEVICE</td> <td><?php include("list_device_zones.php") ?></td></tr>
<tr> <td><hr></td><td><hr></td><td><hr></td></tr>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
</table>



<div id="ch_list" name="ch_list"></div>




<table>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
<tr> <td><hr></td><td><hr></td><td><hr></td></tr>
<tr><td>Channel-Name</td> <td><input type="text" value="" placeholder="CHANNEL NAME" id="nch_name" name="nch_name" /></td> <td></td></tr>
<tr><td>Channel (DMX CHANNEL)</td> <td><input type="number" max="2048" value="0" step="1" id="nch_ch" name="nch_ch" /></td> <td></td></tr>
<tr><td>Channel-Icon</td> <td><?php include("../dashboard/list_icons.php"); ?></td> <td></td></tr>
<tr><td>Is a switch ?</td> <td><input type="checkbox" id="nch_is" name="nch_is" /></td> <td></td></tr>
<tr> <td></td> <td>ADVENCED SETTINGS</td> <td></td></tr>
<tr><td>Channel-Min-Value</td> <td><input type="number" step="1" value="0" id="nch_min" name="nch_min" /></td> <td></td></tr>
<tr><td>Channel-Max-Value</td> <td><input type="number" step="1" value="255" id="nch_max" name="nch_max" /></td> <td></td></tr>
<tr> <td></td> <td><input type="button" onClick="add_channel()" value="ADD CHANNEL" /></td> <td></td></tr>

</table>






</div>
</div>
</body>
</html>
