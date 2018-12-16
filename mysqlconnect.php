#!/usr/bin/php
<?php
$ip = "127.0.0.1:3306";
$name = "root";
$password = "root";
$dbname = "IT490";
$mydb =  new mysqli($ip,$name,$password,$dbname);
 
if ($mydb->errno != 0){
	echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
	exit(0);
}
echo "<br><br>Successfully connected to database".PHP_EOL;
$query = mysqli_query($mydb,"INSERT INTO Builds VALUES ('teewet','5')");

?>
