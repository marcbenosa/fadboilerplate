<?php
/**
 * @package fadboilerplate
 */

$company_logo   = get_field('company_logo', 'options');
$header_logo    = $company_logo['url'];

?>

<header id="masthead" class="site-header top<?php echo !is_front_page() ? ' inner-header' : ''; ?>" role="banner">
    <div class="container-fluid">
        <nav id="site-navigation" class="navbar navbar-expand-md main-navigation top" role="navigation">
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php
                    if(substr($header_logo, -4) === ".svg" ) { ?>
                        <div class="svg-container"><?php echo file_get_contents($header_logo); ?></div>
                    <?php } else { ?>
                        <img src="<?php echo $company_logo['url']; ?>" alt="<?php echo $company_logo['name']; ?>" class="nav-logo" />
                <?php } ?>
            </a>

            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs4-header-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="navbar-menu">
                <?php wp_nav_menu(
                	array(
                	'theme_location'=> 'primary',
                	'menu_id' => 'primary-menu',
                	'depth' => 2,
                	'container' => 'div',
                	'container_class' => 'collapse navbar-collapse',
                	'container_id' => 'bs4-header-menu',
                	'menu_class' => 'navbar-nav mr-auto',
                	'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                	'walker' => new WP_Bootstrap_Navwalker()
                ) );
                ?>
            </div>
        </nav>
        <!-- #site-navigation -->
    </div>
</header>

<div id="content" class="site-content">
