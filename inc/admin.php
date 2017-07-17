<?php

namespace App;

function mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', __NAMESPACE__ . '\mce_buttons_2' );

function mce_before_init_insert_formats( $init_array ) {
  $style_formats = array(
    array(
      'title' => 'Intro',
      'inline' => 'span',
      'classes' => 'lead'
    )
  );

  $init_array['style_formats'] = json_encode( $style_formats );  

  return $init_array;
} 
add_filter( 'tiny_mce_before_init', __NAMESPACE__ . '\mce_before_init_insert_formats' );

function add_option_pages() {
  if ( function_exists('acf_add_options_page') ) {
    acf_add_options_sub_page(array(
      'page_title'  => __('Theme settings', 'blendid'),
      'menu_title'  => __('Theme settings', 'blendid'),
      'menu_slug'   => 'theme-settings',
      'parent_slug' => 'options-general.php'
    ));
  }
}

add_action('after_setup_theme', __NAMESPACE__ . '\add_option_pages', 11);

// Disable br and paragraphs in shortcodes
add_filter( 'the_content', 'shortcode_unautop' );