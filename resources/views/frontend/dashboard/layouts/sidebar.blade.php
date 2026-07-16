<div class="dashboard-sidebar bg-white border-end">

    <button type="button"
        class="btn btn-light rounded-circle position-absolute top-0 end-0 m-3 d-lg-none d-flex align-items-center justify-content-center shadow-sm"
        style="width: 34px; height: 34px; z-index: 99;">
        <i class="bi bi-x-lg text-dark small"></i>
    </button>

    <div class="dashboard-sidebar__inner d-flex flex-column h-100 p-4">

        <div class="mb-5 px-2">
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                <div class="sidebar-logo-icon me-3 shadow-sm">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <div>
                    <h5 class="fw-bolder text-dark mb-0 letter-spacing-tight">
                        Pulse
                    </h5>
                    <small class="text-muted fw-medium" style="font-size: 0.8rem;">
                        User Panel
                    </small>
                </div>
            </a>
        </div>

        <ul class="nav flex-column gap-2">

            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link active">
                    <div class="sidebar-icon sidebar-primary">
                        <i class="bi bi-grid-1x2-fill"></i>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link sidebar-link">
                    <div class="sidebar-icon sidebar-info">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <span>Profile</span>
                </a>
            </li>

            @can('is-author')
                <li class="nav-item">
                    <a href="{{ route('user.items.index') }}" class="nav-link sidebar-link">
                        <div class="sidebar-icon sidebar-warning">
                            <i class="bi bi-sliders"></i>
                        </div>
                        <span>{{ __('My Items') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link sidebar-link">
                        <div class="sidebar-icon sidebar-success">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <span>{{ __('My Commissions') }}</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link">
                    <div class="sidebar-icon sidebar-secondary">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                    <span>Settings</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link">
                    <div class="sidebar-icon sidebar-success">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>
                    <span>Orders</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link">
                    <div class="sidebar-icon sidebar-danger">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <span>Wishlist</span>
                </a>
            </li>

        </ul>

        <div class="mt-auto pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="btn w-100 rounded-4 d-flex align-items-center justify-content-center gap-2 py-2 fw-bold logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>

    </div>
</div>
