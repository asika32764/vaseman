<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Vaseman\Listener;

use Windwalker\Event\Event;
use Windwalker\Ioc;
use Windwalker\Loader\ClassLoader;

/**
 * The VasemanListener class.
 *
 * @since  {DEPLOY_VERSION}
 */
class VasemanListener
{
    /**
     * onAfterInitialise
     *
     * @param Event $event
     *
     * @return  void
     *
     * @since  __DEPLOY_VERSION__
     */
    public function onAfterInitialise(Event $event)
    {
        $app    = $event['app'];
        $config = $app->config;

        switch ($config['mode']) {
            case 'test':
                $root = WINDWALKER_ROOT;
                break;
            default:
                $root = $config->get('project.path.root');

                $root = $root ?: WINDWALKER_ROOT;
                break;
        }

        $data = $config->get('outer_project') ? $root . '/.vaseman' : $root;

        $config['path.templates'] = $data . '/layouts';

        $config->set('project.path.root', $root);
        $config->set('project.path.data', $data);
        $config->set('project.path.entries', $data . '/entries');
        $config->set('project.path.layouts', $data . '/layouts');

        // Config
        if ($config->get('outer_project')) {
            $file = $config->get('project.path.root') . '/.vaseman/config.php';

            if (is_file($file)) {
                $config->loadFile($file, 'php');
            }
        }

        // Loader
        $loader = new ClassLoader;

        $loader->register();

        if ($config->get('outer_project') || $config->get('mode') == 'test') {
            $loader->addPsr4('Vaseman\\', $config->get('project.path.data') . '/src');
        }

        // Plugins
        $plugins    = $config->get('plugins', []);
        $dispatcher = Ioc::getDispatcher();

        foreach ($plugins as $plugin) {
            if (class_exists($plugin) && is_subclass_of($plugin,
                    'Vaseman\\Plugin\\AbstractPlugin') && $plugin::$isEnabled) {
                $dispatcher->addListener(new $plugin);
            }
        }
    }
}
