<?php

/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Event;

use Windwalker\Event\AbstractEvent;
use Windwalker\Filesystem\FileObject;

/**
 * The AfterProcessEvent class.
 */
class AfterProcessEvent extends AbstractEvent
{
    use ProcessEventTrait;

    protected FileObject $destFile;

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
}
