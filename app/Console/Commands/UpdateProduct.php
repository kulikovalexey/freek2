<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:update-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update products in store';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $productsData = \DB::select('CALL `sp_select_products_for_update`(441980)');

        foreach ($productsData as $item){
            print_r($item);


            Log::info();
        }

    }
}
