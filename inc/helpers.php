<?php

namespace App;

use Blendid\Starter\Asset;
use Blendid\Starter\Assets\JsonManifest;

/**
 * @param $filename
 * @return string
 */
function asset_path($filename) {
  static $manifest;
  
  isset($manifest) || $manifest = new JsonManifest(get_template_directory() . '/' . Asset::$dist . '/rev-manifest.json');

  return (string) new Asset($filename, $manifest);
}

/**
 * Returns the revisioned asset, without the full path (URI)
 * @param  [type] $filename [description]
 * @return [type]           [description]
 */
function asset_name($filename) {
  static $manifest;
  
  isset($manifest) || $manifest = new JsonManifest(get_template_directory() . '/' . Asset::$dist . '/rev-manifest.json');

  return (new Asset($filename, $manifest))->getFilename();
}
