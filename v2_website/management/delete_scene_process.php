<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");




if(isset($_POST['scene_id']) && $_POST['scene_id'] != ""){

$delete_device_query = mysql_query("DELETE FROM `scenes` WHERE `id`='".$_POST['scene_id']."'");
$delete_device_query = mysql_query("DELETE FROM `scene_states` WHERE `scene_id`='".$_POST['scene_id']."'");


$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Delete Scene: ".$_POST['scene_id']."')");
	
	echo "Scene deleted";
	echo "WEITERLEITUNG";
header("Location: scene_management.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>