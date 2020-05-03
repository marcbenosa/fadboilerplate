<?php
/**
 * Instagram API
 * Pulls post items from instagram without the use of Access Key and Token.
 **/

function instagram_request($username) {
	$instagram_access_url = "https://www.instagram.com/" . $username . "/?__a=1";
	$instagram_json = file_get_contents($instagram_access_url);
	$data = json_decode($instagram_json, true);

	$ig_post = $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][0]['node'];

	$ig_post_url = $ig_post['shortcode'];
	$ig_post_image = $ig_post['display_url'];
	$ig_post_thumbnail = $ig_post['thumbnail_src'];
	$ig_post_text = $ig_post['edge_media_to_caption']['edges'][0]['node']['text'];

	$ig_obj = $ig_obj->instagram[0];
	$ig_obj->post_url = "https://www.instagram.com/p/" . $ig_post_url . "/";
	$ig_obj->images->full = $ig_post_image;
	$ig_obj->images->thumbnail = $ig_post_thumbnail;
	$ig_obj->text = $ig_post_text;

	$instagram_obj = json_encode($ig_obj);
	return $instagram_obj;
}

function instagram_local_request() {
	$instagram_access_url = get_stylesheet_directory() . "/inc/instagram_json/instagram_feed.json";
	$instagram_json = file_get_contents($instagram_access_url);
	$data = json_decode($instagram_json, true);
	return $data;
}

function ig_footer_feed() {
	$ig_request = instagram_local_request();

	echo '<a href="' . $ig_request['post_url'] . '" target="_blank" />';
	echo '<div class="ig_image"><img src="' . $ig_request['images']['thumbnail'] . '" width="100%" /></div>';
	echo '<div class="social-content ig_text"><p>' . substr($ig_request['text'], 0, 150) . '...</p></div>';
	echo '</a>';
}
?>
