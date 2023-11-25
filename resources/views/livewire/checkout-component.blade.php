<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        @if(Cart::count() > 0)
        <section class="mt-50 mb-50">
            <div class="container">
                <form method="post" class="row" wire:submit.prevent="placeOrder">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <div class="form-group">
                            <input type="text" required="" name="firstname" placeholder="First name *" wire:model="firstname">
                            @error('firstname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" required="" name="lastname" placeholder="Last name *" wire:model="lastname">
                            @error('lastname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" required="" placeholder="Address *" wire:model="address">
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="city" placeholder="City / Town *" wire:model="city">
                            @error('city')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="province" placeholder="Province *" wire:model="province">
                            @error('province')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *" wire:model="zipcode">
                            @error('zipcode')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="email" placeholder="Email address *" wire:model="email">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Cart::content() as $product)
                                            <tr>
                                                <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/products') }}/{{ $product->model->id }}/{{ scandir(public_path('assets/imgs/products/' . $product->model->id))[2] }}" alt="{{ $product->model->name }}"></td>
                                                <td>
                                                    <h5><a href="{{ route('product.details', ['slug' => $product->model->slug]) }}">{{ $product->model->name }}</a></h5> <span class="product-qty">x {{ $product->qty }}</span>
                                                </td>
                                                <td>${{ $product->subtotal }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>Subtotal</th>
                                            <td class="product-subtotal" colspan="2">${{ Cart::subtotal() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td class="product-subtotal" colspan="2">${{ Cart::tax() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Free Shipping</em></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">${{ Cart::total() }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" value="cod" name="payment_type" id="exampleRadios3" wire:model="payment_type">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On Delivery</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" value="card" name="payment_type" id="exampleRadios4" wire:model="payment_type">
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                                    </div>
                                    @error('payment_type')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                @if($payment_type == 'card')
                                    <div class="mb-25">
                                        <h5>Card Details:</h5>
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="card_number" placeholder="Card Number" wire:model="card_number">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="exp_month" placeholder="Expiry Month" wire:model="exp_month">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="exp_year" placeholder="Expiry Year" wire:model="exp_year">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="password" name="CVC" placeholder="CVC" wire:model="CVC">
                                    </div>
                                @endif
                            </div>
                            @if(Session::has('stripe_error'))
                                <div class="alert alert-danger">
                                    <strong>Error | {{Session::get('stripe_error')}}</strong>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        @else
            <h4>No items in cart</h4>
            <p>Add items now!</p>
            <a href="{{ route('shop') }}" class="btn float-start">Shop Now</a>
        @endif
    </main>
</div>
