<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

if(isset($_POST['device_id']) && $_POST['device_id'] != ""){

echo "<table>";
echo "<tr><th>Channel-Name</th> <th>Channel</th> <th>INFO</th> <th>DELETE</th></tr>";

$fetchinfo_dev = mysql_query("SELECT * FROM `channels` WHERE `group_id`='".$_POST['device_id'] ."'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	

$form = "<form action='delete_channel_process.php' method='post'><input type='hidden' name='ch_id' id='ch_id' value='".$row_dev['id']."' /><input type='submit' value='DELETE CHANNEL' /></form>";


echo "<tr><td>".$row_dev['visible_name']."</td> <td>".$row_dev['channel']."</td> <td>Value:".$row_dev['value']." Min:".$row_dev['min']." Max: ".$row_dev['max']." Is switch: ".$row_dev['is_switch']."</td>  <th>".$form."</th></tr>";
}

echo "</table>";

}else{
echo "<tr><td>&nbsp </td> <td> DEVICE UNGUELTIG</td></tr>";
}


?>