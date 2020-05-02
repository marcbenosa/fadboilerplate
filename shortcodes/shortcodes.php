<?php 

/**
 * Functions for the CTA buttons
 * @param  array $atts    Array containing:
 *                        'link' => The url for the button
 *                        'class' => additional classes for the button. Seperate with spaces.
 * @param  string $content The text inside the button
 * @return string          The html for the button
 */
function fadboilerplatetheme_button_shortcode( $atts, $content = null ) {
  $a = shortcode_atts( array(
        'link' => '',
        'class' => '',
        'target' => ''
    ), $atts );

    if(substr($a['link'], 0, 4) != "http") {
      $a['link'] = site_url( $a['link'] );
    }

    ob_start();
  ?>
    <div class="cta-button <?php echo $a['class']; ?>">
      <a class="fadboilerplatetheme-button" href="<?php echo $a['link']; ?>" target="<?php echo $a['target']; ?>">
        <?php echo $content; ?>
      </a>
    </div>
  <?php
  return ob_get_clean();
}
// [fadboilerplatetheme_button class="" link=""]Button Text[/fadboilerplatetheme_button]
add_shortcode( 'fadboilerplatetheme_button', 'fadboilerplatetheme_button_shortcode' );
add_shortcode( 'fadboilerplatetheme_btn', 'fadboilerplatetheme_button_shortcode' );