<?php
//the url https://timelinechallenge.000webhostapp.com/callback.php is registered as callback in my twitter application
//so after successful authenticating twitter application returns here
session_start();
require 'autoload.php';
define('CONSUMER_KEY', 'LNlFNeFVqb4e4MDKRtWsNMuN6'); // add your app consumer key between single quotes
define('CONSUMER_SECRET', '8CJQ4h05nYGYlyiIvH0ghieE05y89sfJJmbzYFTBoGYg1yAZVz'); // add your app consumer secret key between single quotes
use Abraham\TwitterOAuth\TwitterOAuth;
if (isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']) {
	$request_token = [];
	$request_token['oauth_token'] = $_SESSION['oauth_token'];
	$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
	$_SESSION['access_token'] = $access_token;
	// redirect user back to index page
	header('Location: ./');     //redirects to index.php
}
