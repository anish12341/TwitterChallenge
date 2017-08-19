<?php
//this is called from tweets.php as ajax request for dynamic content changing in slideshow , based on screen name which is clicked on
$q=$_REQUEST["q"]; //storing screen name of follower which is clicked on in $q 
require 'index.php';
 $jsobj=json_encode($response);
 echo $jsobj;
?>
