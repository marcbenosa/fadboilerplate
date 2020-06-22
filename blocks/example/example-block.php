<?php
/**
 * [name] Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 * @package fadboilerplate
 */

// Create id attribute allowing for custom "anchor" value.
$id = '[name]-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block-[name]';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Get ACF fields.
$content = get_field( 'content' );
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="block-[name]__container bg-primary text-light p-5">
        <h1>Example Block</h1>
		<div class="block-[name]__text-container">
            <p><?php echo esc_html( $content ); ?></p>
		</div>
	</div>
</section>
