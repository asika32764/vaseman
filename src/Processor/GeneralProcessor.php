<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace App\Processor;

/**
 * The CopyProcessor class.
 *
 * @since  {DEPLOY_VERSION}
 */
class GeneralProcessor extends AbstractFileProcessor
{
    /**
     * render
     *
     * @return  string
     */
    public function render(): string
    {
        return $this->output = file_get_contents($this->file->getPathname());
    }
}
