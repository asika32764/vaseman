<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Service;

use App\Data\ConvertResult;
use App\Data\Template;
use App\Exception\NoConfigException;
use App\Plugin\PluginRegistry;
use App\Processor\ConfigurableProcessorInterface;
use App\Processor\ProcessorFactory;
use App\Web\GlobalVariables;
use React\Filesystem\Filesystem;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Windwalker\DI\Container;
use Windwalker\Filesystem\FileObject;
use Windwalker\Utilities\Cache\InstanceCacheTrait;

/**
 * The LayoutService class.
 */
class LayoutService
{
    use InstanceCacheTrait;

    public function __construct(protected ProcessorFactory $processorFactory, protected Container $container)
    {
    }

    public function createHandler(FileObject $file, FileObject $srcRoot, FileObject $destRoot): \Closure
    {
        return function (Filesystem $filesystem) use ($srcRoot, $destRoot, $file) {
            return $filesystem->getContents($file->getPathname())->then(
                function (string $content) use ($srcRoot, $filesystem, $file, $destRoot) {
                    $extension = $file->getExtension();
                    $processor = $this->processorFactory->create($extension);

                    if ($processor instanceof ConfigurableProcessorInterface) {
                        $tmpl = $this->parseTemplateString($content);
                    } else {
                        $tmpl = new Template();
                    }

                    $tmpl->setSrc($file);
                    $tmpl->setDataRoot($srcRoot);
                    $tmpl->setDestRoot($destRoot);
                    $tmpl->setDestDir($destRoot);
                    $tmpl->setDestFile($destFile = $destRoot->appendPath(DIRECTORY_SEPARATOR . $file->getRelativePathname()));

                    $config = array_merge(
                        $this->getGlobalConfig($srcRoot),
                        $tmpl->getConfig()
                    );
                    $tmpl->setConfig($config);

                    $destFile->getParent()->mkdir();

                    return $processor->createProcessor($tmpl)($filesystem)?->then(fn () => $tmpl);
                }
            );
        };
    }

    public function parseTemplateString(string $template): Template
    {
        if (trim($template) === '') {
            return (new Template([]))
                ->setContent('')
                ->setConfig([]);
        }

        $templateParts = explode('---', $template, 3);
        $config = [];

        try {
            if (\count($templateParts) !== 3) {
                throw new NoConfigException('No config');
            }

            $config = (array) (Yaml::parse($templateParts[1]) ?: []);

            if ($config) {
                array_shift($templateParts);
                array_shift($templateParts);
            }

            $template = implode('---', $templateParts);
        } catch (ParseException|NoConfigException) {
            $template = implode('---', $templateParts);
        }

        return (new Template([]))
            ->setContent($template)
            ->setConfig($config)
            ->setPermalink($config['permalink'] ?? '');
    }

    /**
     * getBackwards
     *
     * @param string $path
     *
     * @return  string
     */
    public static function getBackwards(string $path): string
    {
        $path = explode('/', $path);
        array_pop($path);

        return str_repeat('../', count($path));
    }

    public function getGlobalConfig(FileObject $srcRoot): array
    {
        return $this->once(
            'config',
            function () use ($srcRoot) {
                $config = [];

                if (is_file($srcRoot . '/config.php')) {
                    $config = include $srcRoot . '/config.php';
                }

                return (array) $config;
            }
        );
    }
}
