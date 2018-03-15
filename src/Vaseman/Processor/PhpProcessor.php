<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Vaseman\Processor;

use Windwalker\Core\Renderer\PhpRenderer;
use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\String\StringHelper;

/**
 * The PhpProcessor class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PhpProcessor extends AbstractEngineProcessor
{
    /**
     * render
     *
     * @return  string
     */
    public function doRender()
    {
        $filename = $this->file->getFilename();

        if (StringHelper::endsWith($filename, '.edge.php')) {
            $subProcessor = AbstractFileProcessor::getInstance('edge', $this->file, $this->root, $this->folder);
            $subProcessor->setData($this->getData());
            $subProcessor->config->load($this->config->toArray());

            $this->target = $subProcessor->getTarget();

            return $this->output = $subProcessor->render();
        } elseif (StringHelper::endsWith($filename, '.blade.php')) {
            $subProcessor = AbstractFileProcessor::getInstance('blade', $this->file, $this->root, $this->folder);
            $subProcessor->setData($this->getData());
            $subProcessor->config->load($this->config->toArray());

            $this->target = $subProcessor->getTarget();

            return $this->output = $subProcessor->render();
        }

        throw new \LogicException('Not support pure php file now.');
    }

    /**
     * Method to get property Renderer
     *
     * @return  PhpRenderer
     */
    public function getRenderer()
    {
        if (!$this->renderer) {
            $this->renderer = RendererHelper::getPhpRenderer();
        }

        return $this->renderer;
    }
}
