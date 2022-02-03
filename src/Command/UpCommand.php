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
use Windwalker\Console\CommandInterface;
use Windwalker\Console\CommandWrapper;
use Windwalker\Console\IOInterface;

/**
 * The UpCommand class.
 */
#[CommandWrapper(
    description: ''
)]
class UpCommand implements CommandInterface
{
    /**
     * configure
     *
     * @param  Command  $command
     *
     * @return  void
     */
    public function configure(Command $command): void
    {
        //
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
        return 0;
    }
}
