<?php
function send_data(){
	
	
include('../db_config.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

	
	
$fetchinfo_dev = mysql_query("SELECT * FROM `nodes` WHERE `active`='1'");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$_remote_ip = $row_dev['ip'];
 $_remote_port = $row_dev['port'];
$token = $row_dev['token'];

	

	
	







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
 

 
//Connect socket to remote server
if(!socket_connect($sock , $_remote_ip , $_remote_port))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);  
    die("Could not connect: [$errorcode] $errormsg \n");
    $log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$errormsg."')");
}
 

 
 
 
 
 $fetchinfo_dev10 = mysql_query("SELECT * FROM `channels` WHERE 1");
while($row_dev10 = mysql_fetch_array($fetchinfo_dev10)) {

	
$request_message = "<pin output='".$row_dev10['channel']."' value='".$row_dev10['value']."' token='".$token."'></pin>";
	echo $request_message;
	//Send the message to the server
	
	
	
if( ! socket_send ( $sock , $request_message , strlen($request_message) , 0))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);     
    die("Could not send data: [$errorcode] $errormsg \n");
  $log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$errormsg."')");

}
usleep(30000);

}
 
socket_close($sock);
//$log_update = mysql_query("INSERT INTO `log`(`message`) VALUES ('".$_remote_ip."')");

}
}
?>