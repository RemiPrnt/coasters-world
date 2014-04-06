<?php
session_start();
require_once("twitteroauth/twitteroauth.php");

// Replace the keys below - Go to https://dev.twitter.com/apps to create the Application
$consumerkey = "ibMla2KXX0UY4DM9MIB5PVHNC";
$consumersecret = "dKspg48aSyjzVzU7NiPE7vetI0HHVpNXeHfVH1puyuZHxEZf1r";
$accesstoken = "96179077-nJePKGCsBENy4wqfgtKX2FFAZoIAu62KGS3kAN6fv";
$accesssecret = "O0uHTjzKEHROgTRHWm4TcjrmPluhzLYtzCDfYB6i1xBVy";


$twitteruser = $_GET['twitteruser'];
$notweets = $_GET['notweets'];

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	return $connection;
}

$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesssecret);
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

echo json_encode($tweets);
?>