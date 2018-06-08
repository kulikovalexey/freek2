<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\SupplierData\SupplierData;

class UpdateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:update-product {supplier}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update products in store from {supplier}';

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
        $supplier = $this->argument('supplier');
        $this->info(' update products supplier: ' . $supplier);
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($supplier)
        );

        $productsData = \DB::select('CALL `sp_select_products_for_update`(' . $supplierData->id . ')');

        if ($productsData) {
            $this->info('data start to update');
            foreach ($productsData as $item) {
                print_r($item->articleCode);


                \Log::info('updated : ' . $supplierData->id);
            }
        } else {
            $this->info('no data to update');
        }

    }


    protected function getConfigSuppliers($supplier) //:TODO rebase
    {
        return config("suppliers.{$supplier}");
    }
}
