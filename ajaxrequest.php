<?php

$q=$_REQUEST["q"];
require 'index.php';
//$r=$_SESSION["callback"];
  $jsobj=json_encode($response);
 echo $jsobj;
?>
