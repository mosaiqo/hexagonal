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


use Mosaiqo\Hexagonal\Console\BaseCommand;
use Mosaiqo\Hexagonal\Filesystem\Traits\FilesystemTrait;
use Mosaiqo\Hexagonal\Finder\Traits\FinderTrait;
use Mosaiqo\Hexagonal\Generators\JobGenerator;
use Mosaiqo\Hexagonal\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


/**
 * Class MakeJobCommand
 * @package Mosaiqo\Hexagonal\Console\Commands
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class MakeJobCommand extends BaseCommand
{
	use FinderTrait, FilesystemTrait;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hexagonal:make:job {--Q|queue}';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Job in a domain';
	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Job';

	/**
	 * Execute the console command.
	 *
	 * @return bool|null
	 * @throws \Exception
	 */
	public function handle()
	{
		$generator = new JobGenerator();
		$domain = studly_case($this->argument('domain'));
		$title = $this->parseName($this->argument('job'));
		$isQueueable = $this->option('queue');
		try {
			$job = $generator->generate($title, $domain, $isQueueable);
			$this->info(
				'Job class ' . $title . ' created successfully.' .
				"\n" .
				"\n" .
				'Find it at <comment>' . $job->relativePath . '</comment>' . "\n"
			);
		} catch (Exception $e) {
			$this->error($e->getMessage());
		}
	}

	/**
	 * @return array
	 */
	public function getArguments()
	{
		return [
			['job', InputArgument::REQUIRED, 'The job\'s name.'],
			['domain', InputArgument::REQUIRED, 'The domain to be responsible for the job.'],
		];
	}

	/**
	 * @return array
	 */
	public function getOptions()
	{
		return [
			['queue', 'Q', InputOption::VALUE_NONE, 'Whether a job is queueable or not.'],
		];
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	public function getStub()
	{
		return $this->getStubDirectory('Job.stub');
	}

	/**
	 * Parse the job name.
	 *  remove the Job.php suffix if found
	 *  we're adding it ourselves.
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	protected function parseName($name)
	{
		return Str::job($name);
	}
}