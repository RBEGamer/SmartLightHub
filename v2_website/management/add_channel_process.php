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


if(isset($_POST['nch_name']) && $_POST['nch_name'] != "" && isset($_POST['nch_ch']) && $_POST['nch_ch'] != ""&& isset($_POST['nch_is']) && $_POST['nch_is'] != "" && isset($_POST['nch_min']) && $_POST['nch_min'] != "" && isset($_POST['nch_max']) && $_POST['nch_max'] != "" && isset($_POST['nch_device']) && $_POST['nch_device'] != "" && $_POST['nch_icon'] != "" && isset($_POST['nch_icon'])){

  $adcounter = 0;
 $fetchinfo_dev = mysql_query("SELECT * FROM `channels` WHERE `channel`='".$_POST['nch_ch']."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$adcounter++;
}
 
 if($adcounter == 0){
	 
	 //INSERT INTO `smart_light`.`channels` (`id`, `channel`, `value`, `min`, `max`, `visible_name`, `group_id`, `is_switch`, `active`) VALUES (NULL, '123', '0', '0', '255', '[ DEVICE NAME ]', '0', '0', '1');
	 
	 $log_update = mysql_query("INSERT INTO `smart_light`.`channels` (`id`, `channel`, `value`, `min`, `max`, `visible_name`, `group_id`, `is_switch`, `active`, `icon_id`) VALUES (NULL, '".$_POST['nch_ch']."', '0', '".$_POST['nch_min']."', '".$_POST['nch_max']."', '".$_POST['nch_name']."', '".$_POST['nch_device']."', '".$_POST['nch_is']."', '1', '".$_POST['nch_icon']."');");
	
	 
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Channel added : ".$_POST['nch_name']."')");
	
echo "Der Channel " .$_POST['nch_name'] ." wurde zu dem Device[".$_POST['nch_device']."] hinzugefügt";
	 
	 }else{
		 echo "Dieser Channel existiert schon! Bitte waehle einen anderen Channel.";
		 }
}else{
echo "Bitte fuelle alle Felder aus";
}



?>