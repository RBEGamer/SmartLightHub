<?php
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");



function refresh_nodes(){


$fetchinfo_dev1 = mysql_query("SELECT * FROM `nodes` WHERE 1");
while($row_dev1 = mysql_fetch_array($fetchinfo_dev1)) {	


$$remote_ip = $row_dev1['ip'];
$remote_port = $row_dev1['port'];
$remote_password = $row_dev1['sec_token'];



$fetchinfo_dev = mysql_query("SELECT * FROM `channels` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {	
	$channel = $row_dev['channel'];
	$value = $row_dev['value'];
	$device_id = $row_dev['group_id'];
 
$message = "";	
$message = $message  ."<device>";
$message = $message  ."<config pass='".$remote_password."'></config>";
$message = $message ."<pin channel='" .$channel ."' value='".$value ."' pass='".$remote_password."' device='".$device_id."'></pin>";
$message = $message ."</device>";	

$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES (socket)");

send_data($remote_ip, $remote_port, $message);
}
}

}//ende function
















 





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
    $update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Couldn't create socket: ".$errorcode." -> ".$errormsg." \n')");
}
 
echo "Socket created \n";
 
//Connect socket to remote server
if(!socket_connect($sock , $_remote_ip , $_remote_port))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);  
    die("Could not connect: [$errorcode] $errormsg \n");
    $update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Could not connect: ".$errorcode." -> ".$errormsg." \n')");
}
 
echo "Connection established \n";
 
//Send the message to the server
if( ! socket_send ( $sock , $_message , strlen($_message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);     
    die("Could not send data: [$errorcode] $errormsg \n");
    $update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Could not send data to Deivce (IP:".$_remote_ip.":".$_remote_port."): ".$errorcode." -> ".$errormsg." \n')");

}
echo "Message send successfully \n";

	 
$update = mysql_query("INSERT INTO `log`(`message`) VALUES ('Send data to Device (IP:".$_remote_ip.":".$_remote_port.")" .$_message. "')");

}




?>