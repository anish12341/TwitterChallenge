<?php
//this file is included initially , when user logs-in in order to display 10 tweets from his/her timeline with photos/videos/gifs
function anish(){
  global $tweets;
       if($tweets==NULL){
echo '<ul><li class="static"><h2>No tweets yet</h2></li><ul>';        //when user timeline has no tweets 
}
else{                                                                //for first 10 tweets 
	for ($i=0;$i<=10;$i++){
	     if($i==10){                                              //for sack of slideshow when its "logical"  slide 11
	        if(isset($tweets[0]->extended_entities->media[0]->video_info->variants[0]->url)){    //check whether tweet has video
               $pos=strpos($tweets[0]->text,'https');
                if($pos==0){                                                                         //check whether tweet contains ONLY video
                 echo'<li class="slide"><video controls>
<source src="'.$tweets[0]->extended_entities->media[0]->video_info->variants[0]->url.'" type="video/mp4"></li>';
		}
	        else{										     //check whether tweet has both video and text
                $required=substr($tweets[0]->text,0,$pos);
		echo '<li class="slide"><h3>'.$required.'</h3><video controls><source src="'.$tweets[0]->extended_entities->media[0]->video_info->variants[0]->url.'" type="video/mp4"></li>';
		 }
		}
                 elseif(isset($tweets[0]->entities->media[0]->media_url_https)){                     //check whether tweet has photo
	         $pos=strpos($tweets[0]->text,'https');
	          if($pos==0){
                 echo'<li class="slide"><img class="image"src="'.$tweets[0]->entities->media[0]->media_url_https.'"//check whether tweet contains ONLY photo
				 ></li>';
		}
	        else{										    //check whether tweet has both photo and text
                $required=substr($tweets[0]->text,0,$pos);
		echo '<li class="slide slide1"><h3>'.$required.'</h3><br><img class="image" src="'.$tweets[0]->entities->media[0]->media_url_https.'"></li>';
		 }
	       }			
                 else{                                                                               //at last tweet with only text
		echo '<li class="slide slide1"><h3>'.$tweets[0]->text.'</h3></li>';
		 }		
	       }
	     else{                                                                    //for "logical" slides 1-10
               if(isset($tweets[$i]->extended_entities->media[0]->video_info->variants[0]->url)){
               $pos=strpos($tweets[$i]->text,'https');
                if($pos==0){
                 echo'<li class="slide"><video controls>
<source src="'.$tweets[$i]->extended_entities->media[0]->video_info->variants[0]->url.'" type="video/mp4"></li>';
		}
	        else{
                $required=substr($tweets[$i]->text,0,$pos);
		echo '<li class="slide"><h3>'.$required.'</h3><video controls><source src="'.$tweets[$i]->extended_entities->media[0]->video_info->variants[0]->url.'" type="video/mp4"></li>';
		 }
		}
                 elseif(isset($tweets[$i]->entities->media[0]->media_url_https)){
	         $pos=strpos($tweets[$i]->text,'https');
	          if($pos==0){
                 echo'<li class="slide"><img class="image" src="'.$tweets[$i]->entities->media[0]->media_url_https.'"></li>';
		}
	        else{
                $required=substr($tweets[$i]->text,0,$pos);
		echo '<li class="slide"><h3>'.$required.'</h3><br><img class="image" src="'.$tweets[$i]->entities->media[0]->media_url_https.'"></li>';
		 }
	       }			
                 else{
		echo '<li class="slide"><h3>'.$tweets[$i]->text.'</h3></li>';
		 }					 
              }							
	    }
        } 
}
?>
