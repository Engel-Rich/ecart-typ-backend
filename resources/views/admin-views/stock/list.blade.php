@extends('layouts.admin.app')

@section('title',\App\Utils\translate('stock_limit_products_list'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="">
            <div class="row align-items-center mb-3">
                <div class="col-12 mb-2 mb-sm-0">
                    <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize">
                        <i class="tio-files"></i>
                        <span>{{\App\Utils\translate('stock_limit_products_list')}} <span class="badge badge-soft-dark ml-2">{{$products->total()}}</span></span>
                    </h1>
                    <span>{{ \App\Utils\translate('the_products_are_shown_in_this_list,_which_quantity_is_below') }} {{ \App\Models\BusinessSetting::where(['key'=>'stock_limit'])->first()->value }}</span>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-12 col-sm-8 col-md-6">
                                <form action="{{url()->current()}}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{\App\Utils\translate('search_by_product_code_or_name')}}" aria-label="{{\App\Utils\translate('Search')}}" value="{{ $search }}"  required>
                                        <button type="submit" class="btn btn-primary">{{\App\Utils\translate('search')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-1 col-12 col-sm-4">
                                <select name="qty_order_sort" class="form-control" id="qtyOrderSortSelect">
                                    <option value="default" {{ $sortOrderQty== "default"?'selected':''}}>{{\App\Utils\translate('default_sort')}}</option>
                                    <option value="quantity_asc" {{ $sortOrderQty== "quantity_asc"?'selected':''}}>{{\App\Utils\translate('quantity_sort_by_(low_to_high)')}}</option>
                                <option value="quantity_desc" {{ $sortOrderQty== "quantity_desc"?'selected':''}}>{{\App\Utils\translate('quantity_sort_by_(high_to_low)')}}</option>
                                <option value="order_asc" {{ $sortOrderQty== "order_asc"?'selected':''}}>{{\App\Utils\translate('order_sort_by_(low_to_high)')}}</option>
                                <option value="order_desc" {{ $sortOrderQty== "order_desc"?'selected':''}}>{{\App\Utils\translate('order_sort_by_(high_to_low)')}}</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{\App\Utils\translate('#')}}</th>
                                <th>{{\App\Utils\translate('name')}}</th>
                                <th >{{\App\Utils\translate('image')}}</th>
                                <th>{{ \App\Utils\translate('supplier_name/mobile') }}</th>
                                <th>{{\App\Utils\translate('product_code')}}</th>
                                <th>{{\App\Utils\translate('purchase_price')}}</th>
                                <th>{{\App\Utils\translate('selling_price')}}</th>
                                <th>{{\App\Utils\translate('quantity')}}</th>
                                <th>{{ \App\Utils\translate('orders') }}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($products as $key=>$product)
                                <tr>
                                    <td>{{$products->firstitem()+$key}}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{substr($product['name'],0,20)}}{{strlen($product['name'])>20?'...':''}}
                                        </span>
                                    </td>
                                    <td>
                                        <img class="img-one-sto" src="{{$product['image_fullpath']}}">
                                    </td>
                                    <td>
                                        {{ $product->supplier?$product->supplier->name:\App\Utils\translate('not_found') }} <br>
                                        {{ $product->supplier?$product->supplier->mobile:\App\Utils\translate('not_found')  }}
                                    </td>
                                    <td>{{ $product['product_code'] }}</td>
                                    <td>{{priceCurrencyFormatPlacing($product['purchase_price'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position())}}</td>
                                    <td>{{priceCurrencyFormatPlacing($product['selling_price'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position())}}</td>
                                    <td>{{ $product['quantity'] }}
                                        <button class="btn btn-sm update-quantity-btn" data-product-id="{{ $product->id }}" id="{{ $product->id }}" type="button" data-toggle="modal" data-target="#update-quantity">
                                            <i class="tio-add-circle"></i>
                                        </button>
                                    </td>
                                    <td>{{ $product->order_count??0 }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                {!! $products->links() !!}
                                </tfoot>
                            </table>
                        </div>
                        @if(count($products)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 img-two-sto" src="{{ asset('assets/admin/img/no-data.jpg') }}" alt="{{ \App\Utils\translate('Image Description')}}">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="update-quantity" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{\App\Utils\translate('update_product_quantity')}} <br>
                    <span class="text-danger">({{\App\Utils\translate('to_decrease_product_quantity_use_minus_before_number._Ex: -10')}} )</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.stock.update-quantity')}}" method="post" class="row">
                    @csrf
                    <div class="form-group col-sm-12">
                        <label for="">{{\App\Utils\translate('quantity')}}</label>
                        <input type="number" class="form-control" name="quantity" required>
                        <input type="hidden" id="product_id" name="id" value="{{ $product['id']??0 }}">
                    </div>
                    <div class="form-group col-sm-12">
                        <button class="btn btn-sm btn-primary" type="submit">{{\App\Utils\translate('submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script_2')
    <script src={{asset("assets/admin/js/global.js")}}></script>

    <script>
        "use strict";

        $('.update-quantity-btn').on('click', function() {
            var productId = $(this).data('product-id');
            update_quantity_sto(productId);
        });

        $('#qtyOrderSortSelect').on('change', function() {
            var selectedValue = $(this).val();
            var redirectUrl = '{{ url('/') }}/admin/stock/stock-limit/?sort_orderQty=' + selectedValue;
            window.location.href = redirectUrl;
        });
    </script>

@endpush
