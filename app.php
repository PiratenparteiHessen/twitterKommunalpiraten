<?php

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$connection = new TwitterOAuth($customerKey, $customerSecret, $accessToken, $accessTokenSecret);
$objFollower = $connection->get('friends/ids', array('screen_name' => 'KoPoPiratenHE'));

$stringJson = file_get_contents("http://search.twitter.com/search.json?q=kopopi&locale=de");
$decodeJson = json_decode($stringJson);
foreach($decodeJson->results as $value) {
    if(in_array($value->from_user_id_str, $objFollower->ids)) {
        $connection->post('statuses/retweet/' . $value->id_str);
    }
}

    

