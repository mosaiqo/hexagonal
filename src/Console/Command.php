<?php

namespace Mosaiqo\Hexagonal\Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand {
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