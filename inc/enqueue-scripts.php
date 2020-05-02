<?php
/**
 * Enqueue scripts and styles for the frontend.
 */
function fadboilerplate_scripts() {
	/**
	 * Additional Styles
	 */

	// Font-Awesome by CDN
	// https://fontawesome.com/
    wp_enqueue_style( "font-awesome", "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css", false, NULL, 'all' );

	// Slick Slider CSS
	// https://kenwheeler.github.io/slick/
    wp_enqueue_style( "slick-style", get_template_directory_uri() . '/lib/slick/slick.css', false, NULL, 'all' );
  	wp_enqueue_style( 'slick-style' );
  	wp_enqueue_style( "slick-theme-style", get_template_directory_uri() . '/lib/slick/slick-theme.css', false, NULL, 'all' );
  	wp_enqueue_style( 'slick-theme-style' );

    // Template Stylesheet
	wp_enqueue_style( 'fadboilerplate-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fadboilerplate-style', 'rtl', 'replace' );

	// Overriden by Bootstrap 4
	// wp_enqueue_script( 'fadboilerplate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	/**
	 * Scripts
	 */
	// Skip Link Focus
	wp_enqueue_script( 'fadboilerplate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	// Comment Reply Script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Slick Slider JS
	// https://kenwheeler.github.io/slick/
	wp_register_script( 'slick-js', get_template_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'slick-js' );

	// GSAP
	// https://greensock.com/get-started/#loading-gsap
	// By CDN
	wp_register_script( "gsap-js", "https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js", false, NULL, 'all' );
	wp_enqueue_script( 'gsap-js' );

	// ScrollMagic
	// https://scrollmagic.io/
	wp_register_script( "scrollmagic-js", "//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js", false, NULL, 'all' );
	wp_enqueue_script( 'scrollmagic-js' );
	// Debugging script
	// wp_register_script( "scrollmagic-debug-js", "//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js", false, NULL, 'all' );
	// wp_enqueue_script( 'scrollmagic-debug-js' );

	// Popper.js
	// https://popper.js.org/
	wp_register_script( "popper-js", "https://unpkg.com/@popperjs/core@2", false, NULL, 'all' );
	wp_enqueue_script( 'popper-js' );

	// Respond.js
	// https://github.com/scottjehl/Respond
	// For use when needing to support legacy browsers
	// A fast & lightweight polyfill for min/max-width CSS3 Media Queries (for IE 6-8, and more)
	// by CDN
	// wp_register_script( "respond-js", "https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js", false, NULL, 'all' );
	// wp_enqueue_script( 'respond-js' );

	// Match-Height.js
	// https://github.com/liabru/jquery-match-height
	// For a JS function to match heights of elements.
	// by CDN
	wp_register_script( "match-height-js", "https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js", array('jquery'), NULL, 'all' );
	wp_enqueue_script( 'match-height-js' );

	// Theme Scripts
	wp_register_script( 'fadboilerplate-js', get_template_directory_uri() . '/js/fadboilerplate.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'fadboilerplate-js' );

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

