#!/usr/bin/php
<?php

require_once('/home/parth/git/path.inc');
require_once('/home/parth/git/get_host_info.inc');
require_once('/home/parth/git/rabbitMQLib.inc');

function doRollback ($type,$package,$tier,$packageName){

        echo "Rollback Request received" . PHP_EOL;
        echo "TYPE: " . $type . PHP_EOL;
        echo "PACKAGE: " . $package . PHP_EOL;
        echo "TIER: " . $tier . PHP_EOL;
        echo "PACKAGE NAME: " . $packageName . PHP_EOL;

	

}


function doUpdate ($type,$package,$tier,$packageName){

        echo "Update Request received" . PHP_EOL;
        echo "TYPE: " . $type . PHP_EOL;
        echo "PACKAGE: " . $package . PHP_EOL;
        echo "TIER: " . $tier . PHP_EOL;
        echo "PACKAGE NAME: " . $packageName . PHP_EOL;


}

function doDeploy ($type,$package,$tier,$packageName){

	echo "Deploy Request received" . PHP_EOL;
	echo "TYPE: " . $type . PHP_EOL;
	echo "PACKAGE: " . $package . PHP_EOL;
	echo "TIER: " . $tier . PHP_EOL;
	echo "PACKAGE NAME: " . $packageName . PHP_EOL;

	echo "Installing " . $packageName . " on " . $tier ." " . $package;
	# execute shell script to install backend package

}


function doBundle ($type,$package,$tier,$packageName,$version){

        echo "Bundle Request received" . PHP_EOL;
        echo "TYPE: " . $type . PHP_EOL;
        echo "PACKAGE: " . $package . PHP_EOL;
        echo "TIER: " . $tier . PHP_EOL;
        echo "PACKAGE NAME: " . $packageName . PHP_EOL;

	echo "SCP INITIATED... ";
	echo "TAR FILE RECEIVED!";

	$mydb = new mysqli('127.0.0.1','root','root','IT490');

        if ($mydb->errno != 0){

                echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
                exit(0);
        }


	$query = mysqli_query($mydb, "INSERT INTO Builds VALUES('$packageName','$version')");

}


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "rollback":
      return doRollback($request['type'],$request['package'],$request['tier'],$request['packageName']);
    case "update":
      return doUpdate($request['type'],$request['package'],$request['tier'],$request['packageName']);
    case "deploy":
      return doDeploy($request['type'],$request['package'],$request['tier'],$request['packageName']);
    case "bundle":
      return doBundle($request['type'],$request['package'],$request['tier'],$request['packageName'],$request['version']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}



$server = new rabbitMQServer("deployrabbitMQServer.ini","testServer");

echo "DeploySystem Server BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "DeploySystem Server END".PHP_EOL;
exit();
?>

