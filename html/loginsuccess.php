<?php

session_start();

//ERROR LOGGING
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
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
  
<p>Search for any Movie/TV Shows & Visit forums about the Movie/TV Show.</p>
    
 <form method="POST" action="">
      <input type="text" name="search" placeholder="Type Title Here" required>
      <button type="submit">Search</button>
    </form>




<table class="table table-bordered">
 <thead>
 <tr>
 <th>Movie Info</th>
 <th>Movie Poster</th>
 <th>Recommended Movies</th>
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
	  $movieid = $variable['id'];    
	$title = $variable['title'];
        if (is_null($title)){
             $title = $title ."Title not found";
	}

	$releasedate =  $variable['release_date'];
        if (is_null($releasedate)){
                $releasedate = $releasedate . "Release date not found";
	}

	$synopsis = $variable['overview'];

	$vote = $variable['vote_count'];


	echo '<td><a button name = "' .$title.'" onclick ="getText(this)" id = "'.$movieid.'" href = "forumstest.php" >  '. $title . ' </a>
	
	<br><strong> Release Date :</strong> '.$releasedate.' <br>

<strong>	Synopsis :</strong> '.$synopsis.' <br>
<strong>		Votes :</strong> '.$vote.' <br>



<br>
		
		</td>';
	
        //echo"<td>".$title."</td>"; 
	//echo '<td><a id = "anchorID" href="forumstest.php">  '. $title . '</td> </a>';
	$_SESSION['title'] = $title;
	

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
	
	
	
	
        $ch2 = curl_init("https://api.themoviedb.org/3/movie/".$movieid."/recommendations?api_key=a99025c572bede9218ee420b5c9f4cc4&language=en-US&page=1");
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
        //Set results to var
        $curl_results2 = curl_exec($ch2);
        curl_close($ch2);
	$jsonarray2 = json_decode($curl_results2, true);
echo "<td>";
	$i = 0;
	//Show max of 4 movies
	foreach($jsonarray2['results'] as $variable2){
		
		if ($i++ > 3) break;
	$recommend =  $variable2['title'];
        	if (is_null($recommend)){
                	$recommend = $recommend . 'NULL';
		}
	$posterpath2 = $variable2['poster_path'];
        	if (is_null($posterpath2)){
                	$posterpath2 = $posterpath2 . 'NULL';
		}
	$image2 = 'https://image.tmdb.org/t/p/w92' . $posterpath2;
        	$imagedata2 = base64_encode(file_get_contents($image2));	
	
	echo "".$recommend."<br> <img src =".$image2."> <br>";
		
	}
echo "</td>";
//	echo nl2br("\n\n");

	
	echo "</tr>";

}


      		
     
?>

</table>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
//Get text from whatever link that is clicked and set a cookie so it may be passed to forumtest.php
function getText(obj){
	var t = $(obj).text();
	document.cookie = "title="+t;
	console.info(t);	
}
</script>



<script id="cid0020000203039478046" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 400px;height: 400px;">{"handle":"moviebuddychatroom","arch":"js","styles":{"a":"33cc00","b":100,"c":"FFFFFF","d":"FFFFFF","k":"33cc00","l":"33cc00","m":"33cc00","n":"FFFFFF","p":"10","q":"33cc00","r":100,"pos":"br","cv":1,"cvbg":"33cc00","cvw":75,"cvh":30}}</script>
