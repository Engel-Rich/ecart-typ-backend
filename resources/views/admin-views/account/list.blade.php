@extends('layouts.admin.app')

@section('title',\App\Utils\translate('account_list'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize">
                <i class="tio-filter-list"></i>
                <span>{{\App\Utils\translate('account_list')}} <span
                        class="badge badge-soft-dark ml-2">{{$accounts->total()}}</span></span>
            </h1>
        </div
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-10 mb-1 mb-md-0 col-sm-7 col-md-6">
                                <form action="{{url()->current()}}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{\App\Utils\translate('search_by_account_title')}}"
                                               value="{{ $search }}" required>
                                        <button type="submit"
                                                class="btn btn-primary">{{\App\Utils\translate('search')}} </button>

                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-sm-5  col-md-4">
                                <a href="{{route('admin.account.add')}}" class="btn btn-primary float-right"><i
                                        class="tio-add-circle"></i> {{\App\Utils\translate('add_new_account')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{\App\Utils\translate('#')}}</th>
                                <th>{{\App\Utils\translate('account_info')}}</th>
                                <th>{{\App\Utils\translate('balance_info')}}</th>
                                <th class="w-fp-acc">{{\App\Utils\translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($accounts as $key=>$account)
                                <tr>
                                    <td>{{ $accounts->firstItem()+$key }}</td>
                                    <td>
                                        <div class="max-w450 text-wrap">
                                            {{ $account->account }} <br>
                                            @if ($account->id !=1 && $account->id !=2 && $account->id !=3)
                                                {{ $account->account_number }} <br>
                                                {{ $account->description }}
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        {{\App\Utils\translate('balance')}}
                                        : {{ priceCurrencyFormatPlacing($account->balance, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }} <br>
                                        {{\App\Utils\translate('total_in')}}
                                        : {{ $account->total_in ? priceCurrencyFormatPlacing($account->total_in, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position())}}
                                        <br>
                                        {{ \App\Utils\translate('total_out') }}
                                        : {{ $account->total_out ? priceCurrencyFormatPlacing($account->total_out, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position())}} <br>
                                    </td>
                                    <td>
                                        @if ($account->id !=1 && $account->id !=2 && $account->id !=3)
                                            <a class="btn btn-white mr-1"
                                               href="{{route('admin.account.edit',[$account['id']])}}">
                                                <span class="tio-edit"></span>
                                            </a>
                                            <a class="btn btn-white mr-1 form-alert" href="javascript:"
                                               data-id="account-{{$account['id']}}"
                                               data-message="{{ \App\Utils\translate('Want to delete this account') }}?">
                                                <span class="tio-delete"></span></a>
                                            <form action="{{route('admin.account.delete',[$account['id']])}}"
                                                  method="post" id="account-{{$account['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                        @else
                                            <span>{{\App\Utils\translate('default')}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                {!! $accounts->links() !!}
                                </tfoot>
                            </table>
                        </div>
                        @if(count($accounts)==0)
                            @include('layouts.admin.partials._no-data-section')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')

@endpush
