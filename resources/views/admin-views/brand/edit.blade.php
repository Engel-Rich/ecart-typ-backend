@extends('layouts.admin.app')

@section('title',\App\Utils\translate('update_brand'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css"/>
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
                        <span>{{\App\Utils\translate('update_brand')}}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
               <div class="card">
                   <div class="card-body">
                        <form action="{{route('admin.brand.update',[$brand['id']])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">{{\App\Utils\translate('brand_name')}}</label>
                                        <input type="text" name="name" class="form-control" value="{{ $brand->name }}">
                                        <input name="position" value="0" class="d-none">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>{{\App\Utils\translate('image')}}</label><small class="text-danger">* ( {{\App\Utils\translate('ratio_1:1')}}  )</small>
                                        <input
                                            type="file"
                                            class="filepond"
                                            name="brand"
                                            data-max-file-size="55MB"
                                            data-max-files="100"
                                            data-allow-reorder="true"
                                            data-allow-multiple="true"
                                            class="custom-file-input"
                                        />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('submit')}}</button>
                            <a href="{{route('admin.brand.add')}}" class="btn btn-danger">{{\App\Utils\translate('cancel')}}</a>
                        </form>
                   </div>
               </div>
            </div>

        </div>
    </div>
@endsection

@push('script_2')
    <script src="{{asset("assets/admin/js/global.js")}}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset("assets/filepond/js/filepond-plugin-file-validate-size.min.js") }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond-plugin-image-edit.js') }}"></script>
    <script src="{{ asset('assets/filepond/js/filepond.min.js') }}"></script>

    <script>
        initializeFilePond('brand',@json($image),"{!! env('APP_URL') !!}","{!! csrf_token() !!}")
    </script>
@endpush
