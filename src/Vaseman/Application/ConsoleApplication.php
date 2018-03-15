<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Application;

use Vaseman\Command\InitCommand;
use Vaseman\Error\ConsoleErrorHandler;
use Windwalker\Console\Application;
use Windwalker\Console\IO\IOFactory;
use Windwalker\Console\IO\NullInput;
use Windwalker\Environment\Environment;
use Windwalker\Structure\Structure;

/**
 * The ConsoleApplication class.
 *
 * @since  {DEPLOY_VERSION}
 */
class ConsoleApplication extends Application
{
    /**
     * initialise
     *
     * @return  void
     */
    public function boot()
    {
        $this->set('outer_project', true);

        ConsoleErrorHandler::register();

        $env = new Environment;

        $working = $env->platform->getWorkingDirectory();

        $this->set('project.path.working', $working);

        parent::boot();
    }

    /**
     * prepareExecute
     *
     * @return  void
     *
     * @since  __DEPLOY_VERSION__
     */
    protected function prepareExecute()
    {
        // TODO: Use parent if core version getter fix
        if ($this->getRootCommand()->getOption('n')) {
            IOFactory::getIO()->setInput(new NullInput);
        }
    }

    /**
     * registerCommands
     *
     * @return  void
     */
    public function registerCommands()
    {
        parent::registerCommands();

        $this->addCommand(new InitCommand);
    }

    /**
     * loadConfiguration
     *
     * @param Structure $config
     * @param string    $name
     */
    protected function loadConfiguration(Structure $config, $name = null)
    {
        parent::loadConfiguration($config, $name);
    }
}
