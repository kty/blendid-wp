<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}

$context = Timber::get_context();

$context['posts_per_page'] = intval(get_option('posts_per_page'));
$context['paged'] = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
  'post_type' => 'post',
  'posts_per_page' => $context['posts_per_page'],
  'paged' => $context['paged']
);

$context['posts'] = Timber::get_posts($args);

if (count($context['posts']) >= $context['posts_per_page']) {
  $context['have_posts_next'] = true;
} else {
  $context['have_posts_next'] = false;
}

$templates = array( 'index.twig' );
if ( is_home() ) {
  array_unshift( $templates, 'home.twig' );
}

Timber::render( $templates, $context );