#!/usr/bin/php
<?php

require_once('/home/parth/git/path.inc');
require_once('/home/parth/git/get_host_info.inc');
require_once('/home/parth/git/rabbitMQLib.inc');
#This script creates the tar file
exec('./tar_gen.sh ');
#execute script to make a tar file of database
#exec('./backuptest.sh ');
#exec('./installbundle.sh');
#Increment version number
$mydb = new mysqli('192.168.1.11','user','password','deploy');
if ($mydb->errno != 0){
	echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
	exit(0);
}
#Variables that can be set......
$type = 	readline("Enter Type: ");		#IE.. bundle
$package = 	readline("Enter Package: ");		#IE.. backend
$tier = 	readline("Enter Tier: ");		#IE.. QA
$packageName =	readline("Enter PackageName: ");	#IE.. filename

if ($type == 'rollback'){
	$rollbackVersion = readline("Enter version to rollback to: ");
}



#Starting Version Number
$increment_value = "1";
//get last version number

$query = mysqli_query($mydb, "SELECT * FROM Builds WHERE filename = '$packageName'");
$count = mysqli_num_rows($query);
#If type is bundle do
if ($type == 'bundle'){
	if ($count){
        	#Get last version number
        	$check = mysqli_query($mydb, "SELECT * FROM Builds WHERE filename = '$packageName' ORDER BY (version+0) DESC LIMIT 1");
        	$row = mysqli_fetch_assoc($check);
        	$version = $row['version'];
        	echo "File Already Exists! Creating next version #" . ($version + $increment_value);
	}else{
        	echo "Unknown File! Creating Version #1";
        	$version = "0";
	}
}
#If type is deploy do
if ($type == 'deploy'){
	#Get last version number
	$check = mysqli_query($mydb, "SELECT * FROM Builds WHERE filename = '$packageName' ORDER BY (version+0) DESC LIMIT 1");
	$row = mysqli_fetch_assoc($check);
	$version = $row['version'];
	echo "Deploying " .  $packageName . "-" . $version;
}
if ($type == 'rollback'){
	$check = mysqli_query($mydb, "SELECT * FROM Builds WHERE filename = '$packageName' AND version = '$rollbackVersion'");
	$row = mysqli_fetch_assoc($check);
	if ($row){
		echo "File Found! Rolling back!";
	}
}



$client = new rabbitMQClient("deployclientrabbitMQServer.ini","testServer");
$request = array();
$request['type'] = $type;
$request['package'] = $package;
$request['tier'] = $tier;
$request['packageName'] = $packageName;
if ($type == 'bundle'){
	$request['version'] = $version + $increment_value;
}
if ($type == 'deploy'){
        $request['version'] = $version;
}
if ($type == 'rollback'){
	$request['rollbackversion'] = $rollbackVersion;
}
$response = $client->send_request($request);
//print_r($response);
echo "\n";
#rename the generated tar file
if ($type == 'bundle'){
rename("/home/parth/backups/backup.tgz","/home/parth/backups/".$request['packageName']."-".$request['version'].".tgz");
#This script scps the file, then deletes it
exec('./scp_tar.sh');
}

?>
