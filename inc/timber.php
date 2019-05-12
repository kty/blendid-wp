<?php

$timber = new \Timber\Timber();

if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
  });
  
  add_filter('template_include', function($template) {
    return get_stylesheet_directory() . '/public/no-timber.html';
  });
  
  return;
}

Timber::$dirname = array( 'inc', 'templates', 'templates/views' );

class BlendidStarter extends TimberSite {

  function __construct() {
    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    parent::__construct();
  }

  function register_post_types() {
    //this is where you can register custom post types
  }

  function register_taxonomies() {
    //this is where you can register custom taxonomies
  }

  function add_to_context( $context ) {
    $context['menu'] = new TimberMenu();
    $context['site'] = $this;
    $context['icons_path'] = \App\asset_path( 'img/icons.svg' );

    return $context;
  }

  function orphans( $s ) {
    if (class_exists('\iworks_orphan')) {
      $orphan = new \iworks_orphan();
      return $orphan->replace( $s );
    } else {
      return $s;
    }
  }

  function the_content( $s ) {
    return apply_filters('the_content', $s);
  }

  function the_title( $s ) {
    return apply_filters('the_title', $s);
  }

  function remove_nbsp( $s ) {
    return str_replace('&nbsp;', ' ', $s);
  }

  function add_to_twig( $twig ) {
    /* this is where you can add your own functions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter( new Twig_SimpleFilter( 'asset_path', '\App\asset_path' ) );
    $twig->addFilter( new Twig_SimpleFilter( 'asset_name', '\App\asset_name' ) );
    $twig->addFilter( new Twig_SimpleFilter( 'orphans', array($this, 'orphans') ) );
    $twig->addFilter( new Twig_SimpleFilter( 'the_content', array($this, 'the_content') ) );
    $twig->addFilter( new Twig_SimpleFilter( 'the_title', array($this, 'the_title') ) );
    $twig->addFilter( new Twig_SimpleFilter( 'remove_nbsp', array($this, 'remove_nbsp') ) );

    return $twig;
  }

}

new BlendidStarter();