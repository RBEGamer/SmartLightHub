<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
//device_list
*/


if(isset($_POST['device_group']) && $_POST['device_group'] != ""){
	
	
	
$fetchinfo_dev = mysql_query("SELECT `id` FROM `devices` WHERE `zone_id`='".$_POST['device_group']."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {

$delete_device_query = mysql_query("DELETE FROM `channels` WHERE `group_id`='".$row_dev['id']."'");
}
	
$delete_device_query = mysql_query("DELETE FROM `devices` WHERE `zone_id`='".$_POST['device_group']."'");
$delete_device_query = mysql_query("DELETE FROM `zones` WHERE `id`='".$_POST['device_group']."'");
	
	
	
	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Delete Zone, Devices and Channels: ".$_POST['device_group']."')");
	
	echo "Zone deleted";
	echo "WEITERLEITUNG";
header("Location: ../dashboard/dashboard.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>