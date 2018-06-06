<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StoreData\Products;
use App\Classes\StoreData\Variants;
use App\Repository\StoreProductRepository;
use App\Repository\VariantRepository;

class ImportStoreProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:import-store-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import store products';

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
        $this->info(' import store product');
        // api
        $data = (new Products())->getAll();
        (new StoreProductRepository())->saveLoadingData($data);

        $this->info(' import variants');
        // api
        $data = (new Variants())->getAll();
        (new VariantRepository())->saveLoadingData($data);
    }
}
