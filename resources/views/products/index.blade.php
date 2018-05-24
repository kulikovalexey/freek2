@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Store products</div>  {{-- :TODO переименовать --}}


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
                                <th>articleCode</th>
                                <th>sku</th>
                                <th>ean</th>
                                <th>name</th>
                                <th>visibility</th>
                                <th>data01</th>
                                <th>data02</th>
                                <th>data03</th>
                                <th>brand_id</th>
                                <th>supplier_id</th>

                                <th>stockLevel</th>
                                <th>priceIncl</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->variant['articleCode'] }}</td>
                                <td>{{ $product->variant['sku'] }}</td>
                                <td>{{ $product->variant['ean'] }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->visibility }}</td>
                                <td>{{ $product->data01 }}</td>
                                <td>{{ $product->data02 }}</td>
                                <td>{{ $product->data03 }}</td>
                                <td>{{ $product->brand_id }}</td>
                                <td>{{ $product->supplier_id }}</td>
                                <td>{{ $product->variant['stockLevel'] }}</td>
                                <td>{{ $product->variant['priceIncl'] }}</td>
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
