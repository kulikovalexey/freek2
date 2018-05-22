@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Supplier information</div>  {{-- :TODO переименовать --}}


                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                    <div class="panel-body">
                        <div class="input-group">
                            <label for="basic-url">Id</label>
                            <input type="text" class="form-control form-control-lg"  value="{{ $info->id }}" disabled>
                        </div>
                        <div class="input-group">
                            <label for="basic-url">Name</label>
                            <input type="text" class="form-control form-control-lg" value="{{ $info->name }}" disabled>
                        </div>
                        <div class="input-group">
                            <label for="basic-url">Url</label>
                            <input type="text" class="form-control form-control-lg" value="{{ $info->url }}" disabled>
                        </div>
                        <div class="input-group">
                            <label for="basic-url">Except brands</label><br>
                            @foreach($info->exceptBrands as $item)
                                {{ $item }} <br>
                            @endforeach
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
