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

use Mosaiqo\Hexagonal\Finder\Traits\Finder;
use Mosaiqo\Hexagonal\Parser\Parser;
use Mosaiqo\Hexagonal\Console\BaseCommand;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;

class DescribeFeatureCommand extends BaseCommand
{
	use Finder;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:describe:feature';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List the jobs of the specified feature in sequential order.';

	/**
	 * Execute the console command.
	 *
	 * @return bool|null
	 * @throws \Exception
	 */
	public function handle()
	{
		if ($feature = $this->findFeature($this->argument('feature'))) {
			$parser = new Parser();
			$jobs = $parser->parseFeatureJobs($feature);
			$features = [];
			foreach ($jobs as $index => $job) {
				$features[$feature->title][] = [$index+1, $job->title, $job->domain->name, $job->relativePath];
			}
			foreach ($features as $feature => $jobs) {
				$this->comment("\n$feature\n");
				$this->table(['', 'Job', 'Domain', 'Path'], $jobs);
			}
			return true;
		}
		throw new InvalidArgumentException('Feature with name "'.$this->argument('feature').'" not found.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['feature', InputArgument::REQUIRED, 'The feature name to list the jobs of.'],
		];
	}
}