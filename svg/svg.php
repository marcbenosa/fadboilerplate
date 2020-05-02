<?php
/**
 * SVG Handler functions for easy use in themes.
 */

function return_svg($svg) {

	$return = file_get_contents( get_template_directory() . "/svg/" . $svg .".svg");
	return $return;
}

function echo_svg($svg) {

	$return = file_get_contents( get_template_directory() . "/svg/" . $svg .".svg");
	echo $return;
}


?>
