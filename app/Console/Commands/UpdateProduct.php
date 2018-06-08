<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\SupplierData\SupplierData;
use App\SupplierProduct;
use App\Brand;
use App\Variant;
use App\Repository\SyncRepository;
use Mockery\Exception;

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


    protected $syncRepository;

    /**
     * Create a new command instance.
     * UpdateProduct constructor.
     * @param SyncRepository $syncRepository
     */
    public function __construct(SyncRepository $syncRepository)
    {
        parent::__construct();
        $this->syncRepository = $syncRepository;
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

        $cnt = count($productsData);

        if (!empty($productsData)) {
            $this->info('data start to update');
            foreach ($productsData as $item) {
                try {
                    $this->sync($item->articleCode, $item->supplier_id);

                    $this->info('updated : ' . $item->articleCode);
                    sleep(1);
                } catch (Exception $e) {
                    \Log::error('Error');
                }
            }
        } else {
            $this->info('no data to update');
        }

    }


    protected function getConfigSuppliers($supplier) //:TODO rebase
    {
        return config("suppliers.{$supplier}");
    }


    //from synccontroller/ :TODO refactoring

    public function sync($articleCode, $supplierId)  //:TODO refactoring
    {

            $variantData = Variant::where('articleCode', '=', $articleCode)
                ->get()
                ->toArray();

            $productData = SupplierProduct::where('supplier_id', '=', $supplierId)
                ->where('articleCode', '=', $articleCode)
                ->get([
                    'id',
                    'brand',
                    'name',
                    'articleCode',
                    'ean',
                    'sku',
                    'priceIncl',
                    'stockLevel',
                ]);

            $brandId = Brand::where('name', '=', $productData[0]['brand'])->first();

            if (isset($variantData[0]['product_id'])) {

                $resp = $this->updateProduct($productData[0], $variantData[0]['id'], $variantData[0]['product_id']);

                if(isset($resp['id'])) \Log::info('supplierId: ' . $supplierId . '- articleCode: ' . $articleCode . ',  Product was updated');

            } else {

                $resp = $this->createProduct($productData[0], $supplierId, $brandId->id);

                if(isset($resp['id'])) \Log::info('supplierId: ' . $supplierId . '- articleCode: ' . $articleCode . ',  Product was created');
            }



    }

    /**
     * @param $productData
     * @param $supplierId
     * @param $brandId
     * @return array
     */
    protected function createProduct($productData, $supplierId, $brandId)
    {
        $resp = $this->syncRepository->createProduct($productData, $supplierId, $brandId);
        $this->syncRepository->saveNewProductData($resp, $brandId, $supplierId);

        $variantId = $this->syncRepository->getIdForNewVariant($resp['id']);

        return $this->syncRepository->updateVariant($productData, $variantId);
    }

    /**
     * @param $productData
     * @param $variantId
     * @param $productId
     * @return array
     */
    protected function updateProduct($productData, $variantId, $productId)
    {
        return $this->syncRepository->updateProduct($productData, $variantId, $productId);
    }
}
