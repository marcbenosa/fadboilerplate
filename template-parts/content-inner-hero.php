<?php
/**
 * Inner Hero Header Area
 * Uses ACF Fieldset "Inner Hero"
 *
 * @package fadboilerplate
 */


  if( is_home() || is_singular('post') || is_category() ) {
    $hero_image   = get_field('hero_image', get_option('page_for_posts') );
    $hero_title   = get_field('hero_title', get_option('page_for_posts') );
  } else {
    $hero_image = get_field('hero_image');
    $hero_title = get_field('hero_title');
  }

?>

<div class="inner-hero">
	<div class="inner-hero__row">
		<div class="bg-image-cover-padded inner-hero__col" style="background-image:url();">

			<div class="inner-hero__title">
				<h1><?php the_title(); ?></h1>
			</div>

		</div>

	</div>
</div>
