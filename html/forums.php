<?php

session_start();

//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parth/git/rabbitmqphp_example/logging/feLog.txt');
ini_set('log_errors_max_len', 1024);

$username = $_SESSION["username"];
$mydb = new mysqli('192.168.1.4','newuser','4321password','myforum');
if ($mydb->errno != 0){
	echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
	exit(0);
}
$query = mysqli_query($mydb,"SELECT * FROM fquestions ORDER BY id ASC");



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
          <div class="mx-auto order-0">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    
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
  
 <h2> <p>Welcome to Forums</p> </h2>

<table width="90%" border="1" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
</tr>

<?php
// Start looping table row
while($rows = mysqli_fetch_array($query)){
?>
<tr>
<td bgcolor="#FFFFFF"><?php echo $rows['id']; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['topic']; ?></a><BR></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['view']; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['reply']; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['datetime']; ?></td>
</tr>

<?php
// Exit looping and close connection
}
mysqli_close();
?>

<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="new_topic.php"><strong>Create New Topic</strong> </a></td>
</tr>
</table>

</div>
</body>
</html>

