@extends('layouts.admin.app')

@section('title',\App\Utils\translate('update_product'))

@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('assets/filepond/css/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/filepond/css/filepond.min.css') }}">
    <link href="{{ asset('assets/filepond/css/filepond-plugin-image-edit.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="">
            <div class="row align-items-center mb-3">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize">
                        <i class="tio-edit"></i>
                        <span>{{\App\Utils\translate('update_product')}}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.product.update',[$product['id']])}}" method="post"
                              id="product_form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row pl-2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('name')}}
                                            <span class="input-label-secondary">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ $product['name'] }}"
                                               placeholder="{{\App\Utils\translate('product_name')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('product_code_SKU')}}
                                            <span class="input-label-secondary">*</span>
                                            <a class="style-one-pu" id="generateCodeLink">{{\App\Utils\translate('generate_code')}}</a></label>
                                        <input type="text" id="generate_number" minlength="5" name="product_code"
                                               class="form-control" value="{{ $product['product_code'] }}"
                                               placeholder="{{\App\Utils\translate('product_code')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('brand')}}</label>
                                        <select name="brand_id" class="form-control js-select2-custom">
                                            <option value="">---{{\App\Utils\translate('select')}}---</option>
                                            @foreach ($brands as $brand)
                                                <option
                                                    value="{{ $brand['id'] }}" {{ $product->brand == $brand['id'] ? 'selected' : ' ' }}>{{$brand['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('quantity')}}
                                            <span class="input-label-secondary">*</span>
                                        </label>
                                        <input type="number" min="1" name="quantity" class="form-control"
                                               value="{{ $product['quantity'] }}"
                                               placeholder="{{\App\Utils\translate('quantity')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('unit_type')}}
                                            <span class="input-label-secondary">*</span>
                                        </label>
                                        <select name="unit_type" class="form-control js-select2-custom" required>
                                            <option value="">---{{\App\Utils\translate('select')}}---</option>
                                            @foreach ($units as $unit)
                                                <option value="{{$unit['id']}}" {{ $product->unit_type==$unit['id']?'selected':'' }}>{{$unit['unit_type']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('unit_value')}}
                                            <span class="input-label-secondary">*</span>
                                        </label>
                                        <input type="number" min="0" name="unit_value" class="form-control"
                                               value="{{ $product['unit_value'] }}"
                                               placeholder="{{\App\Utils\translate('unit_value')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlSelect1">{{\App\Utils\translate('category')}}<span
                                                class="input-label-secondary">*</span></label>
                                        <select name="category_id" id="category-id"
                                                class="form-control js-select2-custom">
                                            <option value="">---{{\App\Utils\translate('select')}}---</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category['id']}}" {{ $category->id==$product_category[0]->id ? 'selected' : ''}}>{{$category['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlSelect1">{{\App\Utils\translate('sub_category')}}
                                            <span
                                                class="input-label-secondary"></span></label>
                                        <select name="sub_category_id" id="sub-categories"
                                                data-id="{{count($product_category)>=2?$product_category[1]->id:''}}"
                                                class="form-control js-select2-custom">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('selling_price')}}
                                            <span class="input-label-secondary">*</span>
                                        </label>
                                        <input type="number" step="0.01" name="selling_price" class="form-control"
                                               value="{{ $product['selling_price'] }}"
                                               placeholder="{{\App\Utils\translate('selling_price')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('purchase_price')}}
                                            <span class="input-label-secondary">*</span>
                                        </label>
                                        <input type="number" step="0.01" name="purchase_price" class="form-control"
                                               value="{{ $product['purchase_price'] }}"
                                               placeholder="{{\App\Utils\translate('purchase_price')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('discount_type')}}</label>
                                        <select name="discount_type" class="form-control js-select2-custom">
                                            <option value="percent" {{ $product->discount_type == 'percent'?'selected':'' }} >{{\App\Utils\translate('percent')}}</option>
                                            <option value="amount" {{ $product->discount_type == 'amount'?'selected':'' }}>{{\App\Utils\translate('amount')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label id="percent" class="input-label {{ $product->discount_type == 'amount' ? 'd-none' :'' }}">{{\App\Utils\translate('discount_percent')}} (%)</label>
                                        <label id="amount" class="input-label {{ $product->discount_type == 'percent' ? 'd-none' :'' }}">{{\App\Utils\translate('discount_amount')}}</label>
                                        <input type="number" min="0" name="discount" class="form-control"
                                               value="{{ $product['discount'] }}"
                                               placeholder="{{\App\Utils\translate('discount')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('tax_in_percent')}}
                                            (%)</label>
                                        <input type="number" min="0" name="tax" class="form-control"
                                               value="{{ $product['tax'] }}"
                                               placeholder="{{\App\Utils\translate('tax')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{\App\Utils\translate('select_supplier')}}</label>
                                        <select name="supplier_id" class="form-control js-select2-custom">
                                            <option value="">---{{\App\Utils\translate('select')}}---</option>
                                            @foreach ($suppliers as $supplier)
                                                <option
                                                    value="{{$supplier['id']}}" {{ $product->supplier_id==$supplier['id']?'selected':'' }}>{{$supplier['name']}}
                                                    ({{ $supplier['mobile'] }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>{{\App\Utils\translate('image')}}</label>
                                        <input
                                            type="file"
                                            class="filepond"
                                            name="product"
                                            data-max-file-size="55MB"
                                            data-max-files="100"
                                            data-allow-reorder="true"
                                            data-allow-multiple="true"
                                            class="custom-file-input"
                                        />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src={{asset("assets/admin/js/global.js")}}></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset("assets/filepond/js/filepond-plugin-file-validate-size.min.js") }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-edit.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond.min.js') }}"></script>

    <script>
        initializeFilePond('product',@json($image),"{!! env('APP_URL') !!}","{!! csrf_token() !!}")
    </script>
    <script>
        "use strict";

        $(document).ready(function () {
            setTimeout(function () {
                let category = $("#category-id").val();
                let sub_category = '{{count($product_category)>=2?$product_category[1]->id:''}}';
                getRequest('{{url('/')}}/admin/product/get-categories?parent_id=' + category + '&&sub_category=' + sub_category, 'sub-categories');
            }, 1000)

            $('#generateCodeLink').on('click', function(e) {
                e.preventDefault();
                document.getElementById('generate_number').value = getRndInteger();
            });

            $('select[name="category_id"]').on('change', function() {
                getRequest('{{url('/')}}/admin/product/get-categories?parent_id=' + $(this).val(), 'sub-categories');
            });

            $('select[name="sub_category_id"]').on('change', function() {
                getRequest('{{url('/')}}/admin/product/get-categories?parent_id=' + $(this).val(), 'sub-sub-categories');
            });

            $('select[name="discount_type"]').on('change', function() {
                discount_option(this);
            });
        });
    </script>
@endpush
