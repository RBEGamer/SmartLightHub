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


if(isset($_POST['nsc_name']) && $_POST['nsc_name'] != "" && isset($_POST['nsc_aahkd'])  && isset($_POST['nsc_sis']) ){

  $adcounter = 0;
 $fetchinfo_dev = mysql_query("SELECT * FROM `scenes` WHERE `visible_name`='".$_POST['nsc_name']."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$adcounter++;
}
 
 if($adcounter == 0){
	 
	 //INSERT INTO `smart_light`.`channels` (`id`, `channel`, `value`, `min`, `max`, `visible_name`, `group_id`, `is_switch`, `active`) VALUES (NULL, '123', '0', '0', '255', '[ DEVICE NAME ]', '0', '0', '1');
	 
	 $log_update = mysql_query("INSERT INTO `smart_light`.`scenes` (`id`, `visible_name`, `active`, `show_in_sidebar`, `add_as_home_kit_dev`) VALUES (NULL, '".$_POST['nsc_name']."', '1', '".$_POST['nsc_sis']."', '".$_POST['nsc_aahkd']."');");
	
	 
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Scene added : ".$_POST['nsc_name']."')");
	
echo "Die Scene " .$_POST['nsc_name'] ." wurde  hinzugefügt";
	 
	 }else{
		 echo "Diese Scene existiert schon! Bitte waehle einen anderen Scene-Namen.";
		 }
}else{
echo "Bitte fuelle alle Felder aus";
}



?>