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
 * Class Request
 * @package Mosaiqo\Hexagonal\Components
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Request extends Component
{
	/**
	 * Request constructor.
	 * @param $title
	 * @param $service
	 * @param $namespace
	 * @param $file
	 * @param $path
	 * @param $relativePath
	 * @param $content
	 */
	public function __construct($title, $service, $namespace, $file, $path, $relativePath, $content)
	{
		$this->setAttributes([
			'request' => $title,
			'service' => $service,
			'namespace' => $namespace,
			'file' => $file,
			'path' => $path,
			'relativePath' => $relativePath,
			'content' => $content,
		]);
	}
}