@extends('layouts.blank')

@section('content')
    <div class="text-center text-white mb-4">
        <h2>{{\App\Utils\translate('Welcome to the e-Cartify Software Installation Guide')}}</h2>
        <h6 class="fw-normal">{{\App\Utils\translate('Please follow each step sequentially and provide accurate data as per the instructions provided')}}</h6>
    </div>

    <div class="pb-2">
        <div class="progress cursor-pointer" role="progressbar" aria-label="Grofresh Software Installation"
             aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip"
             data-bs-placement="top" data-bs-custom-class="custom-progress-tooltip" data-bs-title="{{\App\Utils\translate('Final Step')}}!"
             data-bs-delay='{"hide":1000}'>
            <div class="progress-bar" style="width: 90%"></div>
        </div>
    </div>

    <div class="card mt-4 position-relative">
        <div class="d-flex justify-content-end mb-2 position-absolute top-end">
            <a href="#" class="d-flex align-items-center gap-1">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                              data-bs-title="{{\App\Utils\translate('Admin setup')}}">

                            <img src="{{asset('assets/installation')}}/assets/img/svg-icons/info.svg" alt=""
                                 class="svg">
                        </span>
            </a>
        </div>
        <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
            <div class="d-flex align-items-center column-gap-3 flex-wrap">
                <h5 class="fw-bold fs text-uppercase">{{\App\Utils\translate('Step 5')}}. </h5>
                <h5 class="fw-normal">{{\App\Utils\translate('Admin Account Settings')}}</h5>
            </div>
            <p class="mb-4">{{\App\Utils\translate('These information will be used to create')}} <strong>{{\App\Utils\translate('admin credential')}}</strong>
                {{\App\Utils\translate('for your admin panel')}}.
            </p>

            <form method="POST" action="{{ route('system_settings',['token'=>bcrypt('step_6')]) }}">
                @csrf
                <div class="bg-light p-4 rounded mb-4">
                    <div class="px-xl-2 pb-sm-3">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="from-group">
                                    <label for="first-name" class="d-flex align-items-center gap-2 mb-2">Business Name</label>
                                    <input type="text" id="first-name" class="form-control" name="business_name"
                                           required placeholder="{{\App\Utils\translate('Ex: e-Cartify')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="first-name" class="d-flex align-items-center gap-2 mb-2">
                                        {{\App\Utils\translate('First Name')}}</label>
                                    <input type="text" id="first-name" class="form-control" name="admin_f_name"
                                           required placeholder="{{\App\Utils\translate('Ex: John')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="last-name" class="d-flex align-items-center gap-2 mb-2">
                                        {{\App\Utils\translate('Last Name')}}</label>
                                    <input type="text" id="last-name" class="form-control" name="admin_l_name"
                                           required placeholder="{{\App\Utils\translate('Ex: Doe')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="phone" class="d-flex align-items-center gap-2 mb-2">
                                        <span class="fw-medium">{{\App\Utils\translate('Phone')}}</span>
                                        <span class="cursor-pointer" data-bs-toggle="tooltip"
                                              data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                              data-bs-html="true"
                                              data-bs-title="{{\App\Utils\translate('Provide an valid number. This number will be use to send verification code and other attachments in future')}}">
                                                    <img
                                                        src="{{asset('assets/installation')}}/assets/img/svg-icons/info2.svg"
                                                        class="svg" alt="">
                                                </span>
                                    </label>

                                    <div class="number-input-wrap">
                                        <select name="phone_code" id="phone-number" class="form-select">
                                            @foreach(TELEPHONE_CODES as $item)
                                                <option value="{{$item['code']}}">{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                        <input type="tel" id="phone" class="form-control" name="admin_phone" required
                                               placeholder="{{\App\Utils\translate('Ex: 79460018')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="email" class="d-flex align-items-center gap-2 mb-2">
                                        <span class="fw-medium">{{\App\Utils\translate('Email')}}</span>
                                        <span class="cursor-pointer" data-bs-toggle="tooltip"
                                              data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                              data-bs-html="true"
                                              data-bs-title="{{\App\Utils\translate('Provide an valid email. This email will be use to send verification code and other attachments in future')}}">
                                                    <img
                                                        src="{{asset('assets/installation')}}/assets/img/svg-icons/info2.svg"
                                                        class="svg" alt="">
                                                </span>
                                    </label>

                                    <input type="email" id="email" class="form-control" name="admin_email" required
                                           placeholder="{{\App\Utils\translate('Ex: ecartify@jejookit.com')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="password"
                                           class="d-flex align-items-center gap-2 mb-2">{{\App\Utils\translate('Password')}}</label>
                                    <div class="input-inner-end-ele position-relative">
                                        <input type="password" autocomplete="new-password" id="password"
                                               name="password" required class="form-control"
                                               placeholder="{{\App\Utils\translate('Ex: 8+ character')}}" minlength="8">
                                        <div class="togglePassword">
                                            <img
                                                src="{{asset('assets/installation')}}/assets/img/svg-icons/eye.svg"
                                                alt="" class="svg eye">
                                            <img
                                                src="{{asset('assets/installation')}}/assets/img/svg-icons/eye-off.svg"
                                                alt="" class="svg eye-off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="confirm-password" class="d-flex align-items-center gap-2 mb-2">{{\App\Utils\translate('Confirm Password')}}</label>
                                    <div class="input-inner-end-ele position-relative">
                                        <input type="password" autocomplete="new-password" id="confirm_password"
                                              name="confirm_password" class="form-control" placeholder="{{\App\Utils\translate('Ex: 8+ character')}}" required>
                                        <div class="togglePassword">
                                            <img
                                                src="{{asset('assets/installation')}}/assets/img/svg-icons/eye.svg"
                                                alt="" class="svg eye">
                                            <img
                                                src="{{asset('assets/installation')}}/assets/img/svg-icons/eye-off.svg"
                                                alt="" class="svg eye-off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-sm-5">{{\App\Utils\translate('Complete Installation')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
