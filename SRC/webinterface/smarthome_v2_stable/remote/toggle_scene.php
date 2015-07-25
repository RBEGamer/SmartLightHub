<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


/*
//device_list
*/

if(isset($_GET['scene'])){
	
	
	
		







$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Toggle Scene: ".$_GET['scene']." BY REMOTE')");



$fetchinfo_dev11 = mysql_query("SELECT * FROM `scene_states` WHERE `scene_id`='".$_GET['scene']."'");
while($row_dev11 = mysql_fetch_array($fetchinfo_dev11)) {
$log_update = mysql_query("UPDATE `channels` SET `value`='".$row_dev11['channel_value']."' WHERE `id`='".$row_dev11['channel_id']."'");

}


$fetchinfo_dev10 = mysql_query("SELECT * FROM `channels` WHERE 1");
while($row_dev10 = mysql_fetch_array($fetchinfo_dev10)) {

 $channel = $row_dev10['channel'];
$value = $row_dev10['value'];


$fetchinfo_dev = mysql_query("SELECT * FROM `nodes` WHERE `active`='1'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$ip = $row_dev['ip'];
$port = $row_dev['port'];
$token = $row_dev['token'];

/*
$fetchinfo_dev1 = mysql_query("SELECT * FROM `channels` WHERE `active`='1'");
while($row_dev1 = mysql_fetch_array($fetchinfo_dev1)) {
	$channel = $row_dev1['channel'];
	$value = $row_dev1['value'];
	$device_id = $row_dev1['group_id'];
*/	
$request_message = "<pin output='".$channel."' value='".$value."' token='".$token."'></pin>";
	
	//$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$ip."')");
	send_data($ip, $port, $request_message);


}

}











}














function send_data($_remote_ip, $_remote_port, $_message){


if ( preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/', $_remote_ip) ) {
 //  echo 'IP ist gültig.';
}else{
	$_remote_ip = gethostbyname($_remote_ip);
}





	if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode); 
    die("Couldn't create socket: [$errorcode] $errormsg \n");
   
	
	$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$errormsg."')");

}
 
echo "Socket created \n";
 
//Connect socket to remote server
if(!socket_connect($sock , $_remote_ip , $_remote_port))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);  
    die("Could not connect: [$errorcode] $errormsg \n");
    $log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$errormsg."')");
}
 
echo "Connection established \n";
 
//Send the message to the server
if( ! socket_send ( $sock , $_message , strlen($_message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);     
    die("Could not send data: [$errorcode] $errormsg \n");
  $log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$errormsg."')");

}
echo "Message send successfully \n";

	 
//$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$_remote_ip."')");


}

?>