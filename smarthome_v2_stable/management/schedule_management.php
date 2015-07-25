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
	xmlhttp4.open("POST","/smarthome_v2/management/list_schedules.php",true);
xmlhttp4.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	xmlhttp4.send("");
	
  xmlhttp4.onreadystatechange=function(){
        if (xmlhttp4.readyState==4 && xmlhttp4.status==200){ 
        if(xmlhttp4.responseText != ""){
	    document.getElementById("schedule_list").innerHTML =    xmlhttp4.responseText 
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
  
xmlhttp4.open("POST","/smarthome_v2/management/add_schedule_process.php",true);
xmlhttp4.setRequestHeader("Content-type","application/x-www-form-urlencoded");

var monch = "0";
if(document.getElementById("sch_mon").checked){monch = "1";}else{monch = "0";}

var tuech = "0";
if(document.getElementById("sch_tue").checked){tuech = "1";}else{tuech = "0";}

var wedch = "0";
if(document.getElementById("sch_wed").checked){wedch = "1";}else{wedch = "0";}

var thuch = "0";
if(document.getElementById("sch_thu").checked){thuch = "1";}else{thuch = "0";}

var frich = "0";
if(document.getElementById("sch_fri").checked){frich = "1";}else{frich = "0";}

var satch = "0";
if(document.getElementById("sch_sat").checked){satch = "1";}else{satch = "0";}

var sunch = "0";
if(document.getElementById("sch_sun").checked){sunch = "1";}else{sunch = "0";}





xmlhttp4.send("sch_name=" + document.getElementById("sch_name").value + "&sch_time=" + document.getElementById("sch_time").value + "&scene_list=" + document.getElementById("scene_list").value + "&sch_mon=" + monch + "&sch_tue=" + tuech + "&sch_wed=" + wedch + "&sch_thu=" + thuch + "&sch_fri=" + frich + "&sch_sat=" + satch + "&sch_sun=" + sunch);

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



<b> Schedules</b><br><br>




<div id="schedule_list" name="schedule_list"></div>




<table>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
<tr><td>&nbsp </td> <td> &nbsp </td></tr>
<tr> <td><hr></td><td><hr></td><td><hr></td></tr>
<tr><td>Channel-Name</td> <td><input type="text" value="" placeholder="SCHEDULE NAME" id="sch_name" name="sch_name" /></td> <td></td></tr>


<tr><td>Scene to Toggle </td> <td><?php include("../dashboard/list_scenes.php"); ?></td> <td></td></tr>

<tr> <td></td> <td>TIME SETTINGS</td> <td></td></tr>

<tr><td>Toggle Time [FORMAT : HH:MM eg. 09:00 24Hr]</td> <td><input type="time"  value="00:00" id="sch_time" name="sch_time" /></td> <td></td></tr>


<tr><td>MONDAY</td> <td><input type="checkbox" id="sch_mon" name="sch_mon" checked /></td> <td></td></tr>
<tr><td>TUESDAY</td> <td><input type="checkbox" id="sch_tue" name="sch_tue" checked /></td> <td></td></tr>
<tr><td>WEDNESDAY</td> <td><input type="checkbox" id="sch_wed" name="sch_wed" checked /></td> <td></td></tr>
<tr><td>THURSDAY</td> <td><input type="checkbox" id="sch_thu" name="sch_thu" checked /></td> <td></td></tr>
<tr><td>FRIDAY</td> <td><input type="checkbox" id="sch_fri" name="sch_fri" checked /></td> <td></td></tr>
<tr><td>SATURDAY</td> <td><input type="checkbox" id="sch_sat" name="sch_sat" checked /></td> <td></td></tr>
<tr><td>SUNDAY</td> <td><input type="checkbox" id="sch_sun" name="sch_sun" checked /></td> <td></td></tr>

<tr> <td></td> <td><input type="button" onClick="add_channel()" value="ADD SCHEDULE" /></td> <td></td></tr>

</table>






</div>
</div>
</body>
</html>
