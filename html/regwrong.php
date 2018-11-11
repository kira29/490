<?php


//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parth/git/rabbitmqphp_example/logging/feLog.txt');
ini_set('log_errors_max_len', 1024);

echo "<H2> Username Already Exists!!! </H2>";

echo "\n\n";

echo "<H2> Please Register with different Username!!!!! </H2>";

echo "\n\n";

echo "<H2> Redirecting in 3 seconds..please wait </H2>";
header("Refresh:3; url=register.html");

?>

