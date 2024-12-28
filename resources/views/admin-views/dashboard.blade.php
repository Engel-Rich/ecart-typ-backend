@extends('layouts.admin.app')

@section('title',\App\Utils\translate('dashboard'))

@section('content')
<div class="content container-fluid">
    @if (\App\Utils\Helpers::module_permission_check('dashboard_section'))

    <div class="row mb-4">
        <div class="col-md-9">
            <h4 class="card-header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" fill="#384857">
                    <path d="M24.90625 -0.03125C24.863281 -0.0234375 24.820313 -0.0117188 24.78125 0C24.316406 0.105469 23.988281 0.523438 24 1L24 4L0 4L0 38L24 38L24 39.5625L15.28125 48.28125C14.882813 48.679688 14.882813 49.320313 15.28125 49.71875C15.679688 50.117188 16.320313 50.117188 16.71875 49.71875L24 42.4375L24 45C23.996094 45.359375 24.183594 45.695313 24.496094 45.878906C24.808594 46.058594 25.191406 46.058594 25.503906 45.878906C25.816406 45.695313 26.003906 45.359375 26 45L26 42.4375L33.28125 49.71875C33.679688 50.117188 34.320313 50.117188 34.71875 49.71875C35.117188 49.320313 35.117188 48.679688 34.71875 48.28125L26 39.59375L26 38L50 38L50 4L26 4L26 1C26.011719 0.710938 25.894531 0.433594 25.6875 0.238281C25.476563 0.0390625 25.191406 -0.0585938 24.90625 -0.03125 Z M 2 6L48 6L48 36L25.1875 36C25.054688 35.972656 24.914063 35.972656 24.78125 36L2 36 Z M 41 14C39.894531 14 39 14.894531 39 16C39 16.085938 39.019531 16.167969 39.03125 16.25L28.78125 24.15625C28.542969 24.054688 28.277344 24 28 24C27.722656 24 27.457031 24.054688 27.21875 24.15625L27.1875 24.15625L19 18.1875C19.003906 18.125 19 18.0625 19 18C19 16.894531 18.105469 16 17 16C15.894531 16 15 16.894531 15 18C15 18.074219 15.023438 18.144531 15.03125 18.21875L9.78125 22.15625C9.542969 22.054688 9.277344 22 9 22C7.894531 22 7 22.894531 7 24C7 25.105469 7.894531 26 9 26C10.105469 26 11 25.105469 11 24C11 23.925781 10.976563 23.855469 10.96875 23.78125L16.21875 19.84375C16.457031 19.945313 16.722656 20 17 20C17.277344 20 17.542969 19.945313 17.78125 19.84375L17.8125 19.84375L26 25.8125C25.996094 25.875 26 25.9375 26 26C26 27.105469 26.894531 28 28 28C29.105469 28 30 27.105469 30 26C30 25.914063 29.980469 25.832031 29.96875 25.75L40.21875 17.84375L40.25 17.84375C40.480469 17.9375 40.734375 18 41 18C42.105469 18 43 17.105469 43 16C43 14.894531 42.105469 14 41 14Z" fill="#384857" />
                </svg>
                <span class="ml-3">{{\App\Utils\translate('statistics')}}</span>
            </h4>
        </div>
        <div class="col-md-3 float-right mt-2">
            <select class="custom-select" name="statistics_type" id="statisticsTypeSelect">
                <option
                    value="overall" >
                    {{\App\Utils\translate('overall_statistics')}}
                </option>
                <option
                    value="today" >
                    {{\App\Utils\translate("today's_statistics")}}
                </option>
                <option
                    value="month" >
                    {{\App\Utils\translate("this_month's_statistics")}}
                </option>
            </select>
        </div>
    </div>
    <div class="row gx-2 gx-lg-3 mb-4" id="account_stats">
        @include('admin-views.partials._dashboard-balance-stats',['account'=>$account])
    </div>
    <div class="row gx-2 gx-lg-3 mb-3 mb-lg-5">
        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-7">
                            <h5 class="card-header-title mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" fill="#384857">
                                    <path d="M45 2 A 2 2 0 0 0 43.179688 4.8261719L35.191406 16.011719 A 2 2 0 0 0 35 16 A 2 2 0 0 0 33.900391 16.332031L26.994141 12.878906 A 2 2 0 0 0 25 11 A 2 2 0 0 0 23.025391 13.300781L15.726562 19.138672 A 2 2 0 0 0 15 19 A 2 2 0 0 0 13.023438 20.714844L6.234375 23.429688 A 2 2 0 0 0 5 23 A 2 2 0 0 0 5 27 A 2 2 0 0 0 6.9765625 25.285156L13.765625 22.570312 A 2 2 0 0 0 15 23 A 2 2 0 0 0 16.974609 20.701172L24.273438 14.861328 A 2 2 0 0 0 25 15 A 2 2 0 0 0 26.101562 14.667969L33.005859 18.121094 A 2 2 0 0 0 35 20 A 2 2 0 0 0 36.820312 17.171875L44.810547 5.9882812 A 2 2 0 0 0 45 6 A 2 2 0 0 0 45 2 z M 41 15L41 16L41 50L49 50L49 15L41 15 z M 43 17L47 17L47 48L43 48L43 17 z M 21 24L21 25L21 50L29 50L29 24L21 24 z M 23 26L27 26L27 48L23 48L23 26 z M 31 29L31 30L31 50L39 50L39 29L31 29 z M 33 31L37 31L37 48L33 48L33 31 z M 11 32L11 33L11 50L19 50L19 32L11 32 z M 13 34L17 34L17 48L13 48L13 34 z M 1 36L1 37L1 50L9 50L9 36L1 36 z M 3 38L7 38L7 48L3 48L3 38 z" fill="#384857" />
                                </svg>
                                <span  class="ml-3">{{\App\Utils\translate('earning_statistics')}}</span>
                            </h5>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-2 gx-lg-3 mb-3 mb-lg-5">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-header-title mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" fill="#384857">
                            <path d="M24.982422 3 A 1.0001 1.0001 0 0 0 24.535156 3.1132812L3.5351562 14.113281 A 1.0001 1.0001 0 0 0 3 15L3 18 A 1.0001 1.0001 0 0 0 4 19L6.9921875 19L6.9921875 37L5 37 A 1.0001 1.0001 0 0 0 4 38L4 40L3 40 A 1.0001 1.0001 0 0 0 2 41L2 44 A 1.0001 1.0001 0 0 0 3 45L24 45L24 43L4 43L4 42L5 42 A 1.0001 1.0001 0 0 0 6 41L6 39L7.8789062 39 A 1.0081008 1.0081008 0 0 0 8 39.007812L12 39.007812 A 1.0081008 1.0081008 0 0 0 12.115234 39L17.878906 39 A 1.0081008 1.0081008 0 0 0 18 39.007812L22 39.007812 A 1.0081008 1.0081008 0 0 0 22.115234 39L24 39L24 37L23.007812 37L23.007812 19L26.992188 19L26.992188 30.435547C27.610188 30.161547 28.289812 30.003953 29.007812 30.001953L29.007812 19.007812L30.992188 19.007812L30.992188 30L33.007812 30L33.007812 19L36.992188 19L36.992188 30L39.007812 30L39.007812 19.007812L40.992188 19.007812L40.992188 30L43.007812 30L43.007812 19L46 19 A 1.0001 1.0001 0 0 0 47 18L47 15 A 1.0001 1.0001 0 0 0 46.464844 14.113281L25.464844 3.1132812 A 1.0001 1.0001 0 0 0 24.982422 3 z M 25 5.1308594L45 15.605469L45 17L42.039062 17C42.025341 16.999447 42.013858 16.992188 42 16.992188L38 16.992188C37.986155 16.992188 37.974646 16.999447 37.960938 17L32.039062 17C32.025341 16.999447 32.013858 16.992188 32 16.992188L28 16.992188C27.986155 16.992188 27.974646 16.999447 27.960938 17L22.121094 17 A 1.0081008 1.0081008 0 0 0 22 16.992188L18 16.992188 A 1.0081008 1.0081008 0 0 0 17.884766 17L12.121094 17 A 1.0081008 1.0081008 0 0 0 12 16.992188L8 16.992188 A 1.0081008 1.0081008 0 0 0 7.8847656 17L5 17L5 15.605469L25 5.1308594 z M 25 8C22.802706 8 21 9.8027056 21 12C21 14.197294 22.802706 16 25 16C27.197294 16 29 14.197294 29 12C29 9.8027056 27.197294 8 25 8 z M 25 10C26.116414 10 27 10.883586 27 12C27 13.116414 26.116414 14 25 14C23.883586 14 23 13.116414 23 12C23 10.883586 23.883586 10 25 10 z M 13.007812 19L16.992188 19L16.992188 37L13.007812 37L13.007812 19 z M 9.0078125 19.007812L10.992188 19.007812L10.992188 36.992188L9.0078125 36.992188L9.0078125 19.007812 z M 19.007812 19.007812L20.992188 19.007812L20.992188 36.992188L19.007812 36.992188L19.007812 19.007812 z M 29 32C27.417221 32 26 33.222937 26 34.865234L26 45.134766C26 46.717516 27.324925 48 28.908203 48L46.091797 48C47.673944 48 49.001535 46.716171 49 45.130859L49 34.865234C49 33.223584 47.583278 32 46 32L29 32 z M 29 34L46 34C46.526722 34 47 34.446885 47 34.865234L47 45.132812C47.000465 45.613501 46.61765 46 46.091797 46L28.908203 46C28.381481 46 28 45.612015 28 45.134766L28 34.865234C28 34.447532 28.474779 34 29 34 z M 41.65625 36C41.29325 36 41 36.268609 41 36.599609L41 38.400391C41 38.731391 41.29425 39 41.65625 39L44.283203 39C44.646203 39 44.940406 38.731391 44.941406 38.400391L44.941406 36.599609C44.941406 36.268609 44.646203 36 44.283203 36L41.65625 36 z M 31 41 A 1.0001 1.0001 0 1 0 31 43L32 43 A 1.0001 1.0001 0 1 0 32 41L31 41 z M 35 41 A 1.0001 1.0001 0 1 0 35 43L36 43 A 1.0001 1.0001 0 1 0 36 41L35 41 z M 39 41 A 1.0001 1.0001 0 1 0 39 43L40 43 A 1.0001 1.0001 0 1 0 40 41L39 41 z M 43 41 A 1.0001 1.0001 0 1 0 43 43L44 43 A 1.0001 1.0001 0 1 0 44 41L43 41 z" fill="#384857" />
                        </svg>
                        <span  class="ml-3">{{\App\Utils\translate('accounts')}}</span>
                    </h5>
                    <a class="" href="{{route('admin.account.list')}}">{{ \App\Utils\translate('View All') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ \App\Utils\translate('#') }}</th>
                                <th>{{ \App\Utils\translate('account') }}</th>
                                <th>{{\App\Utils\translate('balance')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($accounts as $key=>$account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a class="text-primary" href="{{ route('admin.account.list') }}">
                                                {{ $account->account }}
                                            </a>
                                        </td>
                                        <td>{{ priceCurrencyFormatPlacing($account->balance, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(count($accounts)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 img-one-dash" src="{{asset('assets/admin/img/no-data.jpg')}}" alt="Image Description">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 stock-limit">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-title mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" fill="#384857">
                            <path d="M24.984375 3.9863281 A 1.0001 1.0001 0 0 0 24.839844 4L11 4 A 1.0001 1.0001 0 0 0 10.359375 4.2324219L4.3730469 9.2207031L4.359375 9.2324219 A 1.0001 1.0001 0 0 0 4.3261719 9.2636719 A 1.0001 1.0001 0 0 0 4.2832031 9.3027344 A 1.0001 1.0001 0 0 0 4 10.152344L4 45 A 1.0001 1.0001 0 0 0 5 46L45 46 A 1.0001 1.0001 0 0 0 46 45L46 10.144531 A 1.0001 1.0001 0 0 0 45.765625 9.3554688 A 1.0001 1.0001 0 0 0 45.761719 9.3496094 A 1.0001 1.0001 0 0 0 45.697266 9.2832031 A 1.0001 1.0001 0 0 0 45.640625 9.2324219L45.621094 9.2167969L39.640625 4.2324219 A 1.0001 1.0001 0 0 0 39 4L25.154297 4 A 1.0001 1.0001 0 0 0 24.984375 3.9863281 z M 11.361328 6L24 6L24 9L7.7617188 9L11.361328 6 z M 26 6L38.638672 6L42.238281 9L26 9L26 6 z M 6 11L24.832031 11 A 1.0001 1.0001 0 0 0 25.158203 11L44 11L44 44L6 44L6 11 z M 21.5 15C20.116667 15 19 16.116667 19 17.5C19 18.883333 20.116667 20 21.5 20L28.5 20C29.883333 20 31 18.883333 31 17.5C31 16.116667 29.883333 15 28.5 15L21.5 15 z M 21.5 17L28.5 17C28.716667 17 29 17.283333 29 17.5C29 17.716667 28.716667 18 28.5 18L21.5 18C21.283333 18 21 17.716667 21 17.5C21 17.283333 21.283333 17 21.5 17 z M 31 31L28 34L30 34L30 38L32 38L32 34L34 34L31 31 z M 38 31L35 34L37 34L37 38L39 38L39 34L41 34L38 31 z M 28 39L28 41L41 41L41 39L28 39 z" fill="#384857" />
                        </svg>
                        <span  class="ml-3">{{\App\Utils\translate('stock_limit_products')}}</span>
                    </h5>
                    <a class="" href="{{route('admin.stock.stock-limit')}}">{{ \App\Utils\translate('View All') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ \App\Utils\translate('#') }}</th>
                                <th>{{ \App\Utils\translate('name') }}</th>
                                <th>{{\App\Utils\translate('quantity')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key=>$product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a class="text-primary" href="{{ route('admin.stock.stock-limit') }}">
                                                {{ Str::limit($product->name,40) }}
                                            </a>
                                        </td>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(count($products)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 img-one-dash" src="{{asset('assets/admin/img/no-data.jpg')}}" alt="{{\App\Utils\translate('image_description')}}">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="text-center centered--messages">
           <div>
               <img class="mb-3 img-one-dash" src="{{asset('assets/admin/img/access-denied.svg')}}" alt="{{\App\Utils\translate('image_description')}}">
               <p class="mb-0 text-center">{{ \App\Utils\translate('You do not have access to this content')}}</p>
           </div>
        </div>
    @endif
</div>

@endsection

@push('script')
    <script src="{{asset('assets/admin')}}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{asset('assets/admin')}}/vendor/chart.js.extensions/chartjs-extensions.js"></script>
    <script src="{{asset('assets/admin')}}/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush

@push('script_2')
<script src={{asset("assets/admin/js/global.js")}}></script>

    <script>
        "use strict";

        $('#statisticsTypeSelect').on('change', function() {
            account_stats_update($(this).val());
        });

        function account_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.account-status')}}',
                data: {
                    statistics_type: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    $('#account_stats').html(data.view)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }
        var options = {
            series: [
                {
                    name:"{{ App\Utils\translate('total_revenue') }}",
                    data: [{{$monthlyIncome[1]}},{{$monthlyIncome[2]}},{{$monthlyIncome[3]}},{{$monthlyIncome[4]}},{{$monthlyIncome[5]}},{{$monthlyIncome[6]}},{{$monthlyIncome[7]}},{{$monthlyIncome[8]}},{{$monthlyIncome[9]}},{{$monthlyIncome[10]}},{{$monthlyIncome[11]}},{{$monthlyIncome[12]}}]
                },
                {
                    name:"{{ App\Utils\translate('total_expense') }}",
                    data: [{{$monthlyExpense[1]}},{{$monthlyExpense[2]}},{{$monthlyExpense[3]}},{{$monthlyExpense[4]}},{{$monthlyExpense[5]}},{{$monthlyExpense[6]}},{{$monthlyExpense[7]}},{{$monthlyExpense[8]}},{{$monthlyExpense[9]}},{{$monthlyExpense[10]}},{{$monthlyExpense[11]}},{{$monthlyExpense[12]}}]
                }
            ],
            chart: {
                type: 'area',
                height: 350,
                zoom: {
                    enabled: false
                },
                stacked: true,

            },
            dataLabels: {
            enabled: false
            },
            stroke: {
                curve: 'straight'
            },

            title: {
            text: "{{ App\Utils\translate('statistics') }}",
                align: 'left'
            },
            /*  subtitle: {
                text: 'Price Movements',
                align: 'left'
                }, */
            labels: ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
            /* xaxis: {
            type: 'datetime'
            }, */
            yaxis: {
            opposite: true
            },
            legend: {
                horizontalAlign: 'left'
            }
        };
        var lastMonthStatistic = new ApexCharts(document.querySelector("#chart"), options);
        lastMonthStatistic.render();



    </script>

@endpush
