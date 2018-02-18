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

use Illuminate\Contracts\Support\Arrayable;

class Component implements Arrayable
{
	protected $attributes = [];
	/**
	 * Get the array representation of this instance.
	 *
	 * @return array
	 */
	public function toArray()
	{
		return $this->attributes;
	}
	/**
	 * Set the attributes for this component.
	 *
	 * @param array $attributes
	 */
	protected function setAttributes(array $attributes)
	{
		$this->attributes = $attributes;
	}
	/**
	 * Get an attribute's value if found.
	 *
	 * @param  string $key
	 *
	 * @return mixed
	 */
	public function __get($key)
	{
		if (isset($this->attributes[$key])) {
			return $this->attributes[$key];
		}
	}
}