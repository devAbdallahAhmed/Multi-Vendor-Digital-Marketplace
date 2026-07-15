@php
    $trending = ['PHP Scripts', 'Laravel Themes', 'UI Kits', 'Plugins'];
@endphp

<section class="premium-hero">
    <div class="container">
        <div class="hero-content">

            <!-- Badge -->
            <div class="hero-badge">
                <span class="pulse-dot"></span>
                10,000+ hand-curated digital assets
            </div>

            <!-- Title -->
            <h1 class="hero-title">
                Discover premium digital <br>
                <span class="text-gradient">assets</span> for your next vision
            </h1>

            <!-- Description -->
            <p class="hero-desc">
                WordPress themes, PHP scripts, HTML templates, and mobile UI kits — vetted by our editorial team and
                trusted by 200k creators.
            </p>

            <!-- Search Form -->
            <form action="#" method="GET" class="hero-search-form">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>

                <input type="text" name="query" placeholder="Search themes, plugins, and templates..."
                    class="hero-search-input" required>

                <button type="submit" class="hero-search-btn">Search</button>
            </form>

            <!-- Trending Tags -->
            <div class="trending-area">
                <span class="trending-label">Trending:</span>
                @foreach ($trending as $t)
                    <a href="#" class="trending-tag">{{ $t }}</a>
                @endforeach
            </div>

        </div>
    </div>
</section>
