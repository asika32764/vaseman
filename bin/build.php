<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

include_once __DIR__ . '/../vendor/autoload.php';

Vaseman\Error\ConsoleErrorHandler::register();

/**
 * The PharBuilder class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PharBuilder extends \Windwalker\Application\AbstractCliApplication
{
    /**
     * Method to run the application routines.  Most likely you will want to instantiate a controller
     * and execute it, or perform some sort of task directly.
     *
     * @return  void
     *
     * @since   2.0
     */
    protected function doExecute()
    {
        if ($this->io->getOption('h') || $this->io->getOption('help')) {
            $this->help();

            return;
        }

        $dir = $this->io->getOption('d', '../../vaseman.phar');

        $file = __DIR__ . '/' . $dir;

        if (is_file($file)) {
            unlink($file);
        }

        $this->out('Start generating...');

        $phar = new Phar($file);

        $phar->setStub(<<<PHP
#!/usr/bin/env php
<?php

Phar::mapPhar('vaseman.phar');

require 'phar://vaseman.phar/bin/vaseman'; __HALT_COMPILER();
PHP
        );

        $phar->buildFromDirectory(__DIR__ . '/..');

        $phar->stopBuffering();

        $this->out('Phar generated: ' . $file)->out();
    }

    /**
     * help
     *
     * @return  void
     */
    protected function help()
    {
        $help = <<<HELP

Vaseman Phar Builder
---------------------------------

builder.php [-d]

Options:
    -d    The output directory with file name. For example: -d ../vaseman.phar

HELP;

        $this->io->out($help);
    }
}

$app = new PharBuilder;

$app->execute();
