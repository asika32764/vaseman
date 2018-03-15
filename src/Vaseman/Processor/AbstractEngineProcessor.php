<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Vaseman\Processor;

use Vaseman\View\Page\PageHtmlView;
use Windwalker\Filesystem\File;
use Windwalker\Renderer\AbstractRenderer;
use Windwalker\Structure\Structure;
use Windwalker\Utilities\Queue\PriorityQueue;

/**
 * The AbstractEngineProcessor class.
 *
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractEngineProcessor extends AbstractFileProcessor
{
    /**
     * Property renderer.
     *
     * @var  AbstractRenderer
     */
    protected $renderer;

    /**
     * render
     *
     * @return  string
     */
    public function render()
    {
        $output = $this->doRender();

        return $this->output = $this->renderParentLayout($output);
    }

    /**
     * doRender
     *
     * @return  string
     */
    abstract protected function doRender();

    /**
     * renderLayout
     *
     * @param string $content
     *
     * @return  string
     */
    protected function renderParentLayout($content = null)
    {
        $data = $this->getData();

        $data->content = $content;

        $config = new Structure($data->config);

        if (!$config['layout']) {
            return $content;
        }

        $layout = $config['layout'];
        $data->config['layout'] = null;
        $config['layout'] = null;

        $view = new PageHtmlView;

        $view->setPath($config['path.templates']);
        $view->addPath($config['path.templates'], PriorityQueue::HIGH);
        $view->getData()->bind($data);

        $this->processor = $processor = $view->setLayout($layout)->setConfig($config)->render();

        return $processor->getOutput();
    }

    /**
     * Method to get property Target
     *
     * @return  string
     */
    public function getTarget()
    {
        if (!$this->target) {
            $this->target = ltrim($this->getLayout(), '\\/');

            $this->target = File::stripExtension($this->target) . '.html';
        }

        return $this->target;
    }

    /**
     * Method to get property Renderer
     *
     * @return  AbstractRenderer
     */
    abstract public function getRenderer();

    /**
     * Method to set property renderer
     *
     * @param   AbstractRenderer $renderer
     *
     * @return  static  Return self to support chaining.
     */
    public function setRenderer(AbstractRenderer $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }
}
