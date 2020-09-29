<?php

/**
 * Add a Theme Options page if it exists
 * Default Theme Option
 */
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page( array(
    'page_title'  => 'Theme Options',
    'menu_title'  => 'Theme Options',
    'menu_slug'   => 'acf-options-theme-options',
    'capability'  => 'edit_posts',
    'icon_url'    => 'dashicons-list-view' // Add this line and replace the second inverted commas with class of the icon you like

  ));
}


/**
 * Get the colors formatted for use with Iris, Automattic's color picker
 */
function output_the_colors() {

	// get the colors
    $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

	// bail if there aren't any colors found
	if ( !$color_palette )
		return;

	// output begins
	ob_start();

	// output the names in a string
	echo '[';
		foreach ( $color_palette as $color ) {
			echo "'" . $color['color'] . "', ";
		}
	echo ']';

    return ob_get_clean();

}

/**
 * Add the colors into Iris
 */
add_action( 'acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette' );
function gutenberg_sections_register_acf_color_palette() {

    $color_palette = output_the_colors();
    if ( !$color_palette ) return;
    ?>

    <script type="text/javascript">
        (function( $ ) {
            acf.add_filter( 'color_picker_args', function( args, $field ){

                args.palettes = <?= $color_palette; ?>;
                args.border = false;

                console.log(args);

                return args;

            });
        })(jQuery);
    </script>

    <?php
}

/**
 * Get the palette color class name.
 * @param  string        $search_color  Color string from Color Picker field.
 * @return string|false                 Returns class if color exists in palette.
 */
function get_palette_class_raw($search_color) {

    // get the colors
    $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

	// bail if there aren't any colors found
	if ( !$color_palette )
		return false;

    foreach ( $color_palette as $color ) {

        if ( 0 == strcasecmp( $color['color'] , $search_color  ) ) {

            return $color['slug'];
        }
    }

    return false;
}

/**
 * Get the palette color class name.
 * @param  string        $search_color  Color string from Color Picker field.
 * @param  boolean       $is_background Boolean to return background if true, otherwise color class.
 * @return string|false                 Returns class if color exists in palette.
 */
function get_palette_class($search_color, $is_background = false) {

    $color_class = get_palette_class_raw( $search_color );

    // bail if there aren't any colors found
	if ( !$color_class )
		return false;

    return ($is_background) ?
        'has-' . $color_class . '-background-color':
        'has-' . $color_class . '-color';
}
