<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");



echo "<table>";
echo "<tr><th>Schedule Name</th> <th>TOGGLE TIME</th> <th>SCENE TO TOGGLE</th> <th>ACTIVE DAYS</th> <th>DELETE</th> <th>ENABLE / DISABLE</th> <th></th> </tr>";

$fetchinfo_dev = mysql_query("SELECT * FROM `schedule` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	

$form = "<form action='delete_schedule_process.php' method='post'><input type='hidden' name='schedule_id' id='schedule_id' value='".$row_dev['id']."' /><input type='submit' value='DELETE SCHEDULE' /></form>";



$form_day = "";

if($row_dev['monday'] == "1"){$form_day = $form_day ."Monday, ";}
if($row_dev['tuesday'] == "1"){$form_day = $form_day ."Tuesday, ";}
if($row_dev['wednesday'] == "1"){$form_day = $form_day ."Wednesday, ";}
if($row_dev['thursday'] == "1"){$form_day = $form_day ."Thursday, ";}
if($row_dev['friday'] == "1"){$form_day = $form_day ."Friday, ";}
if($row_dev['saturday'] == "1"){$form_day = $form_day ."Saturday, ";}
if($row_dev['sunday'] == "1"){$form_day = $form_day ."Sunday";}




$form0  = "";
if($row_dev['active'] == "1"){
	$form0 = "<form action='disable_schedule_process.php' method='post'><input type='hidden' name='schedule_id' id='schedule_id' value='".$row_dev['id']."' /><input type='submit' value='DISABLE SCHEDULE' /></form>";
	}else{
		$form0 = "<form action='enable_schedule_process.php' method='post'><input type='hidden' name='schedule_id' id='schedule_id' value='".$row_dev['id']."' /><input type='submit' value='ENABLE SCHEDULE' /></form>";
		}
		
		
//
$form_scene = "";
$fetchinfo_dev0 = mysql_query("SELECT * FROM `scenes` WHERE `id`='".$row_dev['scene_to_toggle']."'");
while($row_dev0 = mysql_fetch_array($fetchinfo_dev0)) {
	$form_scene = $form_scene .$row_dev0['visible_name'];
}
echo "<tr><td>".$row_dev['visible_name']."</td> <td>".$row_dev['toggle_time']."</td> <td>".$form_scene."</td> <td>".$form_day."</td> <th>".$form."</th> <th>".$form0."</th> <th></th> </tr>";
}

echo "</table>";




?>