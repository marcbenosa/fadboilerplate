<?php
/**
* Register custom block categories
*/
function my_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'fadboilerplate-blocks',
				'title' => __( 'fadboilerplate Blocks', 'fadboilerplate-blocks' ),
				'icon'  => 'wordpress',
			),
		)
	);
}
add_filter( 'block_categories', 'my_block_category', 10, 2);


//reference: https://www.advancedcustomfields.com/resources/acf_register_block_type/
function register_acf_block_types() {

	/*
	// register a testimonial block.
	name
	(String) A unique name that identifies the block (without namespace). For example ‘testimonial’. Note: A block name can only contain lowercase alphanumeric characters and dashes, and must begin with a letter.
	title
	(String) The display title for your block. For example ‘Testimonial’.
	description
	(String) (Optional) This is a short description for your block.
	category
	(String) Blocks are grouped into categories to help users browse and discover them. The core provided categories are [ common | formatting | layout | widgets | embed ]. Plugins and Themes can also register custom block categories.
	icon
	(String|Array) (Optional) An icon property can be specified to make it easier to identify a block. These can be any of WordPress’ Dashicons, or a custom svg element.
	keywords
	(Array) (Optional) An array of search terms to help user discover the block while searching.
	post_types
	(Array) (Optional) An array of post types to restrict this block type to.
	mode
	(String) (Optional) The display mode for your block. Available settings are “auto”, “preview” and “edit”. Defaults to “preview”. auto: Preview is shown by default but changes to edit form when block is selected. preview: Preview is always shown. Edit form appears in sidebar when block is selected. edit: Edit form is always shown.
	Note. When in “preview” or “edit” modes, an icon will appear in the block toolbar to toggle between modes.
	align
	(String) (Optional) The default block alignment. Available settings are “left”, “center”, “right”, “wide” and “full”. Defaults to an empty string.
	render_template
	(String) The path to a template file used to render the block HTML. This can either be a relative path to a file within the active theme or a full path to any file.
	render_callback
	(Callable) (Optional) Instead of providing a render_template, a callback function name may be specified to output the block’s HTML.
	enqueue_style
	(String) (Optional) The url to a .css file to be enqueued whenever your block is displayed (front-end and back-end).
	enqueue_script
	(String) (Optional) The url to a .js file to be enqueued whenever your block is displayed (front-end and back-end).
	enqueue_assets
	(Callable) (Optional) A callback function that runs whenever your block is displayed (front-end and back-end) and enqueues scripts and/or styles.
	supports
	(Array) (Optional) An array of features to support. All properties from the JavaScript block supports documentation may be used. The following options are supported:

	*/
	acf_register_block_type(array(
	    'name'              => 'example',
	    'title'             => __('Example'),
	    'category'          => 'fadboilerplate-blocks',
	    'description'       => __('Example Block'),
	    'render_template'   => 'blocks/example/example-block.php',
	    'icon'              => 'wordpress',
	    'keywords'          => array( 'example' ),
	));

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

	//classic blocks - might not work
	if ( null === $block['blockName']
		&& ! empty( $block_content ) ) {
    	$content  = '<div class="wp-block-classic">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    }
    if ("tadv/classic-paragraph" === $block['blockName']) {
    	$content  = '<div class="wp-block-classic">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    }
    return $block_content;
}

add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );
