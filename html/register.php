
<?php 
if(isset($_POST["signup"]))  
      {  
	header("location:index.html");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>
<link href="regcss.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<iframe width="0" height="0" src="https://www.youtube.com/embed/DolWl-MqVGA?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<div class="main">
<h2 class="sub-head">Sign Up</h2>
<div class="sub-main">
<form method="POST" action="RabbitMQRegister.php">

   
    <input type="text" name="input_user" placeholder="Username" required/>
    <input type="password" name="input_pass" placeholder="Password" required />
    
    <input type="submit" name="signup" value="Sign up">
  

			</form>
		</div>
		
</div>

</body>
</html>
