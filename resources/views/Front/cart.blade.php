<x-front-layout title="Cart">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            {{-- <h1 class="page-title">{{ $product->name }}</h1> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('front.products.index') }}"> Cart </a></li>
                            {{-- <li>{{ $product->name }}</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>
    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>

                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                <!-- Cart Single List list -->
                @foreach ($cart->get() as $items)
                    <div class="cart-single-list">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('products.show', $items->product->slug) }}"><img
                                        src="{{ $items->product->image }}" alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a href="product-details.html">
                                        {{ $items->product->name }}</a></h5>
                                <p class="product-des">
                                    <span><em>Type:</em> {{ $items->product->category->name }}</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input class="form-control" value="{{ $items->quantity }}">

                                    </input>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ $items->product->price * $items->quantity }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>$-{{ round(100 - (100 * $items->product->price) / $items->product->compare_price) }}%
                                </p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" href="{{ route('delete.cart.product', $items->product->id) }}"><i
                                        class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- End Single List list -->

            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply
                                                    Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart
                                            Subtotal<span>{{ $cart->total() }}</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You
                                            Save<span>{{ $cart->total() }}</span>
                                        </li>
                                        <li class="last">You
                                            Pay<span>$2531.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                        <a href="{{ route('home') }}" class="btn btn-alt">Continue
                                            shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->


</x-front-layout>
