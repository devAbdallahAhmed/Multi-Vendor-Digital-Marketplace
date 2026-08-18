<section class="ph-wrapper">
    <div class="container container-two">
        <div class="row justify-content-evenly">

            <div class="col-xl-5">
                <div class="ph-text-content">
                    <h3 class="ph-title">{{ $highlightedSection->title ?? '' }} <span>Products</span></h3>
                    <p class="ph-desc">{{ $highlightedSection->subtitle ?? '' }}</p>
                    <a href="{{ route('highlighted-products') }}" class="ph-btn-main">{{ __('View All Items') }}</a>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="row gy-4">

                    @forelse ($highlightedProducts as $product)
                        <div class="col-sm-6 col-lg-6">
                            <div class="ph-card">
                                <div class="ph-thumb">
                                    <a href="{{ route('product.details', $product->slug ?? $product->id) }}">
                                        <img src="{{ asset($product->preview_image ?? 'assets/images/placeholder.png') }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="ph-body">
                                    <div class="ph-meta">
                                        <div class="ph-stars">
                                            @php
                                                $rating = round($product->reviews_avg_stars ?? 0);
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="ph-stars-count">({{ $product->reviews_count ?? 0 }})</span>
                                        </div>
                                        <span class="ph-sales"><i class="ti ti-download"></i>
                                            {{ $product->sales_count ?? 0 }}</span>
                                    </div>
                                    <h6 class="ph-card-title">
                                        <a
                                            href="{{ route('product.details', $product->slug ?? $product->id) }}">{{ $product->name }}</a>
                                    </h6>
                                    <div class="ph-info">
                                        <span class="ph-author">{{ __('by') }} <a
                                                href="#">{{ $product->author->name ?? 'Admin' }}</a></span>
                                        <div class="ph-price-box">
                                            @if (!empty($product->discount_price) && $product->discount_price < $product->price)
                                                <span
                                                    class="ph-price-old">${{ number_format($product->price, 2) }}</span>
                                                <h6 class="ph-price-new">
                                                    ${{ number_format($product->discount_price, 2) }}</h6>
                                            @else
                                                <h6 class="ph-price-new">${{ number_format($product->price, 2) }}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product_item_footer">
                                        <a class="product_cart add-cart" data-id="{{ $product->id }}"
                                            href="javascript:void(0);">
                                            <i class="ti ti-shopping-cart-plus"></i> {{ __('Add To Cart') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted mt-4">{{ __('No highlighted products available at the moment.') }}</p>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</section>
