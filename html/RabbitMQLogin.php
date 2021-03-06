#!/usr/bin/php
<?php
session_start();

//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parth/git/rabbitmqphp_example/logging/feLog.txt');
ini_set('log_errors_max_len', 1024);

require_once('/home/parth/git/path.inc');
require_once('/home/parth/git//get_host_info.inc');
require_once('/home/parth/git/rabbitMQLib.inc');

$client = new rabbitMQClient("/home/parth/git/RabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Login Request";
}


$userName = $_POST["input_username"];
$userPass = $_POST["input_password"];

$request = array();
$request['type'] = "login";
$request['username'] = $userName;
$request['password'] = $userPass;
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "Client received respone  ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;


if($response == 1){
	$_SESSION["username"] = $_POST["input_username"];
	header("Location:loginsuccess.php");
}else{
	header("Location:wronguser.html");
}

?>
