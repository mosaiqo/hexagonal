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

use Mosaiqo\Hexagonal\Console\BaseCommand;
use Mosaiqo\Hexagonal\Filesystem\Traits\FilesystemTrait;
use Mosaiqo\Hexagonal\Finder\Traits\FinderTrait;
use Mosaiqo\Hexagonal\Generators\ControllerGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


/**
 * Class MakeControllerCommand
 * @package Mosaiqo\Hexagonal\Console\Commands
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakeControllerCommand extends BaseCommand
{
	use FinderTrait, FilesystemTrait;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:controller';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new resource Controller class in a service';
	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Controller';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function handle()
	{
		$generator = new ControllerGenerator();
		$service = $this->argument('service');
		$name = $this->argument('controller');
		try {
			$controller = $generator->generate($name, $service, $this->option('plain'));
			$this->info('Controller class created successfully.' .
				"\n" .
				"\n" .
				'Find it at <comment>' . $controller . '</comment>' . "\n"
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
	protected function getArguments()
	{
		return [
			['controller', InputArgument::REQUIRED, 'The controller\'s name.'],
			['service', InputArgument::OPTIONAL, 'The service in which the controller should be generated.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['plain', null, InputOption::VALUE_NONE, 'Generate an empty controller class.'],
		];
	}

	/**
	 * Parse the feature name.
	 *  remove the Controller.php suffix if found
	 *  we're adding it ourselves.
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	protected function parseName($name)
	{
		return studly_case(preg_replace('/Controller(\.php)?$/', '', $name) . 'Controller');
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->option('plain')
			? $this->getStubDirectory('ControllerPlain.stub')
			: $this->getStubDirectory('Controller.stub');
	}
}