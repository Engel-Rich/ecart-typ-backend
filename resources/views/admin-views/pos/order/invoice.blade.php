<div class="width-inone">
    <div class="text-center mb-3">
        <h2 class="line-inone">
            {{ \App\Models\BusinessSetting::where(['key' => 'shop_name'])->first()->value }}
        </h2>
        <h5 class="style-inone">
            {{ \App\Models\BusinessSetting::where(['key' => 'shop_address'])->first()->value }}
        </h5>
        <h5 class="style-intwo">
            {{ \App\Utils\translate('Phone') }}
            : {{ \App\Models\BusinessSetting::where(['key' => 'shop_phone'])->first()->value }}
        </h5>
        <h5 class="style-intwo">
            {{ \App\Utils\translate('Email') }}
            : {{ \App\Models\BusinessSetting::where(['key' => 'shop_email'])->first()->value }}
        </h5>
        <h5 class="style-intwo">
            {{ \App\Utils\translate('Vat_registration_number') }}
            : {{ \App\Models\BusinessSetting::where(['key' => 'vat_reg_no'])->first()->value }}
        </h5>
    </div>

    <hr class="line-dot">

    <div class="mt-3 text-center">
        <h5>{{ \App\Utils\translate('order_ID') }} : {{ $order['id'] }}</h5>

        <h5 class="font-inone fz-10">
            {{ date('d/M/Y h:i a', strtotime($order['created_at'])) }}
        </h5>
    </div>
    <h5 class="text-uppercase"></h5>
    <hr class="line-dot">

    <table class="table mt-3">
        <thead>
            <tr>
                <th>{{ \App\Utils\translate('SL') }}</th>
                <th>{{ \App\Utils\translate('DESC') }}</th>
                <th>{{ \App\Utils\translate('QTY') }}</th>
                <th>{{ \App\Utils\translate('Price') }}</th>
            </tr>
        </thead>

        <tbody>
            @php($sub_total = 0)
            @php($total_tax = 0)
            @php($total_dis_on_pro = 0)
            @foreach ($order->details as $key => $detail)
                @if ($detail->product_details)
                    @php($product = json_decode($detail->product_details, true))
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            <span class="style-inthree">{{ $product['name'] }}</span><br />
                            {{ \App\Utils\translate('price') }} :
                            {{ priceCurrencyFormatPlacing($detail['price'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }} <br>
                            {{ \App\Utils\translate('discount') }} :
                            {{ priceCurrencyFormatPlacing($detail['discount_on_product'] * $detail['quantity'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                        </td>
                        <td class="">
                            {{ $detail['quantity'] }}
                        </td>
                        <td>
                            @php($amount = ($detail['price'] - $detail['discount_on_product']) * $detail['quantity'])
                            {{ priceCurrencyFormatPlacing($amount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                        </td>
                    </tr>
                    @php($sub_total += $amount)
                    @php($total_tax += $detail['tax_amount'] * $detail['quantity'])
                @endif
            @endforeach
        </tbody>
    </table>
    <hr class="line-dot">
    <dl class="row text-black-50">
        <dt class="col-7">{{ \App\Utils\translate('items_price') }}:</dt>
        <dd class="col-5 text-right">{{ priceCurrencyFormatPlacing($sub_total, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</dd>
        <dt class="col-7">{{ \App\Utils\translate('Tax_/_VAT') }}:</dt>
        <dd class="col-5 text-right">{{ priceCurrencyFormatPlacing($total_tax, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</dd>
        <dt class="col-7">{{ \App\Utils\translate('subtotal') }}:</dt>
        <dd class="col-5 text-right">{{ priceCurrencyFormatPlacing($sub_total + $total_tax, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</dd>
        <dt class="col-7">{{ \App\Utils\translate('extra_discount') }}:</dt>
        <dd class="col-5 text-right">
            {{ $order['extra_discount'] ? priceCurrencyFormatPlacing(number_format($order['extra_discount'], 2), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</dd>
        <dt class="col-7">{{ \App\Utils\translate('coupon_discount') }}:</dt>
        <dd class="col-5 text-right">
            {{ priceCurrencyFormatPlacing($order['coupon_discount_amount'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
        </dd>
        <dt class="col-7 total">{{ \App\Utils\translate('total') }}:</dt>
        <dd class="col-5 text-right total">
            {{ priceCurrencyFormatPlacing($sub_total + $total_tax  - ($order['coupon_discount_amount'] + $order['extra_discount']), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
        </dd>
    </dl>

    <div class="d-flex flex-wrap justify-content-between border-top pt-3">
        <div class="mr-1">
            {{ \App\Utils\translate('Paid_by') }}: {{ ($order->payment_id != 0) ? ($order->account ? $order->account->account : \App\Utils\translate('account_deleted')): 'Customer balance' }}
        </div>
        @if ($order->payment_id == 1)
            <div class="mr-1">{{ \App\Utils\translate('amount') }}:
                {{ $order->collected_cash ? priceCurrencyFormatPlacing($order->collected_cash, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) : priceCurrencyFormatPlacing(0, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
            </div>
            <div class="mr-1">{{ \App\Utils\translate('change') }} :
                {{ priceCurrencyFormatPlacing(number_format($order->collected_cash - $order->order_amount - $order->total_tax + $order->extra_discount + $order->coupon_discount_amount, 2), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
            </div>
        @endif
    </div>
    <hr class="line-dot">
    <h5 class="text-center">
        {{ \App\Utils\translate('THANK YOU') }}
    </h5>
    <hr class="line-dot">
</div>
