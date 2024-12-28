@extends('layouts.admin.app')

@section('title',\App\Utils\translate('Settings'))

@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{\App\Utils\translate('short_cut_key_list')}}</h3>
                    </div>
                    <div class="card-body">
                        <span>{{\App\Utils\translate('to_click_order')}} : {{\App\Utils\translate('alt')}} + {{\App\Utils\translate('O')}}</span><br>
                        <span>{{\App\Utils\translate('to_click_payment_submit')}} : {{\App\Utils\translate('alt')}} + {{\App\Utils\translate('S')}}</span><br>
                        <span>{{\App\Utils\translate('to_click_cancel_cart_item_all')}} : {{\App\Utils\translate('alt')}} + {{\App\Utils\translate('C')}}</span><br>
                        <span>{{\App\Utils\translate('to_click_add_new_customer')}} : {{\App\Utils\translate('alt')}} + {{\App\Utils\translate('A')}}</span> <br>
                        <span>{{\App\Utils\translate('to_click_add_new_customer_form')}} : {{\App\Utils\translate('alt')}} + {{\App\Utils\translate('N')}}</span><br>
                        <span>{{\App\Utils\translate('to_click_short_cut_keys')}} : {{\App\Utils\translate('alt')}} + {{\App\Utils\translate('K')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
