<x-front-layout>
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Serachig page Product</h2>

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

</x-front-layout>
