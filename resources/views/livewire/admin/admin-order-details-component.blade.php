<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Home</a>
                    <span></span> Order Details
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Order Items
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.orders') }}" class="btn btn-success float-end">All Orders</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Img</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><img src="{{ asset('assets/imgs/products') }}/{{ $item->product->id }}/{{ scandir(public_path('assets/imgs/products/' . $item->product->id))[2] }}" alt="{{ $item->product->name }}" width="60"></td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>${{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td class="cart_total_label">Cart Subtotal</td>
                                            <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ $order->subtotal }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Tax</td>
                                            <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ $order->tax }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Shipping</td>
                                            <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free Shipping</td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Total</td>
                                            <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">${{ $order->total }}</span></strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Shipment Details
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 mt-3">
                                    <label for="firstname" class="form-label">Firstname</label>
                                    <input type="text" class="form-control" name="firstname" value="{{ $order->firstname }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="lastname" class="form-label">Lastname</label>
                                    <input type="text" class="form-control" name="lastname" value="{{ $order->lastname }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ $order->email }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" class="form-control" name="province" value="{{ $order->province }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="column2" class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" value="{{ $order->city }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="zipcode" class="form-label">Zipcode</label>
                                    <input type="text" class="form-control" name="zipcode" value="{{ $order->zipcode }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ $order->address }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Transaction Details
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 mt-3">
                                    <label for="type" class="form-label">Type</label>
                                    <input type="text" class="form-control" name="type" value="{{ $order->transaction->type }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" name="status" value="{{ $order->transaction->status }}" disabled>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="updated_at" class="form-label">Transaction Date Time</label>
                                    <input type="text" class="form-control" name="updated_at" value="{{ $order->transaction->updated_at }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
