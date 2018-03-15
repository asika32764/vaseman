<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Asset;

use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Path;

/**
 * The Entry class.
 *
 * @since  {DEPLOY_VERSION}
 */
class Asset
{
    /**
     * Property name.
     *
     * @var string
     */
    protected $name;

    /**
     * Property path.
     *
     * @var  string
     */
    protected $path;

    /**
     * Property root.
     *
     * @var  string
     */
    protected $root;

    /**
     * Property file.
     *
     * @var \SplFileInfo
     */
    protected $fileInfo;

    /**
     * Class init.
     *
     * @param string $path
     * @param string $root
     */
    public function __construct($path, $root)
    {
        $this->root = $root;
        $this->path = ltrim(str_replace(realpath($root), '', realpath($path)), '/\\');

        $this->fileInfo = new \SplFileInfo($root . '/' . $path);

        $this->name = File::stripExtension($this->fileInfo->getBasename());
        $this->type = $this->fileInfo->getExtension();
    }

    /**
     * Method to get property Name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Method to get property Path
     *
     * @return  string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Method to get property Root
     *
     * @return  string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Method to get property FileInfo
     *
     * @return  \SplFileInfo
     */
    public function getFileInfo()
    {
        return $this->fileInfo;
    }

    /**
     * getRoute
     *
     * @return  string
     */
    public function getRoute()
    {
        if ($this->name == 'index' || $this->name == 'default') {
            $route = dirname($this->path);

            return Path::clean($route == '.' ? null : $route, '/');
        }

        return Path::clean(File::stripExtension($this->path), '/');
    }
}
