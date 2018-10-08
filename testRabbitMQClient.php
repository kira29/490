#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQDB.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Hello!";
}

$request = array();
$request['type'] = "Login";
$request['username'] = "$input_username";
$request['password'] = "$input_password";
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "Client received respone  ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

