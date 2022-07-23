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
use App\Event\AfterProcessEvent;
use App\Event\BeforeProcessEvent;
use App\Plugin\PluginRegistry;
use App\Service\LayoutService;
use App\Web\AssetService;
use Composer\Autoload\ClassLoader;
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

        $command->addArgument(
            'dest',
            InputArgument::OPTIONAL,
            'The dest to output site.'
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
            'asset-version',
            'a',
            InputOption::VALUE_OPTIONAL,
            'Append version suffix to assets path.',
            false
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
        $dest = $io->getArgument('dest');

        if (!$root || Path::isRelative($root)) {
            $root = $workingDir . DIRECTORY_SEPARATOR . $root;
        }

        $root = fs(Path::realpath($root));

        if ($dest) {
            $dataRoot = $root->appendPath('/.vaseman');

            if (Path::isRelative($dest)) {
                $dest = $workingDir . DIRECTORY_SEPARATOR . $dest;
            }

            $root = fs($dest);
        } else {
            $dataRoot = $root->appendPath('/.vaseman');
        }

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

        $vendorAutoload = $dataRoot->appendPath('/vendor/autoload.php');

        if ($vendorAutoload->isFile()) {
            include $vendorAutoload->getPathname();
        }

        /** @var \Composer\Autoload\ClassLoader $loader */
        $loader = $this->app->service(ClassLoader::class);
        $loader->addPsr4('App\\', $dataRoot . '/src/');

        $config = $this->layoutService->fetchGlobalConfig($dataRoot);

        // Assets
        $av = $io->getOption('asset-version');

        if ($av !== false) {
            $config['assets']['append_version'] = true;

            if ($av !== null) {
                $config['assets']['version'] = $av;
            }
        }

        $this->layoutService->setGlobalConfig($config);

        // Convert
        $folders = $config['folders'] ?? [];

        // Plugins
        foreach ($config['plugins'] ?? [] as $plugin) {
            $this->pluginRegistry->add($plugin);
        }

        foreach ($folders as $srcFolder => $destFolder) {
            $dataRoot = fs($dataRoot);
            $destFolder = $root->appendPath('/' . $destFolder);
            $files = Filesystem::files(
                $dataRoot . '/' . $srcFolder,
                true,
                FilesystemIterator::FOLLOW_SYMLINKS
            );

            foreach ($files as $file) {
                // $io->writeln('[<comment>Prepare</comment>]: ' . $file->getRelativePathname());

                $tmpl = $this->layoutService->handle($file, $dataRoot, $destFolder);

                $io->writeln(
                    '[<info>Rendered</info>]: ' . $tmpl->getDestFile()->getRelativePathname($root)
                );
            }
        }

        // Links
        $hard = $io->getOption('hard');
        $links = $config['links'] ?? [];

        foreach ($links as $srcFolder => $destFolder) {
            $dataRoot = fs($dataRoot);
            $destFolder = $root->appendPath('/' . $destFolder);

            if ($destFolder->isLink()) {
                if (defined('PHP_WINDOWS_VERSION_MAJOR')) {
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

                        $template = (new Template())
                            ->setSrc($file)
                            ->setDestRoot($destFolder)
                            ->setDestFile($destFile)
                            ->setDestDir($destFile->getParent());

                        $event = $this->pluginRegistry->emit(
                            BeforeProcessEvent::class,
                            compact('template')
                        );

                        if ($event->isSkip()) {
                            continue;
                        }

                        $template = $event->getTemplate();

                        $template->getSrc()->copyTo($destFile = $template->getDestFile(), true);

                        $io->writeln('[<info>Copy</info>]: ' . $destFile->getRelativePathname($root));

                        $event = $this->pluginRegistry->emit(
                            AfterProcessEvent::class,
                            compact('template', 'destFile')
                        );
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
