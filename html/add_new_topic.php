<?php
session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);
$mydb = new mysqli('127.0.0.1','root','root','IT490');
if ($mydb->errno != 0){
        echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
        exit(0);
}
$username = $_SESSION["username"];
// get data that sent from form 
$topic = $_POST['topic'];
$detail = $_POST['detail'];
$name = $username;
$datetime = date("d/m/y h:i:s"); //create date time
echo $topic;
echo "<br><br>";
echo $detail;
echo "<br><br>";
echo $name;
echo "<br><br>";
echo $name;
echo "<br><br>";
echo $datetime;
$query = mysqli_query($mydb,"INSERT INTO fquestions (topic, detail, name, datetime) VALUES ('$topic', '$detail', '$name','$datetime')");
if($query){
echo "Successful<BR>";
echo "<a href=forums.php>View your topic</a>";
}
else {
echo "ERROR";
}
?>
