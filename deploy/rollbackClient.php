#!/usr/bin/php
<?php
require_once('/home/parth/git/path.inc');
require_once('/home/parth/git/get_host_info.inc');
require_once('/home/parth/git/rabbitMQLib.inc');

$client = new rabbitMQClient("deployclientrabbitMQServer.ini","testServer");
$request = array();
$request['type'] = "rollback";
$request['package'] = "BE";
$request['tier'] = "QA";
$request['packageName'] = "backendPackage-v";
$response = $client->send_request($request);
//print_r($response);
echo "\n";
?>
