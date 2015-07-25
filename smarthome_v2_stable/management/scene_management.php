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
	xmlhttp4.open("POST","/smarthome_v2/management/list_scenes.php",true);
xmlhttp4.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	xmlhttp4.send("");
	
  xmlhttp4.onreadystatechange=function(){
        if (xmlhttp4.readyState==4 && xmlhttp4.status==200){ 
        if(xmlhttp4.responseText != ""){
	    document.getElementById("scene_list").innerHTML =    xmlhttp4.responseText 
        }  
        }
    }

	}




function add1(){
	alert("213");
	}


function add(){
	
	
	//hier ajax ausführen
	if (window.XMLHttpRequest){
               xmlhttp4=new XMLHttpRequest();
               }else{
        xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
		}
  
xmlhttp4.open("POST","/smarthome_v2/management/add_scene_process.php",true);
xmlhttp4.setRequestHeader("Content-type","application/x-www-form-urlencoded");

var sis = "0";
if(document.getElementById("nsc_sis").checked){
	sis = "1";
	}else{
		sis = "0";
		}


if(document.getElementById("nsc_aahkd").checked){
	xmlhttp4.send("nsc_name="+ document.getElementById("nsc_name").value + "&nsc_aahkd=1" + "&nsc_sis=" + sis);
	}else{
		xmlhttp4.send("nsc_name="+ document.getElementById("nsc_name").value + "&nsc_aahkd=0");
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






<div id='scene_list'></div>






<b> Add Scene</b><br><br>





<div id="ch_list" name="ch_list"></div>




<table>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
<tr> <td><hr></td><td><hr></td><td><hr></td></tr>
<tr><td>Scene-Name</td> <td><input type="text" value="" placeholder="SCENE NAME" id="nsc_name" name="nsc_name" /></td> <td></td></tr>


<tr><td>Show in Sidebar</td> <td><input type="checkbox" id="nsc_sis" name="nsc_sis" checked/></td> <td></td></tr>

<tr> <td></td> <td>ADVENCED SETTINGS</td> <td></td></tr>

<tr><td>Add as HomeKit-Device</td> <td><input type="checkbox" id="nsc_aahkd" name="nsc_aahkd" checked/></td> <td></td></tr>






<tr> <td></td> <td><input type="button" onClick="add()" value="ADD SCENE" /></td> <td></td></tr>

</table>






</div>
</div>
</body>
</html>
