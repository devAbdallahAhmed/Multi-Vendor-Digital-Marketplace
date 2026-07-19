<div class="dashboard-nav navbar navbar-expand-lg bg-white border rounded-3 shadow-sm px-3 py-2 mb-4 d-flex align-items-center"
    style="min-height: 60px;">

    <div class="d-flex align-items-center gap-2">
        <button type="button"
            class="btn btn-light border rounded-3 nav-btn d-flex align-items-center justify-content-center"
            style="width: 40px; height: 40px;">
            <i class="bi bi-list fs-5 text-dark"></i>
        </button>
    </div>

    <div class="d-flex align-items-center gap-2 ms-auto">
        <button
            class="btn btn-light border rounded-3 nav-btn position-relative d-flex align-items-center justify-content-center"
            style="width: 40px; height: 40px;">
            <i class="bi bi-bell-fill fs-6 text-dark"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-1"></span>
        </button>

        <div class="dropdown">
            <button class="btn btn-light border rounded-3 shadow-sm px-2 py-1 d-flex align-items-center gap-2"
                data-bs-toggle="dropdown">
                <i class="bi bi-globe2 text-primary"></i>
                <span class="fw-semibold small text-dark">ENG</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 p-1">
                <li><a class="dropdown-item rounded-2 small py-1" href="#">English</a></li>
                <li><a class="dropdown-item rounded-2 small py-1" href="#">Arabic</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="btn btn-white border rounded-3 shadow-sm px-2 py-1 d-flex align-items-center gap-2"
                data-bs-toggle="dropdown">
                <img src="{{ asset('assets/front/images/thumbs/user-profile.png') }}" class="rounded-circle border"
                    width="32" height="32" alt="User">
                <div class="text-start d-none d-lg-block">
                    <div class="fw-bold text-dark" style="font-size: 0.8rem;">{{ Auth::user()->name ?? 'User' }}</div>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-1" style="width: 200px;">
                <li><a class="dropdown-item rounded-2 small py-2" href="#"><i class="bi bi-person-fill me-2"></i>
                        Profile</a></li>
                <li>
                    <hr class="dropdown-divider my-1">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item rounded-2 small py-2 text-danger"><i
                                class="bi bi-box-arrow-right me-2"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
