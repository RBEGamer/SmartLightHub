//

<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
device_group
zone_name
show_sidebar
icon_list
*/


if(isset($_POST['device_group']) && $_POST['device_group'] != "" && isset($_POST['zone_name']) && $_POST['zone_name'] != "" && isset($_POST['icon_list']) && $_POST['icon_list'] != ""){
	
	
if(isset($_POST['show_sidebar'])){
	$delete_device_query = mysql_query("UPDATE `zones` SET `visible_name`='".$_POST['zone_name']."',`icon_id`='".$_POST['icon_list']."',`show_in_sidebar`='1' WHERE `id`='".$_POST['device_group']."'");
	}else{
		$delete_device_query = mysql_query("UPDATE `zones` SET `visible_name`='".$_POST['zone_name']."',`icon_id`='".$_POST['icon_list']."',`show_in_sidebar`='0' WHERE `id`='".$_POST['device_group']."'");
		}	

	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Edit Device : ".$_POST['device_list']."')");
	
	echo "Device deleted";
	echo "WEITERLEITUNG";
header("Location: ../dashboard/dashboard.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>