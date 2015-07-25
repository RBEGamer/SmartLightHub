<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");




if(isset($_POST['schedule_id']) && $_POST['schedule_id'] != ""){

$delete_device_query = mysql_query("DELETE FROM `schedule` WHERE `id`='".$_POST['schedule_id']."'");
	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Delete Schedule: ".$_POST['schedule_id']."')");
	
	echo "Schedule deleted";
	echo "WEITERLEITUNG";
header("Location: schedule_management.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>