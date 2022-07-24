<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Data;

use Windwalker\Data\ValueObject;
use Windwalker\Filesystem\FileObject;

/**
 * The Template class.
 */
class Template extends ValueObject
{
    public FileObject $src;

    public FileObject $dataRoot;

    public FileObject $destRoot;

    public FileObject $destDir;

    public FileObject $destFile;

    public string $content = '';

    public array $config = [];

    public string $permalink = '';

    public bool $skip = false;

    /**
     * @return string
     */
    public function &getContent(): string
    {
        return $this->content;
    }

    /**
     * @param  string  $content
     *
     * @return  static  Return self to support chaining.
     */
    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function &getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param  array  $config
     *
     * @return  static  Return self to support chaining.
     */
    public function setConfig(array $config): static
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return string
     */
    public function &getPermalink(): string
    {
        return $this->permalink;
    }

    /**
     * @param  string  $permalink
     *
     * @return  static  Return self to support chaining.
     */
    public function setPermalink(string $permalink): static
    {
        $this->permalink = $permalink;

        return $this;
    }

    /**
     * @return FileObject
     */
    public function getSrc(): FileObject
    {
        return $this->src;
    }

    /**
     * @param  FileObject  $src
     *
     * @return  static  Return self to support chaining.
     */
    public function setSrc(FileObject $src): static
    {
        $this->src = $src;

        return $this;
    }

    /**
     * @return FileObject
     */
    public function getDestDir(): FileObject
    {
        return $this->destDir;
    }

    /**
     * @param  FileObject  $destDir
     *
     * @return  static  Return self to support chaining.
     */
    public function setDestDir(FileObject $destDir): static
    {
        $this->destDir = $destDir;

        return $this;
    }

    /**
     * @return FileObject
     */
    public function getDestFile(): FileObject
    {
        return $this->destFile;
    }

    /**
     * @param  FileObject  $destFile
     *
     * @return  static  Return self to support chaining.
     */
    public function setDestFile(FileObject $destFile): static
    {
        $this->destFile = $destFile;

        return $this;
    }

    /**
     * @return FileObject
     */
    public function getDestRoot(): FileObject
    {
        return $this->destRoot;
    }

    /**
     * @param  FileObject  $destRoot
     *
     * @return  static  Return self to support chaining.
     */
    public function setDestRoot(FileObject $destRoot): static
    {
        $this->destRoot = $destRoot;

        return $this;
    }

    /**
     * @return FileObject
     */
    public function getDataRoot(): FileObject
    {
        return $this->dataRoot;
    }

    /**
     * @param  FileObject  $dataRoot
     *
     * @return  static  Return self to support chaining.
     */
    public function setDataRoot(FileObject $dataRoot): static
    {
        $this->dataRoot = $dataRoot;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSkip(): bool
    {
        return $this->skip;
    }

    /**
     * @param bool $skip
     *
     * @return  static  Return self to support chaining.
     */
    public function setSkip(bool $skip): static
    {
        $this->skip = $skip;

        return $this;
    }
}
