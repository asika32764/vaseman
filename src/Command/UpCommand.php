<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Command;

use App\Data\Template;
use App\Plugin\PluginRegistry;
use App\Service\LayoutService;
use React\EventLoop\Loop;
use React\Filesystem\Filesystem as ReactFilesystem;
use React\Promise\PromiseInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Windwalker\Console\CommandInterface;
use Windwalker\Console\CommandWrapper;
use Windwalker\Console\Input\InputOption;
use Windwalker\Console\IOInterface;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Filesystem\Filesystem;
use Windwalker\Filesystem\Path;

use function React\Promise\all;
use function Windwalker\fs;

/**
 * The UpCommand class.
 */
#[CommandWrapper(
    description: ''
)]
class UpCommand implements CommandInterface
{
    protected ?\Throwable $exception = null;

    public function __construct(
        protected ConsoleApplication $app,
        protected LayoutService $layoutService,
        protected PluginRegistry $pluginRegistry
    ) {
    }

    /**
     * configure
     *
     * @param  Command  $command
     *
     * @return  void
     */
    public function configure(Command $command): void
    {
        $command->addArgument(
            'root',
            InputArgument::OPTIONAL,
            'The project root.'
        );

        $command->addOption(
            'dir',
            'd',
            InputOption::VALUE_REQUIRED,
            'Directory to convert.'
        );
    }

    /**
     * Executes the current command.
     *
     * @param  IOInterface  $io
     *
     * @return  int Return 0 is success, 1-255 is failure.
     */
    public function execute(IOInterface $io): int
    {
        $io->style()->title('Start generating site');

        $workingDir = $this->app->config('project.working_dir') ?? getcwd();
        $root = $io->getArgument('root');

        if (!$root || $root === '.') {
            $root = $workingDir;
        }

        $root = fs($root);
        $dataRoot = $root->appendPath('/.vaseman');
        $configFile = $dataRoot->appendPath('/config.php');

        if (!$dataRoot->isDir()) {
            throw new \RuntimeException(
                sprintf(
                    '%s is not a Vaseman project.',
                    $dataRoot->getPathname()
                )
            );
        }

        /** @var \Composer\Autoload\ClassLoader $loader */
        $loader = include WINDWALKER_VENDOR . '/autoload.php';
        $loader->addPsr4('App\\', $dataRoot . '/src/');

        $config = include $configFile->getPathname();
        $folders = $config['folders'] ?? [];

        $loop = Loop::get();
        $filesystem = ReactFilesystem::create($loop);

        $promises = [];

        $config = $this->layoutService->getGlobalConfig($dataRoot);

        foreach ($config['plugins'] ?? [] as $plugin) {
            $this->pluginRegistry->add($plugin);
        }

        foreach ($folders as $srcFolder => $destFolder) {
            $dataRoot = fs($dataRoot);
            $destFolder = fs(Path::realpath($destFolder ?: '.'));
            $files = Filesystem::files($dataRoot . '/' . $srcFolder, true);

            foreach ($files as $file) {
                $io->writeln('[<comment>Prepare</comment>]: ' . $file->getRelativePathname());

                $handler = $this->layoutService->createHandler($file, $dataRoot, $destFolder);

                /** @var PromiseInterface $promise */
                $promise = $handler($filesystem);

                $promises[] = $promise
                    ->then(
                        function (Template $tmpl) use ($root, $io) {
                            $io->writeln(
                                '[<info>Rendered</info>]: ' . $tmpl->getDestFile()->getRelativePathname($root)
                            );

                            return $tmpl;
                        },
                    );
            }
        }

        all($promises)->then(
            function () use ($loop) {
                $loop->stop();
            },
            function (\Throwable $e) use ($loop) {
                $this->exception = $e;
                $loop->stop();
            }
        );

        $loop->run();

        if ($this->exception) {
            throw $this->exception;
        }

        $io->newLine();

        // $io->style()->success('Generate Completed.');

        return 0;
    }
}
