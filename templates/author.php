<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
global $wp_query;

$context = Timber::get_context();
  
$context['posts_per_page'] = intval(get_option('posts_per_page'));
$context['paged'] = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
  'post_type' => 'post',
  'posts_per_page' => $context['posts_per_page'],
  'paged' => $context['paged']
);

if ( isset( $wp_query->query_vars['author'] ) ) {
  $author = new TimberUser( $wp_query->query_vars['author'] );

  $context['author'] = $author;
  $context['title'] = __('Author', 'blendid') . ': ' . $author->name();
}

$context['posts'] = Timber::get_posts($args);

if (count($context['posts']) >= $context['posts_per_page']) {
  $context['have_posts_next'] = true;
} else {
  $context['have_posts_next'] = false;
}

Timber::render( array( 'author.twig', 'archive.twig', 'index.twig' ), $context );
