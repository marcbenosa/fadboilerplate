<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wilminvest
 */
$contact      = get_field('contact', 'options');
$social       = get_field('social_media', 'options');
$links        = get_field('footer_links', 'options');
$newsletter   = get_field('newsletter_shortcode', 'options');

?>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info container">
        <div class="footer row">
            <div class="col-sm-3">
                <div class="footer__contact">
                    <?php if($contact['email'] !== ""): ?>
                    	<a class="d-block" href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] );?></a>
                	<?php endif; ?>
                    <?php if($contact['phone'] !== ""): ?>
                    	<a class="d-block" href="tel:<?php echo esc_attr( $contact['phone'] ); ?>">p <?php echo esc_html( $contact['phone'] );?></a>
                	<?php endif; ?>
                    <?php if($contact['fax'] !== ""): ?>
                    	<span class="d-block">f <?php echo esc_html( $contact['fax'] );?></span>
                	<?php endif; ?>
                </div>
            </div>
            <div class="col-sm-3 footer-nav-menu">
                <?php wp_nav_menu( array(
                    'theme_location'  => 'footer',
                    'menu_id'         => 'footer-menu',
                    'menu_class'      => 'nav flex-column',
                    'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
                    'container'       => 'div',
                    'container_class' => '',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ) );
                ?>
            </div>
            <div class="col-sm-6">
                <?php echo do_shortcode( $newsletter ); ?>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-6">
                <div class="footer__copyright">
                    <div class="footer__copyright-text">Copyright <?php echo date('Y') . ' ' . get_bloginfo( 'name' );?>. All rights reserved.</div>
                    <div class="footer__copyright-terms">
                        <a class="footer__copyright-link" href="<?php echo esc_attr( $links['privacy_terms'] ); ?>" target="self">Privacy &amp; Terms</a>
                        <span class="pl-1 pr-1">|</span>
                        <a class="footer__copyright-link" href="<?php echo esc_attr( $links['contact'] ); ?>" target="self">Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="social m-0 text-right">
                    <a class="social-button" href="<?php echo esc_attr( $social['facebook_url'] ); ?>"><?php echo_svg('facebook'); ?></a>
                    <a class="social-button" href="<?php echo esc_attr( $social['instagram_url'] ); ?>"><?php echo_svg('insta'); ?></a>
                    <a class="social-button" href="<?php echo esc_attr( $social['twitter_url'] ); ?>"><?php echo_svg('twitter'); ?></a>
                    <a class="social-button" href="<?php echo esc_attr( $social['linkedin_url'] ); ?>"><?php echo_svg('linkedin'); ?></a>
                </div>
            </div>
        </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
