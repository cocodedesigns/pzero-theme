<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set cache file **/
$tweet_file = TEMPLATEPATH . '/inc/twitter/TweetCache.json';

/** Set cache time in minutes **/
$cache_time = 15;

/** Set access tokens here **/
$settings = array(
    'oauth_access_token' => "3130870528-pfG7LlcYur0Wprl34KS8mZxdb0OJie64748uYgb",
    'oauth_access_token_secret' => "b9vWmgBhvsF1ORoqrdo437S6d5HCdl0NJHqDoVL3k4pEY",
    'consumer_key' => "0TDi14Nl7hkZOcxy9WFtnlltL",
    'consumer_secret' => "k3qzXDF7ApRJFCL4pCiJJ0y1vXvPJVY1Fr5GhEaXQOtxKlPDqW"
);

ReadLatestUpdate();
    		 
 function ReadLatestUpdate(){
	global $tweet_file;
    global $cache_time;
	
	if(!file_exists($tweet_file)){
		UpdateTimeline();
		return;
	}
	$handle = fopen($tweet_file,'r');
	$strUpdateDate = fgets($handle);
	fclose($handle);
	if(empty($strUpdateDate)){
		//file is empty
		UpdateTimeline();
	}
	else{
		$updateDate = new DateTime($strUpdateDate);
		$now = new DateTime("now");
		$since = $updateDate->diff($now);
		
		$minutes = $since->i;
		
		if($minutes > $cache_time){
			//reload feed
			UpdateTimeline();
		}
		else{
			//read cache
			ReadFromCache();
		}
		
	}
 }
 
 function ReadFromCache(){
	global $tweet_file;
	$handle = fopen($tweet_file,'r');
	$data = fgets($handle); //skip first line
	$data = '';
	while(!feof($handle)){
		$data.= fgets($handle);
	}
	fclose($handle);
	showData($data);
 }
 
 function UpdateCache($timeline){
	global $tweet_file;
	$handle = fopen($tweet_file,'w') or die ('Cannot open cache file');
	$data = date('m/d/Y h:i:s a', time())."\r\n".$timeline;
	fwrite($handle,$data);
	fclose($handle);
 }
 
 function UpdateTimeline(){
 global $settings;
 /** Perform a GET request and echo the response **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=twitter&count=20&exclude_replies=true';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
    
			 //save to cache
			 UpdateCache($response);
}

function showData($data){
    $tweets = json_decode($data);

    foreach ($tweets as $tweet){
        echo linkify_tweet('<h1>'.$tweet->text.'</h1><p>User: '.$tweet->user->name.' (@'.$tweet->user->screen_name.')');

    }
}

function linkify_tweet($tweet) {
  //Convert urls to <a> links
  $tweet = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $tweet);
  //Convert hashtags to twitter searches in <a> links
  $tweet = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $tweet);
  //Convert attags to twitter profiles in <a> links
  $tweet = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $tweet);
  // Return formatted tweet
  return $tweet;
}
?>