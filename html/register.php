
<?php 

//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/home/parth/git/rabbitmqphp_example/logging/feLog.txt');
ini_set('log_errors_max_len', 1024);

?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>
<link href="regcss.css" rel="stylesheet" type="text/css"/>
</head>
<body>



<?php 


?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>

</head>
<body>

<form action="/phpBB3/ucp.php?mode=login" method="post">
    <h3><a href="/phpBB3/ucp.php?mode=login">Login</a>&nbsp; &bull; &nbsp; <a href="/phpBB3/ucp.php?mode=register">Register</a></h3>
    <fieldset>
        <label for="username">Username:</label>&nbsp;
        <input type="text" name="username" id="username" size="10" title="Username" />
        <label for="password">Password:</label>&nbsp;
        <input type="password" name="password" id="password" size="10" title="Password" />
        <input type="submit" name="login" value="Login" />
    </fieldset>
</form>

</body>
</html>
</body>
</html>
