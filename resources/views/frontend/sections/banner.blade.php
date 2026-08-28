<section class="premium-hero">
    <div class="container">
        <div class="hero-content">

            <!-- Badge -->
            @if (!empty($hero->badge))
                <div class="hero-badge">
                    <span class="pulse-dot"></span>
                    {{ $hero?->badge }}
                </div>
            @endif

            <!-- Title -->
            <h1 class="hero-title" style="color: #1e293b;">
                {{ $hero?->title }} <span class="text-gradient">Marketplace</span>
            </h1>
            <!-- Description -->
            <p class="hero-desc">
                {{ $hero?->subtitle }}
            </p>

            <!-- Search Form -->
            <form action="{{ route('products') }}" method="GET" class="hero-search-form">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="{{ __('Search themes, plugins, and templates...') }}" class="hero-search-input"
                    required>

                <button type="submit" class="hero-search-btn">{{ __('Search') }}</button>
            </form>

            <!-- Trending Tags -->
            @if (!empty($hero->trending_tags))
                <div class="trending-area">
                    <span class="trending-label">Trending:</span>
                    @foreach ($hero->trending_tags as $tag)
                        <a href="{{ route('products', ['search' => $tag]) }}"
                            class="trending-tag">{{ $tag }}</a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</section>
