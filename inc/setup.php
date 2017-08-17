<?php

namespace App;

/**
 * Setup template folder
 */
add_filter('stylesheet', function ($stylesheet) {
  return dirname($stylesheet);
});

add_action('after_switch_theme', function () {
  $stylesheet = get_option('stylesheet');
  if (basename($stylesheet) !== 'templates') {
    update_option('stylesheet', $stylesheet . '/templates');
  }
});

add_action('customize_render_section', function ($section) {
  if ($section->type === 'themes') {
    $section->title = wp_get_theme(basename(__DIR__))->display('Name');
  }
}, 10, 2);

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  wp_deregister_script('jquery');

  wp_enqueue_style('stylesheets/app.css', asset_path('stylesheets/app.css'), false, null);
  wp_enqueue_script('javascripts/app.js', asset_path('javascripts/app.js'), [], null, true);

  $app = array(
    'sitename' => get_bloginfo('name'),
    'themepath' => get_stylesheet_directory_uri(),
    'ajaxurl' => admin_url('admin-ajax.php'),
    'loadingmessage' => __('Loading', 'blendid'),
  );

  wp_localize_script( 'javascripts/app.js', 'blendid', $app);
}, 100);

add_action('admin_enqueue_scripts', function() {
  wp_enqueue_style('stylesheets/admin.css', asset_path('stylesheets/admin.css'), false, null);
});

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
  load_theme_textdomain('blendid', get_template_directory() . '/lang');

  add_theme_support('title-tag');

  add_theme_support( 'menus' );

  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'blendid')
  ]);

  add_theme_support('post-thumbnails');

  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  add_editor_style(asset_path('stylesheets/editor.css'));
});