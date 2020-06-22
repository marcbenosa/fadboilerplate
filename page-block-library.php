<?php
/**
 * Template Name: Block Library
 * The template for displaying the style guide
 *
 * @package fadboilerplate
 */
add_action('wp_head', function() { ?>
	<style>
		.wp-block-heading h2 {
			position: relative;
			background: yellow;
			margin: 6rem 3rem;
		}

		.wp-block-heading h2::after {
			content: '';
			position: absolute;
			background: black;
			top: -6px;
			left: 0;
			width: 50%;
			height: 6px;
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

add_action('wp_footer', function () { ?>
	<script>
		( function ( body ) {
			'use strict';
			var elements = document.querySelectorAll('*[id]');
			var blocks = [];
			for (var i = 0, n = elements.length; i < n; ++i) {
				var el = elements[i];
				if ('block' == el.id.substr(0,5)) {
					var node = document.createElement("LI");
					var link = document.createElement("A");
					let text = document.getElementById(el.id).textContent;
					var textnode = document.createTextNode(text);
					link.appendChild(textnode);
					link.href = '#'+el.id;
					node.appendChild(link);
					document.getElementById("quickmenu-menu").appendChild(node);
				}
			}
		} )( document.body );
	</script>
<?php });

/**
 * Automatically add IDs to headings such as <h2></h2>
 */
function auto_id_headings( $content ) {

	$content = preg_replace_callback( '/(\<h[1-6](.*?))\>(Block.*)(<\/h[1-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );

    return $content;

}
add_filter( 'the_content', 'auto_id_headings' );

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
