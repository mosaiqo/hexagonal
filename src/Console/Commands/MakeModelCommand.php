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
use Mosaiqo\Hexagonal\Generators\ModelGenerator;
use Mosaiqo\Hexagonal\Finder\Traits\FinderTrait;
use Mosaiqo\Hexagonal\Console\Traits\CommandTrait;
use Mosaiqo\Hexagonal\Filesystem\Traits\FilesystemTrait;
use Symfony\Component\Console\Input\InputArgument;
use Mosaiqo\Hexagonal\Console\BaseCommand;


/**
 * Class MakeModelCommand
 * @package Mosaiqo\Hexagonal\Console\Commands
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakeModelCommand extends BaseCommand
{
	use FinderTrait, CommandTrait, FilesystemTrait;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:model';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Eloquent Model.';
	/**
	 * The type of class being generated
	 * @var string
	 */
	protected $type = 'Model';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$generator = new ModelGenerator();
		$name = $this->argument('model');
		try {
			$model = $generator->generate($name);
			$this->info('Model class created successfully.' .
				"\n" .
				"\n" .
				'Find it at <comment>' . $model->relativePath . '</comment>' . "\n"
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
			['model', InputArgument::REQUIRED, 'The Model\'s name.']
		];
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	public function getStub()
	{
		return $this->getStubDirectory('Model.stub');
	}
}