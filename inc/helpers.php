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