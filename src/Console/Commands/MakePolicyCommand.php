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

use Mosaiqo\Hexagonal\Finder\Traits\FinderTrait;
use Mosaiqo\Hexagonal\Console\Traits\CommandTrait;
use Mosaiqo\Hexagonal\Filesystem\Traits\FilesystemTrait;
use Exception;
use Mosaiqo\Hexagonal\Generators\PolicyGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Mosaiqo\Hexagonal\Console\BaseCommand;

/**
 * Class MakePolicyCommand
 * @package Mosaiqo\Hexagonal\Console\Commands
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakePolicyCommand extends BaseCommand
{
	use FinderTrait, CommandTrait, FilesystemTrait;
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