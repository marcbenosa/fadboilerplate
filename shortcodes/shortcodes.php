<?php

/**
 * Functions for the CTA buttons
 * @param  array $atts    Array containing:
 *                        'link' => The url for the button
 *                        'class' => additional classes for the button. Seperate with spaces.
 * @param  string $content The text inside the button
 * @return string          The html for the button
 */
 function fadboilerplate_cta_button_shortcode( $atts, $content = null ) {
     $a = shortcode_atts( array(
         'link' => '',
         'class' => '',
         'target' => '_self'
     ), $atts );

     // Protect from empty target given by ACF.
     $a['target'] = (!empty($a['target'])) ? $a['target'] : '_self';

     if(substr($a['link'], 0, 4) != "http") {
         $a['link'] = site_url( $a['link'] );
     }

     ob_start();
     ?>
         <a class="btn btn-cta <?php echo $a['class']; ?>" href="<?php echo $a['link']; ?>" target="<?php echo $a['target']; ?>">
             <span class="button-inner">
                 <?php echo $content; ?>
             </span>
         </a>
     <?php
     return ob_get_clean();
 }
 // [cta_button class="" link=""]Button Text[/cta_button]
 add_shortcode( 'cta_button', 'fadboilerplate_cta_button_shortcode' );
 add_shortcode( 'fadboilerplate_button', 'fadboilerplate_cta_button_shortcode' );
 add_shortcode( 'fadboilerplate_btn', 'fadboilerplate_cta_button_shortcode' );
