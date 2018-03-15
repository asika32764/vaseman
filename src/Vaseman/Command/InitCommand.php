<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Command;

use Windwalker\Console\Command\Command;
use Windwalker\Console\Prompter\BooleanPrompter;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Folder;

/**
 * The InitCommand class.
 *
 * @since  {DEPLOY_VERSION}
 */
class InitCommand extends Command
{
    /**
     * Property isEnabled.
     *
     * @var  boolean
     */
    public static $isEnabled = true;

    /**
     * Property name.
     *
     * @var  string
     */
    protected $name = 'init';

    /**
     * Property description.
     *
     * @var  string
     */
    protected $description = 'Initialise a site project.';

    /**
     * Property usage.
     *
     * @var  string
     */
    protected $usage = 'up <cmd><path></cmd> <option>[options]</option>';

    /**
     * doExecute
     *
     * @return  integer
     */
    protected function doExecute()
    {
        $working = $this->console->get('project.path.working');

        $root = $this->getArgument(0);

        if (!$root) {
            $root = $working;
        } else {
            if (strpos($root, '/') === 0) {
                $root = $working . '/' . $root;
            }
        }

        $dataRoot = $root . '/.vaseman';

        $this->console->set('project.path.root', realpath($root));
        $this->console->set('project.path.data', realpath($dataRoot));

        $systemRoot = WINDWALKER_ROOT;

        $boolPrompter = new BooleanPrompter;

        if (!$boolPrompter->ask('This action will remove all current files, are you sure to continue? [<comment>Y/n</comment>]: ')) {
            $this->out('<comment>canceled.</comment>')->out();

            return true;
        }

        $this->out()->out('<comment>Start initialise Vaseman project.</comment>')->out();

        $this->copyFolder($systemRoot . '/asset', $dataRoot . '/asset');
        $this->copyFolder($systemRoot . '/entries', $dataRoot . '/entries');
        $this->copyFolder($systemRoot . '/layouts', $dataRoot . '/layouts');
        $this->copyFolder($systemRoot . '/resources/packages', $dataRoot, false);
        $this->copyFile($systemRoot . '/etc/config.php', $dataRoot . '/config.php');

        $this->createFolder($dataRoot . '/src/Plugin');
        $this->createFolder($dataRoot . '/src/Helper');
        $this->createFolder($dataRoot . '/src/Twig');

        $this->out()->out('<info>Project generated.</info>')->out();

        return true;
    }

    /**
     * copy
     *
     * @param string $src
     * @param string $dest
     * @param bool   $overwrite
     *
     * @return  void
     */
    protected function copyFolder($src, $dest, $overwrite = true)
    {
        $this->out('<info>Create</info>: ' . $dest);

        if (is_dir($dest) && $overwrite) {
            Folder::delete($dest);
        }

        Folder::copy($src, $dest);
    }

    /**
     * copy
     *
     * @param string $src
     * @param string $dest
     *
     * @return  void
     */
    protected function copyFile($src, $dest)
    {
        $this->out('<info>Create</info>: ' . $dest);

        if (is_file($dest)) {
            File::delete($dest);
        }

        File::copy($src, $dest);
    }

    /**
     * createFolder
     *
     * @param string $dest
     *
     * @return  void
     */
    protected function createFolder($dest)
    {
        $this->out('<info>Create</info>: ' . $dest);

        Folder::create($dest);

        File::write($dest . '/.gitkeep', '');
    }
}
