<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Command;

use App\Event\DataProvideEvent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Windwalker\Console\CommandInterface;
use Windwalker\Console\CommandWrapper;
use Windwalker\Console\Input\InputOption;
use Windwalker\Console\IOInterface;
use Windwalker\Event\Attributes\EventSubscriber;
use Windwalker\Event\Attributes\ListenTo;
use Windwalker\Utilities\StrNormalize;

use function Windwalker\fs;

/**
 * The MakePluginCommand class.
 */
#[CommandWrapper(
    description: 'Make a plugin class.'
)]
class MakePluginCommand implements CommandInterface
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
        $command->addArgument(
            'name',
            InputArgument::REQUIRED,
            'Plugin name'
        );
        $command->addOption(
            'force',
            'f',
            InputOption::VALUE_NONE,
            'Force overwrite file.'
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
        $name = $io->getArgument('name');
        $force = (bool) $io->getOption('force');
        $root = getcwd();

        $className = StrNormalize::toPascalCase($name) . 'Plugin';

        $code = $this->getPluginTemplate($className);
        $file = fs($root . '/.vaseman/src/Plugin/' . $className . '.php');

        if ($file->exists() && !$force) {
            $io->style()->warning('File exists: ' . $file->getRelativePathname($root));
        } else {
            $file->write($code);

            $io->writeln('Make file: <info>ROOT/' . $file->getRelativePathname($root) . '</info>');
        }

        return 0;
    }

    protected function getPluginTemplate(string $className): string
    {
        return <<<PHP
<?php

namespace App\Plugin;

use App\Event\DataProvideEvent;
use Windwalker\Event\Attributes\EventSubscriber;
use Windwalker\Event\Attributes\ListenTo;

#[EventSubscriber]
class {$className}
{
    #[ListenTo(DataProvideEvent::class)]
    public function dataProvider(DataProvideEvent \$event): void
    {
        \$data = &\$event->getData();
    }
}

PHP;

    }
}
