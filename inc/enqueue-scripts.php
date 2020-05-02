<?php
/**
 * Enqueue scripts and styles for the frontend.
 */
function fadboilerplate_scripts() {
	wp_enqueue_style( 'fadboilerplate-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fadboilerplate-style', 'rtl', 'replace' );

	// Overriden by Bootstrap 4
	// wp_enqueue_script( 'fadboilerplate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'fadboilerplate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fadboilerplate_scripts' );

/**
 * Custom Login Styles
 */
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/wp_login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/**
 * Custom Admin Styles
 */
function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', get_template_directory_uri() . '/css/wp_admin.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');

