<?php
/*
 * This file is part of the lucid-console project.
 *
 * (c) Vinelab <dev@vinelab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mosaiqo\Hexagonal\Generators;

use Mosaiqo\Hexagonal\Finder\Traits\Finder;
use Mosaiqo\Hexagonal\Filesystem\Traits\Filesystem;

use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;
/**
 * @author Abed Halawi <abed.halawi@vinelab.com>
 */
class Generator
{
	use Finder;
	use Filesystem;

	/**
	 * @var string
	 */
	protected $stubDirectory = __DIR__.'/../stubs/';

	/**
	 * @param string $path
	 * @return string
	 */
	protected function getStubDirectory ($path = '') {
		return $this->stubDirectory . $path;
	}
}