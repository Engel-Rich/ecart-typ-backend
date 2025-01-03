@extends('layouts.admin.app')

@section('title',\App\Utils\translate('add_new_coupon'))

@push('css_or_js')
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css"/>
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="">
            <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize mb-3">
                <i class="tio-add-circle-outlined"></i>
                <span>{{\App\Utils\translate('add_new_coupon')}}</span>
            </h1>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.coupon.store')}}" method="post">
                                @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('title')}}</label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="{{\App\Utils\translate('new_coupon')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('coupon_code')}}</label>
                                            <a href="javascript:void(0)" class="float-right c1 fz-12 generate-code-link">{{\App\Utils\translate('generate_code')}}</a>
                                        </div>
                                        <input type="text" name="code" class="form-control" value="" id="code"
                                            placeholder="{{\Illuminate\Support\Str::random(8)}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('coupon_type')}} </label>
                                        <select name="coupon_type" class="form-control coupon-type-change">
                                            <option value="default">{{\App\Utils\translate('default')}}</option>
                                            <option value="first_order">{{\App\Utils\translate('first_order')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6" id="limit-for-user">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('limit_for_same_user')}} </label>
                                        <input min="1" type="number" name="user_limit" value="{{ old('user_limit') }}" class="form-control" placeholder="{{\App\Utils\translate('EX:_10')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('start_date')}} </label>
                                        <input id="start_date" type="date" name="start_date" class="form-control checkstartDate" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('expire_date')}} </label>
                                        <input id="expire_date" type="date" name="expire_date" class="form-control check-date" required>
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('min_purchase')}} </label>
                                            <input type="number" step="0.01" name="min_purchase" value="0" min="0" max="1000000" class="form-control"
                                                placeholder="{{\App\Utils\translate('100')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6" id="max_discount">
                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('max_discount')}}</label>
                                            <input type="number" step="0.01" min="0" value="0" max="1000000" name="max_discount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('discount')}}</label>
                                            <input type="number" step="0.01" min="1" max="1000000" name="discount" value="{{ old('discount') }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('discount')}} {{\App\Utils\translate('type')}}</label>
                                            <select  name="discount_type" class="form-control discount-amount">
                                                <option value="percent">{{\App\Utils\translate('percent')}}</option>
                                                <option value="amount">{{\App\Utils\translate('amount')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{\App\Utils\translate('submit')}}</button>
                            </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-6">
                                    <h5 class="card-header-title">
                                        <span>{{\App\Utils\translate('coupon_table')}}</span>
                                        <span class="badge badge-soft-dark ml-2">{{$coupons->total()}}</span>
                                    </h5>

                                </div>
                                <div class="col-12 col-sm-8 col-md-6 mt-1 mt-sm-0">
                                    <form action="{{url()->current()}}" method="GET">
                                        <div class="input-group input-group-merge input-group-flush">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-search"></i>
                                                </div>
                                            </div>
                                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                                   placeholder="{{\App\Utils\translate('search_by_code_or_title')}}" aria-label="Search" value="{{$search}}" required>
                                            <button type="submit" class="btn btn-primary">{{\App\Utils\translate('search')}} </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{\App\Utils\translate('#')}}</th>
                                    <th>{{\App\Utils\translate('title')}}</th>
                                    <th>{{\App\Utils\translate('code')}}</th>
                                    <th>{{\App\Utils\translate('min')}} {{\App\Utils\translate('purchase')}}</th>
                                    <th>{{\App\Utils\translate('max')}} {{\App\Utils\translate('discount')}}</th>
                                    <th>{{\App\Utils\translate('discount')}}</th>
                                    <th>{{\App\Utils\translate('discount')}} {{\App\Utils\translate('type')}}</th>
                                    <th>{{\App\Utils\translate('start')}} {{\App\Utils\translate('date')}}</th>
                                    <th>{{\App\Utils\translate('expire')}} {{\App\Utils\translate('date')}}</th>
                                    <th>{{\App\Utils\translate('status')}}</th>
                                    <th>{{\App\Utils\translate('action')}}</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($coupons as $key=>$coupon)
                                <tr>
                                    <td>{{$coupons->firstitem()+$key}}</td>
                                    <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{$coupon['title']}}
                                    </span>
                                    </td>
                                    <td>{{$coupon['code']}}</td>
                                    <td>{{ priceCurrencyFormatPlacing($coupon['min_purchase'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</td>
                                    <td>{{ $coupon['discount_type'] == 'percent' ? priceCurrencyFormatPlacing($coupon['max_discount'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : '-'}}</td>
                                    <td>{{ $coupon['discount_type'] == 'amount' ? priceCurrencyFormatPlacing($coupon['discount'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : $coupon['discount']."%"}}</td>
                                    <td>{{$coupon['discount_type']}}</td>
                                    <td>{{$coupon['start_date']}}</td>
                                    <td>{{$coupon['expire_date']}}</td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm">
                                            <input type="checkbox" class="toggle-switch-input change-status"
                                                data-route="{{ route('admin.coupon.status',[$coupon['id'],$coupon->status?0:1]) }}"
                                                   class="toggle-switch-input" {{$coupon->status?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <a class="btn btn-white mr-1"
                                                   href="{{route('admin.coupon.edit',[$coupon['id']])}}"><span class="tio-edit"></span></a>
                                        <a class="btn btn-white mr-1 form-alert" href="javascript:"
                                           data-id="coupon-{{$coupon['id']}}"
                                           data-message="{{ \App\Utils\translate('Want to delete this coupon') }}?"><span class="tio-delete"></span>
                                        </a>
                                        <form action="{{route('admin.coupon.delete',[$coupon['id']])}}"
                                                method="post" id="coupon-{{$coupon['id']}}">
                                            @csrf @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table>
                            <tfoot>
                            {!! $coupons->links() !!}
                            </tfoot>
                        </table>
                         @if(count($coupons)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 w-one-carsi" src="{{ asset('assets/admin/img/no-data.jpg') }}" alt="{{\App\Utils\translate('Image Description')}}">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script src={{asset("assets/admin/js/coupon-index.js")}}></script>

    <script>
        "use strict";

        $('.generate-code-link').on('click', function() {
            generateCode();
        });

        function  generateCode(){
            let code = Math.random().toString(36).substring(2,12);
            $('#code').val(code)
        }
    </script>
@endpush
