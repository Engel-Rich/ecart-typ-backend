@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/custom.css" />
@endpush
<div class="card-body pt-0">
    <div class="table-responsive pos-cart-table border">
        <table class="table table-align-middle mb-0">
            <thead class="text-muted">
            <tr>
                <th>{{ \App\Utils\translate('item') }}</th>
                <th>{{ \App\Utils\translate('qty') }}</th>
                <th>{{ \App\Utils\translate('price') }}</th>
                <th>{{ \App\Utils\translate('delete') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subtotal = 0;
            $tax = 0;
            $ext_discount = 0;
            $ext_discount_type = 'amount';
            $discount_on_product = 0;
            $product_tax = 0;
            $coupon_discount = 0;
            ?>

            @if (session()->has($cartId) && count(session($cartId)) > 0)
                    <?php
                    $cart = session()->get($cartId);
                    if (isset($cart['tax'])) {
                        $tax = $cart['tax'];
                    }
                    if (isset($cart['ext_discount'])) {
                        $ext_discount = $cart['ext_discount'];
                        $ext_discount_type = $cart['ext_discount_type'];
                    }
                    if (isset($cart['coupon_discount'])) {
                        $coupon_discount = $cart['coupon_discount'];
                    }
                    ?>
                @foreach (session($cartId) as $key => $cartItem)
                    @if (is_array($cartItem))
                            <?php
                            $product_subtotal = $cartItem['price'] * $cartItem['quantity'];
                            $discount_on_product += $cartItem['discount'] * $cartItem['quantity'];
                            $subtotal += $product_subtotal;
                            $product_tax += $cartItem['tax'] * $cartItem['quantity'];

                            ?>
                        <tr>
                            <td class="media gap-2 align-items-center">
                                <img class="avatar avatar-sm"
                                     src="{{onErrorImage($cartItem['image'],asset('storage/product').'/' . $cartItem['image'],asset('assets/admin/img/ecartify.png') ,'product/')}}"
                                     alt="{{ $cartItem['name'] }} {{\App\Utils\translate('image')}}">
                                <div class="media-body">
                                    <h5 class="text-hover-primary mb-0">{{ Str::limit($cartItem['name'], 10) }}</h5>
                                </div>
                            </td>
                            <td>
                                <input type="number" data-key="{{ $key }}" class="form-control text-center qty-width"
                                       value="{{ $cartItem['quantity'] }}" min="1"
                                       onkeyup="updateQuantity('{{ $cartItem['id'] }}',this.value)">
                            </td>
                            <td>
                                <div>
                                    {{ priceCurrencyFormatPlacing($product_subtotal, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                                </div>
                            </td>
                            <td>
                                <a href="javascript:removeFromCart({{ $cartItem['id'] }})"
                                   class="btn btn-sm btn-outline-danger square-btn"> <i class="tio-delete"></i></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
@php
    $total = $subtotal - $discount_on_product;
    $discount_amount = $ext_discount_type == 'percent' && $ext_discount > 0 ? ($subtotal * $ext_discount) / 100 : $ext_discount;
    $total -= $discount_amount;
    $total_tax_amount = $product_tax;
@endphp
<div class="box p-3">
    <dl class="row">
        <dt class="col-6">{{ \App\Utils\translate('sub_total') }} :</dt>
        <dd class="col-6 text-right">{{ priceCurrencyFormatPlacing($subtotal, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</dd>

        <dt class="col-6">{{ \App\Utils\translate('product_discount') }} :</dt>
        <dd class="col-6 text-right">{{ priceCurrencyFormatPlacing($discount_on_product, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</dd>

        <dt class="col-6">{{ \App\Utils\translate('extra_discount') }} :</dt>
        <dd class="col-6 text-right">
            <button id="extra_discount" class="btn btn-sm" type="button" data-toggle="modal"
                    data-target="#add-discount"><i
                    class="tio-edit"></i></button>
                    {{ priceCurrencyFormatPlacing(number_format($discount_amount, 2), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
        </dd>
        <dt class="col-6">{{ \App\Utils\translate('coupon_discount') }} :</dt>
        <dd class="col-6 text-right">
            <button id="coupon_discount" class="btn btn-sm" type="button" data-toggle="modal"
                    data-target="#add-coupon-discount"><i
                    class="tio-edit"></i></button>
                    {{ priceCurrencyFormatPlacing($coupon_discount, \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
        </dd>

        <dt class="col-6">{{ \App\Utils\translate('tax') }} :</dt>
        <dd class="col-6 text-right">
            {{ priceCurrencyFormatPlacing(round($total_tax_amount, 2), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
        </dd>
        <dt class="col-6">{{ \App\Utils\translate('total') }} :</dt>
        <dd class="col-6 text-right h4 b">
            <span id="total_price" class="d-none">{{ round($total + $total_tax_amount - $coupon_discount, 2) }}</span>
            <span>{{ priceCurrencyFormatPlacing(round($total + $total_tax_amount - $coupon_discount, 2), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}</span>
        </dd>
    </dl>
    <div class="row g-2">
        <div class="col-6 mt-2">
            <button type="button" class="btn btn-danger btn-block empty-cart">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="14" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" fill-rule="evenodd" class=""><g><path fill="#ffffff" fill-rule="nonzero" d="M60.5 3.5c2 2 2 5.1 0 7L39.3 31.8l21.2 21.7c2 2 2 5.1 0 7-2 2-5.1 2-7 0L32.2 38.8 10.5 60.5c-2 2-5.1 2-7 0-2-2-2-5.1 0-7l21.7-21.7L3.5 10.5c-2-2-2-5.1 0-7 2-2 5.1-2 7 0l21.7 21.3L53.5 3.5c1.9-1.9 5-1.9 7 0z" opacity="1" data-original="#fb4455"></path><path fill="#ffffff" fill-rule="nonzero" d="M60.5 3.5c2 2 2 5.1 0 7L39.3 31.8l21.2 21.7c.952.953 1.451 2.155 1.496 3.358A4.747 4.747 0 0 1 60.5 60.5c-2 2-5.1 2-7 0L32.2 38.8 10.5 60.5c-2 2-5.1 2-7 0-1.074-1.074-1.572-2.465-1.492-3.818A4.752 4.752 0 0 1 3.5 53.5c9.144 2.068 40.217-31.799 57-50z" opacity="1" data-original="#da4455" class=""></path></g></svg>
                {{ \App\Utils\translate('Cancel_Order') }}
            </button>
        </div>
        <div class="col-6 mt-2">
            <button type="button" class="btn btn-success btn-block submit-order">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><defs><clipPath id="a" clipPathUnits="userSpaceOnUse"><path d="M0 512h512V0H0Z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></clipPath></defs><g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="m0 0-141.421-367.695a39.87 39.87 0 0 0-9.051-13.902c-15.621-15.621-40.947-15.621-56.569 0A39.81 39.81 0 0 0-217.39-363.7l-35.869 133.912a39.812 39.812 0 0 1-10.35 17.897 39.806 39.806 0 0 1-17.896 10.349l-133.913 35.87a39.801 39.801 0 0 0-17.896 10.349c-15.622 15.621-15.622 40.948 0 56.569a39.84 39.84 0 0 0 13.901 9.05L-51.718 51.718c14.303 5.502 31.132 2.485 42.668-9.051C2.485 31.132 5.502 14.303 0 0Z" style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(489.325 437.607)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="m0 0-84.853-84.853" style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(104.853 104.853)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="m0 0-56.568-56.568" style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(189.706 76.568)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="m0 0-56.568-56.568" style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(76.568 189.706)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="m0 0-84.853-84.853" style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(367.137 367.137)" fill="none" stroke="#ffffff" stroke-width="40" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path></g></g></svg>
                {{ \App\Utils\translate('Place_Order') }}
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="add-customer" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ \App\Utils\translate('add_new_customer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.customer.store') }}" method="post" id="product_form">
                    @csrf
                    <input type="hidden" class="form-control" name="balance" value=0>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{ \App\Utils\translate('customer_name') }} <span
                                        class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                       placeholder="{{ \App\Utils\translate('customer_name') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{ \App\Utils\translate('mobile_no') }} <span
                                        class="input-label-secondary text-danger">*</span></label>
                                <input type="tel" id="mobile" name="mobile" class="form-control"
                                       value="{{ old('mobile') }}"
                                       pattern="[+0-9]+"
                                       title="Please enter a valid phone number with only numbers and the plus sign (+)"
                                       placeholder="{{ \App\Utils\translate('mobile_no') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{ \App\Utils\translate('email') }}</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email') }}"
                                       placeholder="{{ \App\Utils\translate('Ex_:_ex@example.com') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{ \App\Utils\translate('state') }}</label>
                                <input type="text" name="state" class="form-control"
                                       value="{{ old('state') }}" placeholder="{{ \App\Utils\translate('state') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{ \App\Utils\translate('city') }} </label>
                                <input type="text" name="city" class="form-control"
                                       value="{{ old('city') }}" placeholder="{{ \App\Utils\translate('city') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{ \App\Utils\translate('zip_code') }} </label>
                                <input type="text" name="zip_code" class="form-control"
                                       value="{{ old('zip_code') }}"
                                       placeholder="{{ \App\Utils\translate('zip_code') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{ \App\Utils\translate('address') }} </label>
                                <input type="text" name="address" class="form-control"
                                       value="{{ old('address') }}"
                                       placeholder="{{ \App\Utils\translate('address') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" id="submit_new_customer"
                                class="btn btn-primary">{{ \App\Utils\translate('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-discount" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ \App\Utils\translate('extra_discount') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">{{ \App\Utils\translate('discount') }}</label>
                        <input type="number" id="dis_amount" class="form-control" name="discount" step="0.01" min="0">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">{{ \App\Utils\translate('type') }}</label>
                        <select name="type" id="type_ext_dis" class="form-control type_ext_dis">
                            <option value="amount" {{ $ext_discount_type == 'amount' ? 'selected' : '' }}>
                                {{ \App\Utils\translate('amount') }}
                                ({{ \App\Utils\Helpers::currency_symbol() }})
                            </option>
                            <option value="percent" {{ $ext_discount_type == 'percent' ? 'selected' : '' }}>
                                {{ \App\Utils\translate('percent') }}
                                (%)
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-primary extra-discount"
                            type="submit">{{ \App\Utils\translate('submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-coupon-discount" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ \App\Utils\translate('coupon_discount') }}</h5>
                <button id="coupon_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">{{ \App\Utils\translate('coupon_code') }}</label>
                    <input type="text" id="coupon_code" class="form-control" name="coupon_code">
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-primary coupon-discount" type="submit">{{ \App\Utils\translate('submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-tax" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ \App\Utils\translate('update_tax') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.pos.tax') }}" method="POST" class="row">
                    @csrf
                    <div class="form-group col-12">
                        <label for="">{{ \App\Utils\translate('tax') }} (%)</label>
                        <input type="number" class="form-control" name="tax" min="0">
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

<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ \App\Utils\translate('payment') }} </h5>
                <button id="payment_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span class="style-three-cart">{{ \App\Utils\translate('total') }}</span>
                <h4 class="mb-0" id="total_balance"><span class="style-four-cart"> = </span>
                    {{ priceCurrencyFormatPlacing(round($total + $total_tax_amount - $coupon_discount, 2), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                </h4>
            </div>
            @php
                $accounts = \App\Models\Account::orderBy('id')->get();
            @endphp
            <div class="modal-body">
                <form action="{{ route('admin.pos.order') }}" id='order_place' method="post">
                    @csrf
                    <div class="form-group">
                        <label class="input-label" for="">{{ \App\Utils\translate('type') }}</label>
                        <select class="payment-opp form-control" name="type" id="payment_opp"
                                class="form-control select2" required>
                            @foreach ($accounts as $account)
                                @if ($account['id'] != 2 && $account['id'] != 3)
                                    <option value="{{ $account['id'] }}">{{ $account['account'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-none" id="balance">
                        <label class="input-label" for="">{{ \App\Utils\translate('customer_balance') }}
                            ({{ \App\Utils\Helpers::currency_symbol() }})</label>
                        <input type="number" id="balance_customer" class="form-control" name="customer_balance"
                               disabled>
                    </div>
                    <div class="form-group d-none" id="remaining_balance">
                        <label class="input-label" for="">{{ \App\Utils\translate('remaining_balance') }}
                            ({{ \App\Utils\Helpers::currency_symbol() }})</label>
                        <input type="number" id="balance_remain" class="form-control" name="remaining_balance"
                               value="" readonly>
                    </div>
                    <div class="form-group d-none" id="transaction_ref">
                        <label class="input-label" for="">{{ \App\Utils\translate('transaction_reference') }}
                            ({{ \App\Utils\Helpers::currency_symbol() }})
                            -({{ \App\Utils\translate('optional') }})</label>
                        <input type="text" id="tran_ref" class="form-control" name="transaction_reference">
                    </div>
                    <div class="form-group" id="collected_cash">
                        <label class="input-label" for="">{{ \App\Utils\translate('collected_cash') }}
                            ({{ \App\Utils\Helpers::currency_symbol() }})</label>
                        <input type="number" id="cash_amount" onkeyup="price_calculation();" class="form-control"
                               name="collected_cash" step="0.01">
                    </div>
                    <div class="form-group" id="returned_amount">
                        <label class="input-label" for="">{{ \App\Utils\translate('returned_amount') }}
                            ({{ \App\Utils\Helpers::currency_symbol() }})</label>
                        <input type="number" id="returned" class="form-control" name="returned_amount"
                               value="" readonly>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm btn-primary" id="order_complete"
                                type="submit">{{ \App\Utils\translate('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="short-cut-keys" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ \App\Utils\translate('short_cut_keys') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>{{ \App\Utils\translate('to_click_order') }} : alt + O</span><br>
                <span>{{ \App\Utils\translate('to_click_payment_submit') }} : alt + S</span><br>
                <span>{{ \App\Utils\translate('to_close_payment_submit') }} : alt + Z</span><br>
                <span>{{ \App\Utils\translate('to_click_cancel_cart_item_all') }} : alt + C</span><br>
                <span>{{ \App\Utils\translate('to_click_add_new_customer') }} : alt + A</span> <br>
                <span>{{ \App\Utils\translate('to_submit_add_new_customer_form') }} : alt + N</span><br>
                <span>{{ \App\Utils\translate('to_click_short_cut_keys') }} : alt + K</span><br>
                <span>{{ \App\Utils\translate('to_print_invoice') }} : alt + P</span> <br>
                <span>{{ \App\Utils\translate('to_cancel_invoice') }} : alt + B</span> <br>
                <span>{{ \App\Utils\translate('to_focus_search_input') }} : alt + Q</span> <br>
                <span>{{ \App\Utils\translate('to_click_extra_discount') }} : alt + E</span> <br>
                <span>{{ \App\Utils\translate('to_click_coupon_discount') }} : alt + D</span> <br>
            </div>
        </div>
    </div>
</div>
<script>
    "use strict";
    $(document).ready(function() {

        $(".empty-cart").on('click', function(){
            emptyCart();
        });

        $(".submit-order").on('click', function(){
            submit_order();
        });

        $(".coupon-discount").on('click', function(){
            coupon_discount();
        });

        $(".extra-discount").on('click', function(){
            extra_discount();
        });

        $('.type_ext_dis').on('change', function() {
            limit(this);
        });

        $('.payment-opp').on('change', function() {
            payment_option(this);
        });

    });
</script>
