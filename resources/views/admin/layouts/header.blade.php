<!-- Top Header Section -->
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none custom-header">
    <div class="container-xl">

        <!-- Search Bar (Left Side) -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="header-search-wrapper">
                <form action="./" method="get" autocomplete="off" novalidate>
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control header-search-input" placeholder="Search for anything...">
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side Actions -->
        <div class="navbar-nav flex-row order-md-last">

            <!-- Notifications Dropdown -->
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0 text-white-50 hover-white" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                    <i class="bi bi-bell fs-2"></i>
                    <span class="badge bg-red badge-notification"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Last updates</h3>
                        </div>
                        <div class="list-group list-group-flush list-group-hoverable">
                            <div class="list-group-item">
                                <small class="text-muted d-block">No new notifications</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Profile Dropdown -->
          <div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0 user-menu-trigger"
       data-bs-toggle="dropdown"
       data-bs-auto-close="outside"
       aria-label="Open user menu">
        <span class="avatar avatar-sm rounded-circle shadow-sm profile-avatar"
              style="background-image: url({{ auth()->user('admin')->avatar ? asset(auth()->user('admin')->avatar) : asset('default.png') }})"></span>
        <div class="d-none d-xl-block ps-2 text-start">
            <div class="text-white fw-bold">{{ Auth::user('admin')->name }}</div>
            <div class="mt-1 small text-white-50 opacity-75">System Admin</div>
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-lg ">
        <a href="{{ route('admin.profile.index') }}" class="dropdown-item py-2">
            <i class="bi bi-person me-2"></i> Profile
        </a>
        <a href="#" class="dropdown-item py-2">
            <i class="bi bi-gear me-2"></i> Account Settings
        </a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="dropdown-item text-danger fw-bold py-2 w-100 text-start">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>
        </div>

    </div>
</header>

<style>
    /* Custom Header Classes */
    .custom-header {
        background-color: #0f172a !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        height: 70px;
    }

    /* Search Bar Styling */
    .header-search-wrapper {
        margin: 8px 0;
    }

    .header-search-input {
        background-color: rgba(255, 255, 255, 0.05) !important;
        border: none !important;
        color: white !important;
        width: 350px !important;
        border-radius: 8px !important;
        padding-top: 10px;
        padding-bottom: 10px;
        transition: all 0.3s ease;
    }

    .header-search-input:focus {
        background-color: rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 0 0 2px rgba(32, 107, 196, 0.25) !important;
        width: 400px !important;
    }

    .header-search-input::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    /* Badge Positioning */
    .badge-notification {
        position: absolute;
        top: 8px;
        right: -2px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        border: 2px solid #0f172a;
    }

    /* Profile Avatar Effects */
    .profile-avatar {
        border: 2px solid rgba(255, 255, 255, 0.1);
        transition: border-color 0.3s ease;
    }

    .nav-item:hover .profile-avatar {
        border-color: #206bc4;
    }

    .hover-white:hover {
        color: white !important;
    }
</style>
