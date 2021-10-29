@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Generate Invoice</h1>
    <div class="row text-center justify-content-end mr-1">
        <form method="post" action="/">
            @csrf
                <x-adminlte-button label="Generate New" type="submit" name="generate_new" theme="info" />
        </form>
    </div>
@stop

@section('content')

<div class="row">

    <div class="col-md-6">

        <x-adminlte-card theme="dark" title="Customer Details" >
            <x-adminlte-card theme="info" title="Search" >
            <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="search-input" class="sr-only">Email</label>
                  <input type="text" class="form-control" id="search-input" placeholder="Search by name or phone number">
                </div>
                <div class="form-group col-md-4">
                  <label for="search-btn" class="sr-only">Search</label>
                  <button id="search-btn" type="submit" class="btn btn-primary mb-2">
                      <span id="search-loader" style="display: none">
                        <i class="fas fa-sync fa-spin"></i>
                      </span>
                      &nbsp;&nbsp;
                      Search
                  </button>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <table class="table table-bordered" id="search-result">
                         
                      </table>
                  </div>
              </div>
            </x-adminlte-card>
            <x-adminlte-card theme="info" title="Add New Customer" >
            <form method="post" action="/">
                @csrf
            <div class="row">
                <x-adminlte-input name="name" label="Customer Name" placeholder="Customer Name"
                    fgroup-class="col-md-12" value="{{ old('name') }}"/>
            </div>
            <div class="row">
                <x-adminlte-input name="phone" label="Phone" placeholder="Customer Phone No."
                    fgroup-class="col-md-12" value="{{ old('phone') }}" />
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-adminlte-button label="Submit" type="submit" name="add_customer" value="1" theme="primary" icon="fas fa-refresh"/>
                </div>
          
              </div>
            </form>
            </x-adminlte-card>
        </x-adminlte-card>
    </div>
    
    
    <div class="col-md-6">
        <x-adminlte-card theme="dark" title="Item Details" >
            <form method="post" action="/">
                @csrf
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
                label-class="text-danger" :config="$config1">
              
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-red">
                        <i class="fas fa-tag"></i>
                    </div>
                </x-slot>
                <x-adminlte-options :options="$categories"/>
            </x-adminlte-select-bs>

            <x-adminlte-select-bs id="product" name="product_id" label="Product"
                label-class="text-danger" :config="$config2">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-red">
                        <i class="fas fa-tag"></i>
                    </div>
                </x-slot>
                <x-adminlte-options :options="[]"/>
            </x-adminlte-select-bs>
            <div class="row">
                <x-adminlte-input name="qty" label-class="text-danger" type="number" label="Quantity" placeholder="Enter Quantity"
                    fgroup-class="col-md-12" disable-feedback>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                    
            </div>
            <div class="row">
                <x-adminlte-input name="tax" label-class="text-danger" type="number" label="Tax (%)" placeholder="Enter tax percentage" value="18"
                    fgroup-class="col-md-12" disable-feedback>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                    
            </div>
            
            <div class="row ml-1">
                <div class="form-group mb-0 ">
                    <label class="text-danger">Discount Type</label>
                </div>
             </div>
            <div class="row form-group  ml-1">
               
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="discount_type" id="discount-percent" value="percent" checked>
                    <label class="form-check-label" for="discount-percent">
                    Percentage
                    </label>
               </div>
               <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="discount_type" id="discount-flat" value="flat">
                    <label class="form-check-label" for="discount-flat">
                    Flat
                    </label>
                </div>
            </div>
            <div class="row">
                <x-adminlte-input name="discount" label-class="text-danger" type="number" label="Discount if any" placeholder="Enter discount if any" value="0"
                    fgroup-class="col-md-12" disable-feedback>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                    
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-adminlte-button label="ADD" theme="primary" type="submit" name="add_item" value="1" icon="fas fa-plus"/>
                </div>
          
              </div>
            </form>
        </x-adminlte-card>
        
    </div>
    
</div>

<div class="row">   
    <div class="col-md-12">
        <x-adminlte-card theme="dark" title="Invoice Details" >
            <div class="row">
                <x-adminlte-input name="iLabel" label="Customer Name" placeholder="" readonly class="input-transparent"
                    fgroup-class="row col-md-6" label-class="col-sm-2 col-form-label" value="{{ session()->get('customer.name') }}" igroup-class="col-sm-10" disable-feedback/>
            </div>
            <div class="row">
                <x-adminlte-input name="iLabel" label="Customer Phone No." placeholder="" readonly class="input-transparent"
                    fgroup-class="row col-md-6" label-class="col-sm-2 col-form-label" value="{{ session()->get('customer.phone') }}" igroup-class="col-sm-10" disable-feedback/>
            </div>

            
            <x-adminlte-card title="Invoice Items" theme="blue">
               <table>
                   <table class="table table-bordered">
                       
                       <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price (per unit)</th>
                            <th>In Stock</th>
                            <th>Qty</th>
                            <th>Tax</th>
                            <th>Discount</th>
                            <th>Actions</th>
                        </tr>
                       </thead>
                       @if(session()->get('customer.items') )
                       <tbody>
                           @foreach (session()->get('customer.items') as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['price'] }}</td>
                                    <td>{{ $item['stock'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>{{ $item['tax'] }}%</td>
                                    <td> 
                                        @if($item['discount_type'] == 'flat')
                                            Rs.
                                        @endif
                                         {{ $item['discount'] }}
                                        @if($item['discount_type'] == 'percent')
                                            %
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" action="/">
                                            @csrf
                                             <x-adminlte-button theme="danger" type="submit" name="remove_item" value="{{  $item['id'] }}" icon="fas fa-trash"/>
                                         </form>
                                    </td>
                                </tr>
                           @endforeach
                       </tbody>
                       @endif
                       
                   </table>
               </table>
               
            </x-adminlte-card>
          
            @if(session()->get('customer.items') && count(session()->get('customer.items')) > 0 && session()->get('customer.phone') && session()->get('customer.name'))
                <div class="row text-center justify-content-center">
                    <form method="post" action="/generate-invoice">
                        @csrf
                            <x-adminlte-button label="Generate Invoice" type="submit" name="generate_invoice" theme="success" />
                    </form>
                </div>
            @else
            <div class="row text-center justify-content-center">
                
                        <x-adminlte-button label="Generate Invoice" type="submit" name="generate_invoice" theme="success" disabled />
          
            </div>
            @endif
        </x-adminlte-card>
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        .input-transparent{
            border: 0;
            background: transparent !important;
        }

        .customer-row:hover{
            cursor: pointer;
            background: #007bff33;
        }

        
    </style>
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(function(){
        
            $('#productcategory').on('changed.bs.select', function (e, category_id, isSelected, previousValue) {
               $.post('{{ route("productsbycategory") }}',{ category_id: category_id, _token: "{{ csrf_token() }}" })
               .then(function(data){
                
                let html = '';
                data.map(function(item){
                    html += '<option value="'+ item.id +'">'+item.name+'</option>'
                })

                const addoption = $(html, {class: 'addItem'})
                $('#product')
                .html(addoption)
                .selectpicker('refresh');

               })
               .catch(function(e){
                   console.log(e)
               })
            });

            $("#search-btn").click(function(){
                $("#search-btn").attr('disabled', true)
                $("#search-loader").css('display','inline-block')
                $.post('{{ route("searchCustomer") }}',{ search: $("#search-input").val(), _token: "{{ csrf_token() }}" })
                .then(function(data){
                    const table = $("#search-result")
                    let html = '';
                    
                    if(!data.length) {
                        $("#search-loader").css('display','none');
                        $("#search-btn").attr('disabled', false);
                        html += '  <thead"><tr><td colspan="3" class="text-center">Customer Not Found</td></tr>';
                        table.html(html);
                        return;
                    }
                    
                        html += '<thead class="thead-dark"><tr>';
                        html += '<th>Customer Name</th>';
                        html += '<th>Phone Number</th>';
                        html += '<th>Action</th>';
                        html += '</tr>';
                   
                    data.map(function(item){
                        html += '<tr class="customer-row">';
                        html += '<td>'+item.name+'</td>';
                        html += '<td>'+item.phone+'</td>';
                        html += '<td>\
                            <form method="post" action="/">\
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />\
                                <input type="hidden" name="name" value="'+item.name+'" />\
                                <input type="hidden" name="phone" value="'+item.phone+'" />\
                                <button id="search-btn" type="submit" name="set_customer" class="btn btn-primary mb-2">OK</button>\
                            </form>\
                        </td>';
                        html += '</tr></thead>';
                    })

                    table.html(html);
                    $("#search-loader").css('display','none');
                    $("#search-btn").attr('disabled', false);
                })
                .catch(function(e){
                    $("#search-loader").css('display','none');
                    $("#search-btn").attr('disabled', false);
                    console.log(e)
                })
            })

            $("#search-input").keyup(function(e){
                const key = e.which || e.keyCode;
                if(key == 13){
                    $("#search-btn").trigger('click');
                }
            })

            

        });
    </script>

@stop