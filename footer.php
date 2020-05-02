<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fadboilerplate
 */

$logo       = get_field('footer_logo', 'options');
$phone      = get_field('phone', 'options');
$email      = get_field('email', 'options');

$facebook   = get_field('facebook_url', 'options');
$instagram  = get_field('instagram_url', 'options');
$twitter    = get_field('twitter_url', 'options');
$linkedin   = get_field('linkedin_url', 'options');

$shortcode  = get_field('form_shortcode', 'options');
$menus      = get_field('menu', 'options');
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            <div class="prefooter">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col prefooter-logo">
                            <div class="logo">
                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                            </div>
                        </div>

                        <div class="col prefooter-info">
                            <div class="heading">Contact Info</div>
                            <div class="contact">
                                <a href="tel:<?php echo $phone; ?>">
                                    <?php echo $phone; ?>
                                </a>

                                <a href="mailto:<?php echo $email; ?>">
                                    <?php echo $email; ?>
                                </a>
                            </div>

                            <div class="social">
                                <?php if( !empty($facebook) ) { ?>
                                <a href="<?php echo $facebook; ?>" target="_blank">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <?php }
                                if( !empty($twitter) ) { ?>
                                <a href="<?php echo $twitter; ?>" target="_blank">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col prefooter-form">
                            <div class="heading">Newsletter</div>
                            <?php echo do_shortcode( $shortcode ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="container-fluid">
                    <hr>
                    <div class="row">
                        <div class="col footer-copyright">
                            <span>&copy; <?php echo get_bloginfo( 'name' ). ', '.date( 'Y' ); ?></span>
                        </div>
                        <div class="col footer-menu">
                            <?php
                                if( !empty($menus) ) {
                                    foreach ($menus as $menu) { ?>
                                    <a href="<?php echo get_permalink($menu->ID);  ?>">
                                        <?php echo $menu->post_title; ?>
                                    </a>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->
<a href="#" class="back-to-top scroll-next"></a>
<div id="media-query-detector"></div>
<?php wp_footer(); ?>

</body>
</html>
