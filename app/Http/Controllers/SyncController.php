<?php

namespace App\Http\Controllers;

use App\Repository\SyncRepository;
use App\Brand;
use App\Variant;
use Illuminate\Http\Request;
use App\SupplierProduct;

class SyncController extends Controller
{
    protected $syncRepository;

    public function __construct(SyncRepository $syncRepository)
    {
        $this->syncRepository = $syncRepository;
    }


    public function sync(Request $request)  //:TODO refactoring (in command same function)
    {
        $articleCode = $request->articleCode;
        $supplierId = $request->supplierId;

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

        if(isset($variantData[0]['product_id'])) {

            $resp = $this->updateProduct($productData[0], $variantData[0]['id'], $variantData[0]['product_id']);

            return \Redirect::back()->withErrors(['Product was updated']);

        } else {

            $resp = $this->createProduct($productData[0], $supplierId, $brandId->id);

            return \Redirect::back()->withErrors(['Product was created']);
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