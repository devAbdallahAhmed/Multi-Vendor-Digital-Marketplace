@if ($featuredAuthorSection && $featuredAuthorSection->author_id)
    <section class="premium-author-showcase">
        <div class="container container-two">
            <div class="row align-items-center justify-content-between">

                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="pa-grid-container">
                        <div class="pa-grid">
                            @forelse($authorProducts as $product)
                                <a href="{{ route('product.details', $product->slug ?? $product->id) }}"
                                    class="pa-image-box">
                                    <img src="{{ asset($product->preview_image ?? 'assets/images/placeholder.png') }}"
                                        alt="{{ $product->name }}">
                                </a>
                            @empty
                                <div class="w-100 text-center py-4">
                                    <span class="text-muted">{{ __('No products found for this author.') }}</span>
                                </div>
                            @endforelse
                        </div>

                        <div class="pa-floating-badge">
                            @php
                                $authorName = $featuredAuthorSection->author->name ?? 'Author';
                                $authorImage = $featuredAuthorSection->author->avatar
                                    ? asset($featuredAuthorSection->author->avatar)
                                    : 'https://ui-avatars.com/api/?name=' .
                                        urlencode($authorName) .
                                        '&background=3b82f6&color=fff';
                                $avgRating = number_format($featuredAuthorSection->author->reviews_avg_stars ?? 5, 1);
                                $totalReviews = $featuredAuthorSection->author->reviews_count ?? 0;
                            @endphp
                            <img src="{{ $authorImage }}" alt="{{ $authorName }}" class="pa-badge-avatar"
                                onerror="this.src='https://ui-avatars.com/api/?name=User&background=3b82f6&color=fff'">
                            <div class="pa-badge-info">
                                <h6>{{ $authorName }}</h6>
                                <span>
                                    <i class="fas fa-star text-warning"></i>
                                    {{ $avgRating }} ({{ $totalReviews }} {{ __('Reviews') }})
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="pa-text-content">
                        <span class="pa-tag">{{ __('Author Of The Month') }}</span>
                        <h3 class="pa-title">{{ $featuredAuthorSection->title ?? '' }}</h3>
                        <p class="pa-desc">{{ $featuredAuthorSection->subtitle ?? '' }}</p>
                        <a href="#" class="pa-btn">{{ __('View Author Profile') }}</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
