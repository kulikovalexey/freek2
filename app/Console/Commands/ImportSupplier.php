<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\SupplierData\SupplierData;
use App\Classes\Parser\Parser;
use App\Repository\SupplierRepositoryFactory;
use App\Classes\Loader\Loader;

class ImportSupplier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:import {supplier}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync:import {supplier}';

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
        $this->info(' import supplier: ' . $supplier);
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($supplier)
        );

        $this->info('start download file: ' . $supplier);
        (new Loader())->downloadFile($supplierData);

        $this->info('Start parsing');
        $data = (new Parser())->parse($supplierData);

        $this->info('Saving data');
        $supplierRepository = (new SupplierRepositoryFactory())->makeSupplierRepository($supplierData);
        $supplierRepository->saveLoadingData($data, $supplierData);
    }

    protected function getConfigSuppliers($supplier)  //:TODO rebase
    {
        return config("suppliers.{$supplier}");
    }
}
