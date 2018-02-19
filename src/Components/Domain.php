<?php
/******************************************************************************
 *                                                                            *
 * This file is part of the mosaiqo/hexagonal project.                        *
 * Copyright (c) 2018 Boudy de Geer <boudydegeer@mosaiqo.com>                 *
 * For the full copyright and license information, please view the LICENSE    *
 * file that was distributed with this source code.                           *
 *                                                                            *
 ******************************************************************************/

namespace Mosaiqo\Hexagonal\Components;

use Illuminate\Support\Str;

/**
 * Class Domain
 * @package Mosaiqo\Hexagonal\Components
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Domain extends Component
{
	/**
	 * Domain constructor.
	 * @param $name
	 * @param $namespace
	 * @param $path
	 * @param $relativePath
	 */
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