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
<span class='title'>RBNetworks SMART LIGHT V2</span>
<span class='subtitle'>- Backend -</span>
</div>
<div class='menu'>
<?php include("../menu_links_include.php"); ?>

</div>
</div>
<div class='right'>
<div class='content'>






<b> SETUP your Router  : Port forwarding </b><br>
Forward the port 80 to the IP from your SmartHome-Server.

<br>
<br>Click "Portforwarding"
<br>
<img src="portfreigabe_setup_images/portfreigabe_step_1.png" width="500" />
<br>
<br>Click "New"
<br>
<img src="portfreigabe_setup_images/portfreigabe_step_2.png" width="500" />
<br>
<br>Click Select HTTP-Server then Select your IP or HOSTNAME, click "ok".
<br>
<img src="portfreigabe_setup_images/portfreigabe_step_3.png" width="500" />
<br>
<br>Klick "Apply"
<br>
<img src="portfreigabe_setup_images/portfreigabe_step_4.png" width="500" />




<br><br>
<br><br>


<b> SETUP Cronjob </b><br>
The file <b>(root_dir)/remote/cron.php</b> must be called every minute.
<br>

<br>
Exaple-Config for the linux crontab : <b>* * * * * /path/to/php /var/www/smarthome_v2/remote/cron.php</b><br>
But firt make the cron.php exicutable : <b>chmod +x /var/www/smarthome_v2/remote/cron.php</b>
<br>
<br><br>

<hr>
<h2>ADVANCED CONFIG</h2>
<hr>
<br><br>



<b> SETUP Database : setup (the root_dir)/db_config.php first </b><br><br>
<img src="setup_database_images/setup_db_config.png" width="500" />
<br><br>


<br><br>
<b> SETUP Database : Load data to Database. Create a table with the name "smarthome" first</b><br><br>
<a href="setup_database_data.php" target="_"><input 
type="button" value="Setup Database with SAMPLE DATA"/></a>
<br><br>
<a href="setup_database_empty.php" target="_"><input 
type="button" value="Setup empty Database"/></a>

<br>
<br>
<br>


</div>
</div>
</body>
</html>
