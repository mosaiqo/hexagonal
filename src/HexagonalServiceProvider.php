<?php
namespace Mosaiqo\Hexagonal;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;



class HexagonalServiceProvider extends ServiceProvider {

	/**
	 *
	 */
	public function boot()
	{
		$this->publishes([
			MOSAIQO_HEXAGONAL_PATH.'/files/app' => base_path('src'),
			MOSAIQO_HEXAGONAL_PATH.'/files/config.php' => base_path('config/hexagonal.php'),
			MOSAIQO_HEXAGONAL_PATH.'/files/hexagonal' => base_path('hexagonal'),
		]);

		$this->commands([
			\Mosaiqo\Hexagonal\Console\Commands\ChangeSourceNamespaceCommand::class
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