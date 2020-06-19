<?php
/**
 * Functions which declare theme support for WordPress
 *
 * @package fadboilerplate
 */

if ( ! function_exists( 'fadboilerplate_setupmenus' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fadboilerplate_setupmenus() {

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'fadboilerplate' ),
				'footer'  => esc_html__( 'Footer Menu', 'fadboilerplate' ),
			)
		);
	}

endif;
add_action( 'after_setup_theme', 'fadboilerplate_setupmenus' );
