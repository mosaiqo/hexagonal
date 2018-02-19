<?php
/******************************************************************************
 *                                                                            *
 * This file is part of the mosaiqo/hexagonal project.                        *
 * Copyright (c) 2018 Boudy de Geer <boudydegeer@mosaiqo.com>                 *
 * For the full copyright and license information, please view the LICENSE    *
 * file that was distributed with this source code.                           *
 *                                                                            *
 ******************************************************************************/

namespace Mosaiqo\Hexagonal\Console;

use Illuminate\Console\Command;

class BaseCommand extends Command {
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