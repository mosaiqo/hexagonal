<?php

namespace Mosaiqo\Hexagonal\Generators;

use Exception;
use Mosaiqo\Hexagonal\Str;
use Mosaiqo\Hexagonal\Components\Model;
use Mosaiqo\Hexagonal\Generators\Generator;

/**
 * Class ModelGenerator
 *
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 *
 * @package Mosaiqo\Hexagonal\Generators
 */
class ModelGenerator extends Generator
{
	/**
	 * Generate the file.
	 *
	 * @param $name
	 * @return Model|bool
	 * @throws Exception
	 */
	public function generate($name)
	{
		$model = Str::model($name);
		$path = $this->findModelPath($model);
		if ($this->exists($path)) {
			throw new Exception('Model already exists');
			return false;
		}
		$namespace = $this->findModelNamespace();
		$content = file_get_contents($this->getStub());
		$content = str_replace(
			['{{model}}', '{{namespace}}', '{{foundation_namespace}}'],
			[$model, $namespace, $this->findFoundationNamespace()],
			$content
		);
		$this->createFile($path, $content);
		return new Model(
			$model,
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
		return $this->getStubDirectory('Model.stub');
	}
}