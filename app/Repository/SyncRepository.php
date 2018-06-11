<?php

namespace App\Repository;

use App\Classes\StoreData\Products;
use App\StoreProduct;
use App\Variant;
use ShopApi;

class SyncRepository
{
    public static function markForDeletion($productId)
    {
        $resp = ShopApi::products()->update($productId, [
            "visibility"    => 'hidden',
            "data03"        => 'deleted',
        ]);

        \Log::info('product ' . $productId . ' mark for deletion');  //:TODO include $resp
    }

    public static function removeMarkDelete($productId)
    {
        $resp = ShopApi::products()->update($productId, [
            "visibility"    => 'hidden',
            "data03"        => '',
        ]);

        \Log::info('product ' . $productId . 'remove data03=\'deleted\' products and visibility = \'\';');  //:TODO include $resp
    }


    /**
     * updating product (api)
     * @param $productData
     * @return array
     */
    public function updateProduct($productData, $variantId, $productId)  //remove test data
    {
        $product = StoreProduct::find($productId);

        $data = [
            "ean"           => $productData['ean'],
            "sku"           => $productData['sku'],
            "priceIncl"     => $productData['priceIncl'],
            "stockLevel"    => $productData['stockLevel'],
            "product"       => $productId,
        ];

        if ($this->isFixedPrice($product)){
            unset($data['priceIncl']);
        }

        $resp = ShopApi::variants()->update($variantId, $data); //:TODO refactoring

        return $resp;
    }

    /**
     * for product hidden products (api)
     * @param $productId
     */
    public function updateHiddenProduct($productId)
    {
        $resp = ShopApi::products()->update($productId, [
            "visibility"    => 'hidden',
            "data03"        => '',
        ]);
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
//            'priceExcl'  =>  $resp['priceExcl'], :TODO for supplier1
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


//    /** :TODO for future
//     * delete product (api)
//     * @param $id
//     * @return array
//     */
//    public function deleteProduct($id)
//    {
//        $product = Products::findOrwhere($id);
//
//        $resp = ShopApi::products()->delete($product->id);
//
//        return $resp;
//    }

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
        $resp = ShopApi::products()->delete($id);
        print_r($resp);
    }


    /**
     * check is fixed price
     * @param $productId
     * @return bool
     */
    protected function isFixedPrice($product)
    {
        return ($product->data02 == 'fixed_price');
    }


    /**
     * check is fixed price
     *
     * @param $product
     * @return bool
     */
    protected function isHidden($product)
    {
        return ($product->visibily == 'hidden');
    }

    protected function isDeleted($product)
    {
        return ($product->data03 == 'deleted');
    }
}