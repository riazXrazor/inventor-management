@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Products</h1>
@stop

@section('content')
  {{-- Setup data for datatables --}}
@php
$heads = [
    '#',
    'Name',
    ['label' => 'Category', 'width' => 40],
    ['label' => 'Price', 'width' => 10],
    ['label' => 'Stock', 'width' => 10],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

$config = [
    'data' => [
        [1, 'Product 1', 'Cat 1', 1000, 10 ,'<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
        [2, 'Product 2', 'Cat 1', 1000, 10 ,'<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
        [3, 'Product 3', 'Cat 2', 1000, 10 ,'<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
    ],
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, null, null, ['orderable' => false]],
];
@endphp

{{-- Compressed with style options / fill data using the plugin config --}}
<x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config"
    striped hoverable bordered compressed/>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    {{--  <link rel="stylesheet" href="/css/admin_custom.css">  --}}
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
@stop