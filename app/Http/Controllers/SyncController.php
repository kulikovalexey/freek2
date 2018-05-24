<?php

namespace App\Http\Controllers;

use App\Classes\StoreData\Products;
use App\StoreProduct;
use App\Variant;
use Illuminate\Http\Request;
use App\SupplierProduct;
//use App\Classes\StoreData\Brands;
//use App\Classes\SupplierData\SupplierData;
//use App\Classes\Parser\Parser;
//use App\Classes\StoreData\Products;
//use App\Classes\StoreData\Variants;
//use App\Repository\SupplierRepositoryFactory;
//use App\Repository\StoreProductRepository;
//use App\Repository\VariantRepository;
//use App\Repository\BrandRepository;
use ShopApi;

class SyncController extends Controller
{
    // выбрать все данные
    public function index()
    {

    }


    public function createProduct($data, $supplierData, $brandId) // :TODO rebase all to repositories
    {
        // :TODO here data new supplier product

        $resp = ShopApi::products()->create([
            "visibility"    => "hidden",   // for new hidden?
            "title"         => $data->title,  // name supplier product
            "data01"        => $data->brand,
//            "data02"        => "",
//            "data03"        => "",
            "fulltitle"     => $data->title,  // name supplier product
            "description"   => "",
            "content"       => "",
            "supplier"      => $supplierData->id,  // id supplier
            "brand"         => $brandId   // id brand
        ]);

        return $resp;
    }


    public function sybnc(Request $request)
    {
        $dataForUpdate = Variant::where('articleCode', '=', $request->articleCode)->get()->toArray();


        if(!isset($dataForUpdate[0]['product_id'])) {

            $this->createProduct();

        } else {

            $this->updateProduct();

        }

    }


    public function createVariant($data)  //:TODO prepare data
    {
        $resp = ShopApi::variants()->create([
                "articleCode"     => $data->articleCode,
                "ean"             => $data->ean,
                "sku"             => $data->sku,
                "priceIncl"       => $data->priceIncl,
                "stockLevel"      => $data->stockLevel,
                "product"      => [],
        ]);
        return $resp;
    }


    public function updateProduct(Request $request)  //remove test data
    {
        $dataForUpdate = Variant::where('articleCode', '=', $request->articleCode)->get()->toArray();


        if(!isset($dataForUpdate[0]['product_id'])) {
            echo 'new product'; exit;
        }

        $isStaticPrice = StoreProduct::findOrFail(13359801);  //for check static price
        print_r($isStaticPrice);
        exit;
        print_r($isStaticPrice);


//        if(){
//
//        }






        exit;
        $resp = ShopApi::products()->update($newProductData->id, [
            "title"         => "TEST_title_updated",
            "fulltitle"     => "TEST_fulltitle_updated",
            "description"   => "TEST_description_updated",
            "content"       => "TEST_CONTENT_updated",
        ]);

        return $resp;
    }

    /**
     * delete product
     * @param $id
     * @return array
     */
    public function deleteProduct($id)
    {
        $product = Products::findOrwhere($id);

        $resp = ShopApi::products()->delete($product->id);

        return $resp;
    }

    /**
     * get config data suppliers
     * @param $supplier
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function getConfigSuppliers($supplier)
    {
        return config("suppliers.{$supplier}");
    }

}