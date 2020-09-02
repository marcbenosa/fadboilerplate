<?php
/**
 * @package fadboilerplate
 */

$header_logo  = get_field('company_logo', 'options')['url'];

//method="get" action="<?php echo home_url();  " name="s"

?>

<header id="masthead" class="site-header top<?php echo !is_front_page() ? ' inner-header' : ''; ?>" role="banner">
    <nav id="site-navigation" class="main-navigation navbar navbar-expand-lg top" role="navigation">
        <a class="navbar-brand" href="<?php echo home_url(); ?>">
            <?php
                if(substr($header_logo, -4) === ".svg" ) { ?>
                    <div class="svg-container"><?php echo file_get_contents($header_logo); ?></div>
                <?php } else { ?>
                    <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_logo; ?>" class="nav-logo" />
            <?php } ?>
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

<div id="content" class="site-content container">
    <div class="site-header__spacer top"></div>
