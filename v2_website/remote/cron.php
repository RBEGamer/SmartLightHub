<?php
include('../db_config.php');
include('socket.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
//----------------- SCHEDULE LIST --------------------------------
*/




echo "cron_time:" . date("H:i");
$fetchinfo_dev112 = mysql_query("SELECT * FROM `schedule` WHERE `active`='1' AND `toggle_time`='".date("H:i")."'");
while($row_dev112 = mysql_fetch_array($fetchinfo_dev112)) {



if((date("l") == "Monday" && $row_dev112['monday'] == "1") || (date("l") == "Tuesday" && $row_dev112['tuesday'] == "1") || (date("l") == "Wednesday" && $row_dev112['wednesday'] == "1") || (date("l") == "Thursday" && $row_dev112['thursday'] == "1") || (date("l") == "Friday" && $row_dev112['friday'] == "1") || (date("l") == "Saturday" && $row_dev112['saturday'] == "1") || (date("l") == "Sunday" && $row_dev112['sunday'] == "1") ){
	

echo "toggled scene : " .$row_dev112['scene_to_toggle'];

$fetchinfo_dev11 = mysql_query("SELECT * FROM `scene_states` WHERE `scene_id`='".$row_dev112['scene_to_toggle']."'");
while($row_dev11 = mysql_fetch_array($fetchinfo_dev11)) {
$log_update = mysql_query("UPDATE `channels` SET `value`='".$row_dev11['channel_value']."' WHERE `id`='".$row_dev11['channel_id']."'");

}
}




}


	send_data();



























?>