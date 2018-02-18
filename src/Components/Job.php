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
class Job extends Component
{
	public function __construct($title, $namespace, $file, $path, $relativePath, Domain $domain = null, $content = '')
	{
		$className = str_replace(' ', '', $title) . 'Job';
		$this->setAttributes([
			'title' => $title,
			'className' => $className,
			'namespace' => $namespace,
			'file' => $file,
			'realPath' => $path,
			'relativePath' => $relativePath,
			'domain' => $domain,
			'content' => $content,
		]);
	}

	public function toArray()
	{
		$attributes = parent::toArray();
		if ($attributes['domain'] instanceof Domain) {
			$attributes['domain'] = $attributes['domain']->toArray();
		}
		return $attributes;
	}
}