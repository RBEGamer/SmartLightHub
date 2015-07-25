<?php



include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

$group_id = "";


if( (isset($_POST['group_id']) && $_POST['group_id'] != "") || (isset($_GET['group_id']) && $_GET['group_id'] != "")){

if(isset($_POST['group_id'])){$group_id = $_POST['group_id'];}

if(isset($_GET['group_id']) ){$group_id = $_GET['group_id'];}


echo "<table width='200px'>";


$fetchinfo_dev1 = mysql_query("SELECT * FROM `devices` WHERE `zone_id`='".$group_id."' AND `active`='1'");
while($row_dev1 = mysql_fetch_array($fetchinfo_dev1)) {
//	$amount_inputs = $row_dev1['amount_inputs'];
echo "<tr><th>";

//DISPLAY IMAGE ICON
$fetchinfo_dev2 = mysql_query("SELECT * FROM `icons` WHERE `id`='".$row_dev1['icon_id']."'");
while($row_dev2 = mysql_fetch_array($fetchinfo_dev2)) {
echo "<img src='../icons/".$row_dev2['path'] ."' alt='".$row_dev2['desc'] ."' width='50px'>";
}

echo "</th><th>";
//DISPLAY NAME
echo $row_dev1['visible_name'];
echo "</th></tr>";





//LOAD CHANNELS
$fetchinfo_dev3 = mysql_query("SELECT * FROM `channels` WHERE `group_id` = '".$row_dev1['id']."' AND  `active`='1'");
while($row_dev3 = mysql_fetch_array($fetchinfo_dev3)) {
echo "<tr>";
echo "<td></td>";
echo "<td></td>";

echo "<td>";

$fetchinfo_dev4 = mysql_query("SELECT * FROM `icons` WHERE `id`='".$row_dev3['icon_id']."' AND `is_color_icon`='1'");
while($row_dev4 = mysql_fetch_array($fetchinfo_dev4)) {
echo "<img src='../icons/".$row_dev4['path'] ."' alt='".$row_dev4['desc'] ."' width='15px'>";
}

echo "<tab indent='30'>";
echo $row_dev3['visible_name'];
echo "</td>";



echo "<td>";


$result = "";
	$io_name = "";
	$io_name = $row_dev3['id'] ."_" .$row_dev3['group_id'] ."_" .$row_dev3['channel'];
	
	$f = $row_dev3['id'];
	$s = $row_dev3['group_id'];
	$t = $row_dev3['channel'];
	$ia = $row_dev3['is_switch'];
	$vmin = $row_dev3['min'];
	$vmax = $row_dev3['max'];
	$function_call = "onChange='test(".$f .",".$s .",".$t .",".$ia .", ". $vmin."," .$vmax .")'";


if($row_dev3['is_switch'] == "1"){
	if($row_dev3['value'] > 0){
		$result = " <input type='checkbox' name='".$io_name ."' id='".$io_name."' ".$function_call." checked>";
		}else{
			$result =  " <input type='checkbox' name='".$io_name ."'  id='".$io_name ."' ".$function_call." >";

			}



	}else{
$result =  "<input type='range' name='".$io_name ."' ".$function_call." value='".$row_dev3['value'] ."' id='".$io_name."' min='".$row_dev3['min']."' max='".$row_dev3['max']."'>";
		}



echo $result;
echo "</td>";




echo "</tr>";
}


}
echo "</table>";
}else{
	echo "Bitte wähle eine gültige Gruppe aus!";
}












?>
