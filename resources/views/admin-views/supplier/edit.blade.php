@extends('layouts.admin.app')

@section('title',\App\Utils\translate('update_supplier'))

@section('content')
<div class="content container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title text-capitalize"><i
                    class="tio-edit"></i> {{\App\Utils\translate('update_supplier')}}
            </h1>
        </div>
    </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.supplier.update',[$supplier->id])}}" method="post" enctype="multipart/form-data" >
                            @csrf
                                <div class="row pl-2" >
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label" >{{\App\Utils\translate('supplier_name')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" value="{{ $supplier->name }}"  placeholder="{{\App\Utils\translate('supplier_name')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('mobile_no')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="tel" id="mobile" name="mobile" class="form-control" value="{{ $supplier->mobile }}"
                                                   placeholder="{{\App\Utils\translate('mobile_no')}}"
                                                   pattern="[+0-9]+"
                                                   title="Please enter a valid phone number with only numbers and the plus sign (+)"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2" >
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label" >{{\App\Utils\translate('email')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}"  placeholder="{{\App\Utils\translate('Ex_:_ex@example.com')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label" >{{\App\Utils\translate('state')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="text" name="state" class="form-control" value="{{ $supplier->state }}"  placeholder="{{\App\Utils\translate('state')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2" >
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('city')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="text"  name="city" class="form-control" value="{{ $supplier->city }}"  placeholder="{{\App\Utils\translate('city')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('zip_code')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="text"  name="zip_code" class="form-control" value="{{ $supplier->zip_code }}"  placeholder="{{\App\Utils\translate('zip_code')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2" >
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label">{{\App\Utils\translate('address')}} <span
                                                    class="input-label-secondary text-danger">*</span></label>
                                            <input type="text"  name="address" class="form-control" value="{{ $supplier->address }}"  placeholder="{{\App\Utils\translate('address')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>{{\App\Utils\translate('image')}}</label><small class="text-danger"> ( {{\App\Utils\translate('ratio_1:1')}}  )( {{\App\Utils\translate('optional')}}  )</small>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" >
                                            <label class="custom-file-label" for="customFileEg1">{{\App\Utils\translate('choose_file')}}</label>
                                        </div>
                                        <div class="form-group my-4">
                                            <div class="text-center">
                                                <img class="img-one-su" id="viewer"
                                                src="{{$supplier['image_fullpath']}}" alt="{{\App\Utils\translate('image')}}"/>
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
    <script src={{asset("assets/admin/js/global.js")}}></script>
@endpush
