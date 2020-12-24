<?php
/**
 * Template Name: Style Guide
 * The template for displaying the style guide
 *
 * @package fadboilerplate
 */
add_action('wp_head', function () { ?>
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
<?php } );

get_header(); ?>

	<div id="primary" class="content-area style-guide-page">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class("style-guide"); ?>>
					<div class="container-fluid">
						<div class="entry-content">
							<?php
								the_content();
							?>
						</div>
					</div>
				</article>

            <?php endwhile;?>

        </main>
    </div>

<?php get_footer(); ?>
