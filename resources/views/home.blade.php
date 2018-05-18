@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <div class="panel-body">
                    <a href='lsc.php?getBrands'>Products from store</a><br>
                    <a href='/home/brands'>Brands</a><br>
                </div>
                <div class="panel-body">
                    <a href='lsc.php?updateSupplier=367457,0'>edit Supplier Api BV</a><br>
                    <a href='lsc.php?updateSupplier=9183,0'>edit Supplier Real Solutions Haarlem</a><br>
                    <a href='lsc.php?updateSupplier=9264,0'>edit Supplier Valadis</a><br>
                    <a href='lsc.php?updateSupplier=441980,0'>edit Supplier Wimood</a><br>
                </div>
                <div class="panel-body">
                    <a href='lsc.php?updateSupplier=367457,0'>check Supplier Api BV</a><br>
                    <a href='lsc.php?updateSupplier=9183,0'>check Supplier Real Solutions Haarlem</a><br>
                    <a href='lsc.php?updateSupplier=9264,0'>check Supplier Valadis</a><br>
                    <a href='lsc.php?updateSupplier=441980,0'>check Supplier Wimood</a><br>
                </div>
                <div class="panel-body">
                    <a href='lsc_checkstock.php?updateSupplier=367457#null'>check Stock</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
