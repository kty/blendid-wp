<?php

namespace App;

function register_custom_taxonomies() {
  // register_taxonomy('custom_tag', 'post', array(
  //   'labels' => array(
  //     'name' => __('Custom tags', 'blendid'),
  //     'singular_name' => __('Custom tag', 'blendid'),
  //     'all_items' => __('All custom tags', 'blendid'),
  //     'edit_item' => __('Edit custom tag', 'blendid'),
  //     'view_item' => __('View custom tag', 'blendid'),
  //     'update_item' => __('Update custom tag', 'blendid'),
  //     'add_new_item' => __('Add new custom tag', 'blendid'),
  //     'new_item_name' => __('New custom tag name', 'blendid'),
  //     'parent_item' => __('Parent custom tag', 'blendid'),
  //     'search_items' => __('Search custom tags', 'blendid'),
  //     'not_found' => __('No custom tags found', 'blendid')
  //   ),
  //   'public' => true,
  //   'show_in_menu' => true,
  //   'hierarchical' => true,
  //   'rewrite' => array(
  //     'slug' => __('custom-tag', 'blendid')
  //   )
  // ));
}

add_action('init', __NAMESPACE__ . '\register_custom_taxonomies');