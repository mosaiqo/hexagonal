<?php

namespace Mosaiqo\Hexagonal\Http;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Mosaiqo\Hexagonal\Traits\ServesFeaturesTrait;

/**
 * Base controller.
 */
class Controller extends BaseController
{
	use ValidatesRequests;
	use ServesFeaturesTrait;
}