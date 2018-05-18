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
                        {{ $suppliers->links() }}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>sku</th>
                                <th>ean</th>
                                <th>name</th>
                                <th>brand</th>
                                <th>stockLevel</th>
                                <th>priceIncl</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->sku }}</td>
                                <td>{{ $supplier->ean }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->brand }}</td>
                                <td>{{ $supplier->stockLevel }}</td>
                                <td>{{ $supplier->priceIncl }}</td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    {{ $suppliers->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection