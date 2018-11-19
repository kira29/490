<?php
session_Start();
$mydb = new mysqli('192.168.1.4','newuser','4321password','myforum');
if ($mydb->errno != 0){
        echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
        exit(0);
}
//Javascript get hyperlink name for title in new post....WIP
//$topictest "<script>document.write(myAnchor);</script>";
if(isset($_COOKIE['title'])){
	$topic = $_COOKIE['title'];
}


//$topic = $_SESSION["title"]; //how to get this to change?
$detail = 'Discuss this movie!';
$username = $_SESSION["username"];
$datetime = date("d/m/y h:i:s"); //create date time
$check = mysqli_query($mydb, "SELECT * FROM fquestions WHERE topic = '$topic'");
$count = mysqli_num_rows($check);
if ($count == 1){
	//There is already a post
	echo "<br><br> A forum board already exists! Redirecting you!";
	header("Location: forums.php");/* Redirect browser */
	sleep(5);
	exit();
}else{
	//Create a topic post 
	$query = mysqli_query($mydb,"INSERT INTO fquestions (topic, detail, name, datetime) VALUES ('$topic', '$detail', '$username', '$datetime')");
	echo "<br><br> It appears you are the first to visit this page! Creating a forum post and redirecting you!";
	header("Location: forums.php");/* Redirect browser */
	sleep(5);
	exit();
}
exit();
?>
