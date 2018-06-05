<?php

namespace App\Http\Controllers;

use App\Repository\SyncRepository;
use App\Brand;
use App\Classes\StoreData\Products;
use App\StoreProduct;
use App\Variant;
use Illuminate\Http\Request;
use App\SupplierProduct;
use ShopApi;

class SyncController extends Controller
{
    protected $syncRepository;

    public function __construct(SyncRepository $syncRepository)
    {
        $this->syncRepository = $syncRepository;
    }

    public function sync(Request $request)
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

        if(isset($variantData[0]['product_id'])) { //update

            $resp = $this->syncRepository->updateProduct($productData[0], $variantData[0]['id'], $variantData[0]['product_id']);

            return \Redirect::back()->withErrors(['Product was updated']);

        } else { //create

            $resp = $this->syncRepository->createProduct($productData[0], $supplierId, $brandId->id);
            $this->syncRepository->saveNewProductData($resp, $brandId->id, $supplierId);

            $variantId = $this->syncRepository->getIdForNewVariant($resp['id']);

            $resp = $this->syncRepository->updateVariant($productData[0], $variantId);

            return \Redirect::back()->withErrors(['Product was created']);
        }

    }
}