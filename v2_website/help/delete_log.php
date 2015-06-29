<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

//DELETE FROM `activity_log` WHERE 1
$update = mysql_query("DELETE FROM `log` WHERE 1");

//LOGGEN
$update = mysql_query("INSERT INTO `smart_light`.`log` (`message`, `can_delete`) VALUES ('CLEAR LOG BY USER', '1');");



?>