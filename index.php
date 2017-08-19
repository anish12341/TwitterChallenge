<?php 
//this is the home page and performs neccecary functions to interact with twitter api (setting up connection with consumer key
//and consumer secret key of my twitter application,storing access token in session  $_SESSION['access_token'] ) 
session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'LNlFNeFVqb4e4MDKRtWsNMuN6'); // add your app consumer key between single quotes
define('CONSUMER_SECRET', '8CJQ4h05nYGYlyiIvH0ghieE05y89sfJJmbzYFTBoGYg1yAZVz'); // add your app consumer secret key between single quotes
define('OAUTH_CALLBACK', 'https://timelinechallenge.000webhostapp.com/callback.php'); // your app callback URL
if(isset($_REQUEST["q"])){                  //$q has follower screen name which is set in ajaxrequest.php
                goto tweets;	           //This line here is used in time of ajax request because in ajax response not whole index.php 
	}                                   //is needed only certain lines of it are needed 

if (!isset($_SESSION['access_token'])) {   //check whether user is already logged in 
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	$_SESSION['url']= $url;          //Url to get access token from user by allowing user to login in twitter 
       include 'content.php';             
} else {
      tweets:                           //for ajax response 
	$access_token = $_SESSION['access_token'];            
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
       if(isset($q)){                 //check for $q            
          $response=array();          //It will be of the form [text,photolink,videolink]
           $tweetsoffollower = $connection->get('statuses/user_timeline', ['count' => 50, 'exclude_replies' => true, 'screen_name' => $q, 'include_rts' => false]);
          
         if(sizeof($tweetsoffollower)==0){
             $response["notweet"]="No tweets yet";
         }
        elseif(sizeof($tweetsoffollower)>10){            //if user has more than 10 tweets we need only 10 tweets 
               						 //UPDATE::could hav set 'count' argument as 'count'=>10 on line 28
	       for ($i=0;$i<10;$i++){                    //THIS WHOLE LOGIC OF STORING VALUES IN $RESPONSE IS SAME AS FORESLIDESHOW.PHP WHICH SHOWS TWEETS WITH PHOTOS,VIDEOS,GIFS       
          if(isset($tweetsoffollower[$i]->extended_entities->media[0]->video_info->variants[0]->url)){
               $pos=strpos($tweetsoffollower[$i]->text,'https');
                if($pos==0){                            //video only
                 $response[$i]=array(null,null,$tweetsoffollower[$i]->extended_entities->media[0]->video_info->variants[0]->url);
		}
	        else{                                    //video with text
                $required=substr($tweetsoffollower[$i]->text,0,$pos);
		$response[$i]=array($required,null,$tweetsoffollower[$i]->extended_entities->media[0]->video_info->variants[0]->url);
				 }
		}
          elseif(isset($tweetsoffollower[$i]->entities->media[0]->media_url_https)){
	         $pos=strpos($tweetsoffollower[$i]->text,'https');
	          if($pos==0){                           //photo only
		        $response[$i]=array(null,$tweetsoffollower[$i]->entities->media[0]->media_url_https,null);
		}  
	        else{                                    //photo with text
                $required=substr($tweetsoffollower[$i]->text,0,$pos);
	        $response[$i]=array($required,$tweetsoffollower[$i]->entities->media[0]->media_url_https,null);
		 }
	       }			
                 else{                                    //text only
			  $response[$i]=array($tweetsoffollower[$i]->text,null,null);
		 }					 
}      

}
       else{
      for ($i=0;$i<sizeof($tweetsoffollower);$i++){
          if(isset($tweetsoffollower[$i]->extended_entities->media[0]->video_info->variants[0]->url)){
               $pos=strpos($tweetsoffollower[$i]->text,'https');
                if($pos==0){
                 $response[$i]=array(null,null,$tweetsoffollower[$i]->extended_entities->media[0]->video_info->variants[0]->url);
		}
	        else{
                $required=substr($tweetsoffollower[$i]->text,0,$pos);
		$response[$i]=array($required,null,$tweetsoffollower[$i]->extended_entities->media[0]->video_info->variants[0]->url);
				 }
		}
          elseif(isset($tweetsoffollower[$i]->entities->media[0]->media_url_https)){
	         $pos=strpos($tweetsoffollower[$i]->text,'https');
	          if($pos==0){
		        $response[$i]=array(null,$tweetsoffollower[$i]->entities->media[0]->media_url_https,null);
		}
	        else{
                $required=substr($tweetsoffollower[$i]->text,0,$pos);
	        $response[$i]=array($required,$tweetsoffollower[$i]->entities->media[0]->media_url_https,null);
		 }
	       }			
                 else{
			  $response[$i]=array($tweetsoffollower[$i]->text,null,null);
		 }					 
}
}

       return;                               //return to ajaxrequest.php
}
    else{
	$user = $connection->get("account/verify_credentials");
	$screenname= $user->screen_name;               //storing screen_name for later use in tweets.php
        $profilepic=$user->profile_image_url_https;    //storing link of profile pic for later use in tweets.php
       $forjson=array();
	$tweets = $connection->get('statuses/user_timeline', ['count' => 50, 'exclude_replies' => true, 'screen_name' =>'anish0201', 'include_rts' => false]);
       for ($i=0;$i<sizeof($tweets);$i++){               //This logic for Downloadable file of JSON logic is same as line 35
          if(isset($tweets[$i]->extended_entities->media[0]->video_info->variants[0]->url)){
               $pos=strpos($tweets[$i]->text,'https');     
                if($pos==0){
                 $forjson[$i]=array(null,null,$tweets[$i]->extended_entities->media[0]->video_info->variants[0]->url);
		}
	        else{
                $required=substr($tweets[$i]->text,0,$pos);
		$forjson[$i]=array($required,null,$tweets[$i]->extended_entities->media[0]->video_info->variants[0]->url);
				 }
		}
          elseif(isset($tweets[$i]->entities->media[0]->media_url_https)){
	         $pos=strpos($tweets[$i]->text,'https');
	          if($pos==0){
		        $forjson[$i]=array(null,$tweets[$i]->entities->media[0]->media_url_https,null);
		}
	        else{
                $required=substr($tweets[$i]->text,0,$pos);
	        $forjson[$i]=array($required,$tweets[$i]->entities->media[0]->media_url_https,null);
		 }
	       }			
                 else{
			  $forjson[$i]=array($tweets[$i]->text,null,null);
		 }					 
}
 $jsonobj=json_encode($forjson);
  $fp = fopen('results.json', 'w');                  //Write to json file results.php which is downloadable 
  fwrite($fp, $jsonobj);
  fclose($fp);
    // var_dump ($tweets);
}
$cursor=-1;                                           //For followers list
$j=0;
$k=0;
$f=4;
$screennames=array();
while($f>0&&$cursor!=0){       
$followers=$connection->get('followers/list',['count'=>200,'cursor'=>(int)$cursor,'screen_name'=>'anish0201','skip_status'=>true
,'include_user_entities'=>false]);
   while(isset($followers->users[$k]->screen_name)){
   $screennames[$j]=$followers->users[$k]->screen_name;
   $j++;
   $k++;
   }
$f--;
$k=0;
     $cursor=$followers->next_cursor;
}
sort($screennames);
include 'tweets.php';
				}
?>
