@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Products</h1>
    <div class="row text-center justify-content-end mr-1">


                
                <a href="{{ route('add-product') }}" class="btn btn-info">
                    Add Product
                </a>
   
    </div>
@stop

@section('content')
@if(session('successMsg'))
    <x-adminlte-alert title="success" theme="success" dismissable>
        {{  session('successMsg')  }}
    </x-adminlte-alert>
@endif
  {{-- Setup data for datatables --}}
@php
$heads = [
    ['label' => '#', 'width' => 5],
    'Name',
    ['label' => 'Category', 'width' => 40],
    ['label' => 'Price', 'width' => 10],
    ['label' => 'Stock', 'width' => 10],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];



$config = [
    'data' => collect($products)->map(function($item,$key){
        $btnDelete = '
        <form method="post" action="'.route("delete-product").'" style="display: initial">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" value="'.csrf_token().'" />
            <input type="hidden" name="product_id" value="'.$item["id"].'" />
            <button type="submit" name="delete_product" class="btn btn-xs text-danger text-primary mx-1 shadow" title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>
        </form>
        ';
        $btnEdit = '<form method="get" action="'.route("edit-product").'" style="display: initial">
                    <input type="hidden" name="product_id" value="'.$item["id"].'" />
                    <button type="submit" name="edit_product" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>
                </form>
                ';


        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </button>';
        return [$key+1, $item['name'], $item['category']['category_name'], $item['price'], $item['stock'] ,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'];
    })->all(),
    'order' => [[1, 'asc']],
    'columns' => [
            [ "searchable" =>  false ], 
            [ "searchable" =>  true ], 
            [ "searchable" =>  true ], 
            [ "searchable" =>  false ], 
            [ "searchable" =>  false ], 
            ['orderable' => false, "searchable" =>  false]],
];
@endphp

{{-- Compressed with style options / fill data using the plugin config --}}
<x-adminlte-datatable id="products-table" :heads="$heads" head-theme="dark" :config="$config"
    striped hoverable bordered compressed/>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    {{--  <link rel="stylesheet" href="/css/admin_custom.css">  --}}
    
@stop

@section('js')
  
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  
@stop