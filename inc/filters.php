<?php

namespace App;

/**
* Add <body> classes
*/
add_filter('body_class', function (array $classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  return $classes;
});

/**
* Add "… Continued" to the excerpt
*/
add_filter('excerpt_more', function () {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'blendid') . '</a>';
});

function acf_json_save_point( $path ) {
  // update path
  $path = get_stylesheet_directory() . '/acf-json';

  // return
  return $path;
}

add_filter('acf/settings/save_json', __NAMESPACE__ . '\acf_json_save_point');

function acf_json_load_point( $paths ) {
  // remove original path (optional)
  unset($paths[0]);

  // append path
  $paths[] = get_stylesheet_directory() . '/acf-json';

  // return
  return $paths;
}

add_filter('acf/settings/load_json', __NAMESPACE__ . '\acf_json_load_point');

// Remove the plugin credit/notice from The SEO Framework
add_filter('the_seo_framework_indicator', '__return_false');