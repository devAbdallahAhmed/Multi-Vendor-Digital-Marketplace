<aside class="navbar navbar-vertical navbar-expand-lg custom-sidebar">
    <div class="container-fluid">

        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebar-menu" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark py-3 px-3 m-0">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none gap-3">
                <div class="brand-logo-icon d-flex align-items-center justify-content-center rounded-3 shadow-sm bg-primary bg-opacity-10"
                    style="width: 42px; height: 42px;">
                    <i class="bi bi-grid-1x2-fill fs-4 text-primary"></i>
                </div>
                <div class="d-flex flex-column justify-content-center text-start lh-sm">
                    <span class="brand-title fw-bold fs-4 text-dark mb-1">
                        {{ config('settings.site_name', 'DigStore') }}
                    </span>
                    <span class="brand-subtitle text-muted fw-medium text-uppercase"
                        style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        Admin Panel
                    </span>
                </div>
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-2">

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

                @if (hasPermission('access management'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['admin.roles.*', 'admin.role-users.*']) ? 'show active' : '' }}"
                            href="#navbar-access" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">
                            <span class="nav-link-icon">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <span class="nav-link-title">
                                Access Control
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs(['admin.roles.*', 'admin.role-users.*']) ? 'show' : '' }}">
                            <a class="dropdown-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
                                href="{{ route('admin.roles.index') }}">
                                Roles
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.role-users.*') ? 'active' : '' }}"
                                href="{{ route('admin.role-users.index') }}">
                                Role Users
                            </a>
                        </div>
                    </li>
                @endif

                @if (hasPermission('manage KYC'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['admin.kyc-setting.*', 'admin.kyc-request.*']) ? 'show active' : '' }}"
                            href="#navbar-kyc" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">
                            <span class="nav-link-icon">
                                <i class="bi bi-person-vcard"></i>
                            </span>
                            <span class="nav-link-title">
                                KYC
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs(['admin.kyc-setting.*', 'admin.kyc-request.*']) ? 'show' : '' }}">
                            <a class="dropdown-item {{ request()->routeIs('admin.kyc-setting.*') ? 'active' : '' }}"
                                href="{{ route('admin.kyc-setting.index') }}">
                                KYC Settings
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.kyc-request.*') ? 'active' : '' }}"
                                href="{{ route('admin.kyc-request.index') }}">
                                KYC Requests
                                <span
                                    class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ KycCount() }}</span>
                            </a>
                        </div>
                    </li>
                @endif

                @if (hasPermission('manage categories'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['admin.categories.*', 'admin.sub-categories.*']) ? 'show active' : '' }}"
                            href="#navbar-categories" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button">
                            <span class="nav-link-icon">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </span>
                            <span class="nav-link-title">
                                Categories
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs(['admin.categories.*', 'admin.sub-categories.*']) ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                                        href="{{ route('admin.categories.index') }}">
                                        All Categories
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('admin.sub-categories.*') ? 'active' : '' }}"
                                        href="{{ route('admin.sub-categories.index') }}">
                                        Sub Categories
                                        <span class="badge badge-sm bg-blue-lt text-uppercase ms-auto">New</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif

                @if (hasPermission('review product'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['admin.items.review', 'admin.resubmitted.*', 'admin.soft.rejected.*', 'admin.hard.rejected.*', 'admin.approve.*']) ? 'show active' : '' }}"
                            href="#navbar-items-review" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button">
                            <span class="nav-link-icon">
                                <i class="bi bi-box-seam"></i>
                            </span>
                            <span class="nav-link-title">
                                Product Review
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs(['admin.items.review', 'admin.resubmitted.*', 'admin.soft.rejected.*', 'admin.hard.rejected.*', 'admin.approve.*']) ? 'show' : '' }}">
                            <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('admin.items.review') ? 'active' : '' }}"
                                href="{{ route('admin.items.review') }}">
                                <span>Pending Items</span>
                                @if (isset($counts['pending']) && $counts['pending'] > 0)
                                    <span class="badge badge-sm bg-warning-lt ms-auto">{{ $counts['pending'] }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('admin.resubmitted.*') ? 'active' : '' }}"
                                href="{{ route('admin.resubmitted.index') }}">
                                <span>Resubmitted Items</span>
                                @if (isset($counts['resubmitted']) && $counts['resubmitted'] > 0)
                                    <span class="badge badge-sm bg-info-lt ms-auto">{{ $counts['resubmitted'] }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('admin.soft.rejected.*') ? 'active' : '' }}"
                                href="{{ route('admin.soft.rejected.index') }}">
                                <span>Soft Rejected Items</span>
                                @if (isset($counts['soft_reject']) && $counts['soft_reject'] > 0)
                                    <span
                                        class="badge badge-sm bg-secondary-lt ms-auto">{{ $counts['soft_reject'] }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('admin.hard.rejected.*') ? 'active' : '' }}"
                                href="{{ route('admin.hard.rejected.index') }}">
                                <span>Hard Rejected Items</span>
                                @if (isset($counts['hard_reject']) && $counts['hard_reject'] > 0)
                                    <span
                                        class="badge badge-sm bg-danger-lt ms-auto">{{ $counts['hard_reject'] }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item d-flex align-items-center {{ request()->routeIs('admin.approve.*') ? 'active' : '' }}"
                                href="{{ route('admin.approve.index') }}">
                                <span>Approved Items</span>
                                @if (isset($counts['approved']) && $counts['approved'] > 0)
                                    <span class="badge badge-sm bg-success-lt ms-auto">{{ $counts['approved'] }}</span>
                                @endif
                            </a>
                        </div>
                    </li>
                @endif

                @if (hasPermission('manage order'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['admin.orders.*', 'admin.transactions.*']) ? 'show active' : '' }}"
                            href="#navbar-orders" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button">
                            <span class="nav-link-icon">
                                <i class="bi bi-shop"></i>
                            </span>
                            <span class="nav-link-title">
                                Manage Orders
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs(['admin.orders.*', 'admin.transactions.*']) ? 'show' : '' }}">
                            <a class="dropdown-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                                href="{{ route('admin.orders.index') }}">
                                All Orders
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}"
                                href="#">
                                Transaction
                                <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">0</span>
                            </a>
                        </div>
                    </li>
                @endif

                @if (hasPermission('manage sections'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['admin.hero-section.*', 'admin.featured-category.*', 'admin.highlighted-product-section.*', 'admin.monthly-picked-product-section.*', 'admin.featured-author-section.*', 'admin.counter-section.*', 'admin.banner-section.*', 'admin.footer-section.*', 'admin.social-links.*', 'admin.contact-section.*']) ? 'show active' : '' }}"
                            href="#navbar-sections" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button">
                            <span class="nav-link-icon">
                                <i class="bi bi-layout-wtf"></i>
                            </span>
                            <span class="nav-link-title">
                                Sections
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs(['admin.hero-section.*', 'admin.featured-category.*', 'admin.highlighted-product-section.*', 'admin.monthly-picked-product-section.*', 'admin.featured-author-section.*', 'admin.counter-section.*', 'admin.banner-section.*', 'admin.footer-section.*', 'admin.social-links.*', 'admin.contact-section.*']) ? 'show' : '' }}">
                            <a class="dropdown-item {{ request()->routeIs('admin.hero-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.hero-section.index') }}">
                                Hero Section
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.featured-category.*') ? 'active' : '' }}"
                                href="{{ route('admin.featured-category.index') }}">
                                Featured Categories
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.highlighted-product-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.highlighted-product-section.index') }}">
                                Highlighted Products
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.monthly-picked-product-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.monthly-picked-product-section.index') }}">
                                Monthly Picked Products
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.featured-author-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.featured-author-section.index') }}">
                                Featured Author
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.counter-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.counter-section.index') }}">
                                Counter Section
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.banner-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.banner-section.index') }}">
                                Banner Section
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.footer-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.footer-section.index') }}">
                                Footer Section
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}"
                                href="{{ route('admin.social-links.index') }}">
                                Social Links
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('admin.contact-section.*') ? 'active' : '' }}"
                                href="{{ route('admin.contact-section.index') }}">
                                Contact Section
                            </a>
                        </div>
                    </li>
                @endif

                @if (hasPermission('manage withdraw method'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.withdraw-method.*') ? 'active' : '' }}"
                            href="{{ route('admin.withdraw-method.index') }}">
                            <span class="nav-link-icon">
                                <i class="bi bi-wallet"></i>
                            </span>
                            <span class="nav-link-title">
                                Withdrawal methods
                            </span>
                        </a>
                    </li>
                @endif

                @if (hasPermission('manage withdraw request'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.withdraw-request.*') ? 'active' : '' }}"
                            href="{{ route('admin.withdraw-request.index') }}">
                            <span class="nav-link-icon">
                                <i class="bi bi-cash-stack"></i>
                            </span>
                            <span class="nav-link-title">
                                Withdrawal Request
                            </span>
                        </a>
                    </li>
                @endif

                @if (hasPermission('manage settings'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.setting.*', 'admin.logo-setting.*', 'admin.commission.setting.*') ? 'active' : '' }}"
                            href="{{ route('admin.setting.index') }}">
                            <span class="nav-link-icon">
                                <i class="bi bi-gear"></i>
                            </span>
                            <span class="nav-link-title">
                                Settings
                            </span>
                        </a>
                    </li>
                @endif

                @if (hasPermission('payment setting'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.payment-setting.*') ? 'active' : '' }}"
                            href="{{ route('admin.payment-setting.index') }}">
                            <span class="nav-link-icon">
                                <i class="bi bi-credit-card"></i>
                            </span>
                            <span class="nav-link-title">
                                Payment Settings
                            </span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</aside>
