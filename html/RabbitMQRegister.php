#!/usr/bin/php
<?php

//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parth/git/rabbitmqphp_example/logging/feLog.txt');
ini_set('log_errors_max_len', 1024);

require_once('/home/parth/git/rabbitmqphp_example/path.inc');
require_once('/home/parth/git/rabbitmqphp_example/get_host_info.inc');
require_once('/home/parth/git/rabbitmqphp_example/rabbitMQLib.inc');

$client = new rabbitMQClient("/home/parth/git/rabbitmqphp_example/RabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Testing Register";
}

$userName = $_POST["input_user"];
$userPass = password_hash($_POST["input_pass"],PASSWORD_DEFAULT);

//$userName = "parth";
//$userPass = "parth";
$request = array();
$request['type'] = "register";
$request['username'] = $userName;
$request['password'] = $userPass;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "Client received respone  ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

if(!$response == true){
	
	header("Location:index.html");

}else{
	header("Location:register.html");
}


?>

