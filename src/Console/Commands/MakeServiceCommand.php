<?php
/*
 * This file is part of the lucid-console project.
 *
 * (c) Vinelab <dev@vinelab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mosaiqo\Hexagonal\Console\Commands;

use Mosaiqo\Hexagonal\Finder\Traits\Finder;
use Mosaiqo\Hexagonal\Console\Traits\Command;
use Mosaiqo\Hexagonal\Filesystem\Traits\Filesystem;
use Mosaiqo\Hexagonal\Generators\ServiceGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

/**
 * @author Abed Halawi <abed.halawi@vinelab.com>
 */
class MakeServiceCommand extends SymfonyCommand
{
	use Finder;
	use Command;
	use Filesystem;
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
		return __DIR__.'/../Generators/stubs/service.stub';
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
			$this->info('Service '.$service->name.' created successfully.'."\n");
			$rootNamespace = $this->findRootNamespace();
			$serviceNamespace = $this->findServiceNamespace($service->name);
			$serviceProvider = $serviceNamespace.'\\Providers\\'.$service->name.'ServiceProvider';

			$this->info('Activate it by registering '.
				'<comment>'.$serviceProvider.'</comment> '.
				"\n".
				'in <comment>'.$rootNamespace.'\Foundation\Providers\ServiceProvider@register</comment> '.
				'with the following:'.
				"\n"
			);
			$this->info('<comment>$this->app->register(\''.$serviceProvider.'\');</comment>'."\n");
		} catch (\Exception $e) {
			$this->error($e->getMessage()."\n".$e->getFile().' at '.$e->getLine());
		}
	}
	public function getArguments()
	{
		return [
			['name', InputArgument::REQUIRED, 'The service name.'],
		];
	}
}