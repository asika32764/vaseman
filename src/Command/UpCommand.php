<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Command;

use App\View\PageView;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Windwalker\Console\CommandInterface;
use Windwalker\Console\CommandWrapper;
use Windwalker\Console\Input\InputOption;
use Windwalker\Console\IOInterface;
use Windwalker\Core\Console\ConsoleApplication;

use Windwalker\Core\View\View;
use Windwalker\Filesystem\Filesystem;

use function Windwalker\fs;

/**
 * The UpCommand class.
 */
#[CommandWrapper(
    description: ''
)]
class UpCommand implements CommandInterface
{
    public function __construct(protected ConsoleApplication $app)
    {
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
        $tmpl = $io->getArgument('tmpl');

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

        $config = include $configFile->getPathname();
        $folders = $config['folders'] ?? [];

        foreach ($folders as $srcFolder => $destFolder) {
            $files = Filesystem::files($dataRoot . '/' . $srcFolder, true);

            foreach ($files as $file) {
                $io->out('[<option>Rendering file</option>]: ' . $file);

                /** @var View $view */
                $view = $this->app->make(PageView::class);



                $view->setLayoutMap([]);
            }
        }

        return 0;
    }
}
