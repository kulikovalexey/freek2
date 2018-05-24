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

        $suppliers = SupplierProduct::where('supplier_id', $supplierData->id)
            ->with('variant')
            ->paginate(20);

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