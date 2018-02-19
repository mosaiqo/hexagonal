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
 * Class Operation
 * @package Mosaiqo\Hexagonal\Components
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Operation extends Component
{
	/**
	 * Operation constructor.
	 * @param $title
	 * @param $file
	 * @param $realPath
	 * @param $relativePath
	 * @param Service|null $service
	 * @param string $content
	 */
	public function __construct($title, $file, $realPath, $relativePath, Service $service = null, $content = '')
	{
		$className = str_replace(' ', '', $title) . 'Operation';
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
}