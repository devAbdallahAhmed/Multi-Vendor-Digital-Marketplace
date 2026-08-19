@php
    use Illuminate\Support\Facades\Auth;
    $categories = \App\Models\Category::with('subCategories')->get();
    $cartCount = \App\Models\cartItem::where('user_id', Auth::user()?->id)->count();
@endphp

<header class="prem-header">
    <div class="container container-full">
        <div class="prem-header-inner">

            <a href="index.html" class="prem-logo">
                <img src="{{ asset(config('settings.logo')) }}" alt="Logo">
            </a>

            <ul class="prem-nav d-none d-lg-flex">
                <li class="prem-nav-item">
                    <a href="{{ route('home') }}" class="prem-nav-link">Home</a>
                </li>
                <li class="prem-nav-item">
                    <a href="{{ route('products') }}" class="prem-nav-link">Products</a>
                </li>

                <li class="prem-nav-item">
                    <a href="{{ route('contact') }}" class="prem-nav-link">Contact</a>
                </li>
                <li class="prem-nav-item">
                    <a href="{{ route('kyc.verification') }}" class="prem-nav-link prem-start-selling">Start Selling</a>
                </li>
            </ul>

            <div class="prem-header-right">

                <a href="{{ route('cart.index') }}" class="prem-cart-btn">
                    <i class="ti ti-basket"></i>
                    <span class="prem-cart-badge" id="cart-count">{{ $cartCount }}</span>
                </a>

                <div class="prem-nav-item d-none d-lg-block">
                    <button class="prem-user-btn">
                        <i class="ti ti-user"></i>
                    </button>
                    <ul class="prem-dropdown-menu" style="right: 0; left: auto;">
                        @guest

                            <li><a class="prem-dropdown-item" href="{{ route('login') }}">Sign Up / Login</a></li>
                        @endguest
                        @auth
                            <li><a class="prem-dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li><a class="prem-dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                            <li><a class="prem-dropdown-item" href="#">Settings</a></li>
                        @endauth

                    </ul>
                </div>

                <button type="button" class="prem-mobile-toggle">
                    <i class="las la-bars"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<section class="prem-category-bar">
    <div class="container container-full">
        <ul class="prem-cat-list">
            @foreach ($categories as $category)
                <li class="prem-cat-item">
                    <a class="prem-cat-link" href="{{ route('products', ['category' => $category->slug]) }}">
                        {{ $category->name }}
                        @if ($category->subCategories->count() > 0)
                            <i class="fas fa-chevron-down font-10 ms-1"></i>
                        @endif
                    </a>

                    @if ($category->subCategories->count() > 0)
                        <ul class="prem-cat-dropdown">
                            @foreach ($category->subCategories as $subCategory)
                                <li>
                                    <a href="{{ route('products', ['category' => $category->slug, 'sub-category' => $subCategory->slug]) }}"
                                        class="prem-dropdown-item">
                                        {{ $subCategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</section>
