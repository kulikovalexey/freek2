@extends('layouts.app')

@section('content')
    <div class="container-fluent">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Supplier {{  $suppliers[0]->supplier_id  }}</div> {{-- :TODO переименовать --}}


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
                                <th></th>
                                <th>articleCode</th>
                                <th>sku</th>
                                <th>ean</th>
                                <th>name</th>
                                <th>brand</th>
                                <th>stockLevel (old)</th>
                                <th>stockLevel (new)</th>
                                <th>priceIncl (old)</th>
                                <th>priceIncl (new)</th>
                                <th>priceIncl (origin)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
                                <tr>
                                    <td>
                                        <form action="{{ route('sync.product') }}" method="POST">
                                            <input name="articleCode" type="hidden"
                                                   value="{{ $supplier->articleCode }}">
                                            {{--<input name="prodId" type="hidden" value="{{ $supplier->articleCode }}">--}}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="articleCode"
                                                   value="{{ $supplier->articleCode }}">
                                            <input type="hidden" name="supplier_id"
                                                   value="{{ $suppliers[0]->supplier_id }}">
                                            <button class="btn btn-update">update</button>
                                        </form>
                                    </td>


                                    <td>{{ ( isset ($supplier->variant['articleCode'])) ? $supplier->articleCode : $supplier->articleCode . ' new'  }}</td>
                                    {{--<td>{{ $supplier->articleCode }}</td>--}}
                                    <td>{{ $supplier->sku }}</td>
                                    <td>{{ $supplier->ean }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->brand }}</td>
                                    <td>{{ $supplier->variant['stockLevel'] }}</td>
                                    <td>{{ $supplier->stockLevel }}</td>
                                    <td>{{ $supplier->variant['priceIncl'] }}</td>
                                    <td>{{ $supplier->priceIncl }}</td>
                                    <td>{{ $supplier->priceIncl_origin }}</td>
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
