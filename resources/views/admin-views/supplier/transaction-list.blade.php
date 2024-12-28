@extends('layouts.admin.app')

@section('title', \App\Utils\translate('supplier_details'))

@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div>
                <h1 class="page-header-title">{{ $supplier->name }}</h1>
            </div>
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.supplier.view', [$supplier['id']]) }}">{{ \App\Utils\translate('details') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.supplier.products', [$supplier['id']]) }}">{{ \App\Utils\translate('product_list') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('admin.supplier.transaction-list', [$supplier['id']]) }}">{{ \App\Utils\translate('transaction') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-7 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <span class="font-one-stl badge badge-warning">{{ \App\Utils\translate('due_amount') }}</span>
                            <div class="col-12 style-one-stl">
                                <span>{{ $supplier->due_amount ? priceCurrencyFormatPlacing($supplier->due_amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <a class="col-12 btn btn-info add-new-purchase-btn"
                                   data-supplier-id="{{ $supplier->id }}"
                                    data-toggle="modal"
                                    data-target="#add-new-purchase">{{ \App\Utils\translate('add_new_purchase') }}</a>
                            </div>
                            <div class="col-12">
                                <a class="col-12 btn btn-success payment-due-btn"
                                   data-supplier-id="{{ $supplier->id }}"
                                   data-toggle="modal" data-target="#payment-due">{{ \App\Utils\translate('pay') }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="content container-fluid">
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-12 col-lg-5 mt-2 mb-lg-0">
                                <h3>{{ \App\Utils\translate('transaction_list') }}
                                    <span class="badge badge-soft-dark ml-2">{{ $transactions->total() }}</span>
                                </h3>
                            </div>
                            <div class="col-12  mt-2">
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1">{{ \App\Utils\translate('from') }}
                                                </label>
                                                <input id="start_date" type="date" name="from" class="form-control"
                                                    value="{{ $from }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1">{{ \App\Utils\translate('to') }} </label>
                                                <input id="end_date" type="date" name="to" class="form-control"
                                                    value="{{ $to }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-md-5">
                                            <button href="" class="btn btn-success">
                                                {{ \App\Utils\translate('filter') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ \App\Utils\translate('date') }}</th>
                                    <th>{{ \App\Utils\translate('account') }}</th>
                                    <th>{{ \App\Utils\translate('type') }}</th>
                                    <th>{{ \App\Utils\translate('amount') }}</th>
                                    <th>{{ \App\Utils\translate('description') }}</th>
                                    <th>{{ \App\Utils\translate('debit') }}</th>
                                    <th>{{ \App\Utils\translate('credit') }}</th>
                                    <th>{{ \App\Utils\translate('balance') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ $transaction->date }}</td>
                                        <td>
                                            {{ $transaction->account ? $transaction->account->account : '' }}
                                            <br>
                                        </td>
                                        <td>
                                            @if ($transaction->tran_type == 'Expense')
                                                <span class="badge badge-danger">
                                                    {{ $transaction->tran_type }} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Deposit')
                                                <span class="badge badge-info">
                                                    {{ $transaction->tran_type }} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Transfer')
                                                <span class="badge badge-warning">
                                                    {{ $transaction->tran_type }} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Income')
                                                <span class="badge badge-success">
                                                    {{ $transaction->tran_type }} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Payable')
                                                <span class="badge badge-soft-warning">
                                                    {{ $transaction->tran_type }} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Receivable')
                                                <span class="badge badge-soft-success">
                                                    {{ $transaction->tran_type }} <br>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ priceCurrencyFormatPlacing($transaction->amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                        </td>
                                        <td>
                                            {{ Str::limit($transaction->description, 30) }}
                                        </td>
                                        <td>
                                            @if ($transaction->debit)
                                            {{ priceCurrencyFormatPlacing($transaction->amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @else
                                            {{ priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @endif

                                        </td>
                                        <td>
                                            @if ($transaction->credit)
                                            {{ priceCurrencyFormatPlacing($transaction->amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @else
                                            {{ priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ priceCurrencyFormatPlacing($transaction->balance, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                    {!! $transactions->links() !!}
                                </tfoot>
                            </table>
                        </div>
                        @if (count($transactions) == 0)
                            <div class="text-center p-4">
                                <img class="mb-3 img-one-stl"
                                    src="{{ asset('assets/admin/img/no-data.jpg') }}"
                                    alt="{{ \App\Utils\translate('image_description') }}">
                                <p class="mb-0">{{ \App\Utils\translate('No_data_to_show') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-new-purchase" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ \App\Utils\translate('add_new_purchase') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.supplier.add-new-purchase') }}" method="post" class="row">
                        @csrf
                        <input type="hidden" id="supplier_id" name="supplier_id">
                        <div class="form-group col-sm-6">
                            <label for="">{{ \App\Utils\translate('purchased_amount') }}</label>
                            <input id="purchased_amount" type="number" step=".01" min="0"
                                class="form-control" name="purchased_amount" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">{{ \App\Utils\translate('paid_amount') }}</label>
                            <input id="paid_amount" class="pay_amount form-control" type="number" step=".01"
                                min="0" class="form-control" name="paid_amount" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">{{ \App\Utils\translate('due_amount') }}</label>
                            <input id="due_amount" type="number" step=".01" min="0" class="form-control"
                                name="due_amount" required readonly>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label"
                                    for="exampleFormControlInput1">{{ \App\Utils\translate('account_to') }} </label>
                                <select id="payment_account_id" name="payment_account_id" class="form-control" required>
                                    <option value="">---{{ \App\Utils\translate('select') }}---</option>
                                    @foreach ($accounts as $account)
                                        @if ($account['id'] != 2 && $account['id'] != 3)
                                            <option value="{{ $account['id'] }}" class="account">
                                                {{ $account['account'] }} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <button class="btn btn-sm btn-primary"
                                type="submit">{{ \App\Utils\translate('submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="payment-due" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ \App\Utils\translate('due_payment') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.supplier.pay-due') }}" method="post" class="row">
                        @csrf
                        <input type="hidden" id="due_pay_supplier_id" name="supplier_id">
                        <div class="form-group col-sm-6">
                            <label for="">{{ \App\Utils\translate('total_due_amount') }}</label>
                            <input id="total_due_amount" type="number" step=".01" min="0"
                                class="form-control" name="total_due_amount" value="{{ $supplier->due_amount }}"
                                required readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">{{ \App\Utils\translate('pay_amount') }}</label>
                            <input class="due_remain form-control" id="pay_amount" type="number" step=".01" min="0.1"
                                max="{{ $supplier->due_amount }}" class="form-control" name="pay_amount" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">{{ \App\Utils\translate('remaining_due_amount') }}</label>
                            <input id="remaining_due_amount" type="number" step=".01" min="0"
                                class="form-control" name="remaining_due_amount" required readonly>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label"
                                    for="exampleFormControlInput1">{{ \App\Utils\translate('account_to') }} </label>
                                <select id="payment_account_id" name="payment_account_id" class="form-control" required>
                                    <option value="">---{{ \App\Utils\translate('select') }}---</option>
                                    @foreach ($accounts as $account)
                                        @if ($account['id'] != 2 && $account['id'] != 3)
                                            <option value="{{ $account['id'] }}" class="account">
                                                {{ $account['account'] }} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <button class="btn btn-sm btn-primary"
                                type="submit">{{ \App\Utils\translate('submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

    <script>
        "use strict";

        $('.add-new-purchase-btn').on('click', function() {
            var supplierId = $(this).data('supplier-id');
            add_new_purchase(supplierId);
        });

        $('.payment-due-btn').on('click', function() {
            var supplierId = $(this).data('supplier-id');
            payment_due(supplierId);
        });

        $('.pay_amount').on('input', function() {
            due_calculate();
        });
        $('.due_remain').on('input', function() {
            due_remain();
        });
    </script>

    <script src={{ asset('assets/admin/js/global.js') }}></script>
@endpush
