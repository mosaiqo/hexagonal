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
 * Class Model
 * @package Mosaiqo\Hexagonal\Components
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Model extends Component
{
	/**
	 * Model constructor.
	 * @param $title
	 * @param $namespace
	 * @param $file
	 * @param $path
	 * @param $relativePath
	 * @param $content
	 */
	public function __construct($title, $namespace, $file, $path, $relativePath, $content)
	{
		$this->setAttributes([
			'model' => $title,
			'namespace' => $namespace,
			'file' => $file,
			'path' => $path,
			'relativePath' => $relativePath,
			'content' => $content,
		]);
	}
}