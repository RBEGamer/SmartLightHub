<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");



echo "<table>";
echo "<tr><th>Scene Name</th> <th>INFO</th> <th>DELETE</th> <th>CAPTURE</th><th>TOGGLE SCENE</th></tr>";

$fetchinfo_dev = mysql_query("SELECT * FROM `scenes` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	

$form = "<form action='delete_scene_process.php' method='post'><input type='hidden' name='scene_id' id='scene_id' value='".$row_dev['id']."' /><input type='submit' value='DELETE SCENE' /></form>";

$form1 = "<form action='capture_scene_process.php' method='post'><input type='hidden' name='scene_id' id='scene_id' value='".$row_dev['id']."' /><input type='submit' value='CAPTURE VALUES TO SCENE' /></form>";

$form2 = "<form action='toggle_scene_process.php' method='post'><input type='hidden' name='scene_id' id='scene_id' value='".$row_dev['id']."' /><input type='submit' value='TOGGLE SCENE' /></form>";

echo "<tr><td>".$row_dev['visible_name']."</td> <td>IS A HOMEKIT DEVICE : ".$row_dev['add_as_home_kit_dev']."</td> <th>".$form."</th><th>".$form1."</th><th>".$form2."</th></tr>";
}

echo "</table>";




?>