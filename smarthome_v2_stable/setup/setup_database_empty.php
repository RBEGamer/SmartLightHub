<?php
include('../db_config.php');

// your config



$filename = 'smart_light_database_empty.sql';

$maxRuntime = 10; // less then your max script execution limit



$deadline = time()+$maxRuntime; 
$progressFilename = $filename.'_filepointer'; // tmp file for progress
$errorFilename = $filename.'_error'; // tmp file for erro

mysql_connect($db_host, $db_username, $db_password) OR die('connecting to host: '.$db_host.' failed: '.mysql_error());
mysql_select_db($db_name) OR die('select db: '.$db_name.' failed: '.mysql_error());

($fp = fopen($filename, 'r')) OR die('failed to open file:'.$filename);

// check for previous error
if( file_exists($errorFilename) ){
    die('<pre> previous error: '.file_get_contents($errorFilename));
}

// activate automatic reload in browser
echo '<html><head> <meta http-equiv="refresh" content="'.($maxRuntime+2).'"><pre>';

// go to previous file position
$filePosition = 0;
if( file_exists($progressFilename) ){
    $filePosition = file_get_contents($progressFilename);
    fseek($fp, $filePosition);
}

$queryCount = 0;
$query = '';
while( $deadline>time() AND ($line=fgets($fp, 1024000)) ){
    if(substr($line,0,2)=='--' OR trim($line)=='' ){
        continue;
    }

    $query .= $line;
    if( substr(trim($query),-1)==';' ){
        if( !mysql_query($query) ){
            $error = 'Error performing query \'<strong>' . $query . '\': ' . mysql_error();
            file_put_contents($errorFilename, $error."\n");
            exit;
        }
        $query = '';
        file_put_contents($progressFilename, ftell($fp)); // save the current file position for 
        $queryCount++;
    }
}

if( feof($fp) ){
    echo 'dump successfully restored!';
	header("Location: index.php");
	exit();
}else{
    echo ftell($fp).'/'.filesize($filename).' '.(round(ftell($fp)/filesize($filename), 2)*100).'%'."\n";
    echo $queryCount.' queries processed! please reload or wait for automatic browser refresh!';
}
?>