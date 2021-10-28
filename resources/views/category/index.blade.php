@extends('adminlte::page')

@section('title', 'Category')

@section('content_header')
    <h1>Category</h1>
    <div class="row text-center justify-content-end mr-1">
        <a href="{{ route('add-category') }}" class="btn btn-info">
            Add Category
        </a>

</div>
@stop

@section('content')
@if(session('successMsg'))
    <x-adminlte-alert title="success" theme="success" dismissable>
        {{  session('successMsg')  }}
    </x-adminlte-alert>
@endif
@if(session('errorMsg'))
    <x-adminlte-alert title="Error" theme="danger" dismissable>
        {{  session('errorMsg')  }}
    </x-adminlte-alert>
@endif
  {{-- Setup data for datatables --}}
@php

    $heads = [
        ['label' => '#', 'width' => 10],
        'Category Name',
        ['label' => 'Actions', 'no-export' => true, 'width' => 10]
    ];



               $config = [
                'data' => collect($categories)->map(function($item,$key){
                    $btnDelete = '
                    <form method="post" action="'.route("delete-category").'" style="display: initial">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                        <input type="hidden" name="category_id" value="'.$item["id"].'" />
                        <button type="submit" name="delete_category" class="btn btn-xs text-danger text-primary mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    ';
                    $btnEdit = '<form method="get" action="'.route("edit-category").'" style="display: initial">
                                <input type="hidden" name="category_id" value="'.$item["id"].'" />
                                <button type="submit" name="edit_product" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Delete">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            </form>
                            ';
            
            
                    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>';
                    return [$key+1, $item['category_name'] ,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'];
                })->all(),
                'order' => [[1, 'asc']],
                'columns' => [
                        [ "searchable" =>  false ], 
                        [ "searchable" =>  true ], 
                        ['orderable' => false, "searchable" =>  false]],
            ];
@endphp

{{-- Compressed with style options / fill data using the plugin config --}}
<x-adminlte-datatable id="category-table" :heads="$heads" head-theme="dark" :config="$config"
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