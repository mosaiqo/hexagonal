<?php
namespace Mosaiqo\Hexagonal\Queueables;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Mosaiqo\Hexagonal\Job as BaseJob;
/**
 * An abstract Job that can be managed with a queue
 * when extended the job will be queued by default.
 */
class Job extends BaseJob implements ShouldQueue
{
	use SerializesModels;
	use InteractsWithQueue;
	use Queueable;
}