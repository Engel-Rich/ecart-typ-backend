@extends('layouts.blank')

@section('content')
    <div class="text-center text-white mb-4">
        <h2>{{\App\Utils\translate('e-Cartify Software Installation')}}</h2>
        <h6 class="fw-normal">{{\App\Utils\translate('Please proceed step by step with proper data according to instructions')}}</h6>
    </div>

    <div class="pb-2">
        <div class="progress cursor-pointer" role="progressbar" aria-label="Grofresh Software Installation"
             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip"
             data-bs-placement="top" data-bs-custom-class="custom-progress-tooltip" data-bs-title="{{\App\Utils\translate('Second Step')}}!"
             data-bs-delay='{"hide":1000}'>
            <div class="progress-bar" style="width: 40%"></div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="p-4 mb-md-3 mx-xl-4 px-md-5">

            <div class="d-flex align-items-center column-gap-3 flex-wrap">
                <h5 class="fw-normal">{{\App\Utils\translate('Purchase Information')}}</h5>
            </div>
            <p class="mb-4">{{\App\Utils\translate('Provide your')}} <strong>{{\App\Utils\translate('username')}} </strong>{{\App\Utils\translate('of codecanyon & the')}} <strong>{{\App\Utils\translate('purchase code')}}</strong></p>

            @if (isset($error) || session()->has('error'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            {{\App\Utils\translate(session('error'))}}.
                        </div>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{ route('purchase-code-verify',['token'=>bcrypt('purchase')]) }}">
                @csrf
                <div class="bg-light p-4 rounded mb-4">

                    <div class="px-xl-2 pb-sm-3">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="username" class="d-flex align-items-center gap-2 mb-2">
                                        <span class="fw-medium">{{\App\Utils\translate('Username')}}</span>
                                        <span class="cursor-pointer" data-bs-toggle="tooltip"
                                              data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                              data-bs-html="true"
                                              data-bs-title="{{\App\Utils\translate('The username of your codecanyon account')}}">
                                                    <img
                                                        src="{{asset('assets/installation')}}/assets/img/svg-icons/info2.svg"
                                                        class="svg" alt="">
                                        </span>
                                    </label>
                                    <input type="text" id="username" class="form-control" name="username"
                                           placeholder="{{\App\Utils\translate('Ex: John Doe')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="purchase_key" class="mb-2">
                                        <span class="fw-medium">Purchase Code</span>
                                        <span class="cursor-pointer" data-bs-toggle="tooltip"
                                              data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                              data-bs-html="true"
                                              data-bs-title="{{\App\Utils\translate('The purchase code')}}">
                                                    <img
                                                        src="{{asset('assets/installation')}}/assets/img/svg-icons/info2.svg"
                                                        class="svg" alt="">
                                        </span>
                                    </label>
                                    <input type="text" id="purchase_key" class="form-control" name="purchase_code"
                                           placeholder="Ex: 19xxxxxx-ca5c-49c2-83f6-696a738b0000" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-sm-5">{{\App\Utils\translate('Continue')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection