<?php

namespace App\Console;

use App\Console\Commands\RouteListCommand;
use App\Console\Commands\VkDataCollectionCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		RouteListCommand::class,
		VkDataCollectionCommand::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule $schedule
	 *
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		$schedule
			->command(VkDataCollectionCommand::class)
			->everyMinute()
			->name('vk-data-collection')
			->withoutOverlapping();
	}
}
