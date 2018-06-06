<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StoreData\Brands;
use App\Repository\BrandRepository;

class ImportStoreBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:import-store-brands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import store brands';

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
        $this->info('get brands data');
        $brandsData = (new Brands())->getAll();

        (new BrandRepository())->saveBrands($brandsData);
        $this->info('finish');
    }
}
