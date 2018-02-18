<?php
namespace Mosaiqo\Hexagonal;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Mosaiqo\Hexagonal\Traits\JobDispatcherTrait;
use Mosaiqo\Hexagonal\Traits\MarshalTrait;

abstract class Feature
{
	use MarshalTrait;
	use DispatchesJobs;
	use JobDispatcherTrait;
}