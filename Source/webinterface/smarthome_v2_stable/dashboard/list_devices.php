<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

$result = "<select name='device_list' id='device_list'>";
$fetchinfo_dev = mysql_query("SELECT * FROM `devices` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	 $result = $result ." <option value='".$row_dev['id']."'>".$row_dev['visible_name']."</option>";
//	 $result = $result ."<tr><td>".$counter."</td><td>".$row_dev['id']."</td><td><input type='checkbox' name='device_token_id[]' value='" .$row_dev['id'] ."'  checked/> ".$row_dev['device_model']." </td></tr>";
}
$result = $result ."</select>";
echo $result;
?>