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


if(isset($_POST['sch_name']) && $_POST['sch_name'] != "" && isset($_POST['scene_list']) && $_POST['scene_list'] != "" && isset($_POST['sch_time']) && $_POST['sch_time'] != ""  && isset($_POST['sch_mon']) && $_POST['sch_mon'] != "" && isset($_POST['sch_tue']) && $_POST['sch_tue'] != "" && isset($_POST['sch_wed']) && $_POST['sch_wed'] != ""  && isset($_POST['sch_thu']) && $_POST['sch_thu'] != "" && isset($_POST['sch_fri']) && $_POST['sch_fri'] != "" && isset($_POST['sch_sat']) && $_POST['sch_sat'] != "" && isset($_POST['sch_sun']) && $_POST['sch_sun'] != "" ){

  $adcounter = 0;

 $fetchinfo_dev = mysql_query("SELECT * FROM `schedule` WHERE `time_to_toggle`='".$_POST['sch_time']."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$adcounter++;
}
 
 if($adcounter == 0){
	 

	 $log_update = mysql_query("INSERT INTO `smart_light`.`schedule` (`id`, `visible_name`, `toggle_time`, `scene_to_toggle`, `active`, `toggled`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) VALUES (NULL, '".$_POST['sch_name']."', '".$_POST['sch_time']."', '".$_POST['scene_list']."', '1', '0', '".$_POST['sch_mon']."', '".$_POST['sch_tue']."', '".$_POST['sch_wed']."', '".$_POST['sch_thu']."', '".$_POST['sch_fri']."', '".$_POST['sch_sat']."', '".$_POST['sch_sun']."');");
	
	 
$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Schedule added : ".$_POST['sch_name']."')");
	
echo "Die Schedule " .$_POST['sch_name'] ." wurde hinzugefügt";
	 
	 }else{
		 echo "Ein Task mit dieser Uhzeit existert bereits. Bitt waehle eine andere Uhrzeit";
		 }
}else{
echo "Bitte fuelle alle Felder aus";
}



?>