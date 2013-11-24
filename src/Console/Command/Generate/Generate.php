<?php

namespace Console\Command\Generate\Generate;

use Joomla\Console\Command\Command;

class Generate extends Command
{
	public $name = 'gen';

	public $description = 'Generate a page.';

	//        public $usage = 'example <command> [option]';

	public function configure()
	{
		/*
		$this->addArgument(new ExampleCommand)
				->addOption(
						'a',
						0,
						'desc'
				);
		*/
	}

	public function doExecute()
	{
		$this->out('Example Command');

		return 0;
	}
}