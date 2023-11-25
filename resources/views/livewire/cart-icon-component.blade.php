<div>
    <div class="header-action-icon-2">
        <a class="mini-cart-icon" href="{{ route('shop.cart') }}">
            <img alt="Best Pet Shop" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
            @if(Cart::count() > 0)
                <span class="pro-count blue">{{ Cart::count() }}</span>
            @endif
        </a>
        @if(Cart::count() > 0)
            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                <ul>
                    @foreach(Cart::content() as $product)
                        <li>
                            <div class="shopping-cart-img">
                                <a href="{{ route('product.details', ['slug' => $product->model->slug]) }}"><img alt="{{ $product->model->name }}" src="{{ asset('assets/imgs/products') }}/{{ $product->model->id }}/{{ scandir(public_path('assets/imgs/products/' . $product->model->id))[2] }}"></a>
                            </div>
                            <div class="shopping-cart-title">
                                <h4><a href="{{ route('product.details', ['slug' => $product->model->slug]) }}">{{ substr($product->model->name, 0, 20) }}...</a></h4>
                                <h4><span>{{ $product->qty }} × </span>${{ $product->model->price }}</h4>
                            </div>
                            <div class="shopping-cart-delete">
                                <a href="#" wire:click.prevent="removeItem('{{ $product->rowId }}')"><i class="fi-rs-cross-small"></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="shopping-cart-footer">
                    <div class="shopping-cart-total">
                        <h4>Total <span>{{ Cart::total() }}</span></h4>
                    </div>
                    <div class="shopping-cart-button">
                        <a href="{{ route('shop.cart') }}" class="outline">View cart</a>
                        <a href="{{ route('shop.checkout') }}">Checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
