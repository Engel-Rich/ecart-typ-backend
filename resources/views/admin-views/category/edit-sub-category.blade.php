@extends('layouts.admin.app')

@section('title',\App\Utils\translate('add_new_sub_category'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <div class="">
        <div class="row align-items-center mb-3">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title text-capitalize"><i class="tio-edit"></i> {{\App\Utils\translate('sub_category')}} {{\App\Utils\translate('update')}}</h1>
            </div>
        </div>
    </div>
    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.category.update-sub',[$category['id']])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group lang_form">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('name')}} </label>
                                    <input type="text" name="name" value="{{$category['name']}}" class="form-control" placeholder="{{\App\Utils\translate('new_sub_category')}}" required>
                                </div>
                                <input name="position" value="0" class="d-none">
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">{{\App\Utils\translate('update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
