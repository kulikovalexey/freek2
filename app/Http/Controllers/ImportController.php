<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * import suppliers products
     * @param Request $request
     * @param $supplier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importSupplierProducts(Request $request, $supplier)
    {
        //:TODO create ajax indicator
        \Artisan::call('sync:import', ['supplier' => $supplier]);

        return redirect()->to('/');
    }

    /**
     * import products from store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importStoreProducts()
    {
        //:TODO create ajax indicator
        \Artisan::call('sync:import-store-products');

        return redirect()->to('/');
    }




}