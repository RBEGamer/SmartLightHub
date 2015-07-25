


<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
//device_list
*/


if(isset($_POST['node_id']) && $_POST['node_id'] != ""){

$delete_device_query = mysql_query("UPDATE `nodes` SET `active`='1' WHERE `id`='".$_POST['node_id']."'");	
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Node enabled: ".$_POST['node_id']."')");
	
	echo "Node enabled";
	echo "WEITERLEITUNG";
header("Location: node_management.php");
exit(); 

}else{
	echo "Bitte fuelle alle Felder aus";
	}



?>