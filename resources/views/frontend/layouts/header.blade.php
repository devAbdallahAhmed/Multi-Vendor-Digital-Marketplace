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


<style>
    .prem-category-bar {
        position: relative !important;
        z-index: 9999 !important;
        overflow: visible !important;
    }

    .prem-category-bar .container,
    .prem-cat-list {
        overflow: visible !important;
    }

    .prem-cat-item {
        position: relative !important;
    }

    .prem-cat-item .prem-cat-dropdown {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        z-index: 2147483647 !important;
        background: #ffffff !important;
        min-width: 230px !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
        border-radius: 8px !important;
        padding: 8px 0 !important;

        display: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(5px);
        transition: all 0.2s ease;
    }

    .prem-cat-item.has-dropdown:hover .prem-cat-dropdown {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
    }

    .prem-cat-dropdown li {
        display: block !important;
        width: 100% !important;
    }

    .prem-cat-dropdown li a {
        display: block !important;
        padding: 10px 16px !important;
        color: #333 !important;
        font-size: 14px !important;
        text-decoration: none !important;
        white-space: nowrap !important;
    }

    .prem-cat-dropdown li a:hover {
        background-color: #f8f9fa !important;
        color: #0d6efd !important;
    }
</style>
<section class="prem-category-bar bg-white shadow-sm border-bottom" style="position: relative; z-index: 500;">
    <div class="container container-full">
        <ul class="prem-cat-list d-flex flex-wrap justify-content-center align-items-center gap-4 list-unstyled mb-0 py-3"
            style="position: static;">

            @foreach ($categories as $category)
                @php
                    $hasSubCategories = $category->subCategories->isNotEmpty();
                @endphp

                <!-- استخدمنا كلاسات Bootstrap القياسية dropdown عشان نعتمد على بنية الـ Bootstrap لو موجودة -->
                <li class="prem-cat-item dropdown {{ $hasSubCategories ? 'has-dropdown' : '' }}"
                    style="position: relative;">
                    <a class="prem-cat-link text-dark fw-medium text-decoration-none d-flex align-items-center gap-1 py-1"
                        href="{{ route('products', ['category' => $category->slug]) }}"
                        @if ($hasSubCategories) data-bs-toggle="dropdown" aria-expanded="false" @endif>

                        <span>{{ $category->name }}</span>

                        @if ($hasSubCategories)
                            <i class="fas fa-chevron-down font-10 text-muted"></i>
                        @endif
                    </a>

                    @if ($hasSubCategories)
                        <ul class="dropdown-menu shadow-lg rounded-3 p-2 border-0"
                            style="margin-top: 10px; min-width: 220px; border: 1px solid #eee !important;">

                            @foreach ($category->subCategories as $subCategory)
                                <li>
                                    <a href="{{ route('products', ['category' => $category->slug, 'sub-category' => $subCategory->slug]) }}"
                                        class="dropdown-item px-3 py-2 text-dark rounded">
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
