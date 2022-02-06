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
use App\Renderer\MarkdownRenderer;
use React\Filesystem\Filesystem;
use Windwalker\Filesystem\FileObject;
use Windwalker\Filesystem\Path;

use function Windwalker\fs;

/**
 * The MarkdownProcessor class.
 */
class MarkdownProcessor implements ProcessorInterface, ConfigurableProcessorInterface
{
    public function __construct(protected ProcessorFactory $processorFactory, protected EdgeFactory $edgeFactory)
    {
    }

    public function process(Template $template, array $data = []): FileObject
    {
        $destFile = Path::stripExtension((string) $template->getDestFile()) . '.html';
        $template->setDestFile(fs($destFile, $template->getDestFile()->getRoot()));

        /** @var BladeProcessor $edgeProcessor */
        $edgeProcessor = $this->processorFactory->create('blade');
        $edge = $edgeProcessor->getEdgeEngine($template);

        $config = $template->getConfig();
        $layout = $edge->getLoader()->find(str_replace('/', '.', $config['layout'] ?? ''));

        $content = MarkdownRenderer::render($template->getContent());

        $template->setContent(file_get_contents($layout));

        $rendered = $edgeProcessor->render(
            $template,
            compact('content')
        );

        return $template->getDestFile()->write($rendered);
    }
}
