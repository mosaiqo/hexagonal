<?php
/*
 * This file is part of the mosaiqo/hexagonal project.
 *
 * (c) Mosaiqo <mosaiqo@mosaiqo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mosaiqo\Hexagonal\Generators;

use Mosaiqo\Hexagonal\Finder\Traits\FinderTrait;
use Mosaiqo\Hexagonal\Filesystem\Traits\FilesystemTrait;

use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;


class Generator
{
	use FinderTrait;
	use FilesystemTrait;

	/**
	 * @var string
	 */
	protected $stubDirectory = MOSAIQO_HEXAGONAL_PATH . '/stubs/';

	/**
	 * @param string $path
	 * @return string
	 */
	protected function getStubDirectory($path = '')
	{
		return $this->stubDirectory . $path;
	}
}