#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$filename = '/home/parth/git/logging/feLog.txt';

//Open dbLog file and append contents to an array
if (file_exists($filename)){
	echo "This file $filename exists"."<br>";
	$file = fopen("/home/parth/git/logging/feLog.txt","r");
	$errorArray = [];

while(! feof($file)){
        array_push($errorArray, fgets($file));
}

fclose($file);
//Change ['type'] based on what server this client code is running on
$request = array();
$request['type'] = "frontend";
$request['error_string'] = $errorArray;
$returnedValue = createClientForRmq($request);
//Append contents to a history file that will not be deleted after sending
$fp = fopen("/home/parth/git/logging/feLog.txt", "a");
for($i = 0; $i < count($errorArray); $i++){
        fwrite($fp, $errorArray[$i]);
}
file_put_contents("/home/roydem/database/logging/dbLog.txt", "");
//If file to append to does not exists, create one
} else {
	echo "<br><br>The file $filename does not exist. Creating now.";
	$create = fopen($filename, 'w') or die ('Cannot create file');
}
//RMQ client function
//Uses error.ini that is strictly used for error logging
function createClientForRmq($request){
        $client = new rabbitMQClient("RabbitMQError.ini", "testServer");
       
        if(isset($argv[1])){
            $msg = $argv[1];
        }
        else{
            $msg = "Error Logging";
        }
        $response = $client->send_request($request);
        return $response;
}
    
    
?>
