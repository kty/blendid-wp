<?php

namespace App;

use Timber;

/**
* To keep the count accurate, lets get rid of prefetching
*/
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
* Count number of views on posts
*/

function set_post_views($post_id) {
  $key = 'post_views';
  $count = get_field($key, $post_id);

  if ($count == "") {
    $count = 0;
  } else {
    $count++;
  }

  update_field($key, $count, $post_id);
}

/**
* Track number of views on posts
*/

function track_post_views($post_id) {
  if (!is_single()) return;

  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }

  set_post_views($post_id);
}

add_action( 'wp_head', __NAMESPACE__ . '\track_post_views' );

// Add row shortcode
function row_shortcode($atts, $content = null) {
  $content = strip_tags($content);

  return '<div class="row">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'row', __NAMESPACE__ . '\row_shortcode' );

// Add column shortcode
function column_shortcode($atts, $content = null) {
  $content = strip_tags($content);
  
  return '<div class="mb-4 col-sm-' . $atts['size'] . '">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'col', __NAMESPACE__ . '\column_shortcode' );

// Add product shortcode
function product_shortcode($atts) {
  $url = esc_url($atts['url']);
  $image = esc_url($atts['image']);
  $text = sanitize_text_field($atts['text']);

  return Timber::compile( 'shortcodes/product.twig',
    array(
      'url' => $url,
      'image' => $image,
      'text' => $text
    )
  );
}

add_shortcode( 'product', __NAMESPACE__ . '\product_shortcode' );

function button_shortcode($atts, $content = null) {
  $url = esc_url($atts['url']);
  $text = sanitize_text_field($content);

  return Timber::compile( 'shortcodes/button.twig',
    array(
      'url' => $url,
      'text' => $text
    )
  );
}

add_shortcode( 'button', __NAMESPACE__ . '\button_shortcode' );

function youtube_shortcode($atts) {
  if (isset($atts['id'])) {
    $id = sanitize_text_field($atts['id']);
  } else {
    $id = false;
  }

  return Timber::compile('shortcodes/youtube.twig', array('id' => $id));
}

add_shortcode( 'youtube', __NAMESPACE__ . '\youtube_shortcode' );
