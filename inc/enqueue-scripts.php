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
    // wp_enqueue_style( "font-awesome", "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css", false, NULL, 'all' );

    /**
     * Theme Stylesheet
     *
     * Use CSS source map while running in debug mode.
     * Otherwise, serve the smaller file without mapping JSON.
     */
	if (defined('WP_DEBUG') && true === WP_DEBUG) {
		wp_enqueue_style( 'fadboilerplate-style', get_stylesheet_uri(), array(), _S_VERSION );
		wp_style_add_data( 'fadboilerplate-style', 'rtl', 'replace' );
	} else {
		// Serve CSS without Source Map
		wp_enqueue_style( 'fadboilerplate-style', get_template_directory_uri() . '/dist/style.css', array(), _S_VERSION );
		wp_style_add_data( 'fadboilerplate-style', 'rtl', 'replace' );
	}


	/**
	 * Scripts
	 */
	// Skip Link Focus
	wp_enqueue_script( 'fadboilerplate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

	// Comment Reply Script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_deregister_script('jquery');
    wp_register_script( 'jquery', get_template_directory_uri() . '/lib/jquery-3.4.1.slim.min.js' );
    wp_enqueue_script( 'jquery' );

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
	// Try to use Flexbox first. Use this as a last attempt.
	// wp_register_script( "match-height-js", "https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js", array('jquery'), NULL, 'all' );
	// wp_enqueue_script( 'match-height-js' );

	// Bootstrap 4 Scripts
	// https://getbootstrap.com
	// by Local files
	wp_register_script( "bootstrap-js", get_template_directory_uri() . '/lib/bootstrap.bundle.min.js', array('jquery'), NULL, 'all' );
	wp_enqueue_script( 'bootstrap-js' );

	// Theme Scripts
	wp_register_script( 'fadboilerplate-js', get_template_directory_uri() . '/js/fadboilerplate.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'fadboilerplate-js' );

}
add_action( 'wp_enqueue_scripts', 'fadboilerplate_scripts' );

/**
 * Dequeue WordPress default scripts
 */
function fadboilerplate_default_scripts( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			// Check whether the script has any dependencies
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'fadboilerplate_default_scripts' );

/**
 * Custom Login Styles
 */
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/wp_login.css' );
}
// add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/**
 * Custom Admin Styles
 */
function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', get_template_directory_uri() . '/css/wp_admin.css');
}
// add_action('admin_enqueue_scripts', 'my_admin_theme_style');
