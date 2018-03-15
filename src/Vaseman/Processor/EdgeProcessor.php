<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Processor;

use Vaseman\Edge\VasemanEdgeLoader;
use Windwalker\Core\Renderer\EdgeRenderer;
use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Edge\Cache\EdgeArrayCache;
use Windwalker\Edge\Exception\EdgeException;
use Windwalker\Filesystem\File;
use Windwalker\Utilities\Queue\PriorityQueue;

/**
 * The TwigProcessor class.
 *
 * @since  {DEPLOY_VERSION}
 */
class EdgeProcessor extends AbstractEngineProcessor
{
    /**
     * Property ext.
     *
     * @var  string
     */
    protected $ext = '.edge.php';

    /**
     * render
     *
     * @return  string
     * @throws EdgeException
     */
    public function doRender()
    {
        $renderer = $this->getRenderer();

        $layout = $this->getLayout();

        if (substr($layout, -\strlen($this->ext)) === $this->ext) {
            $layout = substr($layout, 0, -\strlen($this->ext));
        }

        try {
            return $renderer->render($layout, (array) $this->data);
        } catch (EdgeException $e) {
            $message = $this->renderException($e);

            throw new EdgeException($message, $e->getCode(), $e->getFile(), $e->getLine(), $e);
        }
    }

    /**
     * Method to get property Renderer
     *
     * @return  EdgeRenderer
     */
    public function getRenderer()
    {
        if (!$this->renderer) {
            $renderer = $this->renderer = RendererHelper::getEdgeRenderer();
            $renderer->addPath($this->getRoot(), PriorityQueue::HIGH);

            $loader = new VasemanEdgeLoader($this->renderer->getPaths()->toArray());
            $loader->setProcessor($this);

            $renderer->setCache(new EdgeArrayCache)
                ->setLoader($loader);
        }

        return $this->renderer;
    }

    /**
     * Method to get property Target
     *
     * @return  string
     */
    public function getTarget()
    {
        if (!$this->target) {
            $layout = $this->getLayout();

            $this->target = substr($layout, 0, -strlen($this->ext));

            $this->target = File::stripExtension($this->target) . '.html';
        }

        return $this->target;
    }

    /**
     * renderException
     *
     * @param \Exception|\Throwable $e
     *
     * @return  string
     *
     * @since  __DEPLOY_VERSION__
     */
    protected function renderException($e)
    {
        $lines = file($e->getFile());
        $count = \count($lines);

        $line = $e->getLine();
        $start = $line - 3;

        if ($start <= 0) {
            $start = 0;
        }

        $end = $line + 3;

        if ($end > $count) {
            $end = $count;
        }

        $view = '';

        foreach (range($start, $end) as $i) {
            $l = trim($lines[$i], "\n\r");

            if ($i - 1 === $line) {
                $l .= ' <---- (THIS LINE)';
            }

            $view .= $l . "\n";
        }
        
        return <<<TEXT
{$e->getMessage()} ({$e->getLine()})

---------
$view
---------
TEXT;
    }
}
