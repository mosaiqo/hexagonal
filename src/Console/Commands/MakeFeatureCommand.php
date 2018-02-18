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

use Mosaiqo\Hexagonal\Str;
use Mosaiqo\Hexagonal\Finder\Traits\Finder;
use Mosaiqo\Hexagonal\Console\Traits\Command;
use Mosaiqo\Hexagonal\Filesystem\Traits\Filesystem;
use Mosaiqo\Hexagonal\Generators\FeatureGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Mosaiqo\Hexagonal\Console\Command as BaseCommand;

/**
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakeFeatureCommand extends BaseCommand
{
	use Finder;
	use Command;
	use Filesystem;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:feature';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Feature in a service';
	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Feature';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function handle()
	{
		try {
			$service = studly_case($this->argument('service'));
			$title = $this->parseName($this->argument('feature'));
			$generator = new FeatureGenerator();
			$feature = $generator->generate($title, $service);
			$this->info(
				'Feature class ' . $feature->title . ' created successfully.' .
				"\n" .
				"\n" .
				'Find it at <comment>' . $feature->relativePath . '</comment>' . "\n"
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
			['feature', InputArgument::REQUIRED, 'The feature\'s name.'],
			['service', InputArgument::OPTIONAL, 'The service in which the feature should be implemented.'],
		];
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return $this->getStubDirectory('Feature.stub');
	}

	/**
	 * Parse the feature name.
	 *  remove the Feature.php suffix if found
	 *  we're adding it ourselves.
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	protected function parseName($name)
	{
		return Str::feature($name);
	}
}