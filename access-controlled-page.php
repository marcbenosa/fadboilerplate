<?php
/**
 * Template Name: Access Control - Default
 * Template Post Type: post, page
 *
 * The template for displaying a page only if the user is logged in.
 *
 * @package fadboilerplate
 */
if ( ! is_user_logged_in() ) {
	$current_url  = esc_url( home_url($_SERVER['REQUEST_URI']) );
	$redirect_url = esc_url( wp_login_url( $current_url ) );
	wp_redirect( $redirect_url, 302 );
	exit;
}

if ( is_single() && ! is_page() ) {
	require get_template_directory() . '/single.php';
}
else {
	require get_template_directory() . '/page.php';
}
