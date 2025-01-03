@extends('layouts.admin.app')

@section('title',\App\Utils\translate('update_unit_type'))

@section('content')
<div class="content container-fluid">
        <div class="">
            <div class="row align-items-center mb-3">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize">
                        <i class="tio-edit"></i>
                        <span>{{\App\Utils\translate('update_unit')}}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.unit.update',[$unit['id']])}}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="">{{\App\Utils\translate('unit')}}</label>
                                        <input type="text" name="unit_type" class="form-control" value="{{ $unit->unit_type }}">

                                    </div>
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
