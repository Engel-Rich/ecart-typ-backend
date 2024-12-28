@extends('layouts.admin.app')

@section('title',\App\Utils\translate('update_natureofleave'))

@section('content')
<div class="content container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize"><i
                    class="tio-add-circle-outlined"></i> {{\App\Utils\translate('update_natureofleave')}}
            </h1>
        </div>
    </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.natureofleave.update',$natureOfLeave->id) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="col-12 col-md-12 pl-2 form-group">
                                <label class="input-label" >{{\App\Utils\translate('name')}} <span
                                        class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $natureOfLeave->name }}"  placeholder="{{\App\Utils\translate('departement_name')}}" required>
                            </div>
                            <div class="col-12 col-md-12 pl-2 form-group">
                                <label class="input-label" >{{\App\Utils\translate('description')}}</label>
                                <textarea name="description" class="form-control" placeholder="{{\App\Utils\translate('description')}}">{{ $natureOfLeave->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('save')}}</button>
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
