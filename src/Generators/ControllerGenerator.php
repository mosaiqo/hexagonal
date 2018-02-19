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


class ControllerGenerator extends Generator
{
	/**
	 * @param $name
	 * @param $service
	 * @param bool $plain
	 * @return bool|string
	 * @throws Exception
	 */
	public function generate($name, $service, $plain = false)
	{
		$name = Str::controller($name);
		$service = Str::service($service);
		$path = $this->findControllerPath($service, $name);
		if ($this->exists($path)) {
			throw new Exception('Controller already exists!');
		}

		$namespace = $this->findControllerNamespace($service);
		$content = file_get_contents($this->getStub($plain));
		$content = str_replace(
			['{{controller}}', '{{namespace}}', '{{foundation_namespace}}'],
			[$name, $namespace, $this->findFoundationNamespace()],
			$content
		);
		$this->createFile($path, $content);
		return $this->relativeFromReal($path);
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @param $plain
	 * @return string
	 */
	protected function getStub($plain)
	{
		return $plain
			? $this->getStubDirectory('ControllerPlain.stub')
			: $this->getStubDirectory('Controller.stub');
	}
}