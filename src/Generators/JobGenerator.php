<?php
/*
 * This file is part of the mosaiqo/hexagonal project.
 *
 * (c) Mosaiqo <mosaiqo@mosaiqo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mosaiqo\Hexagonal\Generators;

use Exception;
use Mosaiqo\Hexagonal\Str;
use Mosaiqo\Hexagonal\Components\Job;

/**
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class JobGenerator extends Generator
{
	public function generate($job, $domain, $isQueueable = false)
	{
		$job = Str::job($job);
		$domain = Str::domain($domain);
		$path = $this->findJobPath($domain, $job);
		if ($this->exists($path)) {
			throw new Exception('Job already exists');
			return false;
		}
// Make sure the domain directory exists
		$this->createDomainDirectory($domain);
// Create the job
		$namespace = $this->findDomainJobsNamespace($domain);
		$content = file_get_contents($this->getStub($isQueueable));
		$content = str_replace(
			['{{job}}', '{{namespace}}', '{{foundation_namespace}}'],
			[$job, $namespace, $this->findFoundationNamespace()],
			$content
		);
		$this->createFile($path, $content);
		$this->generateTestFile($job, $domain);
		return new Job(
			$job,
			$namespace,
			basename($path),
			$path,
			$this->relativeFromReal($path),
			$this->findDomain($domain),
			$content
		);
	}

	/**
	 * Generate test file.
	 *
	 * @param string $job
	 * @param string $domain
	 */
	private function generateTestFile($job, $domain)
	{
		$content = file_get_contents($this->getTestStub());
		$namespace = $this->findDomainJobsTestsNamespace($domain);
		$jobNamespace = $this->findDomainJobsNamespace($domain) . "\\$job";
		$testClass = $job . 'Test';
		$content = str_replace(
			['{{namespace}}', '{{testclass}}', '{{job}}', '{{job_namespace}}'],
			[$namespace, $testClass, snake_case($job), $jobNamespace],
			$content
		);
		$path = $this->findJobTestPath($domain, $testClass);
		$this->createFile($path, $content);
	}

	/**
	 * Create domain directory.
	 *
	 * @param string $domain
	 */
	private function createDomainDirectory($domain)
	{
		$this->createDirectory($this->findDomainPath($domain) . '/Jobs');
		$this->createDirectory($this->findDomainTestsPath($domain) . '/Jobs');
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @param bool $isQueueable
	 * @return string
	 */
	public function getStub($isQueueable = false)
	{
		return $isQueueable
			? $this->getStubDirectory('JobQueueable.stub')
			: $this->getStubDirectory('Job.stub');
	}

	/**
	 * Get the test stub file for the generator.
	 *
	 * @return string
	 */
	public function getTestStub()
	{
		return $this->getStubDirectory('Tests/JobTest.stub');
	}
}