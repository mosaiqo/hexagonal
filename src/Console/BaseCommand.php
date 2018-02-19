<?php

namespace Mosaiqo\Hexagonal\Console;

use Illuminate\Console\Command;

class BaseCommand extends Command {
	/**
	 * @var string
	 */
	protected $stubDirectory = MOSAIQO_HEXAGONAL_PATH . '/stubs/';

	/**
	 * @param string $path
	 * @return string
	 */
	protected function getStubDirectory($path = '')
	{
		return $this->stubDirectory . $path;
	}
}