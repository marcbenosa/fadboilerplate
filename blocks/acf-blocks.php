<?php
/**
* Register custom block categories
*/
function my_block_category( $categories, $post ) {
	return array_merge(
		array(
			array(
				'slug' => 'fadboilerplate-blocks',
				'title' => __( 'fadboilerplate Blocks', 'fadboilerplate-blocks' ),
				'icon'  => 'wordpress',
			),
		), $categories
	);
}
add_filter( 'block_categories', 'my_block_category', 10, 2);

function fadboilerplate_gutenberg_theme_supports() {
	//https://weblines.com.au/gutenberg-blocks-wide-alignment-full-width/
	add_theme_support( 'align-wide' );

	// Disable Custom Colors
	// add_theme_support( 'disable-custom-colors' );

	// Editor Color Palette
	// add_theme_support( 'editor-color-palette', array(
	// 	array(
	// 		'name'  => __( 'Dark Blue', 'ea-starter' ),
	// 		'slug'  => 'darkblue',
	// 		'color'	=> '#0c131e',
	// 	),
	// ) );
}
add_action( 'after_setup_theme', 'fadboilerplate_gutenberg_theme_supports' );


//reference: https://www.advancedcustomfields.com/resources/acf_register_block_type/
function register_acf_block_types() {

	acf_register_block_type(array(
	    'name'              => 'example',
	    'title'             => __('Example'),
	    'category'          => 'fadboilerplate-blocks',
	    'description'       => __('Example Block'),
	    'render_template'   => 'blocks/example/example-block.php',
	    'icon'              => 'wordpress',
	    'keywords'          => array( 'example' ),
	));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

/**
 * Wrap core gutenberg blocks in divs
 */
function wporg_block_wrapper( $block_content, $block ) {
    if ( !( strpos($block_content, "alignfull") > -1  ) ) {
	    // not full width edits.
	    if ( $block['blockName'] === 'core/paragraph' ) {
	        $content = '<div class="wp-block-paragraph">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    } elseif ( $block['blockName'] === 'core/heading' ) {
	        $content = '<div class="wp-block-heading">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    } elseif ( $block['blockName'] === 'core/quote' ) {
	        $content = '<div class="wp-block-quote-container">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    } elseif ( $block['blockName'] === 'core/columns' ) {
	        $content = '<div class="wp-block-columns-container">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    } elseif ( $block['blockName'] === 'core/list' ) {
	        $content = '<div class="wp-block-list-container">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    } elseif ( $block['blockName'] === 'core/table' ) {
	        $content = '<div class="wp-block-table-container">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    } elseif ( $block['blockName'] === 'core/image' ) {
	        $content = '<div class="wp-block-image-container">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    } elseif ( 	null === $block['blockName']
	    			&& ! empty( $block_content )
	    			&& ! ctype_space( $block_content ) ) {
	    	//classic blocks - might not work
	    	$content  = '<div class="wp-block-classic">';
	        $content .= $block_content;
	        $content .= '</div>';
	        return $content;
	    }
	} else {
		// full width edits
		if ( $block['blockName'] === 'core/image' ) {
	        $content = '<div class="wp-block-image-container">';
	        $content .= '<div class="row">';
	        $content .= $block_content;
	        $content .= '</div>';
	        $content .= '</div>';
	        return $content;
	    }
	}

    return $block_content;
}

add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );
