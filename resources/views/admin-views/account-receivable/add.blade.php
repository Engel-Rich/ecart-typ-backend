@extends('layouts.admin.app')

@section('title',\App\Utils\translate('add_new_receivable'))

@section('content')
<div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-add-circle-outlined"></i> {{\App\Utils\translate('add_new_receivable_balance')}}
                    </h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.account.store-receivable')}}" method="post" >
                    @csrf
                        <div class="row pl-2" >
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('account')}}</label>
                                    <h2>{{\App\Utils\translate('account_receivable')}}</h2>
                                    <input type="hidden" name="account_id" value="3">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label">{{\App\Utils\translate('description')}} </label>
                                    <input type="text" name="description" class="form-control" placeholder="{{\App\Utils\translate('description')}}" >
                                </div>
                            </div>
                        </div>
                        <div class="row pl-2" >
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" >{{\App\Utils\translate('amount')}}</label>
                                    <input type="number" step="0.01" min="0" name="amount" class="form-control" placeholder="{{\App\Utils\translate('amount')}}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('date')}} </label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{\App\Utils\translate('submit')}}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-files"></i> {{\App\Utils\translate('receivable_list')}}</h1>
                </div>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-lg-5 mb-3 mb-lg-0">
                                <form action="{{url()->current()}}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{\App\Utils\translate('search_by_description')}}" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn-primary">{{\App\Utils\translate('search')}} </button>

                                    </div>
                                </form>
                            </div>
                            <div class="col-7">
                                <form action="{{url()->current()}}" method="GET">
                                <div class="row">
                                    <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('from')}} </label>
                                        <input type="date" name="from" class="form-control" value="{{ $from }}" required>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('to')}} </label>
                                            <input type="date" name="to" class="form-control" value="{{ $to }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button href="" class="btn btn-success mt-4"> {{\App\Utils\translate('filter')}}</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ \App\Utils\translate('date') }}</th>
                                <th >{{ \App\Utils\translate('account') }}</th>
                                <th>{{\App\Utils\translate('type')}}</th>
                                <th>{{\App\Utils\translate('amount')}}</th>
                                <th class="w-one-payable">{{\App\Utils\translate('description')}}</th>
                                <th>{{ \App\Utils\translate('debit') }}</th>
                                <th >{{\App\Utils\translate('credit')}}</th>
                                <th >{{\App\Utils\translate('balance')}}</th>
                                <th >{{\App\Utils\translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($receivables as $key=>$receivable)
                                    <tr>
                                        <input type="hidden" id="available_balance-{{ $receivable->id }}" value="{{ $receivable->amount }}">
                                        <td>{{ $receivable->date }}</td>
                                        <td>
                                            {{ $receivable->account->account}} <br>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $receivable->tran_type}} <br>
                                            </span>
                                        </td>
                                        <td>
                                            {{ priceCurrencyFormatPlacing($receivable->amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                        </td>
                                        <td>
                                            {{ Str::limit($receivable->description,30) }}
                                        </td>
                                        <td>
                                            @if ($receivable->debit)
                                                {{ priceCurrencyFormatPlacing($receivable->amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @else
                                                {{ priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($receivable->credit)
                                                {{ priceCurrencyFormatPlacing($receivable->amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @else
                                                {{ priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ priceCurrencyFormatPlacing($receivable->balance, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm balance_transfer_rec" id="{{ $receivable->id }}" data-id="{{ $receivable->id }}" type="button" data-toggle="modal" data-target="#balance-transfer">
                                            <i class="tio-edit"></i>
                                        </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                {!! $receivables->links() !!}
                                </tfoot>
                            </table>
                        </div>
                        @if(count($receivables)==0)
                            @include('layouts.admin.partials._no-data-section')
                        @endif
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="balance-transfer" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{\App\Utils\translate('payable_balance_transfer_rec')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.account.receivable-transfer')}}" method="post" class="row">
                    @csrf
                    <input type="hidden" id="transaction_id" name="transaction_id">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('account')}}</label>
                            <h2>{{\App\Utils\translate('account_receivable')}}</h2>
                            <input type="hidden" name="account_id" value="3">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('payment_from')}}</label>
                            <select name="receive_account_id" class="form-control js-select2-custom" >
                                @foreach ($accounts as $account)
                                @if ($account['id']!=2 && $account['id']!=3)
                                    <option value="{{$account['id']}}">{{$account['account']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" >{{\App\Utils\translate('avaiable_balance')}}</label>
                            <input id="payment_balance" type="number" step="0.01" min= "0" name="amount" class="form-control" placeholder="{{\App\Utils\translate('amount')}}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('date')}} </label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="input-label">{{\App\Utils\translate('description')}} </label>
                            <input type="text" name="description" class="form-control" placeholder="{{\App\Utils\translate('description')}}" >
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <button class="btn btn-sm btn-primary" type="submit">{{\App\Utils\translate('submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script_2')
    <script src={{asset("assets/admin/js/accounts.js")}}></script>
@endpush
