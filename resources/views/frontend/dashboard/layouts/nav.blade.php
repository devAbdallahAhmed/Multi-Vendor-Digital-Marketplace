<!-- =========================
    Dashboard Navbar
========================= -->

<div class="dashboard-nav navbar navbar-expand-lg bg-white border rounded-4 shadow-sm px-4 py-3 mb-4">

    <!-- Left Side -->
    <div class="d-flex align-items-center gap-3">

        <!-- Sidebar Toggle -->
        <button type="button"
                class="btn btn-light border rounded-4 nav-btn">

            <i class="bi bi-list fs-3 text-dark"></i>

        </button>

        <!-- Back Button -->
        <button type="button"
                class="btn btn-light border rounded-4 nav-btn">

            <i class="bi bi-arrow-right-short fs-3 text-dark"></i>

        </button>

        <!-- Search -->
        <form action="#"
              class="position-relative d-none d-md-block">

            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>

            <input type="text"
                   class="form-control border rounded-4 bg-light ps-5 shadow-sm"
                   placeholder="Search here..."
                   style="width: 320px; height: 48px;">

        </form>

    </div>

    <!-- Right Side -->
    <div class="d-flex align-items-center gap-3 ms-auto">

        <!-- Notification -->
        <button class="btn btn-light border rounded-4 nav-btn position-relative">

            <i class="bi bi-bell-fill fs-5 text-dark"></i>

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-1">
            </span>

        </button>

        <!-- Language -->
        <div class="dropdown">

            <button class="btn btn-light border rounded-4 shadow-sm px-3 py-2 d-flex align-items-center gap-2"
                    data-bs-toggle="dropdown">

                <i class="bi bi-globe2 text-primary fs-5"></i>

                <span class="fw-semibold text-dark">
                    ENG
                </span>

                <i class="bi bi-chevron-down small text-secondary"></i>

            </button>

            <!-- Dropdown -->
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 p-2">

                <li>
                    <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2"
                       href="#">

                        <i class="bi bi-translate text-primary"></i>

                        English
                    </a>
                </li>

                <li>
                    <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2"
                       href="#">

                        <i class="bi bi-translate text-success"></i>

                        Arabic
                    </a>
                </li>

                <li>
                    <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2"
                       href="#">

                        <i class="bi bi-translate text-warning"></i>

                        French
                    </a>
                </li>

            </ul>

        </div>

        <!-- User Dropdown -->
        <div class="dropdown">

            <button class="btn btn-white border rounded-4 shadow-sm px-2 py-2 d-flex align-items-center gap-3"
                    data-bs-toggle="dropdown">

                <!-- Avatar -->
                <img src="{{ asset('assets/front/images/thumbs/user-profile.png') }}"
                     class="rounded-circle border object-fit-cover"
                     width="48"
                     height="48"
                     alt="User">

                <!-- Info -->
                <div class="text-start d-none d-lg-block">

                    <div class="fw-bold text-dark small">
                        {{ Auth::user()->name ?? 'User' }}
                    </div>

                    <div class="text-muted small">
                        User Account
                    </div>

                </div>

                <i class="bi bi-chevron-down text-secondary"></i>

            </button>

            <!-- Dropdown -->
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 overflow-hidden"
                style="width: 280px;">

                <!-- Profile -->
                <li>

                    <a href="#"
                       class="dropdown-item rounded-4 py-3 px-3 d-flex align-items-center gap-3">

                        <div class="dropdown-icon bg-primary-subtle text-primary">

                            <i class="bi bi-person-fill"></i>

                        </div>

                        <div>

                            <div class="fw-semibold text-dark">
                                Profile
                            </div>

                            <small class="text-muted">
                                Manage account
                            </small>

                        </div>

                    </a>

                </li>

                <!-- Settings -->
                <li>

                    <a href="#"
                       class="dropdown-item rounded-4 py-3 px-3 d-flex align-items-center gap-3">

                        <div class="dropdown-icon bg-warning-subtle text-warning">

                            <i class="bi bi-gear-fill"></i>

                        </div>

                        <div>

                            <div class="fw-semibold text-dark">
                                Settings
                            </div>

                            <small class="text-muted">
                                Preferences
                            </small>

                        </div>

                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <!-- Logout -->
                <li>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="dropdown-item rounded-4 py-3 px-3 d-flex align-items-center gap-3 text-danger">

                            <div class="dropdown-icon bg-danger-subtle text-danger">

                                <i class="bi bi-box-arrow-right"></i>

                            </div>

                            <div>

                                <div class="fw-semibold">
                                    Logout
                                </div>

                                <small class="text-muted">
                                    Sign out account
                                </small>

                            </div>

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</div>

<style>

    .dashboard-nav{
        min-height: 80px;
    }

    .nav-btn{
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-btn:hover{
        background: #f8fafc;
    }

    .dropdown-icon{
        width: 42px;
        height: 42px;

        border-radius: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;

        flex-shrink: 0;
    }

    .dropdown-item{
        transition: all .2s ease;
    }

    .dropdown-item:hover{
        background: #f8fafc;
        transform: translateX(3px);
    }

</style>
