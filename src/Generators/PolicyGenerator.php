<?php

namespace Mosaiqo\Hexagonal\Generators;

use Exception;
use Mosaiqo\Hexagonal\Str;
use Mosaiqo\Hexagonal\Components\Policy;
use Mosaiqo\Hexagonal\Generators\Generator;

/**
 * Class PolicyGenerator
 *
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 *
 * @package Mosaiqo\Hexagonal\Generators
 */
class PolicyGenerator extends Generator
{
	/**
	 * Generate the file.
	 *
	 * @param $name
	 * @return Policy|bool
	 * @throws Exception
	 */
	public function generate($name)
	{
		$policy = Str::policy($name);
		$path = $this->findPolicyPath($policy);
		if ($this->exists($path)) {
			throw new Exception('Policy already exists');
			return false;
		}
		$this->createPolicyDirectory();
		$namespace = $this->findPolicyNamespace();
		$content = file_get_contents($this->getStub());
		$content = str_replace(
			['{{policy}}', '{{namespace}}', '{{foundation_namespace}}'],
			[$policy, $namespace, $this->findFoundationNamespace()],
			$content
		);
		$this->createFile($path, $content);
		return new Policy(
			$policy,
			$namespace,
			basename($path),
			$path,
			$this->relativeFromReal($path),
			$content
		);
	}

	/**
	 * Create Policies directory.
	 */
	public function createPolicyDirectory()
	{
		$this->createDirectory($this->findPoliciesPath());
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	public function getStub()
	{
		return $this->getStubDirectory('Policy.stub');
	}
}