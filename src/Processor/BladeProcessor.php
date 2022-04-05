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
use Windwalker\Filesystem\FileObject;

/**
 * The BladeProcessor class.
 */
class BladeProcessor implements ProcessorInterface, ConfigurableProcessorInterface
{
    public function __construct(protected EdgeFactory $edgeFactory, protected GlobalVariables $globalVariables)
    {
    }

    public function process(Template $template, array $data = []): FileObject
    {
        try {
            $content = $this->render($template, $data);
        } catch (EdgeException $e) {
            throw new EdgeException(
                "Error when render: {$template->getSrc()->getPathname()} - " .
                $e->getMessage(),
                $e->getCode(),
                $e->getFile(),
                $e->getLine(),
                $e
            );
        }

        return $template->getDestFile()->write($content);
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
        return $this->edgeFactory->createEdge(
            $template->getDataRoot() . '/layouts',
            $template
        );
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
