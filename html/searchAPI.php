#!/usr/bin/php
<?php
//Search input from hmtl
$search_input = $_POST['search'];
//Username obtained from user login using post
$username = 'username'; //not set up atm
echo nl2br("\n\n ");
echo nl2br("WELCOME TO MOVIE BUDDY\n\n");
if (isset($_POST['search']) && !empty($_POST['search'])){
  	    	
	$searchname = preg_replace('/\s+/', '+',$search_input);
	//API MULTI SEARCH ( MOVIES AND SHOWS)
        $ch = curl_init("https://api.themoviedb.org/3/search/multi?api_key=a99025c572bede9218ee420b5c9f4cc4&language=en-US&query=" . $searchname . "&page=1&include_adult=false");	
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	//Set results to var
	$curl_results = curl_exec($ch);
        curl_close($ch);
}else{
	echo nl2br("Why are you here then?\n");
	exit();
	
}
$jsonarray = json_decode($curl_results, true); //convert json into multidimensional associative array 
//Iterate through the array 'results' and assign a variable to each type that we want
foreach($jsonarray['results'] as $variable){
        $title = $variable['title'];
        if (is_null($title)){
                $title = $title . 'NULL';
        }
        //echo nl2br('TITLE: ' . $title . "\n");
echo '<a id = "anchorID" href="forumtest.php">  '. $title . ' </a>';	
        $overview =  $variable['overview'];
        if (is_null($overview)){
                $overview = $overview . 'NULL';
        }
        echo nl2br('OVERVIEW: ' . $overview . "\n");
        $releasedate =  $variable['release_date'];
        if (is_null($releasedate)){
                $releasedate = $releasedate . 'NULL';
        }
        echo nl2br('RELEASE DATE: ' . $releasedate . "\n");
        $posterpath = $variable['poster_path'];
        if (is_null($posterpath)){
                $posterpath = $posterpath . 'NULL';
        }
	//echo nl2br('POSTER PATH: ' . 'https://image.tmdb.org/t/p/w500' . $posterpath . "\n\n");
	//Get image path and base64 encode it so that it may be displayed
	$image = 'https://image.tmdb.org/t/p/w500' . $posterpath;
	$imagedata = base64_encode(file_get_contents($image));
	//Display image
	echo "<img src=\"".$image."\">";
	echo nl2br("\n\n");
        echo nl2br("- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n");
}
?>


<script type="text/javascript">
var username = <?php echo(json_encode($username)); ?>;
var Tawk_API=Tawk_API||{};
Tawk_API.visitor = {
name : username
};
Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5be5bb4f0e6b3311cb789c94/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

<html>
<head>
<body>
<header>
<a href="javascript:history.back()">Go Back</a> </header>
</body>
</html>
