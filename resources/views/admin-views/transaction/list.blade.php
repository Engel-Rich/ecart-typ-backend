@extends('layouts.admin.app')

@section('title',\App\Utils\translate('transaction_list'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title d-flex align-items-center g-2px text-capitalize"><i
                        class="tio-files"></i> {{\App\Utils\translate('transaction_list')}}
                    <span class="badge badge-soft-dark ml-2">{{$transactions->total()}}</span>
                </h1>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <form action="{{url()->current()}}" method="GET">
                        <div class="row m-1">
                            <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('account')}} </label>
                                <select id="account_id" name="account_id" class="form-control js-select2-custom">
                                    <option value="">---{{\App\Utils\translate('select')}}---</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{$account['id']}}" {{ $accId==$account['id']?'selected':''}}>{{$account['account']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('type')}} </label>
                                <select id="tran_type" name="tran_type" class="form-control js-select2-custom">
                                    <option value="">---{{\App\Utils\translate('select')}}---</option>
                                    <option value="Expense" {{ $tranType=='Expense'?'selected':''}}>{{\App\Utils\translate('expense')}}</option>
                                    <option value="Transfer" {{ $tranType=='Transfer'?'selected':''}}>{{\App\Utils\translate('transfer')}}</option>
                                    <option value="Income" {{ $tranType=='Income'?'selected':''}}>{{\App\Utils\translate('income')}}</option>
                                    <option value="Payable" {{ $tranType=='Payable'?'selected':''}}>{{\App\Utils\translate('payable')}}</option>
                                    <option value="Receivable" {{ $tranType=='Receivable'?'selected':''}}>{{\App\Utils\translate('receivable')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('start_date')}} </label>
                                <input id="start_date" type="date" name="from" class="form-control" value="{{ $from }}">
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\Utils\translate('expire_date')}} </label>
                                <input id="end_date" type="date" name="to" class="form-control" value="{{ $to }}">
                            </div>

                            @if ($accId!=null || $tranType!=null || $from!=null || $to!=null)
                                <?php
                                    $chk = 1;
                                ?>
                            @else
                            <?php
                                    $chk = 0;
                                ?>
                            @endif

                            <div class="col-12 ">
                                <div class="row d-flex justify-content-end ">
                                    <button class="btn btn-success col-2 mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" fill="#FFFFFF">
                                            <path d="M1 0C.4 0 0 .4 0 1v3c0 .3.1.5.3.7L14.7 20h14.6L43.7 4.7c0 0 .1-.1.1-.1 0-.1.1-.1.1-.2 0-.1 0-.2 0-.3 0 0 0-.1 0-.1V1c0-.6-.4-1-1-1H1zM16 22v17c0 .4.2.7.5.8l10 6c.2.1.3.2.5.2.2 0 .3 0 .5-.1.3-.2.5-.5.5-.9V22H16z" fill="#FFFFFF" />
                                        </svg>
                                        &nbsp;{{\App\Utils\translate('filter')}}
                                    </button>
                                    <a href="{{ route('admin.account.list-transaction') }}" class="btn btn-danger col-2 mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" fill="#FFFFFF">
                                            <path d="M20 3C14.486 3 10 7.486 10 13L10 33.171875L6.4140625 29.585938 A 2.0002 2.0002 0 0 0 4.9785156 28.980469 A 2.0002 2.0002 0 0 0 3.5859375 32.414062L10.585938 39.414062 A 2.0002 2.0002 0 0 0 13.414062 39.414062L20.414062 32.414062 A 2.0002 2.0002 0 1 0 17.585938 29.585938L14 33.171875L14 13C14 9.691 16.691 7 20 7L30.46875 7L30.734375 3L20 3 z M 37.970703 10 A 2.0002 2.0002 0 0 0 36.585938 10.585938L29.585938 17.585938 A 2.0002 2.0002 0 1 0 32.414062 20.414062L36 16.828125L36 37C36 40.309 33.309 43 30 43L19.509766 43L19.255859 47L30 47C35.514 47 40 42.514 40 37L40 16.828125L43.585938 20.414062 A 2.0002 2.0002 0 1 0 46.414062 17.585938L39.414062 10.585938 A 2.0002 2.0002 0 0 0 37.970703 10 z" fill="#FFFFFF" />
                                        </svg>
                                        &nbsp;{{\App\Utils\translate('reset')}}
                                    </a>
                                    <a href="{{ route('admin.account.transaction-export',['account_id'=>$accId,'tran_type'=>$tranType,'from'=>$from,'to'=>$to]) }}" class="btn btn-info col-2" data-toggle="tooltip" data-placement="top" title="{{ $chk==0?\App\Utils\translate('export__data'):''}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M46.935 55a1 1 0 0 0-1 1v1.07a.93.93 0 0 1-.93.93h-34.72a.93.93 0 0 1-.93-.93V6.93a.93.93 0 0 1 .93-.93h17.22a1 1 0 0 0 0-2h-17.22a2.933 2.933 0 0 0-2.93 2.93v50.14a2.933 2.933 0 0 0 2.93 2.93h34.72a2.933 2.933 0 0 0 2.93-2.93c-.002-.855.184-2.008-1-2.07Z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path><path d="M52.64 31h-4.71V20.43a.99.99 0 0 0-.29-.71L32.21 4.29A1.013 1.013 0 0 0 30.5 5v13.5a2.934 2.934 0 0 0 2.93 2.93h12.5V31H22.64a4.005 4.005 0 0 0-4 4v14a4.005 4.005 0 0 0 4 4h30a3.999 3.999 0 0 0 4-4V35a3.999 3.999 0 0 0-4-4ZM29.02 45.89a1.002 1.002 0 0 1-1.7 1.06l-1.91-3.06-1.92 3.06a.997.997 0 1 1-1.69-1.06L24.23 42l-2.43-3.89a.997.997 0 1 1 1.69-1.06l1.92 3.06 1.91-3.06a1.002 1.002 0 0 1 1.7 1.06L26.59 42Zm7.22 1.53h-3.69a3.065 3.065 0 0 1-2.84-3.24v-6.6a1 1 0 0 1 2 0v6.6c0 .66.4 1.24.84 1.24h3.69a1 1 0 0 1 0 2ZM41.03 41h1.1a3.21 3.21 0 0 1 0 6.42h-3.31a1 1 0 0 1 0-2h3.31a1.21 1.21 0 0 0 0-2.42h-1.1a3.21 3.21 0 0 1 0-6.42h3.31a1 1 0 0 1 0 2h-3.31a1.21 1.21 0 0 0 0 2.42Zm12.46 4.89a.998.998 0 0 1-1.69 1.06l-1.92-3.06-1.91 3.06a1.002 1.002 0 0 1-1.7-1.06L48.7 42l-2.43-3.89a1.002 1.002 0 1 1 1.7-1.06l1.91 3.06 1.92-3.06a.998.998 0 0 1 1.69 1.06L51.06 42Z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                        &nbsp;{{\App\Utils\translate('export')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ \App\Utils\translate('date') }}</th>
                                <th>{{ \App\Utils\translate('account') }}</th>
                                <th>{{\App\Utils\translate('type')}}</th>
                                <th>{{\App\Utils\translate('amount')}}</th>
                                <th >{{\App\Utils\translate('description')}}</th>
                                <th>{{ \App\Utils\translate('debit') }}</th>
                                <th >{{\App\Utils\translate('credit')}}</th>
                                <th >{{\App\Utils\translate('balance')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($transactions as $key=>$transaction)
                                    <tr>
                                        <td>{{ $transaction->date }}</td>
                                        <td>
                                            @if($transaction->account)
                                                {{$transaction->account->account}}
                                            @else
                                                <span class="badge badge-danger">{{ \App\Utils\translate('Account Deleted') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->tran_type == 'Expense')
                                                <span class="badge badge-danger">
                                                    {{ $transaction->tran_type}} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Deposit')
                                                <span class="badge badge-info">
                                                    {{ $transaction->tran_type}} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Transfer')
                                                <span class="badge badge-warning">
                                                    {{ $transaction->tran_type}} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Income')
                                                <span class="badge badge-success">
                                                    {{ $transaction->tran_type}} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Payable')
                                                <span class="badge badge-soft-warning">
                                                    {{ $transaction->tran_type}} <br>
                                                </span>
                                            @elseif($transaction->tran_type == 'Receivable')
                                                <span class="badge badge-soft-success">
                                                    {{ $transaction->tran_type}} <br>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ priceCurrencyFormatPlacing($transaction->amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                        </td>
                                        <td>
                                            {{ Str::limit($transaction->description,30) }}
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
                        @if(count($transactions)==0)
                            <div class="text-center p-4">
                                <img class="mb-3 img-one-tranl" src="{{ asset('assets/admin/img/no-data.jpg') }}" alt="{{\App\Utils\translate('image_description')}}">
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
    <script src={{asset("assets/admin/js/transaction.js")}}></script>
@endpush
