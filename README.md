# TwitterTimelineChallenge
this is for rtcamp recruitments(**UPDATE:Do refer Update and Website flow below for better understanding**)
## Getting Started
In this project there is a home page through which user logs in to their respective twitter account and gets access to their tweets as well as followers list.
## Technologies Used 
HTMl,CSS,JAVASCRIPT,PHP,AJAX,JQUERY
## Library Used
https://github.com/abraham/twitteroauth to interact with Twitter API
## Demo Link
https://timelinechallenge.000webhostapp.com/
## Update 
Updated all files explain how each file , check comments in each file .
## Website Flow
index.php 

   if(!$_SESSION['acess_token']) is set   
   
        ---->content.php
   else 
   
        ---->tweets.php is included in index.php
        
             inside tweets.php
             
                   ---->slideshow.css
                   
                   ---->ss.js for jquery slide show
                   
                   ----><script></script> contains code for searching follower and ajax code 
                   
                   ---->general layout of website
