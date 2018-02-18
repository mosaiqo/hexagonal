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


/**
 * @author Boudy de Geer <boudydegeer@mosaiqo.com>
 */
class Request extends Component
{
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