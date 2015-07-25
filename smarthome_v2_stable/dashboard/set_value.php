<?php
include("../remote/socket.php");
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


if(isset($_POST['channel']) && $_POST['channel'] != "" && isset($_POST['value']) && $_POST['value'] != "" && isset($_POST['group_id']) && $_POST['group_id'] != ""){
	
 	

	
$update = mysql_query("UPDATE `channels` SET `value`='".$_POST['value']."' WHERE `group_id`='".$_POST['group_id']."' AND `channel`='".$_POST['channel']."'");
	 



	send_data();








//	echo "change value complete";

	}else{
		echo "error";
	}









































 







?>