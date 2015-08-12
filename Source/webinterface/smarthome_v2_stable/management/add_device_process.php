<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
device_name
device_group
icon_list

*/


if(isset($_POST['device_name']) && $_POST['device_name'] != "" && isset($_POST['device_group']) && $_POST['device_group'] != "" && isset($_POST['icon_list']) && $_POST['icon_list'] != ""){
	
 $adcounter = 0;
 $fetchinfo_dev = mysql_query("SELECT * FROM `devices` WHERE `visible_name`='".$_POST['device_name']."' AND `zone_id`='".$_POST['device_group']."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$adcounter++;
}
 
 
if($adcounter == 0){
	
	//addden
	//INSERT INTO `smart_light`.`devices` (`id`, `visible_name`, `zone_id`, `icon_id`, `active`) VALUES (NULL, 'test', '0', '0', '1');
	
	
	$add_device_query = mysql_query("INSERT INTO `smart_light`.`devices` (`id`, `visible_name`, `zone_id`, `icon_id`, `active`) VALUES (NULL, '".$_POST['device_name']."', '".$_POST['device_group']."', '".$_POST['icon_list']."', '1');");
	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Add Device : ".$_POST['device_name']." to Zone : ".$_POST['device_group']."')");
	
	echo "Device added";
	echo "WEITERLEITUNG";
header("Location: ../dashboard/dashboard.php");
exit(); 
	}else{
	echo "Der DeviceName exisiterit in dieser Zone bereits";
	}
}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>