@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    <a href='lsc.php?getBrands'>Products from store</a><br>
                    <a href='/home/brands'>Brands</a><br>
                    <a href='/home/supplier1'>Supplier1 Real Solutions Haarle (9183)</a><br>
                    <a href='/home/supplier2'>Supplier2 API BV (367457)</a><br>
                    <a href='/home/supplier3'>Supplier3 Valadis (9264)</a><br>
                    <a href='/home/supplier4'>Supplier4 Wimood (441980)</a><br>
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
