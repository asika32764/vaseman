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

    public function createProcessor(Template $template, array $data = []): \Closure
    {
        $destFile = Path::stripExtension((string) $template->getDestFile()) . '.html';
        $template->setDestFile(fs($destFile, $template->getDestFile()->getRoot()));

        return function (Filesystem $filesystem) use ($template) {
            /** @var BladeProcessor $edgeProcessor */
            $edgeProcessor = $this->processorFactory->create('blade');
            $edge = $edgeProcessor->getEdgeEngine($template);

            $config = $template->getConfig();
            $layout = $edge->getLoader()->find(str_replace('/', '.', $config['layout'] ?? ''));

            return $filesystem->getContents($layout)->then(
                function ($wrapper) use ($edgeProcessor, $filesystem, $template) {
                    $content = MarkdownRenderer::render($template->getContent());

                    $template->setContent($wrapper);

                    $rendered = $edgeProcessor->render(
                        $template,
                        compact('content')
                    );

                    return $filesystem->file((string) $template->getDestFile())->putContents($rendered);
                }
            );
        };
    }
}
