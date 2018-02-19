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

/**
 * Class Service
 * @package Mosaiqo\Hexagonal\Components
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Service extends Component
{
	/**
	 * Service constructor.
	 * @param $name
	 * @param $realPath
	 * @param $relativePath
	 */
	public function __construct($name, $realPath, $relativePath)
	{
		$this->setAttributes([
			'name' => $name,
			'slug' => snake_case($name),
			'realPath' => $realPath,
			'relativePath' => $relativePath,
		]);
	}
	// public function toArray()
	// {
	//     $attributes = parent::toArray();
	//
	//     unset($attributes['realPath']);
	//
	//     return $attributes;
	// }
}