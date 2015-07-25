<?php
include("../remote/socket.php");
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
//device_list
*/

if(isset($_GET['scene_id'])){
	
	
	
		







$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Toggle Scene: ".$_GET['scene_id']." BY USER')");



$fetchinfo_dev11 = mysql_query("SELECT * FROM `scene_states` WHERE `scene_id`='".$_GET['scene_id']."'");
while($row_dev11 = mysql_fetch_array($fetchinfo_dev11)) {
$log_update = mysql_query("UPDATE `channels` SET `value`='".$row_dev11['channel_value']."' WHERE `id`='".$row_dev11['channel_id']."'");

}

send_data();
}

	echo "Scene toggled";
	echo "WEITERLEITUNG";
header("Location: landing_page.php");











?>