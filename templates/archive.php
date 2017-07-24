<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$queried_object = get_queried_object();

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::get_context();

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
	$context['title'] = 'Archive: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
	$context['title'] = 'Archive: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} else if ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} else if ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

$context['posts_per_page'] = intval(get_option('posts_per_page'));
$context['paged'] = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
  'post_type' => 'post',
  'posts_per_page' => $context['posts_per_page'],
  'paged' => $context['paged']
);

if ( is_category() || is_tag() ) {
  $context['taxonomy'] = $queried_object->taxonomy;
  $context['term_id'] = $queried_object->term_id;

  $args['tax_query'] = array(
    array(
      'taxonomy' => $queried_object->taxonomy,
      'field' => 'term_id',
      'terms' => array($queried_object->term_id)
    )
  );
}

$context['posts'] = Timber::get_posts();

if (count($context['posts']) >= $context['posts_per_page']) {
  $context['have_posts_next'] = true;
} else {
  $context['have_posts_next'] = false;
}

Timber::render( $templates, $context );
