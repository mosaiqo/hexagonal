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
use Mosaiqo\Hexagonal\Filesystem\Traits\FilesystemTrait;
use Mosaiqo\Hexagonal\Generators\ServiceGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Mosaiqo\Hexagonal\Console\BaseCommand;


/**
 * Class MakeServiceCommand
 * @package Mosaiqo\Hexagonal\Console\Commands
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakeServiceCommand extends BaseCommand
{
	use FinderTrait, FilesystemTrait;

	/**
	 * The base namespace for this command.
	 *
	 * @var string
	 */
	private $namespace;
	/**
	 * The Services path.
	 *
	 * @var string
	 */
	private $path;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:service';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Service';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return __DIR__ . '/../Generators/stubs/service.stub';
	}

	/**
	 * Execute the console command.
	 *
	 * @return bool|null
	 */
	public function handle()
	{
		try {
			$name = $this->argument('name');
			$generator = new ServiceGenerator();
			$service = $generator->generate($name);
			$this->info('Service ' . $service->name . ' created successfully.' . "\n");
			$rootNamespace = $this->findRootNamespace();
			$serviceNamespace = $this->findServiceNamespace($service->name);
			$serviceProvider = $serviceNamespace . '\\Providers\\' . $service->name . 'ServiceProvider';

			$this->info('Activate it by registering ' .
				'<comment>' . $serviceProvider . '</comment> ' .
				"\n" .
				'in <comment>' . $rootNamespace . '\Hexagonal\Providers\ServiceProvider@register</comment> ' .
				'with the following:' .
				"\n"
			);
			$this->info('<comment>$this->app->register(\'' . $serviceProvider . '\');</comment>' . "\n");
		} catch (\Exception $e) {
			$this->error($e->getMessage() . "\n" . $e->getFile() . ' at ' . $e->getLine());
		}
	}

	/**
	 * @return array
	 */
	public function getArguments()
	{
		return [
			['name', InputArgument::REQUIRED, 'The service name.'],
		];
	}
}