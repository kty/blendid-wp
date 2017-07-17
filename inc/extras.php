<?php

namespace App;

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

add_action( 'wp_head', __NAMESPACE__ . '\track_post_views');

// Add row shortcode
function row_shortcode($atts, $content = null) {
  $content = str_replace(array('<br />', '<br>'), '', $content);

  return '<div class="row">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'row', __NAMESPACE__ . '\row_shortcode' );

// Add column shortcode
function column_shortcode($atts, $content = null) {
  $content = str_replace(array('<br />', '<br>'), '', $content);
  
  return '<div class="col-sm-' . $atts['size'] . '">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'col', __NAMESPACE__ . '\column_shortcode' );

// Add product shortcode
function product_shortcode($atts) {
  ob_start();
  ?>
  <div class="product">
    <a href="<?php echo $atts['link']; ?>">
      <img src="<?php echo $atts['image']; ?>">
      <p><?php echo $atts['text']; ?></p>
      <button class="btn btn-primary"><?php _e('See product', 'blendid'); ?></button>
    </a>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode( 'product', __NAMESPACE__ . '\product_shortcode' );

function button_shortcode($atts, $content = null) {
  return '<a class="btn btn-primary" href="' . $atts['link'] . '">' . $content . '</a>';
}

add_shortcode('button', __NAMESPACE__ . '\button_shortcode');