@extends('layouts.admin.app')
@section('title',\App\Utils\translate('Order List'))
@push('css_or_js')
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css"/>
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="">
            <div class="row align-items-center mb-3">
                <div class="col-sm">
                    <h1 class="page-header-title text-capitalize">{{\App\Utils\translate('pos')}} {{\App\Utils\translate('orders')}}
                        <span class="badge badge-soft-dark ml-2">{{$orders->total()}}</span></h1>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-sm-8 col-md-6 col-lg-6 mb-3 mb-lg-0">
                        <form action="{{url()->current()}}" method="GET">
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input type="search" name="search" class="form-control"
                                       placeholder="{{\App\Utils\translate('search_by_order_id')}}" aria-label="Search"
                                       value="{{ $search }}" required>
                                <button type="submit" class="btn btn-primary">{{\App\Utils\translate('search')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6"></div>
                </div>
            </div>
            <div class="table-responsive ">
                <table
                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th class="">{{\App\Utils\translate('#')}}</th>
                        <th class="table-column-pl-0">{{\App\Utils\translate('order')}}</th>
                        <th>{{\App\Utils\translate('date')}}</th>
                        <th>{{\App\Utils\translate('payment_method')}}</th>
                        <th>{{\App\Utils\translate('order_amount')}}</th>
                        <th>{{\App\Utils\translate('total_tax')}}</th>
                        <th>{{\App\Utils\translate('extra_discount')}}</th>
                        <th>{{\App\Utils\translate('coupon_discount')}}</th>
                        <th>{{\App\Utils\translate('paid_amount')}}</th>
                        <th>{{\App\Utils\translate('actions')}}</th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                        @foreach($orders as $key=>$order)
                            <tr class="status-{{$order['order_status']}} class-all">
                                <td class="">
                                    {{$key+$orders->firstItem()}}
                                </td>
                                <td class="table-column-pl-0">
                                    <a class="text-primary print-invoice" href="#" data-id="{{$order->id}}">{{$order['id']}}</a>
                                </td>
                                <td>{{date('d M Y',strtotime($order['created_at']))}}</td>
                                <td>
                                    {{ ($order->payment_id != 0) ? ($order->account ? $order->account->account : \App\Utils\translate('account_deleted')): \App\Utils\translate('Customer balance') }}
                                </td>
                                <td>
                                    {{ priceCurrencyFormatPlacing($order->order_amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                </td>
                                <td>{{ priceCurrencyFormatPlacing($order['total_tax'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</td>
                                <td>{{ $order->extra_discount ? priceCurrencyFormatPlacing($order->extra_discount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</td>
                                <td>{{ $order->coupon_discount_amount ? priceCurrencyFormatPlacing($order->coupon_discount_amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</td>
                                <td>{{ priceCurrencyFormatPlacing($order->order_amount + $order->total_tax - $order->extra_discount - $order->coupon_discount_amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position())}}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <div class="d-inline">
                                            <button class="btn btn-sm btn-white print-invoice" target="_blank" type="button"
                                                    data-id="{{$order->id}}"><i
                                                    class="tio-download"></i> {{\App\Utils\translate('invoice')}}
                                            </button>
                                        </div>
                                        <div class="d-inline ml-3">
                                            <a class="btn btn-white form-alert" href="javascript:"
                                            data-id="order-{{$order->id}}"
                                            style="height: 37px!important; display: flex; justify-content: center; align-items: center;"
                                            data-message="{{ \App\Utils\translate('Want to delete this order') }}?"><span class="tio-delete"></span></a>
                                            <form action="{{route('admin.pos.delete-order',[$order->id])}}"
                                                method="post" id="order-{{$order->id}}">
                                                @csrf @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            {!! $orders->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            @if(count($orders)==0)
                <div class="text-center p-4">
                    <img class="mb-3 img-one-ol" src="{{ asset('assets/admin/img/no-data.jpg') }}"
                         alt="Image Description">
                    <p class="mb-0">{{ \App\Utils\translate('No_data_to_show')}}</p>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="print-invoice" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal-content1">
                <div class="modal-header">
                    <h5 class="modal-title">{{\App\Utils\translate('print')}} {{\App\Utils\translate('invoice')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-dark" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <input type="button" class="mt-2 btn btn-primary non-printable print-div"
                                   data-name="printableArea"
                                   value="{{\App\Utils\translate('Proceed, If thermal printer is ready')}}."/>
                            <a href="{{url()->previous()}}"
                               class="mt-2 btn btn-danger non-printable">{{\App\Utils\translate('Back')}}</a>
                        </div>
                        <hr class="non-printable">
                    </div>
                    <div class="row m-auto" id="printableArea">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";
        $(".print-invoice").on('click', function(){
            let order_id = $(this).data('id');
            print_invoice(order_id);
        });

        function print_invoice(order_id) {
            $.get({
                url: '{{url('/')}}/admin/pos/invoice/' + order_id,
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#print-invoice').modal('show');
                    $('#printableArea').empty().html(data.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }
    </script>
    <script src={{asset("assets/admin/js/global.js")}}></script>
@endpush
