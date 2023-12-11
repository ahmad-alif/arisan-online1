<?php

namespace App\Console;

use App\Console\Commands\CheckDeposits;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        \App\Console\Commands\CheckDeposits::class,
    ];


    // protected function schedule(Schedule $schedule): void
    // {
    //     // $schedule->command('inspire')->hourly();
    //     // $schedule->command('check:deposits')->daily();
    // }
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('setoran:check-status')->daily();
        $schedule->command('setoran:remind-members')->everyMinute();
        // $schedule->job(new CheckDeposits)->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
