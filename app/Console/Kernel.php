<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('backup:clean')->daily()->at('01:58')->appendOutputTo(storage_path('logs/laravel.log'));
        $schedule->command('backup:run --only-db')->daily()->at('01:58')->appendOutputTo(storage_path('logs/laravel.log'));
        // $schedule->command('backup:clean')->everyMinute()->appendOutputTo(storage_path('logs/laravel.log'));
        // $schedule->command('backup:run --only-db')->everyMinute()->appendOutputTo(storage_path('logs/laravel.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
