<section class="premium-weekly-section"
    style="background-image: url('{{ asset('assets/images/thumbs/selling-product-bg.jpg') }}');">
    <div class="container container-two">
        <div class="row justify-content-between align-items-center">

            <div class="col-xl-5">
                <div class="premium-weekly-content">
                    <h3 class="premium-weekly-title">{{ $monthlyPickedSection->title ?? __('Monthly Picked Products') }}
                    </h3>
                    <p class="premium-weekly-desc">{{ $monthlyPickedSection->content ?? '' }}</p>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="selling-product-slider">

                    @forelse ($monthlyPickedProducts as $product)
                        <div class="premium-weekly-card">
                            <div class="pwc-thumb">
                                <a href="{{ route('product.details', $product->slug ?? $product->id) }}" class="w-100">
                                    <img src="{{ asset($product->preview_image ?? 'assets/images/placeholder.png') }}"
                                        alt="{{ $product->name }}">
                                </a>
                            </div>

                            <div class="pwc-meta">
                                <ul class="pwc-stars">
                                    @php
                                        $rating = round($product->reviews_avg_stars ?? 0);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <li><i class="fas fa-star"></i></li>
                                        @else
                                            <li><i class="far fa-star"></i></li>
                                        @endif
                                    @endfor
                                    <span class="pwc-stars-text">({{ $product->reviews_count ?? 0 }})</span>
                                </ul>
                                <span class="pwc-sales"><i class="ti ti-download"></i>
                                    {{ $product->sales_count ?? 0 }}</span>
                            </div>

                            <h6 class="pwc-title">
                                <a
                                    href="{{ route('product.details', $product->slug ?? $product->id) }}">{{ $product->name }}</a>
                            </h6>

                            <div class="pwc-info">
                                <span class="pwc-author">{{ __('by') }} <a
                                        href="#">{{ $product->author->name ?? 'Admin' }}</a></span>
                                <div>
                                    @if (!empty($product->discount_price) && $product->discount_price < $product->price)
                                        <span class="pwc-price-old">${{ number_format($product->price, 2) }}</span>
                                        <h6 class="pwc-price-new">${{ number_format($product->discount_price, 2) }}
                                        </h6>
                                    @else
                                        <h6 class="pwc-price-new">${{ number_format($product->price, 2) }}</h6>
                                    @endif
                                </div>
                            </div>

                            <div class="pwc-footer">
                                <a href="#" class="ph-cart-btn"><i class="ti ti-shopping-cart-plus"></i></a>
                                <a href="{{ $product->demo_link ?? '#' }}" target="_blank"
                                    class="ph-demo-btn">{{ __('Live Demo') }}</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-white mt-4">
                            <p>{{ __('No monthly picked products available at the moment.') }}</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>
