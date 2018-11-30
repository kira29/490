#!/usr/bin/php
<?php

require_once('/home/parth/git/path.inc');
require_once('/home/parth/git/get_host_info.inc');
require_once('/home/parth/git/rabbitMQLib.inc');
echo "Enter info for deployment";
echo "\n";
#Variables that can be set......
#$type = 	readline("Enter Type: ");		#IE.. bundle
$package = 	readline("Enter Package: ");		#IE.. backend
$tier = 	readline("Enter Tier: ");		#IE.. QA
$packageName =	readline("Enter PackageName: ");	#IE.. filename
$version = 	readline("Enter Version: ");		#IE.. 2


$client = new rabbitMQClient("deployclientrabbitMQServer.ini","testServer");
$request = array();
$request['type'] = "deploy";
$request['package'] = $package;
$request['tier'] = $tier;
$request['packageName'] = $packageName;
$request['version'] = $version;
$response = $client->send_request($request);
//print_r($response);
echo "\n";
?>
