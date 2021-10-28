@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Edit Category</h1>
   
@stop

@section('content')

<div class="row">

    <div class="offset-md-1 col-md-8">
        <x-adminlte-card theme="dark" title="Category Details" >
            @if(session('successMsg'))
                <x-adminlte-alert title="success" theme="success" dismissable>
                    {{  session('successMsg')  }}
                </x-adminlte-alert>
            @endif
            <form method="post" action="{{ route('patch-edit-category') }}">
                @csrf
                @method('PATCH')
            <div class="row">
                <x-adminlte-input name="name" label="Category Name" placeholder="Enter Category Name" value="{{ $category->category_name }}"
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
                     <input type="hidden" name="category_id" value="{{ $category->id }}" />
                    <x-adminlte-button label="Submit" type="submit" name="edit_category" value="1" theme="primary" icon="fas fa-refresh"/>
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