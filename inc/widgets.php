<?php

namespace App;

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
  $config = [
    'before_widget' => '<section class="widget frame %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="title"><span>',
    'after_title'   => '</span></div>'
  ];
  register_sidebar([
    'name'          => __('Primary', 'blendid'),
    'id'            => 'sidebar-primary'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer', 'blendid'),
    'id'            => 'sidebar-footer'
  ] + $config);
});