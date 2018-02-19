<?php
namespace Mosaiqo\Hexagonal;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Mosaiqo\Hexagonal\Console\Commands\MakeServiceCommand;


class HexagonalServiceProvider extends ServiceProvider {

	/**
	 *
	 */
	public function boot()
	{
		$this->publishes([
			MOSAIQO_HEXAGONAL_PATH.'/files/app' => base_path('src'),
			MOSAIQO_HEXAGONAL_PATH.'/files/config.php' => base_path('config/hexagonal.php'),
		]);

		$this->commands([
			\Mosaiqo\Hexagonal\Console\Commands\ChangeSourceNamespaceCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\DescribeFeatureCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\MakeControllerCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\MakeFeatureCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\MakeJobCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\MakeModelCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\MakeOperationCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\MakeRequestCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\MakeServiceCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\ListFeaturesCommand::class,
			\Mosaiqo\Hexagonal\Console\Commands\ListServicesCommand::class,
		]);
	}

	/**
	 *
	 */
	public function register()
	{
		if (! defined('MOSAIQO_HEXAGONAL_PATH')) {
			define('MOSAIQO_HEXAGONAL_PATH', realpath(__DIR__.'/../'));
		}
	}
}