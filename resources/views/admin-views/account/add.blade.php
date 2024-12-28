@extends('layouts.admin.app')

@section('title',\App\Utils\translate('add_new_account'))

@section('content')
<div class="content container-fluid">
        <div class="mb-3">
            <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize">
                <i class="tio-add-circle-outlined"></i>
                <span>{{\App\Utils\translate('add_new_account')}}</span>
            </h1>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.account.store')}}" method="post" >
                            @csrf
                            <div class="row pl-2" >
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" >{{\App\Utils\translate('account_title')}}</label>
                                        <input type="text" name="account" class="form-control" value="{{ old('account') }}"  placeholder="{{\App\Utils\translate('account_title')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">{{\App\Utils\translate('description')}} </label>
                                        <input type="text" name="description" class="form-control" value="{{ old('description') }}"  placeholder="{{\App\Utils\translate('description')}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2" >
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" >{{\App\Utils\translate('balance')}}</label>
                                        <input type="number" step="0.01" min="0" name="balance" class="form-control" value="{{ old('balance') }}"  placeholder="{{\App\Utils\translate('initial_balance')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" >{{\App\Utils\translate('account_number')}}</label>
                                        <input type="text" name="account_number" class="form-control" value="{{ old('account_number') }}"  placeholder="{{\App\Utils\translate('account_number')}}" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
