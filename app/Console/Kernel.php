<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ImportStoreBrands::class,
        Commands\ImportStoreProducts::class,
        Commands\ImportSupplier::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync:import-store-brands')
            ->hourly()
            ->between('6:00', '22:00');
        $schedule->command('sync:import-store-products')
            ->hourly()
            ->between('6:00', '22:00');
        $schedule->command('sync:import supplier1')
            ->hourly()
            ->between('6:00', '22:00');
        $schedule->command('sync:import supplier2')
            ->hourly()
            ->between('6:00', '22:00');
        $schedule->command('sync:import supplier3')
            ->hourly()
            ->between('6:00', '22:00');
        $schedule->command('sync:import supplier4')
            ->hourly()
            ->between('6:00', '22:00');
//        $schedule->command('sync:create-export-data')
//            ->hourly()
//            ->between('6:00', '22:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
