<?php
/***
* social-feed-pulldown.php
* Pulls the last 10 items from twitter and instagram
* normalizes the data, and saves it in an accessbile way
*
* Meant to be scheduled by wp-cron
*
***/
// error_reporting(-1);
// ini_set('display_errors', 'On');
//Twitter first
//A great help http://iag.me/socialmedia/build-your-first-twitter-app-using-php-in-8-easy-steps/
//https://dev.twitter.com/rest/reference/get/statuses/user_timeline
require_once( __DIR__ . '/twitter-api-php/TwitterAPIExchange.php' );

function callInstagram($url) {
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2
	));

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

//Sort the results by datetime
function cmp_by_datetime($a, $b) {
  return -($a["datetime"] - $b["datetime"]);
}

function social_refresh() {
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
	    'oauth_access_token' => "2834439472-VpJUkyF0kcrLOTBe0z5fxmQlVsBV39zfONZ9y92",
	    'oauth_access_token_secret' => "IaASHHBnEeX257dWxNWnXT7zjkqKn8Odv9E4RhX3UXYzP",
	    'consumer_key' => "uvbeTn5mZ68lOkzEMOGPYAM1c",
	    'consumer_secret' => "9uM43BmOGcZTdT9OP09tk9lM2HM8xmnLQvTeNkZiCvskOAS9Tm"
	);

	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
	$requestMethod = "GET";
	$getfield = '?screen_name=GetRidOfWeeds&count=10&exclude_replies=1';

	$twitter = new TwitterAPIExchange($settings);
	$twitter_json = $twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
	             ->performRequest();
	$twitter_results = json_decode($twitter_json);

	//Then Instagram
	//http://stackoverflow.com/questions/18458038/how-to-use-instagram-api-to-fetch-image-with-certain-hashtag
	//http://jelled.com/instagram/lookup-user-id#

	//https://api.instagram.com/oauth/authorize/?client_id=2eea82ea535f45cf96b815e99cbbb790&redirect_uri=http%3A%2F%2Ftech2gether.org&response_type=token
	// code=8d7a2db192f24297a12421f71e58e833
	$client_id = "b663b43013f5468cad4a4742e702858a";
	$code = '10fde077a56c456a821b0ce5145d78b2';
	$access_token = "3513232202.b663b43.75404746021b4ae68418331424dbf5bd";
	$user = 3513232202;
	$count = 10;
	$url = 'https://api.instagram.com/v1/users/'.$user.'/media/recent?count='.$count.'&access_token='.$access_token;

	//$inst_stream = callInstagram($url);
	//$insta_results = json_decode($inst_stream, true);
	//var_dump($insta_results);


	//Define the data structure
	//We Want:
	//  -- text
	//  -- link
	//  -- image link
	//  -- source
	$final_results = array();

	// PARSE twitter
	foreach ($twitter_results as $item){

		$a = array();
		$a['text'] = $item->text;
		$a['link'] = 'https://twitter.com/GetRidOfWeeds/status/'.$item->id;
		if(isset($item->extended_entities->media[0]->media_url)) {
			$a['image'] = $item->extended_entities->media[0]->media_url;
		} else {
			$a['image'] = '';
		}
		$a['source'] = 'twitter';
		$datetime = new DateTime($item->created_at);
		$datetime->setTimezone(new DateTimeZone('America/New_York'));
		$a['datetime'] = $datetime->format('U');;
		array_push($final_results, $a);
		unset($a);
	}

	// PARSE INSTAGRAM
	/* foreach ($insta_results['data'] as $item){
		$a = array();
		$a['text'] = $item['caption']['text'];
		$a['link'] = $item['link'];
		$a['image'] = $item['images']['standard_resolution']['url'];
		$a['source'] = 'instagram';
		$a['datetime'] = $item['created_time'];
		array_push($final_results, $a);
		unset($a);
	} */



	usort($final_results, "cmp_by_datetime");

	//save the results to file
	@file_put_contents(get_stylesheet_directory() . '/inc/social.json', json_encode($final_results));

  // $file = @fopen( __DIR__ . "/log.txt", "a" );
  // if ( is_resource( $file )) {
  //         fwrite($file, "\n".sprintf('I last ran at %s', date('Y-m-d H:i:s')));
  //         fclose($file);
  // }
}
social_refresh();
