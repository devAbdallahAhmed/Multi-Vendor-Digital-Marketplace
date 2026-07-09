   <div class="col-lg-6 col-xl-4 col-sm-6">
       <div class="product-item ">
           <div class="product-item__thumb d-flex">
               <a href="{{ route('product.details', $item->slug) }}" class="link w-100">
                   @if ($item->preview_type == 'image')
                       <img src="{{ asset($item->main_file) }}" alt="" class="cover-img">
                   @elseif ($item->preview_type === 'video')
                       <video class="player" playsinline loop muted>
                           <source src="{{ asset($item->main_file) }}" type="video/mp4" />
                       </video>
                   @elseif ($item->preview_type === 'audio')
                       <audio class="audio-player" controls>
                           <source src="{{ asset(asset($item->main_file)) }}" type="audio/mp3" />
                       </audio>
                   @endif
           </div>
           <div class="product-item__content">
               <div class="product-item__bottom flx-between gap-2">
                   <div class="d-flex flex-wrap justify-content-between align-items-center w-100">

                       <div class="d-flex align-items-center gap-1">
                           <ul class="star-rating">
                               <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                               <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                               <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                               <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                               <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                           </ul>
                           <span class="star-rating__text text-heading fw-500 font-14">
                               (4502)
                           </span>
                       </div>
                       <span class="product-item__sales font-14"><i class="ti ti-download"></i>
                           9875</span>

                   </div>
               </div>

               <h6 class="product-item__title">
                   <a href="product-details.html" class="link">{{ $item->name }}</a>
               </h6>
               <div class="product-item__info flx-between gap-2">
                   <span class="product-item__author">
                       {{ __('by') }}
                       <a href="profile.html" class="link hover-text-decoration-underline">
                           {{ $item->author->name }}</a>
                   </span>
                   <div class="flx-align gap-2">
                       @if ($item->discount_price > 0)
                           <h6 class="product-item__price mb-0">
                               ${{ $item->discount_price }}</h6>
                           <span class="product-item__prevPrice text-decoration-line-through">{{ $item->price }}</span>
                       @else
                           <span class="product-item__prevPrice text-decoration-line-through">{{ $item->price }}</span>
                       @endif

                   </div>
               </div>
               <div class="product_item_footer">
                   <a class="product_cart add-cart" data-id="{{ $item->id }}" href="javascript:;">
                       <i class="ti ti-shopping-cart-plus"></i> Add To Cart
                   </a>
               </div>
           </div>
       </div>
   </div>
