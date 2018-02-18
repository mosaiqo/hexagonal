<?php
/*
 * This file is part of the lucid-console project.
 *
 * (c) Vinelab <dev@vinelab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mosaiqo\Hexagonal\Components;

use Mosaiqo\Hexagonal\Components\Component;

/**
 * @author Abed Halawi <abed.halawi@vinelab.com>
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