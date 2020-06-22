<?php
/**
 * Template Name: Style Guide
 * The template for displaying the style guide
 *
 * @package fadboilerplate
 */
function hook_style_guide_styles() { ?>
	<style>
		.style-guide-container .row {
			padding-bottom: 10rem;
		}

		.sg-flex {
			display: flex;
			flex-flow: wrap;
		}

		.sg-header {
			text-align: right;
			padding-right: 10rem;
		}

		.sg-colors .sg-color {
			width: 50%;
		}

		.sg-colors .sg-color-block {
			width: 200px;
			height: 200px;
		}

		.sg-typography h1,
		.sg-typography h2,
		.sg-typography h3,
		.sg-typography h4,
		.sg-typography h5 {
			padding-bottom: 1rem;
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
<?php }
add_action('wp_head', 'hook_style_guide_styles');
get_header(); ?>

	<div id="primary" class="content-area style-guide-page">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
				<div class="quickmenu">
					<h4>Quickmenu</h4>
					<ul id="quickmenu-menu">
						<li><a href="#colors">Colors</a></li>
						<li><a href="#color-utilities">Color Utilities</a></li>
						<li><a href="#buttons">Buttons</a></li>
						<li><a href="#type-blog">Type (blog)</a></li>
						<li><a href="#type">Type</a></li>
						<li><a href="#forms">Forms</a></li>
						<li><a href="#images">Images</a></li>
						<li><a href="#quotes">Quotes</a></li>
						<li><a href="#other">Other</a></li>
					</ul>
				</div>
                <?php get_template_part( 'template-parts/content', 'style-guide' ); ?>

            <?php endwhile; // end of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>
