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


if(isset($_POST['zone_name']) && $_POST['zone_name'] != "" && isset($_POST['icon_list']) && $_POST['icon_list'] != ""){
	//show_sidebar
 $adcounter = 0;
 $fetchinfo_dev = mysql_query("SELECT * FROM `zones` WHERE `visible_name`='".$_POST['zone_name']."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$adcounter++;
}
 
 
if($adcounter == 0){
	
	
	
	if(isset($_POST['show_sidebar'])){
		$add_device_query = mysql_query("INSERT INTO `zones`(`visible_name`, `icon_id`, `active`, `show_in_sidebar`) VALUES ('".$_POST['zone_name']."','".$_POST['icon_list']."','1','1')");
	
		}else{
			$add_device_query = mysql_query("INSERT INTO `zones`(`visible_name`, `icon_id`, `active`, `show_in_sidebar`) VALUES ('".$_POST['zone_name']."','".$_POST['icon_list']."','1','0')");
	
			}
	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Add Zone : ".$_POST['zone_name'].". ')");
	
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