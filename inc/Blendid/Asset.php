<?php

namespace Blendid\Starter;

use Blendid\Starter\Assets\ManifestInterface;

/**
 * Class Template
 * @package Roots\Sage
 * @author QWp6t
 */
class Asset
{
    public static $dist = '/public';

    /** @var ManifestInterface Currently used manifest */
    protected $manifest;

    protected $asset;

    protected $dir;

    public function __construct($file, ManifestInterface $manifest = null)
    {
        $this->manifest = $manifest;
        $this->asset = $file;
    }

    public function __toString()
    {
        return $this->getUri();
    }

    public function getUri()
    {
        $file = ($this->manifest ? $this->manifest->get($this->asset) : $this->asset);
        return get_template_directory_uri() . self::$dist . "/$file";
    }

    // Returns the original filename, revisioned through manifest
    public function getFilename()
    {
        $file = ($this->manifest ? $this->manifest->get($this->asset) : $this->asset);
        return $file;
    }
}
