<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");



echo "<table>";
echo "<tr><th>Node-Name</th> <th>IP</th> <th>Set State</th> <th>Delete</th></tr>";

$fetchinfo_dev = mysql_query("SELECT * FROM `nodes` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	

$form1 = "<form action='delete_node_process.php' method='post'><input type='hidden' name='node_id' id='node_id' value='".$row_dev['id']."' /><input type='submit' value='DELETE NODE' /></form>";


$form0  = "";
if($row_dev['active'] == "1"){
	$form0 = "<form action='disable_node_process.php' method='post'><input type='hidden' name='node_id' id='node_id' value='".$row_dev['id']."' /><input type='submit' value='DISABLE NODE' /></form>";
	}else{
		$form0 = "<form action='enable_node_process.php' method='post'><input type='hidden' name='node_id' id='node_id' value='".$row_dev['id']."' /><input type='submit' value='ENABLE NODE' /></form>";
		}





echo "<tr><td>".$row_dev['visible_name']."</td> <td>".$row_dev['ip'].":".$row_dev['port']." PW:".$row_dev['token']."</td> <td>".$form0 ."</td>  <th>".$form1."</th></tr>";


}

echo "</table>";




?>