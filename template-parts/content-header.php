<?php
/**
 * @package fadboilerplate
 */
?>

<header id="masthead" class="site-header top<?php echo !is_front_page() ? ' inner-header' : ''; ?>" role="banner">
    <nav id="site-navigation" class="main-navigation navbar navbar-expand-lg top" role="navigation">
		<a class="navbar-brand" href="<?php echo home_url(); ?>">

			<?php if ( has_custom_logo() ) :
				$header_logo = get_theme_mod( 'custom_logo' );
				$header_logo = wp_get_attachment_image_url($header_logo);
				?>

	            <?php if ( substr($header_logo, -4) === '.svg' ) : ?>
	                <div class="nav-logo svg-container"><?php echo file_get_contents($header_logo); ?></div>
	            <?php else : ?>
	                <img src="<?php echo $header_logo; ?>" alt="<?= get_bloginfo( 'name' ) . ' Logo'; ?>" class="nav-logo" />
	            <?php endif; ?>

			<?php endif; ?>

			<?php if ( display_header_text() ) : ?>
				<span class="nav-title"><?= get_bloginfo( 'name' ); ?></span>
			<?php endif; ?>

        </a>
        <button class="navbar-toggler collapsed d-flex d-lg-none" type="button" data-toggle="collapse" data-target="#main-menu-collapse" aria-controls="main-menu-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon__wrapper"><span class="navbar-toggler-icon"></span></span>
        </button>
        <?php wp_nav_menu( array(
            'theme_location'  => 'primary',
            'menu_id'         => 'primary-menu',
            'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'main-menu-collapse',
            'menu_class'      => 'navbar-nav ml-auto',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
    </nav>
    <!-- #site-navigation -->
</header>
