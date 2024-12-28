@extends('layouts.blank')

@section('title',\App\Utils\translate("home"))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3">
                <div class="card mt-3">
                    <div class="card-body text-center">
                        @php($shop_logo=\App\Models\BusinessSetting::where(['key'=>'shop_logo'])->first()->value)
                        <img width="210"
                             src="{{onErrorImage($shop_logo,asset('storage/shop').'/' . $shop_logo,asset('assets/admin/img/ecartify.png') ,'shop/')}}"
                             alt="{{\App\Utils\translate('logo')}}">
                        <br><hr>
                        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">{{\App\Utils\translate('dashboard')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
