<div id="{{ $product->id }}" class="">
    <input type="hidden" id="product_id" name="id" value="{{ $product->id }}">
    <input type="hidden" id="product_qty" name="quantity" value=1>
    <a data-id="{{ $product->id }}" class="pos-product-item card single-cart-data">
        <div class="pos-product-item_thumb">
            <img src="{{$product['image_fullpath']}}"
            class="img-fit">
        </div>
        <div class="pos-product-item_content">
            <div class="pos-product-item_title">{{ $product['name'] }}</div>
            <div class="pos-product-item_price">
                {{ priceCurrencyFormatPlacing(($product['selling_price'] - \App\Utils\Helpers::discount_calculate($product, $product['selling_price'])), \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}

                @if($product->discount > 0)
                    <span class="fz-10 text-muted text-decoration">
                        {{ priceCurrencyFormatPlacing($product['selling_price'], \App\Utils\Helpers::currency_symbol(), \App\Utils\Helpers::currency_position()) }}
                    </span><br>
                @endif
            </div>
        </div>
    </a>
</div>



