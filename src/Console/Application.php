<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Console;

use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\DI\Container;

/**
 * The Application class.
 */
class Application extends ConsoleApplication
{
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->setVersion('4.0.0');
    }

    /**
     * Your booting logic.
     *
     * @param  Container  $container
     *
     * @return  void
     */
    protected function booting(Container $container): void
    {
        //
    }

    /**
     * Your Terminating logic.
     *
     * @param  Container  $container
     *
     * @return  void
     */
    protected function terminating(Container $container): void
    {
        //
    }
}
