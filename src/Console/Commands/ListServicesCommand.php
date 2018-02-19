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
use Mosaiqo\Hexagonal\Console\BaseCommand;


class ListServicesCommand extends BaseCommand
{
	use FinderTrait;
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