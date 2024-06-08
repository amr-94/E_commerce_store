<x-front-layout>
    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            <!-- Start Single Slider -->
                            @foreach ($products as $product)
                                <div class="single-slider" style="background-image: url({{ asset($product->image) }});">
                                    <div class="content">
                                        <h2><span>{{ $product->name }} (${{ $product->compare_price - $product->price }}
                                                savings)</span>
                                            {{ $product->name }}
                                        </h2>
                                        <p>{{ $product->description }}</p>
                                        <h3><span>Now Only</span> $320.99</h3>
                                        <div class="button">
                                            <a href="{{ route('front.products.show', $product->slug) }}"
                                                class="btn">Shop
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- End Single Slider -->

                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        @php
                            // $newproducts = App\Models\Product::where('status', 'active')
                            //     ->orderBy('created_at', 'desc')
                            //     ->take(1)
                            //     ->get();
                        @endphp
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                                <!-- Start Small Banner -->
                                <div class="hero-small-banner"
                                    style="background-image: url({{ asset($products[0]->image) }});">
                                    <div class="content">
                                        <h2>
                                            <span>New Product</span>
                                            {{ $products[0]->name }}
                                        </h2>
                                        <h3>{{ $products[0]->price }}</h3>
                                    </div>
                                </div>
                                <!-- End Small Banner -->
                            </div>
                            <div class="col-lg-12 col-md-6 col-12">
                                <!-- Start Small Banner -->
                                <div class="hero-small-banner style2">
                                    <div class="content">
                                        <h2>Weekly Sale!</h2>
                                        <p>Saving up to 50% off all online store
                                            items this week.</p>
                                        <div class="button">
                                            <a class="btn" href="product-grids.html">Shop
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start Small Banner -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Featured Categories Area -->

    <!-- End Features Area -->

    <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Product</h2>
                        <p>There are many variations of passages of Lorem
                            Ipsum available, but the majority have
                            suffere'd alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <x-product_card :product="$product" />
                        <!-- End Single Product -->
                    </div>
                @endforeach




            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->

    <!-- Start Banner Area -->
    <section class="banner section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner" style="background-image:url('https://via.placeholder.com/620x340')">
                        <div class="content">
                            <h2>Smart Watch 2.0</h2>
                            <p>Space Gray Aluminum Case with <br>Black/Volt
                                Real Sport Band </p>
                            <div class="button">
                                <a href="product-grids.html" class="btn">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner custom-responsive-margin"
                        style="background-image:url('https://via.placeholder.com/620x340')">
                        <div class="content">
                            <h2>Smart Headphone</h2>
                            <p>Lorem ipsum dolor sit amet, <br>eiusmod
                                tempor
                                incididunt ut labore.</p>
                            <div class="button">
                                <a href="product-grids.html" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Special Offer -->
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Special Offer</h2>
                        <p>There are many variations of passages of Lorem
                            Ipsum available, but the majority have
                            suffere'd alteration in some form.</p>
                    </div>
                </div>
            </div>
            @php
                $offerproduct = App\Models\Product::whereRaw('100 - (100 * price) / compare_price > ?', 50)
                    ->where('status', 'active') //  additional condition
                    ->orderBy('created_at', 'desc') //  ordering
                    ->take(3)
                    ->get();

            @endphp
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row">
                        @foreach ($offerproduct as $product)
                            <div class="col-lg-4 col-md-4 col-12">
                                <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-image">
                                        <img src="{{ asset($product->image) }}" alt="#">
                                        <div class="button">
                                            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i>
                                                Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <span class="category">{{ $product->category->name }}</span>
                                        <h4 class="title">
                                            <a
                                                href="{{ route('front.products.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h4>
                                        <ul class="review">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><span>{{ $product->rating }}</span></li>
                                        </ul>
                                        <div class="price">
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                            </div>
                        @endforeach


                    </div>
                    <!-- Start Banner -->
                    <div class="single-banner right"
                        style="background-image:url('https://via.placeholder.com/730x310');margin-top: 30px;">
                        <div class="content">
                            <h2>Samsung Notebook 9 </h2>
                            <p>Lorem ipsum dolor sit amet, <br>eiusmod
                                tempor
                                incididunt ut labore.</p>
                            <div class="price">
                                <span>$590.00</span>
                            </div>
                            <div class="button">
                                <a href="product-grids.html" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner -->
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <div class="offer-content">
                        <div class="image">
                            <img src="{{ asset($offerproduct[0]->image) }}" alt="#">
                            <span class="sale-tag">-50%</span>
                        </div>

                        <div class="text">
                            <h2><a
                                    href="{{ route('front.products.show', $offerproduct[0]->slug) }}">{{ $offerproduct[0]->name }}</a>
                            </h2>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>{{ $offerproduct[0]->rating }}</span></li>
                            </ul>
                            <div class="price">
                                <span>${{ $offerproduct[0]->price }}</span>
                                <span class="discount-price">${{ $offerproduct[0]->compare_price }}</span>
                                <span class="discount-price"> diss
                                    {{ round(100 - (100 * $offerproduct[0]->price) / $offerproduct[0]->compare_price) }}%</span>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the
                                printing and typesetting industry incididunt
                                ut
                                eiusmod tempor labores.</p>
                        </div>
                        <div class="box-head">
                            <div class="box">
                                <h1 id="days">000</h1>
                                <h2 id="daystxt">Days</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">00</h1>
                                <h2 id="hourstxt">Hours</h2>
                            </div>
                            <div class="box">
                                <h1 id="minutes">00</h1>
                                <h2 id="minutestxt">Minutes</h2>
                            </div>
                            <div class="box">
                                <h1 id="seconds">00</h1>
                                <h2 id="secondstxt">Secondes</h2>
                            </div>
                        </div>
                        <div style="background: rgb(204, 24, 24);" class="alert">
                            <h1 style="padding: 50px 80px;color: white;">We
                                are sorry, Event ended ! </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Special Offer -->

    <!-- Start Home Product List -->
    <section class="home-product-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">Best Sellers</h4>
                    <!-- Start Single List -->
                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img
                                    src="{{ asset('https://via.placeholder.com/100x100"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ') }}  alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">GoPro Hero4
                                    Silver</a>
                            </h3>
                            <span>$287.99</span>
                        </div>
                    </div>
                    <!-- End Single List -->

                </div>
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    {{-- @php
                        $newarrivals = App\Models\Product::where('status', 'active')
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
                    @endphp --}}
                    <h4 class="list-title">New Arrivals</h4>
                    <!-- Start Single List -->
                    @foreach ($products->take(3) as $newproduct)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('front.products.show', $newproduct->slug) }}"><img
                                        src="{{ $newproduct->image }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a
                                        href="{{ route('front.products.show', $newproduct->slug) }}">{{ $newproduct->name }}</a>
                                </h3>
                                <span>{{ $newproduct->price }}</span>
                            </div>
                        </div>
                    @endforeach

                    <!-- End Single List -->

                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="list-title">Top Rated</h4>
                    @php
                        $toprated = App\Models\Product::where('status', 'active')
                            ->orderBy('rating', 'desc')
                            ->take(3)
                            ->get();
                    @endphp
                    <!-- Start Single List -->
                    @foreach ($toprated as $topproduct)
                        <div class="single-list">
                            <div class="list-image">
                                <a href="{{ route('front.products.show', $topproduct->slug) }}"><img
                                        src="{{ $topproduct->image }}" alt="#"></a>
                            </div>
                            <div class="list-info">
                                <h3>
                                    <a
                                        href="{{ route('front.products.show', $topproduct->slug) }}">{{ $topproduct->name }}</a>
                                </h3>
                                <span>{{ $topproduct->price }}</span>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Single List -->

                </div>
            </div>
        </div>
    </section>
    <!-- End Home Product List -->

    <!-- Start Brands Area -->
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <h2 class="title">Popular Brands</h2>
                </div>
            </div>
            <div class="brands-logo-wrapper">
                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">
                    @php
                        $Stores = App\Models\Store::take(10)->get();
                    @endphp
                    @foreach ($Stores as $store)
                        <div class="brand-logo">
                            <p>{{ $store->name }}</p>
                            <a href="{{ route('stores.show', $store->slug) }}">
                                <img src="{{ asset("store/$store->cover_image") }}" alt="#">
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End Brands Area -->

    <!-- Start Blog Section Area -->

    <!-- End Blog Section Area -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->

    @push('scripts')
        <script type="text/javascript">
            //========= Hero Slider
            tns({
                container: '.hero-slider',
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 0,
                items: 1,
                nav: false,
                controls: true,
                controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            });

            //======== Brand Slider
            tns({
                container: '.brands-logo-carousel',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 15,
                nav: false,
                controls: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    540: {
                        items: 3,
                    },
                    768: {
                        items: 5,
                    },
                    992: {
                        items: 6,
                    }
                }
            });
        </script>
    @endpush
</x-front-layout>
