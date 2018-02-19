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



class Operation extends Component
{
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