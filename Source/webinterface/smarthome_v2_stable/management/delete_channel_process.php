<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");




if(isset($_POST['ch_id']) && $_POST['ch_id'] != ""){

$delete_device_query = mysql_query("DELETE FROM `channels` WHERE `id`='".$_POST['ch_id']."'");
	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Delete Channel: ".$_POST['ch_id']."')");
	
	echo "Channel deleted";
	echo "WEITERLEITUNG";
header("Location: channel_management.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>