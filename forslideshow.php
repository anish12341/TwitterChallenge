<?php
function anish(){
  global $tweets;
       if($tweets==NULL){
echo '<ul><li class="static"><h2>No tweets yet</h2></li><ul>';
}
else{
	for ($i=0;$i<=10;$i++){
	     if($i==10){
	        if(isset($tweets[0]->extended_entities->media[0]->video_info->variants[0]->url)){
               $pos=strpos($tweets[0]->text,'https');
                if($pos==0){
                 echo'<li class="slide"><video controls>
<source src="'.$tweets[0]->extended_entities->media[0]->video_info->variants[0]->url.'" type="video/mp4"></li>';
		}
	        else{
                $required=substr($tweets[0]->text,0,$pos);
		echo '<li class="slide"><h3>'.$required.'</h3><video controls><source src="'.$tweets[0]->extended_entities->media[0]->video_info->variants[0]->url.'" type="video/mp4"></li>';
		 }
		}
                 elseif(isset($tweets[0]->entities->media[0]->media_url_https)){
	         $pos=strpos($tweets[0]->text,'https');
	          if($pos==0){
                 echo'<li class="slide"><img class="image"src="'.$tweets[0]->entities->media[0]->media_url_https.'"
				 ></li>';
		}
	        else{
                $required=substr($tweets[0]->text,0,$pos);
		echo '<li class="slide slide1"><h3>'.$required.'</h3><br><img class="image" src="'.$tweets[0]->entities->media[0]->media_url_https.'"></li>';
		 }
	       }			
                 else{
		echo '<li class="slide slide1"><h3>'.$tweets[0]->text.'</h3></li>';
		 }		
	       }
	     else{
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
