<?php
namespace Mosaiqo\Hexagonal\Traits;

use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

trait ServesFeaturesTrait
{
	use
		MarshalTrait,
		DispatchesJobs;
	/**
	 * Serve the given feature with the given arguments.
	 *
	 * @param string $feature
	 * @param array  $arguments
	 *
	 * @return mixed
	 */
	public function serve($feature, $arguments = [])
	{
		return $this->dispatch($this->marshal($feature, new Collection(), $arguments));
	}
}