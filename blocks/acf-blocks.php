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

// Import core block variations
require_once( get_template_directory() . '/blocks/core/core.php' );

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
		'example'           => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'preview_image'   => get_stylesheet_directory_uri() . "/blocks/example/example-block_preview-image.png",
					'is_preview'    => true
				)
			)
		)
	));

	acf_register_block_type(array(
	    'name'              => 'imagebox',
	    'title'             => __('Image Box'),
	    'category'          => 'fadboilerplate-blocks',
	    'description'       => __('Image Box'),
	    'render_template'   => 'blocks/test/test-block.php',
	    'icon'              => 'wordpress',
	    'keywords'          => array( 'test' ),
		// 'example'           => array(
		// 	'attributes' => array(
		// 		'mode' => 'preview',
		// 		'data' => array(
		// 			'preview_image'   => get_stylesheet_directory_uri() . "/blocks/example/example-block_preview-image.png",
		// 			'is_preview'    => true
		// 		)
		// 	)
		// )
	));

	acf_register_block_type(array(
	    'name'              => 'heading',
	    'title'             => __('Heading'),
	    'category'          => 'fadboilerplate-blocks',
	    'description'       => __('Heading Text'),
	    'render_template'   => 'blocks/heading/heading-block.php',
	    'icon'              => 'wordpress',
	    'keywords'          => array( 'heading' ),
		// 'example'           => array(
		// 	'attributes' => array(
		// 		'mode' => 'preview',
		// 		'data' => array(
		// 			'preview_image'   => get_stylesheet_directory_uri() . "/blocks/example/example-block_preview-image.png",
		// 			'is_preview'    => true
		// 		)
		// 	)
		// )
	));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}


/** my custom block */

function my_block_ex_category( $categories, $post ) {
	return array_merge(
		array(
			array(
				'slug' => 'fadboilerplate-blocks',
				'title' => __( 'fadboilerplate example 2', 'fadboilerplate-blocks' ),
				'icon'  => 'wordpress',
			),
		), $categories
	);
}
add_filter( 'block_categories', 'my_block_ex_category', 10, 2);
