@extends('layouts.blank')

@section('content')
    <div class="text-center text-white mb-4">
        <h2>{{\App\Utils\translate('Welcome to the e-Cartify Software Installation Guide')}}</h2>
        <h6 class="fw-normal">{{\App\Utils\translate('Please follow each step sequentially and provide accurate data as per the instructions provided')}}</h6>
    </div>
    <div class="pb-2">
        <div class="progress cursor-pointer" role="progressbar" aria-label="Grofresh Software Installation"
             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip"
             data-bs-placement="top" data-bs-custom-class="custom-progress-tooltip" data-bs-title="First Step!"
             data-bs-delay='{"hide":1000}'>
            <div class="progress-bar" style="width: 20%"></div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="p-4 mb-md-3 mx-xl-4 px-md-5">

            <div class="d-flex align-items-center column-gap-3 flex-wrap mb-4">
                <h5 class="fw-bold fs text-uppercase">{{\App\Utils\translate('Step 1')}}. </h5>
                <h5 class="fw-normal">{{\App\Utils\translate('Check & Verify File Permissions')}}</h5>
            </div>

            <div class="bg-light p-4 rounded mb-4">
                <h6 class="fw-bold text-uppercase fs m-0 letter-spacing  mb-4 pb-sm-3 text-center" style="--fs: 14px">
                    {{\App\Utils\translate('Required Database Information')}}
                </h6>
                <div class="px-xl-2 pb-sm-3">
                    <div class="row g-4 g-md-5">
                        <div class="col-md-4">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="{{asset('assets/installation/assets/img/svg-icons/php-version.svg')}}"
                                     alt="{{ \App\Utils\translate('image') }}">
                                <div
                                    class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                    {{ \App\Utils\translate('PHP Version') }} 8.0 +

                                    @php($phpVersion = number_format((float)phpversion(), 2, '.', ''))
                                    @php($phpVersionMatched = $phpVersion >= 8.0)
                                    @if ($phpVersionMatched)
                                        <img width="20" src="{{asset('assets/installation/assets/img/svg-icons/check.png')}}"
                                             alt="{{ \App\Utils\translate('image') }}">
                                    @else
                                        <span class="cursor-pointer" data-bs-toggle="tooltip"
                                              data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                              data-bs-html="true" data-bs-delay='{"hide":1000}'
                                              data-bs-title="Your php version in server is lower than 8.0 version
                                                   <a href='https://support.cpanel.net/hc/en-us/articles/360052624713-How-to-change-the-PHP-version-for-a-domain-in-cPanel-or-WHM'
                                                   class='d-block' target='_blank'>See how to update</a> ">
                                                <img src="{{asset('assets/installation/assets/img/svg-icons/info.svg')}}"
                                                     class="svg text-danger" alt="{{ \App\Utils\translate('image') }}">
                                            </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        @foreach($permission as $key=>$item)
                            <div class="col-md-4">
                                <div class="d-flex gap-3 align-items-center">
                                    <img src="{{asset('assets/installation/assets/img/svg-icons/curl-enabled.svg')}}"
                                         alt="{{ \App\Utils\translate('image') }}">
                                    <div
                                        class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                        {{ \App\Utils\translate($key) . ' ' . \App\Utils\translate('Enabled') }}

                                        @if ($item)
                                            <img width="20" src="{{asset('assets/installation/assets/img/svg-icons/check.png')}}"
                                                 alt="{{ \App\Utils\translate('image') }}">
                                        @else
                                            <span class="cursor-pointer" data-bs-toggle="tooltip"
                                                  data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                  data-bs-html="true" data-bs-delay='{"hide":1000}'
                                                  data-bs-title="Curl extension is not enabled in your server. To enable go to PHP version > extensions and select curl.">
                                                <img src="{{asset('assets/installation/assets/img/svg-icons/info.svg')}}"
                                                     class="svg text-danger"  alt="{{ \App\Utils\translate('image') }}">
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-4">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="{{asset('assets/installation/assets/img/svg-icons/route-service.svg')}}"
                                     alt="{{ \App\Utils\translate('image') }}">
                                <div
                                    class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                    {{ \App\Utils\translate('.env File Permission') }}

                                    @if ($permission['db_file_write_perm'])
                                        <img width="20" src="{{asset('assets/installation/assets/img/svg-icons/check.png')}}"
                                             alt="{{ \App\Utils\translate('image') }}">
                                    @else
                                        <span class="cursor-pointer" data-bs-toggle="tooltip"
                                              data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                              data-bs-html="true" data-bs-delay='{"hide":1000}'
                                              data-bs-title="Provide file permission for write">
                                                <img src="{{asset('assets/installation/assets/img/svg-icons/info.svg')}}"
                                                     class="svg text-danger" alt="{{ \App\Utils\translate('image') }}">
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="{{asset('assets/installation/assets/img/svg-icons/route-service.svg')}}"
                                     alt="{{ \App\Utils\translate('image') }}">
                                <div class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                    {{ \App\Utils\translate('RouteServiceProvider.php File Permission') }}
                                    @if ($permission['routes_file_write_perm'])
                                        <img width="20"
                                             src="{{asset('assets/installation/assets/img/svg-icons/check.png')}}"
                                             alt="{{ \App\Utils\translate('image') }}">
                                    @else
                                        <span class="cursor-pointer" data-bs-toggle="tooltip"
                                              data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                              data-bs-html="true" data-bs-delay='{"hide":1000}'
                                              data-bs-title="Provide file permission for write">
                                                <img src="{{asset('assets/installation/assets/img/svg-icons/info.svg')}}"
                                                     class="svg text-danger"  alt="{{ \App\Utils\translate('image') }}">
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <p>{{\App\Utils\translate('All the permissions are provided successfully')}} ? </p>

                @if (array_product($permission) && $phpVersionMatched)
                    <a href="{{ route('step3',['token'=>bcrypt('step_3')]) }}" class="btn btn-success px-sm-5">{{ \App\Utils\translate('Proceed Next') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection

