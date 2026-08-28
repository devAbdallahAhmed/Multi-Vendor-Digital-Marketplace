<style>
    .product-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
</style>

<div class="col-lg-6 col-xl-4 col-sm-6">
    <div class="product-item">
        <div class="product-item__thumb d-flex">
            <a href="{{ route('product.details', $item->slug) }}" class="link w-100">
                @if ($item->preview_type == 'image')
                    <img src="{{ asset($item->preview_image ?? $item->main_file) }}" alt="{{ $item->name }}"
                        class="product-img">
                @elseif ($item->preview_type === 'video')
                    <video class="player" playsinline loop muted>
                        <source data-src="{{ asset($item->preview_video ?? $item->main_file) }}" type="video/mp4" />
                    </video>
                @elseif ($item->preview_type === 'audio')
                    <audio class="audio-player" controls>
                        <source data-src="{{ asset($item->preview_audio ?? $item->main_file) }}" type="audio/mp3" />
                    </audio>
                @endif
            </a>
        </div>

        <div class="product-item__content">
            <div class="product-item__bottom flx-between gap-2">
                <div class="d-flex flex-wrap justify-content-between align-items-center w-100">

                    <div class="d-flex align-items-center gap-1">
                        <ul class="star-rating">
                            @php
                                $avgRating = round($item->reviews_avg_stars ?? 0);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avgRating)
                                    <li class="star-rating__item font-11 text-warning"><i class="fas fa-star"></i></li>
                                @else
                                    <li class="star-rating__item font-11 text-muted" style="opacity: 0.3;"><i
                                            class="fas fa-star"></i></li>
                                @endif
                            @endfor
                        </ul>
                        <span class="star-rating__text text-heading fw-500 font-14">
                            ({{ $item->reviews_count ?? 0 }})
                        </span>
                    </div>

                    <span class="product-item__sales font-14">
                        <i class="ti ti-download"></i> {{ $item->sales_count ?? 0 }}
                    </span>
                </div>
            </div>

            <h6 class="product-item__title">
                <a href="{{ route('product.details', $item->slug) }}" class="link">{{ $item->name }}</a>
            </h6>

            <div class="product-item__info flx-between gap-2">
                <span class="product-item__author">
                    {{ __('by') }}
                    <a href="profile.html" class="link hover-text-decoration-underline">
                        {{ $item->author->name }}
                    </a>
                </span>

                <div class="flx-align gap-2">
                    @if ($item->discount_price > 0)
                        <h6 class="product-item__price mb-0">
                            {{ config('settings.currency_icon', '$') }}{{ $item->discount_price }}
                        </h6>
                        <span class="product-item__prevPrice text-decoration-line-through">
                            {{ config('settings.currency_icon', '$') }}{{ $item->price }}
                        </span>
                    @else
                        <h6 class="product-item__price mb-0">
                            {{ config('settings.currency_icon', '$') }}{{ $item->price }}
                        </h6>
                    @endif
                </div>
            </div>

            <div class="product_item_footer">
                <a class="product_cart add-cart" data-id="{{ $item->id }}" href="javascript:void(0);">
                    <i class="ti ti-shopping-cart-plus"></i> {{ __('Add To Cart') }}
                </a>
            </div>
        </div>
    </div>
</div>
