<?php
/**
 * Template Name: Block Library
 * The template for displaying the style guide
 *
 * @package fadboilerplate
 */
add_action('wp_head', function() { ?>
	<style>
		.block-library__name {
			position: relative;
			background: yellow;
			margin: 6rem 3rem 2rem;
		}

		.block-library__name::after {
			content: '';
			position: absolute;
			background: black;
			top: -6px;
			left: 0;
			width: 50%;
			height: 6px;
		}

		.block-library__block {
			padding: 4rem 0;
		}

		.quickmenu {
			position: fixed;
			z-index: 99;
			background: white;
			padding: 1rem;
			right: 0;
			border: 3px solid;
			border-right: none;
		}

		.quickmenu ul {
			margin: 0;
			max-height: 50vh;
			overflow: scroll;
		}
	</style>
<?php });

/**
 * Add items to quickmenu
 */
function block_library_quickmenu() { ?>
	<script>
		( function ( body ) {
			'use strict';
			var elements = document.querySelectorAll('.block-library__name');
			var blocks = [];
			for (var i = 0, n = elements.length; i < n; ++i) {
				var el = elements[i];
				var node = document.createElement("LI");
				var link = document.createElement("A");
				let text = document.getElementById(el.id).textContent;
				var textnode = document.createTextNode(text);
				link.appendChild(textnode);
				link.href = '#'+el.id;
				node.appendChild(link);
				document.getElementById("quickmenu-menu").appendChild(node);
			}
		} )( document.body );
	</script>
<?php }
add_action('wp_footer', 'block_library_quickmenu');

/**
 * Wrap custom gutenberg blocks in divs.
 */
function block_library_block_wrapper( $block_content, $block ) {
	if ( is_page( 'block-library' ) ) {
		$name = $block['blockName'];
		if ( 'acf/' === substr( $name, 0, 4 ) ) {
			$name = ucwords( substr( $name, 4 ) );
		}
		$content = '<h2 id="'. $name .'" class="block-library__name">' . $name . '</h2>';
		$content .= '<div class="block-library__block">';
		$content .= $block_content;
		$content .= '</div>';

	    return $content;
	}

	return $block_content;
}
add_filter( 'render_block', 'block_library_block_wrapper', 20, 2 );

get_header(); ?>

	<div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
				<div class="quickmenu">
					<h4>Quickmenu</h4>
					<ul id="quickmenu-menu"></ul>
				</div>
                <?php get_template_part( 'template-parts/content', 'block-library' ); ?>

            <?php endwhile; // end of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>
