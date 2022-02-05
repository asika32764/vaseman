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
use FilesystemIterator;
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
    description: 'Generate pages.'
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

        $command->addOption(
            'hard',
            null,
            InputOption::VALUE_NONE,
            'Hard copy link files.'
        );

        $command->addOption(
            'strict',
            's',
            InputOption::VALUE_NONE,
            'Use strict mode to show errors.'
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
        $strict = $io->getOption('strict');

        if ($strict) {
            error_reporting(E_ALL);
        }

        $root = $io->getArgument('root');

        if (!$root || $root === '.') {
            $root = $workingDir;
        }
        
        $root = fs(Path::realpath($root));
        $dataRoot = $root->appendPath('/.vaseman');
        $configFile = $dataRoot->appendPath('/config.php');

        define('PROJECT_ROOT', $root->getPathname());
        define('PROJECT_DATA_ROOT', $dataRoot->getPathname());

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

        // Convert
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
            $destFolder = $root->appendPath('/' . $destFolder);
            $files = Filesystem::files(
                $dataRoot . '/' . $srcFolder,
                true,
                FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_FILEINFO
                | FilesystemIterator::FOLLOW_SYMLINKS
            );

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

        // Links
        $hard = $io->getOption('hard');
        $links = $config['links'] ?? [];

        foreach ($links as $srcFolder => $destFolder) {
            $dataRoot = fs($dataRoot);
            $destFolder = $root->appendPath('/' . $destFolder);
            $root->isLink();

            if ($destFolder->isLink()) {
                if (PHP_WINDOWS_VERSION_MAJOR) {
                    rmdir($destFolder->getPathname());
                } else {
                    unlink($destFolder->getPathname());
                }
            }

            if ($hard) {
                // $destFolder->deleteIfExists();

                $files = Filesystem::files(
                    $dataRoot . '/' . $srcFolder,
                    true,
                    FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_FILEINFO
                    | FilesystemIterator::FOLLOW_SYMLINKS
                );

                foreach ($files as $file) {
                    $destFile = fs($destFolder . '/' . $file->getRelativePathname());

                    if (!$destFile->exists() || (string) $destFile->read() !== (string) $file->read()) {
                        $file->copyTo($destFile);
                        $io->writeln('[<info>Copy</info>]: ' . $file->getRelativePathname());
                    }
                }
            } else {
                $destFolder->deleteIfExists();

                Filesystem::symlink($dataRoot . '/' . $srcFolder, $destFolder->getPathname());

                $io->writeln('[<info>Link</info>]: ' . $destFolder->getRelativePathname($root));
            }
        }

        $io->newLine();

        // $io->style()->success('Generate Completed.');

        return 0;
    }
}
