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

use Exception;
use Mosaiqo\Hexagonal\Filesystem\Traits\FilesystemTrait;
use Mosaiqo\Hexagonal\Finder\Traits\FinderTrait;
use Mosaiqo\Hexagonal\Generators\RequestGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Mosaiqo\Hexagonal\Console\BaseCommand;

/**
 * Class RequestMakeCommand
 * @package Mosaiqo\Hexagonal\Console\Commands
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakeRequestCommand extends BaseCommand
{
	use FinderTrait, FilesystemTrait;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:request';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a Request in a specific service.';

	/**
	 * The type of class being generated
	 * @var string
	 */
	protected $type = 'Request';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$generator = new RequestGenerator();
		$name = $this->argument('request');
		$service = $this->argument('service');
		try {
			$request = $generator->generate($name, $service);
			$this->info('Request class created successfully.' .
				"\n" .
				"\n" .
				'Find it at <comment>' . $request->relativePath . '</comment>' . "\n"
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
			['request', InputArgument::REQUIRED, 'The Request\'s name.'],
			['service', InputArgument::REQUIRED, 'The Service\'s name.'],
		];
	}
	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	public function getStub()
	{
		return $this->getStubDirectory('Request.stub');
	}
}