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
use Mosaiqo\Hexagonal\Components\Operation;


class OperationGenerator extends Generator
{
	public function generate($operation, $service, $isQueueable = false, array $jobs = [])
	{
		$operation = Str::operation($operation);
		$service = Str::service($service);
		$path = $this->findOperationPath($service, $operation);
		if ($this->exists($path)) {
			throw new Exception('Operation already exists!');
			return false;
		}
		$namespace = $this->findOperationNamespace($service);
		$content = file_get_contents($this->getStub($isQueueable));
		$useJobs = ''; // stores the `use` statements of the jobs
		$runJobs = ''; // stores the `$this->run` statements of the jobs
		foreach ($jobs as $index => $job) {
			$useJobs .= 'use ' . $job['namespace'] . '\\' . $job['className'] . ";\n";
			$runJobs .= "\t\t" . '$this->run(' . $job['className'] . '::class);';
			// only add carriage returns when it's not the last job
			if ($index != count($jobs) - 1) {
				$runJobs .= "\n\n";
			}
		}
		$content = str_replace(
			['{{operation}}', '{{namespace}}', '{{foundation_namespace}}', '{{use_jobs}}', '{{run_jobs}}'],
			[$operation, $namespace, $this->findFoundationNamespace(), $useJobs, $runJobs],
			$content
		);
		$this->createFile($path, $content);
		// generate test file
		$this->generateTestFile($operation, $service);
		return new Operation(
			$operation,
			basename($path),
			$path,
			$this->relativeFromReal($path),
			($service) ? $this->findService($service) : null,
			$content
		);
	}

	/**
	 * Generate the test file.
	 *
	 * @param string $operation
	 * @param string $service
	 */
	private function generateTestFile($operation, $service)
	{
		$content = file_get_contents($this->getTestStub());
		$namespace = $this->findOperationTestNamespace($service);
		$operationNamespace = $this->findOperationNamespace($service) . "\\$operation";
		$testClass = $operation . 'Test';
		$content = str_replace(
			['{{namespace}}', '{{testclass}}', '{{operation}}', '{{operation_namespace}}'],
			[$namespace, $testClass, mb_strtolower($operation), $operationNamespace],
			$content
		);
		$path = $this->findOperationTestPath($service, $testClass);
		$this->createFile($path, $content);
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub($isQueueable = false)
	{
		return $isQueueable
			? $this->getStubDirectory('OperationQueueable.stub')
			: $this->getStubDirectory('Operation.stub');
	}

	/**
	 * Get the test stub file for the generator.
	 *
	 * @return string
	 */
	private function getTestStub()
	{
		return $this->getStubDirectory('Tests/OperationTest.stub');
	}
}