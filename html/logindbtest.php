<?php
$host="localhost";
$db_username="root";
$db_password="test";
$db_name="test";
$table="Users";
$conn = mysql_connect("$host", "$db_username", "$db_password") or die ("cannot connect");
mysql_select_db("$db_name") or die("cannot select db");
$username=$_POST['username'];
$pass=$_POST['password'];
$username = stripslashes($username); 
$pass = stripslashes($pass);
$username = mysql_real_escape_string($username);
$pass = mysql_real_escape_string($pass);
$sql = "select * from $table where username='$username' AND password='$pass'";
$result=mysql_query($sql,$conn);
$count=mysqli_num_rows($result);

echo "TEST";
if ($count ==1 )
{
	echo "Login Success";
}
else
{
	echo "Fail";
}

?>
