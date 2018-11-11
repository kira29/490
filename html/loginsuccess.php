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
  
  <p>Welcome to Movie Buddies!!</p>
<p>Search for any Movie/TV Shows in the search bar below for movie-related forum.</p>
    
 <form method="POST" action="">
      <input type="text" name="search" placeholder="Type Title Here" required>
      <button type="submit">Search</button>
    </form>




<table class="table table-bordered">
 <thead>
 <tr>
 <th>Movie Title</th>
 <th>Poster</th>
 <th>Release Date</th>
<th>Forums</th>
 </tr>
 </thead>
 <tbody>
 <tr>


<?php

//Search input from hmtl
$search_input = $_POST['search'];
//Username obtained from user login using post
//$username = $username ; //not set up atm
echo nl2br("\n ");

if (isset($_POST['search']) && !empty($_POST['search'])){

	$searchname = preg_replace('/\s+/', '+',$search_input);
	//API MULTI SEARCH ( MOVIES AND SHOWS)
        $ch = curl_init("https://api.themoviedb.org/3/search/multi?api_key=a99025c572bede9218ee420b5c9f4cc4&language=en-US&query=" . $searchname . "&page=1&include_adult=false");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	//Set results to var
	$curl_results = curl_exec($ch);
        curl_close($ch);

}
$jsonarray = json_decode($curl_results, true); //convert json into multidimensional associative array
//Iterate through the array 'results' and assign a variable to each type that we want

foreach($jsonarray['results'] as $variable){
      
	$title = $variable['title'];
        if (is_null($title)){
             $title = $title ."Title not found";
        }
      
        echo"<td>".$title."</td>"; 
	
	$releasedate =  $variable['release_date'];
        if (is_null($releasedate)){
                $releasedate = $releasedate . "Release date not found";
        }

        $posterpath = $variable['poster_path'];
        if (is_null($posterpath)){
                $posterpath = $posterpath . "Poster not found";
        }

	//Get image path and base64 encode it so that it may be displayed
	$image = 'https://image.tmdb.org/t/p/w300' . $posterpath;
	$imagedata = base64_encode(file_get_contents($image));
	//Display image	

	$linkImage =" <img src=\"".$image."\">";


	echo"<td>".$linkImage."</td>";
	echo"<td>".$releasedate."</td>";
	echo"<td>Click here to add a forum for movie</td>";
//	echo nl2br("\n\n");

	
	echo "</tr>";


		
             

}
?>

</table>
</div>
</body>
</html>


