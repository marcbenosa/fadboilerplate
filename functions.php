<?php
/**
 * fadboilerplate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fadboilerplate
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
require get_template_directory() . '/inc/theme-supports.php';

/**
 * Register Menus
 */
require get_template_directory() . '/inc/menus.php';

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
require get_template_directory() . '/inc/widget-areas.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue-scripts.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Mobile Browser Detection
 */
require_once get_template_directory() . '/inc/Mobile_Detect.php';
function is_mobile() {
	$detect = new Mobile_Detect;
	return $detect->isMobile();
}

/**
 * Custom Filters
 */
require_once(get_template_directory() . '/inc/filters.php');

/**
 * Custom Post Types
 */
foreach (glob(get_template_directory() . "/post-types/*.php") as $filename)
{
    include $filename;
}

/**
 * Custom Taxonomies
 */
foreach (glob(get_template_directory() . "/taxonomies/*.php") as $filename)
{
    include $filename;
}

/**
 * SVG handler
 */
require_once(get_template_directory() . '/svg/svg.php');

/**
 * Custom Theme Shortcodes
 */
require_once(get_template_directory() . '/inc/shortcodes.php');

/**
 * Restricting content based on login, ACF, and post types
 */
require_once(get_template_directory() . '/inc/restrict-content-by-acf.php');

/**
 * Allow Editor access to Ninja Forms
 */
require_once(get_template_directory() . '/inc/ninja-forms-editor.php');

/**
 * Advanced Custom Fields (ACF) Spefici Tweaks
 */
require_once(get_template_directory() . '/inc/acf.php');

/**
 * Register Custom Navigation Walker
 * https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 */
if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
    // File does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    // File exists... require it.
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

