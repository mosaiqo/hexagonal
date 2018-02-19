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
 * Class Job
 * @package Mosaiqo\Hexagonal\Components
 */
class Job extends Component
{
	/**
	 * Job constructor.
	 * @param $title
	 * @param $namespace
	 * @param $file
	 * @param $path
	 * @param $relativePath
	 * @param Domain|null $domain
	 * @param string $content
	 */
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

	/**
	 * @return array
	 */
	public function toArray()
	{
		$attributes = parent::toArray();
		if ($attributes['domain'] instanceof Domain) {
			$attributes['domain'] = $attributes['domain']->toArray();
		}
		return $attributes;
	}
}