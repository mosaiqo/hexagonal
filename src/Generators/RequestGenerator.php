<?php

namespace Mosaiqo\Hexagonal\Generators;

use Exception;
use Mosaiqo\Hexagonal\Str;
use Mosaiqo\Hexagonal\Components\Request;
/**
 * Class RequestGenerator
 *
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 *
 * @package Mosaiqo\hexagonal\Generators
 */
class RequestGenerator extends Generator
{
	/**
	 * Generate the file.
	 *
	 * @param string $name
	 * @param string $service
	 * @return Request|bool
	 * @throws Exception
	 */
	public function generate($name, $service)
	{
		$request = Str::request($name);
		$service = Str::service($service);
		$path = $this->findRequestPath($service, $request);
		if ($this->exists($path)) {
			throw new Exception('Request already exists');
			return false;
		}
		$namespace = $this->findRequestsNamespace($service);
		$content = file_get_contents($this->getStub());
		$content = str_replace(
			['{{request}}', '{{namespace}}', '{{foundation_namespace}}'],
			[$request, $namespace, $this->findFoundationNamespace()],
			$content
		);
		$this->createFile($path, $content);
		return new Request(
			$request,
			$service,
			$namespace,
			basename($path),
			$path,
			$this->relativeFromReal($path),
			$content
		);
	}
	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	public function getStub()
	{
		return $this->getStubDirectory('Request.stub');
	}
}