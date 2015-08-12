<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");




if(isset($_POST['scene_id']) && $_POST['scene_id'] != ""){


$delete_device_query = mysql_query("DELETE FROM `scene_states` WHERE `scene_id`='".$_POST['scene_id']."'");


//INSERT INTO `smart_light`.`scene_states` (`id`, `scene_id`, `channel_id`, `channel_value`) VALUES (NULL, '1', '50', '0');


$fetchinfo_dev = mysql_query("SELECT * FROM `channels` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {


$delete_device_query = mysql_query("INSERT INTO `scene_states` (`id`, `scene_id`, `channel_id`, `channel_value`) VALUES (NULL, '".$_POST['scene_id']."', '".$row_dev['id']."', '".$row_dev['value']."');");


}



$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Capture device values to Scene: ".$_POST['scene_id']."')");
	
	echo "Values Captures to Scene";
	echo "WEITERLEITUNG";
header("Location: scene_management.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>