#!/usr/bin/php
<?php
require_once('/home/parth/git/path.inc');
require_once('/home/parth/git/get_host_info.inc');
require_once('/home/parth/git/rabbitMQLib.inc');


#execute script to make a tar file of database
exec('./backuptest.sh ');


#Increment version number
$mydb = new mysqli('192.168.1.184','root','root','IT490');
if ($mydb->errno != 0){
	echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
	exit(0);
}

#Starting Version Number
$increment_value = "1";

//get last version number
$check = mysqli_query($mydb, "SELECT * FROM Builds ORDER BY version DESC LIMIT 1");
$row = mysqli_fetch_assoc($check);
$version = $row['version'];


$client = new rabbitMQClient("deployclientrabbitMQServer.ini","testServer");
$request = array();
$request['type'] = "bundle";
$request['package'] = "BE";
$request['tier'] = "QA";
$request['packageName'] = "backendPackage";
$request['version'] = $version + $increment_value;
$response = $client->send_request($request);
//print_r($response);
echo "\n";
?>
