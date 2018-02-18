<?php
namespace Mosaiqo\Hexagonal\Queueables;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Mosaiqo\Hexagonal\Operation as BaseOperation;

/**
 * An abstract Operation that can be managed with a queue
 * when extended the operation will be queued by default.
 */
class Operation extends BaseOperation implements ShouldQueue
{
	use SerializesModels;
	use InteractsWithQueue;
	use Queueable;
}