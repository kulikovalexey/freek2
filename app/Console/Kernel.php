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
    protected function schedule(Schedule $schedule) //:TODO refactoring
    {
        //data from store
        $schedule->command('sync:import-store-brands')
            ->cron('00 6,12,18 * * *')
            ->between('6:00', '22:00');
        $schedule->command('sync:import-store-products')
            ->cron('02 6,12,18 * * *')
            ->between('6:00', '22:00');

        // import suppliers
        $schedule->command('sync:import supplier1')
            ->cron('05 6,12,18 * * *')
            ->between('6:00', '22:00');
        $schedule->command('sync:import supplier2')
            ->cron('10 6,12,18 * * *')
            ->between('6:00', '22:00');
        $schedule->command('sync:import supplier3')
            ->cron('15 6,12,18 * * *')
            ->between('6:00', '22:00');
        $schedule->command('sync:import supplier4')
            ->cron('20 6,12,18 * * *')
            ->between('6:00', '22:00');

//        // delete (mark product)
//        $schedule->command('sync:delete-product')
//            ->cron('22 6,12,18 * * *')
//            ->between('6:00', '22:00');

        // update products in store
//        $schedule->command('sync:update-product supplier1')
//            ->cron('25 6,12,18 * * *')
//            ->between('6:00', '22:00');
//        $schedule->command('sync:update-product supplier2')
//            ->cron('26 6,12,18 * * *')
//            ->between('6:00', '22:00');
//        $schedule->command('sync:update-product supplier3')
//            ->cron('27 6,12,18 * * *')
//            ->between('6:00', '22:00');
//        $schedule->command('sync:update-product supplier4')
//            ->cron('28 6,12,18 * * *')
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
