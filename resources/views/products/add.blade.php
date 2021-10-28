@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Add New Product</h1>
   
@stop

@section('content')

<div class="row">

    <div class="offset-md-1 col-md-8">
        <x-adminlte-card theme="dark" title="Product Details" >
            @if(session('successMsg'))
                <x-adminlte-alert title="success" theme="success" dismissable>
                    {{  session('successMsg')  }}
                </x-adminlte-alert>
            @endif
            <form method="post" action="{{ route('post-add-product') }}">
                @csrf
            <div class="row">
                <x-adminlte-input name="name" label="Product Name" placeholder="Enter Product Name"
                    fgroup-class="col-md-12" >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            @php
                $config1 = [
                    "title" => "Select Product category..",
                    "liveSearch" => true,
                    "liveSearchPlaceholder" => "Search...",
                    "showTick" => true,
                    "actionsBox" => true
                ];

                $config2 = [
                    "title" => "Select Product..",
                    "liveSearch" => true,
                    "liveSearchPlaceholder" => "Search...",
                    "showTick" => true,
                    "actionsBox" => true
                ];

                $categories = collect($ProductCategory)->mapWithKeys(function($category){
                    return [$category->id => $category->category_name];
                })->all();
            @endphp

            <x-adminlte-select-bs id="productcategory" name="category" label="Product Categories"
                 :config="$config1">
              
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-red">
                        <i class="fas fa-tag"></i>
                    </div>
                </x-slot>
                <x-adminlte-options :options="$categories"/>
            </x-adminlte-select-bs>
            <div class="row">
                <x-adminlte-input type="number" name="price" label="Price" placeholder="Enter Product Price"
                    fgroup-class="col-md-12" >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="row">
                <x-adminlte-input type="number" name="stock" label="Stock" placeholder="Enter Product Stock"
                    fgroup-class="col-md-12" >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-adminlte-button label="ADD" type="submit" name="add_product" value="1" theme="primary" icon="fas fa-refresh"/>
                </div>
          
              </div>
            </form>
        </x-adminlte-card>
    </div>
    
    

</div>


@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    

@stop