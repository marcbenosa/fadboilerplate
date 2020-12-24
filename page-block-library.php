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
add_action('wp_footer', function () { ?>
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
<?php } );

// Based on https://github.com/WordPress/WordPress/blob/965fcddcf68cf4fd122ae24b992e242dfea1d773/wp-includes/blocks.php#L755
add_filter('the_content', function ($content) {
	$output = '';
	$blocks     = parse_blocks($content);
	$acf_blocks = acf_get_block_types();

	foreach ($blocks as $block) {
		$name  = $block['blockName'];
		$title = $name;
		if ($name == '') continue;

		if ( array_key_exists( $name, $acf_blocks ) ) {
			$title = $acf_blocks[$name]['title'];
		}

		$block_output = render_block($block);

		$output .= '<div class="block-library__block">';
		$output .= '<h2 id="'. $name .'" class="block-library__name">' . $title . '</h2>';
		$output .= $block_output;
		$output .= '</div>';
	}

	// If there are blocks in this content, we shouldn't run wpautop() on it later.
	$priority = has_filter('the_content', 'wpautop');
	if ($priority !== false && doing_filter('the_content') && has_blocks($content)) {
		remove_filter('the_content', 'wpautop', $priority);
		add_filter('the_content', '_restore_wpautop_hook', $priority + 1);
	}

	return $output;
}, 5);

get_header(); ?>

	<div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class("block-library"); ?>>

					<div class="quickmenu">
						<h4>Quickmenu</h4>
						<ul id="quickmenu-menu"></ul>
					</div>

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title display-1">', '</h1>' ); ?>
					</header>

					<?php the_content(); ?>

				</article>

            <?php endwhile; ?>

        </main>
    </div>

<?php get_footer(); ?>
