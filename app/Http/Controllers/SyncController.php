<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Classes\StoreData\Products;
use App\StoreProduct;
use App\Variant;
use Illuminate\Http\Request;
use App\SupplierProduct;

use ShopApi;
use Illuminate\Support\Facades\Session;

class SyncController extends Controller
{
    public function sync(Request $request)
    {
//        $this->clearTrash(72868535);
//        $this->clearTrash(72857900);
//        exit;
//
        $articleCode = $request->articleCode;
        $supplierId = $request->supplierId;

        $variantData = Variant::where('articleCode', '=', $articleCode)  //:TODO rename/ проверяю наличие старых variant
            ->get()
            ->toArray();

        $productData = SupplierProduct::where('supplier_id', '=', $supplierId)  // :TODO вытягиваю новые данные из файла поставщика
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
            //update
            $resp = $this->updateProduct($productData[0], $variantData[0]['id'], $variantData[0]['product_id']);  //:TODO refactoring
echo '<br>';

//:TODO обработать ошибку

            return \Redirect::back()->withErrors(['Product was updated']);

        } else {
            //create
            $resp = $this->createProduct($productData[0], $supplierId, $brandId->id);
            $this->saveNewProductData($resp, $brandId->id, $supplierId);

            $variantId = $this->getIdForNewVariant($resp['id']);

            $resp = $this->updateVariant($productData[0], $variantId);

            return \Redirect::back()->withErrors(['Product was created']);
        }

    }



    /**
     * creating product
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
//            "data02"        => "",
//            "data03"        => "",
            "fulltitle"     => $productData['brand'],
            "description"   => "",
            "content"       => "",
            "supplier"      => $supplierId,
            "brand"         => $brandId,
        ]);

        return $resp;
    }

    /**
     * updating product
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
            "product"       => $productId,   //:TODO тут product_id в базе все данные есть. зачем тогда?
        ];

        if ($this->isFixedPrice($productId)){
            unset($data['priceIncl']);
        } else {
            echo 'принимаем новое значение';
        }

        $resp = ShopApi::variants()->update($variantId, $data); //:TODO переделать на универсальное

        return $resp;
    }

    /**
     * create new variant
     * @param $productId
     * @return mixed
     */
    protected function getIdForNewVariant($productId)
    {
        $newVariant = ShopApi::variants()->get(null, [
            'product' => $productId,
            'fields' => "id"
        ]);

       return $newVariant[0]['id'];
    }

    /**
     * update variant
     * @param $data
     * @param $variantId
     * @return array
     */
    protected function updateVariant($data, $variantId)
    {
        $resp = ShopApi::variants()->update($variantId, [
            "articleCode"   => $data->articleCode,
            "ean"           => $data->ean,
            "sku"           => $data->sku,
            "priceIncl"     => $data->priceIncl,
            "stockLevel"    => $data->stockLevel,
            "product"       => [],   //:TODO тут product_id в базе все данные есть. зачем тогда?
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



    protected function saveNewProductData($resp, $brandId, $supplierId)
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


    protected function clearTrash($id)
    {
        // удалить продукт
        $resp = ShopApi::products()->delete($id);
        print_r($resp);
    }


    protected function isFixedPrice($productId)
    {
        $isFixedPrice = StoreProduct::find($productId);

        return ($isFixedPrice->data02 == 'fixed_price');
    }
}