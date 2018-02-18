<?php
namespace Mosaiqo\Hexagonal;

use Illuminate\Support\ServiceProvider;

class HexagonalServiceProvider extends ServiceProvider {

	/**
	 *
	 */
	public function boot()
	{
		$this->publishes([
			MOSAIQO_HEXAGONAL_PATH.'/hexagonal/app' => base_path('app'),
			MOSAIQO_HEXAGONAL_PATH.'/hexagonal/config.php' => base_path('config/hexagonal.php'),
			MOSAIQO_HEXAGONAL_PATH.'/hexagonal/hexagonal' => base_path('hexagonal'),
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