<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );
$context = Timber::get_context();

$context['posts_per_page'] = intval(get_option('posts_per_page'));
$context['paged'] = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$context['search'] = get_search_query();

$context['title'] = sprintf(__('Search results for %s', 'blendid'), get_search_query());
$context['posts'] = Timber::get_posts();

if (count($context['posts']) >= $context['posts_per_page']) {
  $context['have_posts_next'] = true;
} else {
  $context['have_posts_next'] = false;
}

Timber::render( $templates, $context );
