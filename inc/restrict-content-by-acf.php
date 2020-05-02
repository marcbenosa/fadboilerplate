<?php
/**
 * Restricting content based on login, ACF, and post types
 */
function restricted_content_redirect() {
	$login_page_id = 39;

	if ( is_user_logged_in() ) {
		return;
	}

	global $post;
	$id = get_the_id($post);
	$post_type = get_post_type( $post );

	if( get_field( 'restrict_this' ) ) {
		wp_redirect( get_the_permalink( $login_page_id ) . '?redirect=' . $id );
    	exit();
	}

}
add_action( 'template_redirect', 'restricted_content_redirect' );