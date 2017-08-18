<html lang="en">
<head>
  <title>Bootstrap Example</title>
      <script type = "text/javascript"  src = "/bower_components/jquery.min.js"></script>
  <link rel="stylesheet" href="/bower_components/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="slideshow.css">
  <script src="ss.js"></script>
<script>
	 var screennames=<?php echo json_encode($screennames); ?>;
        var i,flag;
       var str;
	  $(document).ready(function(){
         //$("input"). all of these are for follower searching 
         //screennames is an array which contains followerss' screen_names, which was initialized and defined in index.php
	   $("input").on("keyup", function(){                                        //when user starts typing
		flag=0;
                str=this.value;
                    if(this.value.length>=1){
                        for(i=0;i<screennames.length;i++){
                         if(screennames[i].toLowerCase().indexOf(str)>=0){
                           $("#dynamic").append('<li style="list-style-type: none;background-color:white;border-bottom-style: solid;height: 20%;margin:0;padding:0;">'+screennames[i]+'</li>');
                              flag=1;
                        }
			else{                                                         //if there is no match in followers list
			if(flag==0){
				 $('#dynamic li').each(function(){
			         $(this).hide();
			});
		}
	     }
        }
}
		        else{
			 $('#dynamic li').each(function(){
		         $(this).hide();
		  });
	}
                       
    });
			  $("input").on("click",function(){                  //when user click on search bar all of the contents of ul disappears
				
				  $('#dynamic li').each(function(){
					  $(this).hide();
				  });
				  
			  });
			  $("input").on("blur",function(){               //when user clicks away  ul is restored based on the condition
				  var i;
				  if(str.length==0){
				  var ul=document.getElementById("dynamic");
				  $('#dynamic li').each(function(){
					  $(this).remove();
				  });
				  for(i=0;i<=10;i++){
                    $("#dynamic").append('<li style="list-style-type: none;background-color:white;border-bottom-style: solid;height: 20%;margin:0;padding:0;">'+screennames[i]+'</li>');
				  }
				  }
				  
			  });
		  
     //From this to end of the script is ajax part to change content of slideshow dynamically
		  
                 $('body').on('change', function(){  //this is necessary because li is adding dynamically in ul when user types something
		  console.log("now");                //so the body is changing
	          $("#dynamic li").on("click",function(){  //when user clicks on screen_name of follower
                          $.ajax({url: "ajaxrequest.php?q="+$(this).text(),dataType:"json",success: function(result){//query is sent to kikkk.php
                            var count=Object.keys(result).length;          
		            var $slider = $('#slider');//div
                            var xyz=$slider.width();//ul
                            var $slideContainer = $('.slides', $slider);//ul
	                    var $slides = $('.slide', $slider);//li               
                             console.log(result);            //gives back the json object in log 
				//	alert(result[0][0]);
		            $slides.remove();
		            if(result["notweet"]=="No tweets yet"){
                                $slideContainer.append('<li class="slide"><h1>no tweets yet<h1></li>');
                                 $slideContainer.width(width);
                                 $slides.css("width",width);
				 }
				 else{
                                    var styleon="float:left;list-style-type: none;width:"+xyz+"px;height: 400px;background-color:white;";
                                    var stylemedia="height:50%;width:40%;margin-left: auto;margin-right: auto;margin-top: 2%;margin-bottom: 2%;display: block;";
			             var width=$slider.width();
                                      $slideContainer.width(count*width);
				     var width=$slideContainer.width();
                                      var i;
			                    for(i=0;i<count;i++){
			  if(result[i][0]!=null&&result[i][1]==null&&result[i][2]==null){
		          var create='<li style="'+styleon+'"><h3>'+result[i][0]+'</h3></li>';	  
			  $slideContainer.append(create);
		           $slides.width(xyz);
                               }
			 else if(result[i][0]==null){
			    if(result[i][1]!=null){
		 var create='<li style="'+styleon+'"><img style="'+stylemedia+'" src="'+result[i][1]+'"></li>';
                              $slideContainer.append(create);
	                       $slides.width(xyz); 
			
							  }
			    else if(result[i][2]!=null){
		  var create='<li style="'+styleon+'"><video style="'+stylemedia+'" controls><source src="'+result[i][2]+'" type="video/mp4"></li>';
                              $slideContainer.append(create);
				$slides.width(xyz); 
                                 
							   
							  }
							  }
		 else if(result[i][0]!=null){
		     if(result[i][1]!=null){
	            var create='<li style="'+styleon+'"><h3>'+result[i][0]+'</h3><img style="'+stylemedia+'"  src="'+result[i][1]+'"></li>';
                               $slideContainer.append(create);							 
	                            $slides.width(xyz);
					
							  }
		    else if(result[i][2]!=null){
	 	  var create='<li style="'+styleon+'"><h3>'+result[i][0]+'</h3><video style="'+stylemedia+'" controls><source src="'+result[i][2]+'" type="video/mp4"></li>';
                               $slideContainer.append(create);							 
	                            $slides.width(xyz);
                                     
							  }
							  }
							  
							  
					 
					 }
					 
				 }
				 
            }});
                
               });
			  });
                   
	 $("#dynamic li").on("click",function(){
                   alert("for"+$(this).text());
                          $.ajax({url: "ajaxrequest.php?q="+$(this).text(),dataType:"json",success: function(result){
                              var count=Object.keys(result).length;
						   alert(count+"numer of elements");           
		            var $slider = $('#slider');//div
                            var xyz=$slider.width();
                            alert(xyz+"when clicked")
                            var $slideContainer = $('.slides', $slider);//ul
	                     
		             var $slides = $('.slide', $slider);//li
	                     
                              
		            console.log(result);
				//	alert(result[0][0]);
		            $slides.remove();
		            if(result["notweet"]=="No tweets yet"){
                    $("#slides").append('<li class="slide"><h1>no tweets yet<h1></li>');
                   var $slideContainer = $('.slides', $slider);//ul
                       $slideContainer.width(width);
                    $("#slides li").css("width",width);
				 }
				 else{
                        var styleon="float:left;list-style-type: none;width:"+xyz+"px;height: 400px;background-color:white;";
var stylemedia="height:50%;width:40%;margin-left: auto;margin-right: auto;margin-top: 2%;margin-bottom: 2%;display: block;";

			 var width=$slider.width();
                        
			  
	                         $slideContainer.width(count*width);
				var width=$slideContainer.width();
                	       var i;
			 for(i=0;i<count;i++){
			  if(result[i][0]!=null&&result[i][1]==null&&result[i][2]==null){				
			  var create='<li style="'+styleon+'"><h3>'+result[i][0]+'</h3></li>';	  
			  $slideContainer.append(create);
		           $slides.width(xyz);
                               }
			 else if(result[i][0]==null){
			    if(result[i][1]!=null){
		 var create='<li style="'+styleon+'"><img style="'+stylemedia+'" src="'+result[i][1]+'"></li>';
                              $slideContainer.append(create);
	                            $slides.width(xyz); 
							  }
			    else if(result[i][2]!=null){
		  var create='<li style="'+styleon+'"><video style="'+stylemedia+'" controls><source src="'+result[i][2]+'" type="video/mp4"></li>';
                              $slideContainer.append(create);
				$slides.width(xyz);                
			    }
		  }
		 else if(result[i][0]!=null){
		     if(result[i][1]!=null){
	            var create='<li style="'+styleon+'"><h3>'+result[i][0]+'</h3><img style="'+stylemedia+'"  src="'+result[i][1]+'"></li>';
                               $slideContainer.append(create);							 
	                            $slides.width(xyz);
					
							  }
		    else if(result[i][2]!=null){
	 	  var create='<li style="'+styleon+'"><h3>'+result[i][0]+'</h3><video style="'+stylemedia+'" controls><source src="'+result[i][2]+'" type="video/mp4"></li>';
                               $slideContainer.append(create);							 
	                            $slides.width(xyz);
							  }
						  }
			
					 }
					 
				 }
				 
                        }});
                
           });
		
});
			  </script>
</head>
<body>
<div class="container-fluid">
<div class="col-md-3"></div>
<div class="col-md-6">
  <img src="<?php echo $profilepic;?>" class="img-circle " >
<center><h1 ><?php echo $screenname;?></h1></center>
  <hr style="height:3px;border:none;color:#333;background-color:black;">
  <h1 style="position:absolute;left:0%;top:28%">Tweets</h1>
  <h3 style="position:absolute;left:50%;top:28%;color:#8c8c8c">with photos,videos,gifs</h3>
  <div class="container">
  <div id="slider">
                <ul class="slides">
                    <?php
                       include 'forslideshow.php';
                   anish();?>
                </ul>
            </div>
			</div>
			 <button type="button" class="btn btn-default" style="position: absolute;
    right:25%;
    top: 62%;width:50%"id="right"><a href="results.json" download="tweets.json"> TWEETS .json</a></button>
	 <h1 style="position:absolute;left:0%;top:65%">Followers</h1>
  <div class="container">
			
			<div class="container">
			  <div id="followers">
			  
			  
				  <form>
					 <div class="form-group">
					   <input type="text" class="form-control" id="search" placeholder="Email">
					</div>
					</form>
			<ul class="follo" id="dynamic">
			       <?php
				   tweets:
				     
				    for($i=0;$i<10;$i++)
					{
						echo '<li class="list" id="listelements">'.$screennames[$i].'</li>';
					}
			       ?>
			
			</ul>
			</div>
		</div>
  </div>
</div>
</body>
</html>
