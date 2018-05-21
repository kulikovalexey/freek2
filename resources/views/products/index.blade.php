@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Supplier</div>  {{-- :TODO переименовать --}}


                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                    <div class="panel-body">
                        {{ $products->links() }}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>visibility</th>
                                <th>data01</th>
                                <th>data02</th>
                                <th>data03</th>
                                <th>brand_id</th>
                                <th>supplier_id</th>
                                <th>stockLevel</th>
                                <th>priceIncl</th>
                                <th>>sku</th>
                                <th>ean</th>
                                <th>articleCode</th>
                                <th>priceExcl</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $supplier->_id }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->visibility }}</td>
                                <td>{{ $supplier->data01 }}</td>
                                <td>{{ $supplier->data02 }}</td>
                                <td>{{ $supplier->data03 }}</td>
                                <td>{{ $supplier->brand_id }}</td>
                                <td>{{ $supplier->supplier_id }}</td>
                                <td>{{ $supplier->stockLevel }}</td>
                                <td>{{ $supplier->priceIncl }}</td>
                                <td>{{ $supplier->sku }}</td>
                                <td>{{ $supplier->ean }}</td>
                                <td>{{ $supplier->articleCode }}</td>
                                <td>{{ $supplier->priceExcl }}</td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    {{ $products->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
