<?php

namespace App\Http\Controllers;

use App\Classes\SupplierData\SupplierData;
use App\SupplierProduct;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * @param Request $request
     * @param $supplier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $supplier)
    {
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($supplier)
        );

        $suppliers = SupplierProduct::where('supplier_id', $supplierData->id)
            ->with('variant')
            ->orderBy('articleCode')
            ->paginate(100);

         return view('supplier.index', [
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * show supplier
     * @param Request $request
     * @param $supplier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSupplier(Request $request, $supplier)
    {
        $supplierData = new SupplierData(
            $this->getConfigSuppliers($supplier)
        );

        return view('supplier.info', [
            'info' => $supplierData,
        ]);
    }

    /**
     * get config suppliers
     * @param $supplier
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function getConfigSuppliers($supplier)
    {
        return config("suppliers.{$supplier}");
    }
}