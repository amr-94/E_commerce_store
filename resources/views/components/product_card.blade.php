 <!-- Start Single Product -->
 <div class="single-product">
     <div class="product-image">
         <img src="{{ asset("$product->image") }}" alt="#">
         @if ($product->compare_price)
             <span class="sale-tag">-{{ round(100 - (100 * $product->price) / $product->compare_price) }}%</span>
         @endif

         <div class="button">
             <a href="{{ route('front.products.show', $product->slug) }}" class="btn"><i class="lni lni-cart"></i>
                 Add to Cart</a>
         </div>
     </div>
     <div class="product-info">
         <span class="category">{{ $product->category->name }}</span>
         <h4 class="title">
             <a href="{{ route('front.products.show', $product->slug) }}">{{ $product->name }}</a>
         </h4>
         <ul class="review">
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star-filled"></i></li>
             <li><i class="lni lni-star"></i></li>
             <li><span>{{ $product->rating }}</span></li>
         </ul>
         <div class="price">
             <span>{{ $product->price }}</span>
             @if ($product->compare_price)
                 <span class="discount-price">{{ $product->compare_price }}</span>
             @endif

         </div>
     </div>
 </div>
 <!-- End Single Product -->
