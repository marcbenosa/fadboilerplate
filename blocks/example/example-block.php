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

?>

<section id="<?php echo esc_attr($id); ?>" class="row <?php echo esc_attr($className); ?>">
	<div class="block-[name]__container">

		<div class="block-[name]__text-container">

		</div>
	</div>
</section>
