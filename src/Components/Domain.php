<?php
/*
 * This file is part of the mosaiqo/hexagonal project.
 *
 * (c) Mosaiqo <mosaiqo@mosaiqo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mosaiqo\Hexagonal\Components;

use Illuminate\Support\Str;

class Domain extends Component
{
	public function __construct($name, $namespace, $path, $relativePath)
	{
		$this->setAttributes([
			'name' => $name,
			'slug' => Str::studly($name),
			'namespace' => $namespace,
			'realPath' => $path,
			'relativePath' => $relativePath,
		]);
	}
}