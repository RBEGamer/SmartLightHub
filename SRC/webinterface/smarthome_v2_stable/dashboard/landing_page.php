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


</style>

</head>



<body style='font-size:62.5%;' onload="load_all();">
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


<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");
?>



<h1> SCENES </h1>
<hr/>


<?php

echo "<table>";
$fetchinfo_dev = mysql_query("SELECT * FROM `scenes` WHERE `active`='1' AND `show_in_sidebar`='1'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	
	
	echo "<tr><td>";
	echo "<a href='/smarthome_v2/dashboard/quick_scene_toggle.php?scene_id=".$row_dev['id']."'> <br>".$row_dev['visible_name']."</a>";
	
	echo "</td></tr>";
	
	echo "<tr><td>&nbsp</td></tr>";
	

}
echo "</table>";
?>




<h1> ZONES </h1>
<hr/>
<?php

echo "<table>";
$fetchinfo_dev = mysql_query("SELECT * FROM `zones` WHERE `active`='1' AND `show_in_sidebar`='1'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	$fetchinfo_dev1 = mysql_query("SELECT * FROM `icons` WHERE `id`='".$row_dev['icon_id']."'");
while($row_dev1 = mysql_fetch_array($fetchinfo_dev1)) {
	
	echo "<tr><td>";
	echo "<a href='/smarthome_v2/dashboard/quick_dashboard.php?group_id=".$row_dev['id']."'><img src='../icons/".$row_dev1['path'] ."' alt='".$row_dev1['desc'] ."' width='50px'> <br>".$row_dev['visible_name']."</a>";
	
	echo "</td></tr>";
	
	echo "<tr><td>&nbsp</td></tr>";
	
}
}
echo "</table>";
?>



</div>
</div>
</body>
</html>
