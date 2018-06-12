@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Data</div>

                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
                <div class="panel-body">
                    <a href='/home/products'>Products from store</a><br>
                    <a href='/home/brands'>Brands from store</a><br>
                    <a href='/home/supplier1'>Supplier1 Real Solutions Haarle (9183)</a><br>
                    <a href='/home/supplier2'>Supplier2 API BV (367457)</a><br>
                    <a href='/home/supplier3'>Supplier3 Valadis (9264)</a><br>
                    <a href='/home/supplier4'>Supplier4 Wimood (441980)</a><br>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Update data (updated automatically)</div>
                <div class="panel-body">
                    <a href='/store/products'>check Stock</a><br>{{-- :TODO rename route--}}
                    <a href='/import/supplier1'>check Supplier Real Solutions Haarlem</a> {!! file_exists(storage_path('sync/supplier1.csv')) ? '(last updated: ' . date("F d Y H:i:s.", filemtime(storage_path('sync/supplier1.csv'))) .')' : '' !!}<br>
                    <a href='/import/supplier2'>check Supplier Api BV</a> {!! file_exists(storage_path('sync/supplier2.csv')) ? '(last updated: ' . date("F d Y H:i:s.", filemtime(storage_path('sync/supplier2.csv'))) .')' : '' !!}<br>
                    <a href='/import/supplier3'>check Supplier Valadis</a> {!! file_exists(storage_path('sync/supplier3.csv')) ? '(last updated: ' . date("F d Y H:i:s.", filemtime(storage_path('sync/supplier3.csv'))) .')' : '' !!}<br>
                    <a href='/import/supplier4'>check Supplier Wimood</a> {!! file_exists(storage_path('sync/supplier4.xml')) ? '(last updated: ' . date("F d Y H:i:s.", filemtime(storage_path('sync/supplier4.xml'))) .')' : '' !!}<br>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Suppliers settings</div>
                <div class="panel-body">
                    <a href='/home/show/supplier1'>show Supplier Real Solutions Haarlem</a><br>
                    <a href='/home/show/supplier2'>show Supplier Api BV</a><br>
                    <a href='/home/show/supplier3'>show Supplier Valadis</a><br>
                    <a href='/home/show/supplier4'>show Supplier Wimood</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
