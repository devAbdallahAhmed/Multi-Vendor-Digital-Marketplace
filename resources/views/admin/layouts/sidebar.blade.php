<aside class="navbar navbar-vertical navbar-expand-lg custom-sidebar">
    <div class="container-fluid">

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Logo --}}
        <h1 class="navbar-brand navbar-brand-autodark py-5">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                <div class="brand-logo-icon ">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>

                <div>
                    <span class="brand-title">{{ config('settings.site_name') }}</span>
                    <div class="brand-subtitle">Admin Panel</div>
                </div>
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-2">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">

                        <span class="nav-link-icon">
                            <i class="bi bi-speedometer2"></i>
                        </span>

                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>

                {{-- Access Control --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/roles*') ? 'show active' : '' }}"
                        href="#navbar-access" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">

                        <span class="nav-link-icon">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <span class="nav-link-title">
                            Access Control
                        </span>
                    </a>

                    <div class="dropdown-menu {{ request()->is('admin/roles*') ? 'show' : '' }}">
                        <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                            Roles
                        </a>

                        <a class="dropdown-item" href="{{ route('admin.role-users.index') }}">
                            Role Users
                        </a>
                    </div>
                </li>

                {{-- KYC --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/kyc*') ? 'show active' : '' }}"
                        href="#navbar-kyc" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">

                        <span class="nav-link-icon">
                            <i class="bi bi-person-vcard"></i>
                        </span>

                        <span class="nav-link-title">
                            KYC
                        </span>
                    </a>

                    <div class="dropdown-menu {{ request()->is('admin/kyc*') ? 'show' : '' }}">
                        <a class="dropdown-item" href="{{ route('admin.kyc-setting.index') }}">
                            KYC Settings
                        </a>

                        <a class="dropdown-item" href="{{ route('admin.kyc-request.index') }}">
                            KYC Requests
                            <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ KycCount() }}</span>
                        </a>
                    </div>
                </li>


                @if (hasPermission('manage categories'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('admin/categories*') || request()->is('admin/sub-categories*') ? 'show active' : '' }}"
                            href="#navbar-categories" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button">

                            <span class="nav-link-icon">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </span>

                            <span class="nav-link-title">
                                {{ __('Categories') }}
                            </span>
                        </a>

                        <div
                            class="dropdown-menu {{ request()->is('admin/categories*') || request()->is('admin/sub-categories*') ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->is('admin/categories*') ? 'active' : '' }}"
                                        href="{{ route('admin.categories.index') }}">
                                        {{ __('All Categories') }}
                                    </a>

                                    <a class="dropdown-item d-flex align-items-center {{ request()->is('admin/sub-categories*') ? 'active' : '' }}"
                                        href="{{ route('admin.sub-categories.index') }}">
                                        {{ __('Sub Categories') }}
                                        <span class="badge badge-sm bg-blue-lt text-uppercase ms-auto">New</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/items/review*') ? 'show active' : '' }}"
                        href="#navbar-items-review" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">

                        <span class="nav-link-icon">
                            <i class="bi bi-box-seam"></i>
                        </span>

                        <span class="nav-link-title">
                            {{ __('Product Review') }}
                        </span>
                    </a>

                    <div class="dropdown-menu {{ request()->is('admin/items/review*') ? 'show' : '' }}">

                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.items.review') }}">
                            <span>{{ __('Pending Items') }}</span>
                            @if (isset($counts['pending']) && $counts['pending'] > 0)
                                <span class="badge badge-sm bg-warning-lt ms-auto">{{ $counts['pending'] }}</span>
                            @endif
                        </a>

                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('admin.resubmitted.index') }}">
                            <span>{{ __('Resubmitted Items') }}</span>
                            @if (isset($counts['resubmitted']) && $counts['resubmitted'] > 0)
                                <span class="badge badge-sm bg-info-lt ms-auto">{{ $counts['resubmitted'] }}</span>
                            @endif
                        </a>

                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('admin.soft.rejected.index') }}">
                            <span>{{ __('Soft Rejected Items') }}</span>
                            @if (isset($counts['soft_reject']) && $counts['soft_reject'] > 0)
                                <span
                                    class="badge badge-sm bg-secondary-lt ms-auto">{{ $counts['soft_reject'] }}</span>
                            @endif
                        </a>

                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('admin.hard.rejected.index') }}">
                            <span>{{ __('Hard Rejected Items') }}</span>
                            @if (isset($counts['hard_reject']) && $counts['hard_reject'] > 0)
                                <span class="badge badge-sm bg-danger-lt ms-auto">{{ $counts['hard_reject'] }}</span>
                            @endif
                        </a>

                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.approve.index') }}">
                            <span>{{ __('Approved Items') }}</span>
                            @if (isset($counts['approved']) && $counts['approved'] > 0)
                                <span class="badge badge-sm bg-success-lt ms-auto">{{ $counts['approved'] }}</span>
                            @endif
                        </a>

                    </div>
                </li>


                {{-- Manage Orders --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/orders') ? 'show active' : '' }}"
                        href="#navbar-kyc" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">

                        <span class="nav-link-icon">
                            <i class="bi bi-shop"></i>
                        </span>

                        <span class="nav-link-title">
                            {{ __('Manage Orders ') }}
                        </span>
                    </a>

                    <div class="dropdown-menu {{ request()->is('admin/kyc*') ? 'show' : '' }}">
                        <a class="dropdown-item" href="{{ route('admin.orders.index') }}">
                            {{ __('All Orders') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('admin.kyc-request.index') }}">
                            {{ __('Transaction') }}
                            <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">0</span>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/hero-section*', 'admin/featured-category*') ? 'show active' : '' }}"
                        href="#navbar-sections" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                        aria-expanded="{{ request()->is('admin/hero-section*', 'admin/featured-category*') ? 'true' : 'false' }}">

                        <span class="nav-link-icon">
                            <i class="bi bi-shop"></i>
                        </span>

                        <span class="nav-link-title">
                            {{ __('Sections') }}
                        </span>
                    </a>

                    <div
                        class="dropdown-menu {{ request()->is('admin/hero-section*', 'admin/featured-category*') ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->is('admin/hero-section*') ? 'active' : '' }}"
                            href="{{ route('admin.hero-section.index') }}">
                            {{ __('Hero Section') }}
                        </a>

                        <a class="dropdown-item {{ request()->is('admin/featured-category*') ? 'active' : '' }}"
                            href="{{ route('admin.featured-category.index') }}">
                            {{ __('Featured Categories') }}
                        </a>

                        <a class="dropdown-item {{ request()->is('admin/featured-category*') ? 'active' : '' }}"
                            href="{{ route('admin.highlighted-product-section.index') }}">
                            {{ __(' Highlighted Products') }}
                        </a>
                        <a class="dropdown-item " href="{{ route('admin.monthly-picked-product-section.index') }}">
                            {{ __('  Monthly Picked Products') }}
                        </a>
                        <a class="nav-link" href="{{ route('admin.featured-author-section.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-user-star"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Featured Author') }}
                            </span>
                        </a>
                        <a class="nav-link" href="{{ route('admin.counter-section.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-chart-bar"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Counter Section') }}
                            </span>
                        </a>
                        <a class="nav-link" href="{{ route('admin.banner-section.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-photo"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Banner Section') }}
                            </span>
                        </a>
                        <a class="nav-link" href="{{ route('admin.footer-section.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-layout-bottombar"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Footer Section') }}
                            </span>
                        </a>
                        <a class="nav-link" href="{{ route('admin.social-links.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-link"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Social Links') }}
                            </span>
                        </a>

                        <a class="nav-link" href="{{ route('admin.contact-section.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-address-book"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Contact Section') }}
                            </span>
                        </a>
                    </div>
                </li>
                {{-- Vendors --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.withdraw-method.index') }}">
                        <span class="nav-link-icon">
                            <i class="bi bi-wallet"></i>
                        </span>

                        <span class="nav-link-title">
                            {{ __('Withdrawal methods') }}
                        </span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.withdraw-request.index') }}">
                        <span class="nav-link-icon">
                            <i class="bi bi-wallet"></i>
                        </span>

                        <span class="nav-link-title">
                            {{ __('Withdrawal Request') }}
                        </span>
                    </a>
                </li>

                {{-- Settings --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.setting.index') }}">
                        <span class="nav-link-icon">
                            <i class="bi bi-gear"></i>
                        </span>

                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.payment-setting.index') }}">
                        <span class="nav-link-icon">
                            <i class="bi bi-gear"></i>
                        </span>

                        <span class="nav-link-title">
                            {{ __('Payment Settings') }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
