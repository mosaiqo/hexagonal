<?php
/*
 * This file is part of the mosaiqo/hexagonal project.
 *
 * (c) Mosaiqo <mosaiqo@mosaiqo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mosaiqo\Hexagonal\Console\Commands;

use Mosaiqo\Hexagonal\Finder\Traits\FinderTrait;
use Mosaiqo\Hexagonal\Console\Traits\CommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Mosaiqo\Hexagonal\Console\BaseCommand;

class ListFeaturesCommand extends BaseCommand
{
	use FinderTrait, CommandTrait;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:list:features';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List the features.';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function handle()
	{
		foreach ($this->listFeatures($this->argument('service')) as $service => $features) {
			$this->comment("\n$service\n");
			$features = array_map(function($feature) {
				return [$feature->title, $feature->service->name, $feature->file, $feature->relativePath];
			}, $features->all());
			$this->table(['Feature', 'Service', 'File', 'Path'], $features);
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
			['service', InputArgument::OPTIONAL, 'The service to list the features of.'],
		];
	}
}