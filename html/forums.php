<?php

session_start();

//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parth/git/rabbitmqphp_example/logging/feLog.txt');
ini_set('log_errors_max_len', 1024);

$username = $_SESSION["username"];


?>


<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.navbar, .navbar-bar {
  
  color: white;
padding-bottom : 1px;
padding-top : 1px;

}

.container {

	padding-top: 60px;
padding-right : 50px;
}

</style>
</head>
<body>
   <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      
      <a class="navbar-brand">Hi <?= $username?></a>
       <a class="navbar-brand"> Kehoes Bros </a>
    
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="loginsuccess.php">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="forums.php">Forums</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      
    </nav>
           

<div class="container">
  
  <p>Welcome to Forums</p>



</div>
</body>
</html>

