
<?php

if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
  require_once $composer;
}

/**
* Clear cache route for Timber
*/

Routes::map('clear-cache', function($params){
  $loader = new TimberLoader();
  $loader->clear_cache_timber();
  $loader->clear_cache_twig();
  
  wp_redirect(home_url());
  
  exit;
});

/**
 * Helper function for debugging
 */
function pr() {
  if (func_num_args() < 1) {
    return;
  }

  echo "<pre>";

  foreach (func_get_args() as $value) {
    if(is_scalar($value) || empty($value)) {
      var_dump($value);
    } else {
      print_r($value);
    }
  }

  echo "</pre>";
}

$blendid_includes = [
  'inc/timber.php',
  'inc/helpers.php',
  'inc/setup.php',
  'inc/filters.php',
  'inc/cleanup.php',
  'inc/admin.php',
  'inc/widgets.php',
  'inc/post-types.php',
  'inc/taxonomies.php',
  'inc/extras.php',
  'inc/lang.php',
  'inc/ajax.php'
];

array_walk($blendid_includes, function ($file) {
  if (!locate_template($file, true, true)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'blendid'), $file), E_USER_ERROR);
  }
});
