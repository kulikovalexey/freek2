@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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

                                {{--$table->increments('id');--}}
                                {{--$table->string('name');--}}
                                {{--$table->string('createdAt');--}}
                                {{--$table->string('updatedAt');--}}
                                {{--$table->string('visibility')->nullable();--}}
                                {{--$table->string('data01')->nullable();--}}
                                {{--$table->string('data02')->nullable();--}}
                                {{--$table->string('data03')->nullable();--}}
                                {{--$table->integer('brand_id')->nullable();--}}
                                {{--$table->integer('supplier_id')->nullable();--}}
                                {{--$table->string('priceExcl')->nullable();--}}

                                {{--$table->string('articleCode')->nullable();--}}
                                {{--$table->string('ean')->nullable();--}}
                                {{--$table->string('sku')->nullable();  //:TODO ключ?--}}
                                {{--$table->integer('priceIncl')->nullable();--}}
                                {{--$table->integer('stockLevel')->nullable();--}}
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
                                <th>sku</th>
                                <th>ean</th>
                                <th>articleCode</th>
                                <th>priceExcl</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->visibility }}</td>
                                <td>{{ $product->data01 }}</td>
                                <td>{{ $product->data02 }}</td>
                                <td>{{ $product->data03 }}</td>
                                <td>{{ $product->brand_id }}</td>
                                <td>{{ $product->supplier_id }}</td>
                                <td>{{ $product->stockLevel }}</td>
                                <td>{{ $product->priceIncl }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->ean }}</td>
                                <td>{{ $product->articleCode }}</td>
                                <td>{{ $product->priceExcl }}</td>
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
