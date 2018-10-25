<?php

session_start();

//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parth/git/rabbitmqphp_example/logging/feLog.txt');
ini_set('log_errors_max_len', 1024);

echo "Login Success";

echo '<h2>Welcome '.$_SESSION["username"].'</h2';


?>


<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
</head>
<body>
<form method="POST">





			</form>


   <p><a href="logout.php">Logout</a></p>

</body>
</html>
