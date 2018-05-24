<?php

namespace App\Http\Controllers;

use App\Classes\SupplierData\SupplierData;
use App\StoreProduct;
use App\SupplierProduct;
use App\Repository\BrandRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index(Request $request, $supplier)
    {
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($supplier)
        );

        $suppliers = SupplierProduct::where('supplier_id', $supplierData->id)->with(
            'variant')->paginate(20);

//        /*
//        DB::table('notices')
//        ->join('users', 'notices.user_id', '=', 'users.id')
//        ->join('departments', 'users.dpt_id', '=', 'departments.id')
//        ->select('notices.id', 'notices.title', 'notices.body', 'notices.created_at', 'notices.updated_at', 'users.name', 'departments.department_name')
//        ->paginate(20);
//        */
//
//
//
//        $suppliers = \DB::table('store_products')
//            ->leftJoin('variants', 'store_products.id', '=', 'variants.product_id' )
//            ->leftJoin('brands', 'store_products.brand_id', '=', 'brands.id' )
//            ->rightJoin('supplier_products', 'variants.articleCode', '=', 'supplier_products.articleCode' )
//            ->where('supplier_products.supplier_id', '=', $supplierData->id )
//            ->paginate(20);
//
////        print_r($suppliers);
////exit;

         return view('supplier.index', [
            'suppliers' => $suppliers,
        ]);
    }

    public function showSupplier(Request $request, $supplier)
    {
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($supplier)
        );

        return view('supplier.info', [
            'info' => $supplierData,
        ]);
    }

    protected function getConfigSuppliers($supplier)
    {
        return config("suppliers.{$supplier}");
    }



}