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


if(isset($_POST['node_name']) && $_POST['node_name'] != "" && isset($_POST['node_ip']) && $_POST['node_ip'] != "" && isset($_POST['node_port']) && $_POST['node_port'] != "" && isset($_POST['node_token']) && $_POST['node_token'] != ""){

  $adcounter = 0;
 $fetchinfo_dev = mysql_query("SELECT * FROM `nodes` WHERE `ip`='".$_POST['node_ip']."' AND `port`='".$_POST['node_port']."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$adcounter++;
}
 
 if($adcounter == 0){


	 $log_update = mysql_query("INSERT INTO `smart_light`.`nodes` (`id`, `visible_name`, `ip`, `port`, `token`, `active`) VALUES (NULL, '".$_POST['node_name']."', '".$_POST['node_ip'] ."', '".$_POST['node_port'] ."', '".$_POST['node_token'] ."', '1');");
	
	 
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Node added : ".$_POST['node_name']."')");
echo "Der Node " .$_POST['node_name'] ." wurde hinzugefügt";
	 
	 }else{
		 echo "Es existiert bereits ein Node mit dieser IP und diesem Token";
		 }
}else{
echo "Bitte fuelle alle Felder aus";
}



?>