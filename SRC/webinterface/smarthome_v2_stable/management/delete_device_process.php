<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
//device_list
*/


if(isset($_POST['device_list']) && $_POST['device_list'] != ""){
$delete_device_query = mysql_query("DELETE FROM `devices` WHERE `id`='".$_POST['device_list']."'");
$delete_device_query = mysql_query("DELETE FROM `channels` WHERE `group_id`='".$_POST['device_list']."'");	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Delete Device and Channels : ".$_POST['device_list']."')");
	
	echo "Device deleted";
	echo "WEITERLEITUNG";
header("Location: ../dashboard/dashboard.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>