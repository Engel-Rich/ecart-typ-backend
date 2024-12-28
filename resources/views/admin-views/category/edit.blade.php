@extends('layouts.admin.app')

@section('title',\App\Utils\translate('category_update'))

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
                    <h1 class="page-header-title text-capitalize"><i class="tio-edit"></i> {{\App\Utils\translate('category_update')}}</h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.category.update',[$category['id']])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group lang_form">
                                        <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('name')}} </label>
                                        <input type="text" name="name" value="{{$category['name']}}" class="form-control" placeholder="{{\App\Utils\translate('new_category')}}" required>
                                    </div>
                                    <input name="position" value="0" class="d-none">
                                </div>
                                @if ($category['parent_id'] == 0)
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>{{\App\Utils\translate('image')}}</label><small class="text-danger">* ( {{\App\Utils\translate('ratio_1:1')}}  )</small>
                                            <input
                                                type="file"
                                                class="filepond"
                                                name="category"
                                                data-max-file-size="55MB"
                                                data-max-files="100"
                                                data-allow-reorder="true"
                                                data-allow-multiple="true"
                                                class="custom-file-input"
                                            />
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('update')}}</button>
                            <a href="{{route('admin.category.add')}}" class="btn btn-danger">{{\App\Utils\translate('cancel')}}</a>
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
        initializeFilePond('category',@json($image),"{!! env('APP_URL') !!}","{!! csrf_token() !!}")
    </script>
@endpush
