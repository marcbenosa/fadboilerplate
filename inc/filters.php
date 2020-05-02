<?php
/**
 * fadboilerplate filters
 *
 * Many filters are off by default but are included here for ease of access
 */


/*
 *  Don't "auto-paragraph" images in the WYSIWYG
 *  https://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
 */
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
// add_filter('the_content', 'filter_ptags_on_images');

/**
 * Control YouTube Embed Settings
 */
function remove_youtube_controls($code){
    if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
        $return = preg_replace("@src=(['\"])?([^'\">]*)@", "src=$1$2&showinfo=0&rel=0", $code);
        return $return;
    }
    return $code;
}
// add_filter('embed_handler_html', 'remove_youtube_controls');
// add_filter('embed_oembed_html', 'remove_youtube_controls');

/**
 * Filter the results in the search pages
 */
function SearchFilter($query) {
	if (!is_admin() && $query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
//add_filter('pre_get_posts','SearchFilter');

/**
 * Allow svg and pdf filetype in media uploader
 */
function allow_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['pdf'] = 'application/pdf';
  return $mimes;
}
add_filter('upload_mimes', 'allow_mime_types');

/**
 * Hide wp admin bar from users that aren't admins
 */
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	    show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');

/**
 * Modify the Lifespan of a public preview link
 */
if( class_exists( 'DS_Public_Post_Preview' ) ) {
    add_filter( 'ppp_nonce_life', 'my_nonce_life' );
    function my_nonce_life() {
        return 60 * 60 * 24 * 30; // 30 days
    }
}


/**
 * Page Slug Body Class
 */
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	    $classes[] = $post->post_type . '-' . $post->post_name;
	}
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );
