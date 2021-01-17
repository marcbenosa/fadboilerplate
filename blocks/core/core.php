<?php
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

function fadboilerplate_register_block_styles() {

	/**
	 * Group
	 */
	register_block_style(
		'core/group',
		array(
			'name'         => 'gutter',
			'label'        => __( 'Gutter' ),
			'style_handle' => 'fadboilerplate'
		)
	);
}
add_action('acf/init', 'fadboilerplate_register_block_styles');
