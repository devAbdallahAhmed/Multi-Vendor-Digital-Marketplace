<section class="premium-products position-relative z-index-1 py-5">
    <div class="container container-two">

        <h3 class="premium-heading mb-4">{{ __('Recently Arrived New Items') }}</h3>

        <!-- Tab Navigation (Category Names) -->
        <ul class="nav nav-pills premium-nav-pills mb-4" id="pills-tab" role="tablist">
            @foreach ($featuredItems as $categoryName => $items)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                        id="pills-{{ Str::slug($categoryName) }}-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-{{ Str::slug($categoryName) }}" type="button" role="tab"
                        aria-controls="pills-{{ Str::slug($categoryName) }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $categoryName }}
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- Tab Content (Products) -->
        <div class="tab-content" id="pills-tabContent">
            @foreach ($featuredItems as $categoryName => $items)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                    id="pills-{{ Str::slug($categoryName) }}" role="tabpanel"
                    aria-labelledby="pills-{{ Str::slug($categoryName) }}-tab" tabindex="0">

                    <div class="row gy-4">
                        @forelse($items as $item)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="premium-card h-100 shadow-sm rounded-3 overflow-hidden">
                                    <div class="product-item__thumb d-flex">
                                        <a href="{{ route('product.details', $item->slug) }}" class="link w-100">
                                            @if ($item->preview_type == 'image')
                                                <img src="{{ asset($item->preview_image ?? $item->main_file) }}"
                                                    alt="" class="product-img">
                                            @elseif ($item->preview_type === 'video')
                                                <video class="player" playsinline loop muted>
                                                    <source src="{{ asset($item->preview_video ?? $item->main_file) }}"
                                                        type="video/mp4" />
                                                </video>
                                            @elseif ($item->preview_type === 'audio')
                                                <audio class="audio-player" controls>
                                                    <source src="{{ asset($item->preview_audio ?? $item->main_file) }}"
                                                        type="audio/mp3" />
                                                </audio>
                                            @endif
                                        </a>
                                    </div>

                                    <div class="premium-card-body p-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <ul class="star-rating">
                                                @php
                                                    $avgRating = round($item->reviews_avg_stars ?? 0);
                                                @endphp

                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avgRating)
                                                        <li class="star-rating__item font-11 text-warning"><i
                                                                class="fas fa-star"></i></li>
                                                    @else
                                                        <li class="star-rating__item font-11 text-muted"
                                                            style="opacity: 0.3;"><i class="fas fa-star"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                            <span class="star-rating__text text-heading fw-500 font-14">
                                                ({{ $item->reviews_count ?? 0 }})
                                            </span>
                                        </div>

                                        <h6 class="premium-card-title mb-2">
                                            <a href="{{ route('product.details', $item->slug ?? $item->id) }}"
                                                class="text-dark text-decoration-none text-truncate d-block">
                                                {{ $item->name }}
                                            </a>
                                        </h6>

                                        <div
                                            class="premium-card-info d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                            <span class="premium-author small text-muted">
                                                {{ __('by') }} <a href="#"
                                                    class="text-primary text-decoration-none">{{ $item->author->name ?? 'themepix' }}</a>
                                            </span>
                                            <div class="premium-price-wrap d-flex align-items-center gap-2">
                                                @if (!empty($item->discount_price) && $item->discount_price < $item->price)
                                                    <span
                                                        class="premium-price-old text-decoration-line-through text-muted small">${{ number_format($item->price, 2) }}</span>
                                                    <h6 class="premium-price-new text-success mb-0">
                                                        ${{ number_format($item->discount_price, 2) }}</h6>
                                                @else
                                                    <h6 class="premium-price-new text-dark mb-0">
                                                        ${{ number_format($item->price, 2) }}</h6>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="product_item_footer">
                                            <a class="product_cart add-cart" data-id="{{ $item->id }}"
                                                href="javascript:void(0);">
                                                <i class="ti ti-shopping-cart-plus"></i> {{ __('Add To Cart') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted mb-0">{{ __('No items found in this category yet.') }}</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="#" class="premium-view-all btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                {{ __('View All Products') }}
            </a>
        </div>

    </div>
</section>
