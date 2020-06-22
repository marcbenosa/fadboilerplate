<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fadboilerplate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("style-guide"); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title display-1">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="container-fluid style-guide-container">

		<div class="row">
			<div class="col bg-dark text-white p-5">
				<h1 class="text-primary">Developers</h1>
				<p>Please review the <a href="https://getbootstrap.com/docs/4.5/getting-started/introduction/" target="_blank">Bootstrap Documentation</a> before building the theme. To avoid unnecessary bloating, try to use as many built in utility classes or pre-defined css that are automatically included in the compile.
				<br/>Only create new classes or utilities if 100% necessary. <span class="text-primary font-weight-bold"><?php echo esc_html('Smaller CSS > developer workflow.'); ?></span></p>
				<a class="btn btn-primary" href="https://getbootstrap.com/docs/4.5/getting-started/introduction/" target="_blank">Bootstrap Documentation</a>
			</div>
		</div>

		<div class="row sg-colors">
			<div class="col-lg sg-header">
				<hr/>
				<h1 id="colors">COLORS</h1>
			</div>
			<div class="col-lg sg-content sg-flex">
				<div class="sg-color">
					<div class="sg-color-block bg-primary"></div>
					<p>#fdbe3a<br/>
					253 190 58<br/>
					.bg-primary<br/>
					<span class="text-primary">.text-primary</span></p>
				</div>
				<div class="sg-color">
					<div class="sg-color-block bg-dark"></div>
					<p>#211e1f<br/>
					33 30 31<br/>
					.bg-dark<br/>
					<span class="text-dark">.text-dark</span></p>
				</div>
				<div class="sg-color">
					<div class="sg-color-block bg-danger"></div>
					<p>#ed442a<br/>
					273 68 42<br/>
					.bg-danger<br/>
					<span class="text-danger">.text-danger</span></p>
				</div>
				<div class="sg-color">
					<div class="sg-color-block bg-secondary"></div>
					<p>#49b498<br/>
					73 180 152<br/>
					.bg-secondary<br/>
					<span class="text-secondary">.text-secondary</span></p>
				</div>
				<div class="sg-color">
					<div class="sg-color-block bg-info"></div>
					<p>#e80382<br/>
					232 3 130<br/>
					.bg-info<br/>
					<span class="text-info">.text-info</span></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<hr/>
				<h1 id="color-utilities">Color Utilities</h1>
				<a href="https://getbootstrap.com/docs/4.5/utilities/colors/" target="_blank">See Bootstrap 4.5 Docs</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg">
				<p class="text-primary">.text-primary</p>
				<p class="text-secondary">.text-secondary</p>
				<p class="text-success">.text-success</p>
				<p class="text-danger">.text-danger</p>
				<p class="text-warning">.text-warning</p>
				<p class="text-info">.text-info</p>
				<p class="text-light bg-dark">.text-light</p>
				<p class="text-dark">.text-dark</p>
				<p class="text-body">.text-body</p>
				<p class="text-muted">.text-muted</p>
				<p class="text-white bg-dark">.text-white</p>
				<p class="text-black-50">.text-black-50</p>
				<p class="text-white-50 bg-dark">.text-white-50</p>
			</div>
			<div class="col-lg">
				<div class="p-3 mb-2 bg-primary text-white">.bg-primary</div>
				<div class="p-3 mb-2 bg-secondary text-white">.bg-secondary</div>
				<div class="p-3 mb-2 bg-success text-white">.bg-success</div>
				<div class="p-3 mb-2 bg-danger text-white">.bg-danger</div>
				<div class="p-3 mb-2 bg-warning text-dark">.bg-warning</div>
				<div class="p-3 mb-2 bg-info text-white">.bg-info</div>
				<div class="p-3 mb-2 bg-light text-dark">.bg-light</div>
				<div class="p-3 mb-2 bg-dark text-white">.bg-dark</div>
				<div class="p-3 mb-2 bg-white text-dark">.bg-white</div>
				<div class="p-3 mb-2 bg-transparent text-dark">.bg-transparent</div>
			</div>
		</div>

		<div class="row sg-colors">
			<div class="col-lg sg-header">
				<hr/>
				<h1 id="buttons">BUTTONS</h1>
			</div>
			<div class="col-lg sg-content">
				<?php echo do_shortcode( '[cta_button link="#"]Call to Action[/cta_button]' ); ?>
				<pre><code><?php echo esc_html(
'<button class="btn btn-cta">
	<span class="button-inner">
		Call to Action
	</span>
</button>' ); ?></code></pre>
				<h4>Shortcode</h4>
				<pre><code>[cta_button class="" link="" target=""]Call to Action[/cta_button]</code></pre>
				<p>
					<button class="btn btn-primary">
						.btn.btn-primary
					</button>
					<button class="btn btn-secondary">
						.btn.btn-secondary
					</button>
					<button class="btn btn-dark">
						.btn.btn-dark
					</button>
				</p>
				<p>
					<button class="btn btn-outline-primary">
						.btn.btn-outline-primary
					</button>
					<button class="btn btn-outline-secondary">
						.btn.btn-outline-secondary
					</button>
					<button class="btn btn-outline-dark">
						.btn.btn-outline-dark
					</button>
				</p>
				<p>
					<button class="btn btn-link">
						.btn.btn-link
					</button>
				</p>
			</div>
		</div>

		<div class="row sg-typography">
			<div class="col-lg sg-header">
				<hr/>
				<h1 id="type-blog">TYPE (BLOG)</h1>
			</div>
			<div class="col-lg sg-content">
				<h1>H1 - Font - Size</h1>
				<h2>H2 - Font - Weight - Size</h2>
				<h3>H3 - Font - Weight - Size</h3>
				<h4>H4 - Font - Weight - Size</h4>
				<h5>H5 - Font - Weight - Size</h5>
			</div>
		</div>

		<div class="row sg-typography">
			<div class="col-lg sg-header">
				<hr/>
				<h1 id="type">TYPE</h1>
			</div>
			<div class="col-lg sg-content">
				<div>
					<h2>Heading - Font - Weight - Size</h2>
					<h3>Sub Headings - Font - Weight - Size</h3>
					<p>Regular - Font - Weight - Size</p>
				</div>
			</div>
		</div>

		<div class="row sg-forms">
			<div class="col-lg sg-header">
				<hr/>
				<h1 id="forms">FORMS</h1>
			</div>
			<div class="col-lg sg-content">
				<?php echo do_shortcode("[ninja_form id=2]"); ?>
			</div>
		</div>

		<div class="row sg-forms">
			<div class="col-lg sg-header">
				<hr/>
				<h1 id="images">IMAGES</h1>
			</div>
			<div class="col-lg sg-content">
				<h1 class="mb-0">Figures</h1>
				<figure>
					<img src="https://picsum.photos/536/354">
					<figcaption>A caption for the above image.</figcaption>
				</figure>
				<pre><code><?php echo esc_html(
'<figure>
  <img src="..." alt="...">
  <figcaption>A caption for the above image.</figcaption>
</figure>' ); ?></code></pre>
			</div>
		</div>

		<div class="row sg-forms">
			<div class="col-lg sg-header">
				<hr/>
				<h1 id="quotes">QUOTES/ HIGHLIGHTED TEXT</h1>
			</div>
			<div class="col-lg sg-content">
				<blockquote>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
					<cite>Someone famous</cite>
				</blockquote>
				<pre><code><?php echo esc_html(
'<blockquote>
	<p>...</p>
	<cite>Someone famous</cite>
</blockquote>' ); ?></code></pre>
				<blockquote class="bg-danger text-white">
					<p>With modifiers.</p>
					<cite>.bg-danger.text-white</cite>
				</blockquote>
				<blockquote class="border border-primary">
					<p>With border.</p>
					<cite>.border.border-primary</cite>
				</blockquote>
			</div>
		</div>

	</div> <!-- close container -->
	<div class="container-fluid">
		<div class="row sg-forms">
			<div class="col-lg sg-header text-left">
				<hr/>
				<h1 id="other">OTHER</h1>
			</div>
		</div>
		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fadboilerplate' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'fadboilerplate' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
