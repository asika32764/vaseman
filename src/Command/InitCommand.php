<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Windwalker\Console\CommandInterface;
use Windwalker\Console\CommandWrapper;
use Windwalker\Console\IOInterface;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Filesystem\Filesystem;
use Windwalker\Filesystem\Path;

use Windwalker\Utilities\Str;

use function Windwalker\fs;

/**
 * The InitCommand class.
 */
#[CommandWrapper(
    description: ''
)]
class InitCommand implements CommandInterface
{
    protected IOInterface $io;

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
            'The init path.'
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
        $this->io = $io;

        $workingDir = $this->app->config('project.working_dir') ?? getcwd();
        $root = $io->getArgument('root');

        if (!$root) {
            $root = $workingDir;
        }

        $root = Path::realpath($root);

        $root = fs($root);
        $dataRoot = $root->appendPath('/.vaseman');
        $systemRoot = WINDWALKER_ROOT;

        $check = $io->askConfirmation(
            'This action will remove all current files, are you sure to continue? [<comment>Y/n</comment>]: '
        );

        if (!$check) {
            $io->style()->warning('Canceled.');

            return 0;
        }

        $io->style()->title('Start initialise Vaseman project.');

        $this->copyFolder($systemRoot . '/assets', $dataRoot->getPathname() . '/assets');
        $this->copyFolder($systemRoot . '/entries', $dataRoot->getPathname() . '/entries');
        $this->copyFolder($systemRoot . '/layouts', $dataRoot->getPathname() . '/layouts');
        $this->copyFolder($systemRoot . '/resources/packages', $dataRoot->getPathname(), false);
        $this->copyFile($systemRoot . '/etc/site.php', $dataRoot->getPathname() . '/config.php');

        $this->createFolder($dataRoot . '/src/Plugin');
        $this->createFolder($dataRoot . '/src/Helper');
        // $this->createFolder($dataRoot . '/src/Twig');

        $io->writeln('<info>Project generated.</info>');

        return 0;
    }

    public function copyFile(string $src, string $dest): void
    {
        $this->io->writeln('<info>Create</info>: ' . $this->removeWorkingDir($dest));

        if (is_file($dest)) {
            Filesystem::delete($dest);
        }

        Filesystem::copy($src, $dest);
    }

    public function copyFolder(string $src, string $dest, bool $override = true): void
    {
        if (is_dir($dest) && $override) {
            Filesystem::delete($dest);
        }

        foreach (Filesystem::files($src, true) as $file) {
            $this->copyFile(
                $file->getPathname(),
                $dest . '/' . $file->getRelativePathname()
            );
        }
    }

    public function createFolder(string $dest): void
    {
        $this->io->writeln('<info>Create</info>: ' . $this->removeWorkingDir($dest));

        Filesystem::write($dest . '/.gitkeep', '');
    }

    protected function removeWorkingDir(string $path): string
    {
        $cwd = getcwd();

        if (str_starts_with($path, $cwd)) {
            $path = ltrim(Str::removeLeft($path, $cwd), '/\\');
        }

        return $path;
    }
}
