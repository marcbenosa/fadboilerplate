<?php

/**
 * Add a Theme Options page if it exists 
 * Default Theme Option
 */
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page( array(
    'page_title'  => 'Theme Options',
    'menu_title'  => 'Theme Options',
    'menu_slug'   => 'acf-options-theme-options',
    'capability'  => 'edit_posts',
    'icon_url'    => 'dashicons-list-view' // Add this line and replace the second inverted commas with class of the icon you like

  ));
}