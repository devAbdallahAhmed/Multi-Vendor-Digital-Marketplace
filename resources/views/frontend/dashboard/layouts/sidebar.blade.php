<div class="dashboard-sidebar bg-white border-end h-100 d-flex flex-column">
    <button type="button"
        class="btn btn-light rounded-circle position-absolute top-0 end-0 m-3 d-lg-none d-flex align-items-center justify-content-center shadow-sm"
        style="width: 30px; height: 30px; z-index: 99;">
        <i class="bi bi-x-lg small"></i>
    </button>

    <div class="dashboard-sidebar__inner d-flex flex-column h-100 py-4 px-3">
        <div class="mb-4 px-2 text-center">
            <a href="{{ url('/') }}" class="d-inline-block text-decoration-none">
                <img src="{{ asset(config('settings.logo')) }}" alt="DigiMart Logo" class="img-fluid" style="max-height: 45px;">
            </a>
        </div>

        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span class="small">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('profile') }}"
                    class="nav-link sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-person-circle"></i>
                    <span class="small">Profile</span>
                </a>
            </li>

            @can('is-author')
                <li class="nav-item">
                    <a href="{{ route('user.items.index') }}"
                        class="nav-link sidebar-link {{ request()->routeIs('user.items.*') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                        <i class="bi bi-sliders"></i>
                        <span class="small">{{ __('My Items') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                        <i class="bi bi-wallet2"></i>
                        <span class="small">{{ __('Commissions') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sales.index') }}"
                        class="nav-link sidebar-link {{ request()->routeIs('sales.*') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                        <i class="bi bi-wallet2"></i>
                        <span class="small">{{ __('Sales') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.withdraw.index') }}"
                        class="nav-link sidebar-link {{ request()->routeIs('user.withdraw.*') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                        <i class="bi bi-cash-coin"></i>
                        <span class="small">{{ __("Withdraws") }}</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a href="{{ route('reviews.index') }}"
                    class="nav-link sidebar-link {{ request()->routeIs('reviews.*') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-star-fill"></i>
                    <span class="small">{{ __("Reviews") }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('orders.index') }}"
                    class="nav-link sidebar-link {{ request()->routeIs('orders.index') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-bag-check-fill"></i>
                    <span class="small">{{ __('Purchases') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('orders.transaction') }}"
                    class="nav-link sidebar-link {{ request()->routeIs('orders.transaction') ? 'active' : '' }} d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-receipt"></i>
                    <span class="small">{{ __('Transactions') }}</span>
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-danger w-100 rounded-3 d-flex align-items-center justify-content-center gap-2 py-2 fw-bold small">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>
