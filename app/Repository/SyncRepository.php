<?php

namespace App\Repository;

use App\Brand;
use App\Classes\StoreData\Products;
use App\StoreProduct;
use App\Variant;
use Illuminate\Http\Request;
use App\SupplierProduct;
use ShopApi;

class SyncRepository
{
    /**
     * updating product (api)
     * @param $productData
     * @return array
     */
    public function updateProduct($productData, $variantId, $productId)  //remove test data
    {
        $data = [
//            "articleCode"   => $productData['articleCode'],
//            "ean"           => $productData['ean'],
//            "sku"           => $productData['sku'],
            "priceIncl"     => $productData['priceIncl'],
            "stockLevel"    => $productData['stockLevel'],
            "product"       => $productId,
        ];

        if ($this->isFixedPrice($productId)){
            unset($data['priceIncl']);
        }

        $resp = ShopApi::variants()->update($variantId, $data); //:TODO дублировние.переделать на универсальное

        return $resp;
    }


    /**
     * creating product (api)
     * @param $productData
     * @param $supplierId
     * @return array
     */
    public function createProduct($productData, $supplierId, $brandId)
    {
        $resp = ShopApi::products()->create([
            "visibility"    => "hidden",
            "title"         => $productData['name'],
            "data01"        => $productData['brand'],
            "fulltitle"     => $productData['brand'],
            "description"   => "",
            "content"       => "",
            "supplier"      => $supplierId,
            "brand"         => $brandId,
        ]);

        return $resp;
    }

    /** save new product (db)
     * @param $resp
     * @param $brandId
     * @param $supplierId
     * @return bool
     */
    public function saveNewProductData($resp, $brandId, $supplierId)
    {
        $data = [
            'id'         =>  $resp['id'],
            'name'       =>  $resp['title'],
            'data01'     =>  $resp['data01'],
            'data02'     =>  $resp['data02'],
            'data03'     =>  $resp['data03'],
            'brand_id'   =>  $brandId,
            'supplier_id'=>  $supplierId,
//            'priceExcl'  =>  $resp['priceExcl'], :TODO перепроверить
        ];

        return StoreProduct::insert($data);
    }

    /**
     * create new variant (api)
     * @param $productId
     * @return mixed
     */
    public function getIdForNewVariant($productId)
    {
        $newVariant = ShopApi::variants()->get(null, [
            'product' => $productId,
            'fields' => "id"
        ]);

        return $newVariant[0]['id'];
    }

    /**
     * update variant (api)
     * @param $data
     * @param $variantId
     * @return array
     */
    public function updateVariant($data, $variantId)
    {
        $resp = ShopApi::variants()->update($variantId, [
            "articleCode"   => $data->articleCode,
            "ean"           => $data->ean,
            "sku"           => $data->sku,
            "priceIncl"     => $data->priceIncl,
            "stockLevel"    => $data->stockLevel,
            "product"       => [],
        ]);

        return $resp;
    }


    /**
     * delete product (api)
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
     * save new variant (db)
     * @param $resp
     * @return bool
     */
    protected function saveNewVariantData($resp)
    {
        $data = [
            'id'         =>  $resp['id'],
            'articleCode'       =>  $resp['articleCode'],
            'ean'     =>  $resp['ean'],
            'sku'     =>  $resp['sku'],
            'priceIncl'     =>  $resp['priceIncl'],
            'stockLevel'    =>  $resp['stockLevel'],
            'product_id'    =>  $resp['product_id'],
        ];

        return Variant::insert($data);
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


    /**
     * delete product (api)
     * @param $id
     */
    protected function clearTrash($id)
    {
        // удалить продукт
        $resp = ShopApi::products()->delete($id);
        print_r($resp);
    }


    /**
     * check is fixed price
     * @param $productId
     * @return bool
     */
    protected function isFixedPrice($productId)
    {
        $isFixedPrice = StoreProduct::find($productId);

        return ($isFixedPrice->data02 == 'fixed_price');
    }

}