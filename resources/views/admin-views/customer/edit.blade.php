@extends('layouts.admin.app')

@section('title',\App\Utils\translate('update_customer'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css"/>
@endpush

@section('content')
<div class="content container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title text-capitalize"><i
                    class="tio-edit"></i> {{\App\Utils\translate('update_customer')}}
            </h1>
        </div>
    </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.customer.update',[$customer->id])}}" method="post" id="product_form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="balance" min="0" step="0.01" value="{{ $customer->balance }}">
                                <div class="row pl-2" >
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label" >{{\App\Utils\translate('customer_name')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" value="{{ $customer->name }}" placeholder="{{\App\Utils\translate('customer_name')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('mobile_no')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="tel" id="mobile" name="mobile" class="form-control" value="{{ $customer->mobile }}"
                                                   pattern="[+0-9]+"
                                                   title="Please enter a valid phone number with only numbers and the plus sign (+)"
                                                   placeholder="{{\App\Utils\translate('mobile_no')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2" >
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label" >{{\App\Utils\translate('email')}}</label>
                                            <input type="email" name="email" class="form-control" value="{{ $customer->email }}" placeholder="{{\App\Utils\translate('Ex_:_ex@example.com')}}" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label" >{{\App\Utils\translate('state')}}</label>
                                            <input type="text" name="state" class="form-control" value="{{ $customer->state }}" placeholder="{{\App\Utils\translate('state')}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2" >
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('city')}} </label>
                                            <input type="text"  name="city" class="form-control" value="{{ $customer->city }}" placeholder="{{\App\Utils\translate('city')}}" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('zip_code')}} </label>
                                            <input type="text"  name="zip_code" class="form-control" value="{{ $customer->zip_code }}" placeholder="{{\App\Utils\translate('zip_code')}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2" >

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('address')}} </label>
                                            <input type="text"  name="address" class="form-control" value="{{ $customer->address }}" placeholder="{{\App\Utils\translate('address')}}" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label>{{\App\Utils\translate('image')}}</label><small> ( {{\App\Utils\translate('ratio_1:1')}} )( {{\App\Utils\translate('optional')}} )</small>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" >
                                            <label class="custom-file-label" for="customFileEg1">{{\App\Utils\translate('choose_file')}}</label>
                                        </div>
                                        <div class="form-group my-4">
                                            <div class="text-center">
                                                <img class="img-one-cusu" id="viewer"
                                                src="{{$customer['image_fullpath']}}" alt="{{\App\Utils\translate('image')}}"/>
                                            </div>
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
    <script>
        "use strict";
        $(document).on('ready', function () {
            @php($country=$customer->country)
            $("#country option[value='{{$country}}']").attr('selected', 'selected').change();
        })
    </script>
    <script src={{asset("assets/admin/js/global.js")}}></script>
@endpush
