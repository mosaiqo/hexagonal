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

use Mosaiqo\Hexagonal\Components\Component;

/**
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Service extends Component
{
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