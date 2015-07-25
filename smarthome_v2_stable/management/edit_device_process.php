//

<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
device_list
device_name
device_group
icon_list
*/


if(isset($_POST['device_list']) && $_POST['device_list'] != "" && isset($_POST['device_name']) && $_POST['device_name'] != "" && isset($_POST['device_group']) && $_POST['device_group'] != "" && isset($_POST['icon_list']) && $_POST['icon_list'] != ""){
	
$delete_device_query = mysql_query("UPDATE `devices` SET `visible_name`='".$_POST['device_name']."',`zone_id`='".$_POST['device_group']."',`icon_id`='".$_POST['icon_list']."',`active`='1' WHERE `id`='".$_POST['device_list']."'");
	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Edit Device : ".$_POST['device_list']."')");
	
	echo "Device deleted";
	echo "WEITERLEITUNG";
header("Location: ../dashboard/dashboard.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>