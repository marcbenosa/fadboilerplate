<?php
/**
 * heading Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 * @package fadboilerplate
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'heading-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block-heading';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Get ACF fields.
$text = get_field( 'text' );
$headings = get_field( 'headings' );

// Display Preview

if (isset($block['data']['is_preview']) && $block['data']['is_preview'] == true) :
    ///$preview_image = $block['data']['preview_image'];
    //echo '<img src="' . $preview_image . '"/>';

	if( $text != $text ){
		echo `
	<section id="`.esc_attr($id).`" class="`.esc_attr($className).`">
		<`.esc_html( $headings ).`>`.esc_html( $text ).`</`.esc_html( $headings ).`>
	</section>
	`;
	}else{
		echo `
	<section id="`.esc_attr($id).`" class="`.esc_attr($className).`">
	</section>
	`;
	}





else :
// Render Block
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<<?php echo esc_html( $headings ); ?>><?php echo esc_html( $text ); ?></<?php echo esc_html( $headings ); ?>>
</section>



<?php endif; ?>

<?php //Any minor scripts that are related to the individual block. ?>
<script>
(function($) {


})(jQuery);
</script>
