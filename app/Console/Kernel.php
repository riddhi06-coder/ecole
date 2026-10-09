<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Sync GrayQuest status every 5 minutes
        $schedule->command('grayquest:sync-status')
                 ->everyminute()
                 ->withoutOverlapping();
    }


    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        // Load all console commands in app/Console/Commands
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
