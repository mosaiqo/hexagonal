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
 * Class Feature
 * @package Mosaiqo\Hexagonal\Components
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Feature extends Component
{
	/**
	 * Feature constructor.
	 * @param $title
	 * @param $file
	 * @param $realPath
	 * @param $relativePath
	 * @param Service|null $service
	 * @param string $content
	 */
	public function __construct($title, $file, $realPath, $relativePath, Service $service = null, $content = '')
	{
		$className = str_replace(' ', '', $title) . 'Feature';
		$this->setAttributes([
			'title' => $title,
			'className' => $className,
			'service' => $service,
			'file' => $file,
			'realPath' => $realPath,
			'relativePath' => $relativePath,
			'content' => $content,
		]);
	}
	// public function toArray()
	// {
	//     $attributes = parent::toArray();
	//
	//     // real path not needed
	//     unset($attributes['realPath']);
	//
	//     // map the service object to its name
	//     $attributes['service'] = $attributes['service']->name;
	//
	//     return $attributes;
	// }
}