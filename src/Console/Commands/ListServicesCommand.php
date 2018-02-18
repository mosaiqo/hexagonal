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

use Mosaiqo\Hexagonal\Console\Traits\Command;
use Mosaiqo\Hexagonal\Finder\Traits\Finder;
use Mosaiqo\Hexagonal\Console\Command as BaseCommand;

/**
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class ListServicesCommand extends BaseCommand
{
	use Finder;
	use Command;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:list:services';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List the services in this project.';

	/**
	 *
	 */
	public function handle()
	{
		$services = $this->listServices()->all();
		$this->table(
			['Service', 'Slug', 'Path'],
			array_map(function ($service) {
				return [$service->name, $service->slug, $service->relativePath];
			},
			$services)
		);
	}
}