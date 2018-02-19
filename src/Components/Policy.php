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
 * Class Policy
 * @package Mosaiqo\Hexagonal\Components
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Policy extends Component
{
	/**
	 * Policy constructor.
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
			'policy' => $title,
			'namespace' => $namespace,
			'file' => $file,
			'path' => $path,
			'relativePath' => $relativePath,
			'content' => $content,
		]);
	}
}