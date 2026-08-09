<div class="dashboard-sidebar bg-white border-end h-100 d-flex flex-column">
    <button type="button"
        class="btn btn-light rounded-circle position-absolute top-0 end-0 m-3 d-lg-none d-flex align-items-center justify-content-center shadow-sm"
        style="width: 30px; height: 30px; z-index: 99;">
        <i class="bi bi-x-lg small"></i>
    </button>

    <div class="dashboard-sidebar__inner d-flex flex-column h-100 py-4 px-3">
        <div class="mb-4 px-2">
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                <div class="sidebar-logo-icon me-2 shadow-sm d-flex align-items-center justify-content-center"
                    style="width: 35px; height: 35px; border-radius: 8px;">
                    <i class="bi bi-lightning-charge-fill text-primary"></i>
                </div>
                <div>
                    <h6 class="fw-bolder text-dark mb-0">Pulse</h6>
                    <small class="text-muted" style="font-size: 0.75rem;">User Panel</small>
                </div>
            </a>
        </div>

        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link sidebar-link active d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span class="small">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile') }}"
                    class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-person-circle"></i>
                    <span class="small">Profile</span>
                </a>
            </li>
            @can('is-author')
                <li class="nav-item">
                    <a href="{{ route('user.items.index') }}"
                        class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
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
                        class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                        <i class="bi bi-wallet2"></i>
                        <span class="small">{{ __('Sales') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.withdraw.index') }}" class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                        <i class="bi bi-gear-fill"></i>
                        <span class="small">{{ __("Withdraws") }}</span>
                    </a>
                </li>
            @endcan

             <li class="nav-item">
                    <a href="{{ route('reviews.index') }}" class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                        <i class="bi bi-gear-fill"></i>
                        <span class="small">{{ __("Reviews") }}</span>
                    </a>
                </li>
            <li class="nav-item">
                <a href="{{ route('orders.index') }}"
                    class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-bag-check-fill"></i>
                    <span class="small">{{ __('Purchases') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('orders.transaction') }}"
                    class="nav-link sidebar-link d-flex align-items-center gap-2 py-2 px-3 rounded-3">
                    <i class="bi bi-bag-fill"></i>
                    <span class="small">{{ __('Transactions') }}</span>
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="btn btn-danger w-100 rounded-3 d-flex align-items-end justify-content-center gap-2 py-2 fw-bold small">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>
