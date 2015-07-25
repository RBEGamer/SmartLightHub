<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

$result = "<select name='device_list' id='device_list' onChange='refresh_table()'>";
$fetchinfo_dev = mysql_query("SELECT * FROM `devices` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	
$fetchinfo_dev1 = mysql_query("SELECT * FROM `zones` WHERE `id`='".$row_dev['zone_id']."'");
while($row_dev1 = mysql_fetch_array($fetchinfo_dev1)) {	
	
	
$result = $result ." <option value='".$row_dev['id']."'>".$row_dev1['visible_name'] ." -> ".$row_dev['visible_name']."</option>";
}
}
$result = $result ."</select>";
echo $result;
?>