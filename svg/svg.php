<?php
/**
 * SVG Handler functions for easy use in themes.
 */

function return_svg($svg) {

	$return = file_get_contents( get_template_directory() . "/svg/" . $svg .".svg");
	return $return;
}

function echo_svg($svg) {

	echo return_svg($svg);
}

function return_svg_find_replace($svg, $find, $replace) {
	$return = file_get_contents( get_template_directory() . "/svg/" . $svg .".svg");
	$return = str_replace ( $find , $replace , $return );
	return $return;
}

function echo_svg_find_replace($svg, $find, $replace) {
	echo return_svg_find_replace($svg, $find, $replace);
}

?>
