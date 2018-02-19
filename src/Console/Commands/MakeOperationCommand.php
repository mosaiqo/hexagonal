<?php
/******************************************************************************
 *                                                                            *
 * This file is part of the mosaiqo/hexagonal project.                        *
 * Copyright (c) 2018 Boudy de Geer <boudydegeer@mosaiqo.com>                 *
 * For the full copyright and license information, please view the LICENSE    *
 * file that was distributed with this source code.                           *
 *                                                                            *
 ******************************************************************************/

namespace Mosaiqo\Hexagonal\Console\Commands;

use MosaiqoHexagonalConsoleBaseCommand;
use Mosaiqo\Hexagonal\Console\Traits\Command;
use Mosaiqo\Hexagonal\Filesystem\Traits\Filesystem;
use Mosaiqo\Hexagonal\Finder\Traits\Finder;
use Mosaiqo\Hexagonal\Generators\OperationGenerator;
use Mosaiqo\Hexagonal\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


/**
 * Class MakeOperationCommand
 * @package Mosaiqo\Hexagonal\Console\Commands
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakeOperationCommand extends BaseCommand
{
	use Finder;
	use Command;
	use Filesystem;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:operation {--Q|queue}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Operation in a domain';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Operation';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function handle()
	{
		$generator = new OperationGenerator();
		$service = studly_case($this->argument('service'));
		$title = $this->parseName($this->argument('operation'));
		$isQueueable = $this->option('queue');
		try {
			$operation = $generator->generate($title, $service, $isQueueable);
			$this->info(
				'Operation class ' . $title . ' created successfully.' .
				"\n" .
				"\n" .
				'Find it at <comment>' . $operation->relativePath . '</comment>' . "\n"
			);
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}

	/**
	 * Parse the operation name.
	 *  remove the Operation.php suffix if found
	 *  we're adding it ourselves.
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	protected function parseName($name)
	{
		return Str::operation($name);
	}

	/**
	 * @return array
	 */
	public function getArguments()
	{
		return [
			['operation', InputArgument::REQUIRED, 'The operation\'s name.'],
			['service', InputArgument::OPTIONAL, 'The service in which the operation should be implemented.'],
		];
	}

	/**
	 * @return array
	 */
	public function getOptions()
	{
		return [
			['queue', 'Q', InputOption::VALUE_NONE, 'Whether a operation is queueable or not.'],
		];
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	public function getStub()
	{
		return $this->getStubDirectory('Operation.stub');
	}
}