<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="bower_components\bootstrap-social\bootstrap-social.css">
<link rel="stylesheet" href="bower_components\font-awesome\css\font-awesome.min.css">

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body, html, .container-fluid {
         height: 100%;
    }
	
	</style>
</head>
<body>
<div class="container-fluid">
<div class="row" style="background-color:#33B8FF;height:30%">

<div class="text-center">
 <div class="col-xs-12" ><h1 style="padding-top:3%">Twitter challenge</h1></div>
 </div>
 
</div>
<form>
<center>
  <!-- Contextual button for informational alert messages -->
<a class="btn btn-sm btn-social btn-twitter" style="margin-top:5%" href="<?php echo $_SESSION['url']?>" >
    <span class="fa fa-twitter"></span> Sign in with Twitter
  </a>
  
</div>
</center>


</body>
</html>
