<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Processor;

use App\Data\Template;
use App\Edge\EdgeFactory;
use App\Web\GlobalVariables;
use React\Filesystem\Filesystem;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Exception\EdgeException;

/**
 * The BladeProcessor class.
 */
class BladeProcessor implements ProcessorInterface
{
    public function __construct(protected EdgeFactory $edgeFactory, protected GlobalVariables $globalVariables)
    {
    }

    public function createProcessor(Template $template, array $data = []): \Closure
    {
        return function (Filesystem $filesystem) use ($data, $template) {
            try {
                $content = $this->render($template, $data);
            } catch (EdgeException $e) {
                throw new EdgeException(
                    sprintf(
                        'Error on: %s - %s',
                        $template->getSrc()->getPathname(),
                        $e->getPrevious()->getMessage()
                    ),
                    $e->getCode(),
                    $template->getSrc()->getPathname(),
                    $e->getLine(),
                    $e
                );
            }

            return $filesystem->file((string) $template->getDestFile())->putContents($content);
        };
    }

    /**
     * getEdgeEngine
     *
     * @param  Template  $template
     *
     * @return  Edge
     */
    public function getEdgeEngine(Template $template): Edge
    {
        return $this->edgeFactory->createEdge($template->getDataRoot() . '/layouts');
    }

    /**
     * render
     *
     * @param  Template  $template
     * @param  array     $data
     *
     * @return  string
     *
     * @throws EdgeException
     */
    public function render(Template $template, array $data = []): string
    {
        return $this->getEdgeEngine($template)
            ->render(
                $template->getContent(),
                array_merge(
                    $this->globalVariables->createGlobals($template),
                    $data
                )
            );
    }
}
