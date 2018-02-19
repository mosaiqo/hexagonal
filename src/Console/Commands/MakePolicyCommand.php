<?php
/******************************************************************************
 * Copyright (c) 2018.                                                        *
 ******************************************************************************/

namespace Mosaiqo\Hexagonal\Console\Commands;

use Mosaiqo\Hexagonal\Finder\Traits\Finder;
use Mosaiqo\Hexagonal\Console\Traits\Command;
use Mosaiqo\Hexagonal\Filesystem\Traits\Filesystem;
use Exception;
use Mosaiqo\Hexagonal\Generators\PolicyGenerator;
use Symfony\Component\Console\Input\InputArgument;
use MosaiqoHexagonalConsoleBaseCommand;

/**
 * Class MakePolicyCommand
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package Mosaiqo\Hexagonal\Console\Commands
 */
class MakePolicyCommand extends BaseCommand
{
	use Finder;
	use Command;
	use Filesystem;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:policy';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a Policy.';
	/**
	 * The type of class being generated
	 * @var string
	 */
	protected $type = 'Policy';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$generator = new PolicyGenerator();
		$name = $this->argument('policy');
		try {
			$policy = $generator->generate($name);
			$this->info('Policy class created successfully.' .
				"\n" .
				"\n" .
				'Find it at <comment>' . $policy->relativePath . '</comment>' . "\n"
			);
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	public function getArguments()
	{
		return [
			['policy', InputArgument::REQUIRED, 'The Policy\'s name.']
		];
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	public function getStub()
	{
		return $this->getStubDirectory('Policy.stub');
	}
}