
<?php



echo "movie search : ";

$search = $_POST["search"];

$moviename = preg_replace('/\s+/', '+',$search);

echo $moviename;

$api = "https://api.themoviedb.org/3/search/movie?api_key=a99025c572bede9218ee420b5c9f4cc4&language=en-US&query=".$moviename."&page=1&include_adult=false";
echo $api;

$response = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=a99025c572bede9218ee420b5c9f4cc4&language=en-US&query=".$moviename."&page=1&include_adult=false");
//$response = json_decode($response);
echo $reponse;

?>

<html>
<head>
<body>
<header>
<a href="javascript:history.back()">Go Back</a> </header>
</body>
</html>
