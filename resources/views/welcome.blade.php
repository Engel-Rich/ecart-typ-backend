@extends('layouts.blank')

@section('content')
    <div class="text-center text-white mb-4">
        <h2>{{\App\Utils\translate('Welcome to the e-Cartify Software Installation Guide')}}</h2>
        <h6 class="fw-normal">{{\App\Utils\translate('All Done, Great Job. Your software is ready to run')}}. </h6>
    </div>

    <div class="card mt-4">
        <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
            <div class="p-4 rounded mb-4 text-center">
                <h5 class="fw-bold">{{\App\Utils\translate('Configure the following setting to run the system properly')}}</h5>

                <ul class="list-group mar-no mar-top bord-no">
                    <li class="list-group-item">{{\App\Utils\translate('Business Setting')}}</li>
                </ul>
            </div>

            <div class="text-center">
                <a href="{{ env('APP_URL') }}/admin/auth/login" target="_blank" class="btn btn-success px-sm-5">{{\App\Utils\translate('Admin Panel')}}</a>
            </div>
        </div>
    </div>
@endsection
