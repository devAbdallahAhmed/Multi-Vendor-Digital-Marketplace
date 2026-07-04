{{-- resources/views/admin/layouts/header.blade.php --}}
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none bg-white border-bottom shadow-sm sticky-top">
    <div class="container-xl">

        {{-- ============= Search ============= --}}
        <div class="collapse navbar-collapse" id="navbar-menu">
            <form action="./" method="get" class="w-100" autocomplete="off" novalidate>
                <div class="position-relative" style="max-width: 380px;">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                    <input type="text" class="form-control rounded-4 ps-5 py-2 border-0 bg-light shadow-sm"
                        placeholder="{{ __('Search dashboard...') }}">
                </div>
            </form>
        </div>

        {{-- ============= Right Side ============= --}}
        <div class="navbar-nav flex-row align-items-center gap-3 ms-auto">

            {{-- Notifications Dropdown --}}
            <div class="nav-item dropdown">
                <a href="#"
                    class="btn btn-light rounded-circle position-relative d-flex align-items-center justify-content-center shadow-sm"
                    style="width: 45px; height: 45px;" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell fs-5 text-secondary"></i>
                    {{-- Notification Dot (show only if unread > 0) --}}
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-white rounded-circle"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 p-0 overflow-hidden"
                    style="width: 320px;">
                    {{-- Header --}}
                    <div class="p-3 border-bottom bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ __('Notifications') }}</h6>
                                <small class="text-muted">{{ __('Latest updates') }}</small>
                            </div>
                            <span class="badge bg-primary-subtle text-primary">0 {{ __('New') }}</span>
                        </div>
                    </div>
                    {{-- Body --}}
                    <div style="max-height: 300px; overflow-y: auto;">
                        {{-- Empty State --}}
                        <div class="text-center p-4">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-bell-slash fs-3 text-secondary"></i>
                            </div>
                            <h6 class="fw-semibold mb-1">{{ __('No notifications') }}</h6>
                            <small class="text-muted">{{ __("You're all caught up.") }}</small>
                        </div>
                    </div>
                    {{-- Footer --}}
                    <div class="p-2 border-top text-center">
                        <a href="#" class="text-decoration-none small">{{ __('View all notifications') }}</a>
                    </div>
                </div>
            </div>

            {{-- User Dropdown --}}
            <div class="nav-item dropdown">
                <a href="#"
                    class="d-flex align-items-center text-decoration-none px-2 py-1 rounded-4 hover-bg-light"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">

                    {{-- Avatar --}}
                    <span class="avatar avatar-md rounded-circle border border-2 shadow-sm"
                        style="background-image: url({{ auth()->user('admin')->avatar ? asset(auth()->user('admin')->avatar) : asset('default.png') }})">
                    </span>

                    {{-- Name & Role --}}
                    <div class="ms-3 d-none d-xl-block text-start">
                        <div class="fw-bold text-dark">{{ Auth::user('admin')->name }}</div>
                        <small class="text-muted">{{ __('System Admin') }}</small>
                    </div>

                    <i class="bi bi-chevron-down small text-secondary ms-2"></i>
                </a>

                {{-- Dropdown Menu --}}
                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-0 overflow-hidden user-dropdown-menu"
                    style="width: 280px;">

                    {{-- User Info Header --}}
                    <div class="p-4 text-center border-bottom bg-light-subtle">
                        <div class="position-relative d-inline-block mb-3">
                            <span class="avatar avatar-xl rounded-circle shadow"
                                style="background-image: url({{ auth()->user('admin')->avatar ? asset(auth()->user('admin')->avatar) : asset('default.png') }});
                                         width: 80px;
                                         height: 80px;
                                         background-size: cover;
                                         background-position: center;">
                            </span>
                            {{-- Online Indicator --}}
                            <span
                                class="position-absolute bottom-0 end-0 bg-success border border-3 border-white rounded-circle"
                                style="width: 18px; height: 18px;"></span>
                        </div>

                        <h5 class="fw-bold mb-1 text-dark">{{ Auth::user('admin')->name }}</h5>
                        <div class="text-muted small">{{ __('Administrator Account') }}</div>
                    </div>

                    {{-- Menu Links --}}
                    <div class="py-2">
                        <a href="{{ route('admin.profile.index') }}"
                            class="dropdown-item d-flex align-items-center gap-3 py-3 px-4">
                            <div class="menu-icon bg-primary-subtle text-primary">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">{{ __('Profile') }}</div>
                                <small class="text-muted">{{ __('Manage your profile') }}</small>
                            </div>
                        </a>

                        <a href="{{ route('admin.setting.index') }}"
                            class="dropdown-item d-flex align-items-center gap-3 py-3 px-4">
                            <div class="menu-icon bg-warning-subtle text-warning">
                                <i class="bi bi-gear"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">{{ __('Settings') }}</div>
                                <small class="text-muted">{{ __('Account preferences') }}</small>
                            </div>
                        </a>
                    </div>

                    <div class="dropdown-divider m-0"></div>

                    {{-- Logout --}}
                    <div class="p-2">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit"
                                class="dropdown-item logout-btn d-flex align-items-center gap-3 rounded-3 py-3 px-3 w-100">
                                <div class="menu-icon bg-danger-subtle text-danger">
                                    <i class="bi bi-box-arrow-right"></i>
                                </div>
                                <div class="fw-semibold">{{ __('Logout') }}</div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

<style>
    /* Hover effect on user button */
    .hover-bg-light:hover {
        background: #f8f9fa;
        transition: 0.2s ease;
    }

    /* Dropdown menu icon styles */
    .menu-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Dropdown item hover */
    .user-dropdown-menu .dropdown-item:hover,
    .user-dropdown-menu .logout-btn:hover {
        background: #f8f9fa;
    }

    .user-dropdown-menu .dropdown-item,
    .user-dropdown-menu .logout-btn {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    .bg-primary-subtle {
        background: rgba(32, 107, 196, 0.12);
        color: #206bc4;
    }

    .bg-warning-subtle {
        background: rgba(245, 158, 11, 0.12);
        color: #f59e0b;
    }

    .bg-danger-subtle {
        background: rgba(214, 57, 57, 0.12);
        color: #d63939;
    }
</style>
