<!-- Sidebar Section -->
<aside class="navbar navbar-vertical navbar-expand-lg" style="background-color: #0f172a; border-right: 1px solid rgba(255,255,255,0.05);">
    <div class="container-fluid">
        <!-- Logo & Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark py-4">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                <div class="bg-primary text-white p-2 rounded-3 me-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 35px; height: 35px;">
                    <i class="bi bi-grid-1x2-fill" style="font-size: 1.2rem;"></i>
                </div>
                <span class="text-white fw-bold tracking-tight" style="font-size: 1.25rem;">PulseCRM</span>
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <!-- Navigation Links -->
            <ul class="navbar-nav pt-lg-3">

                <!-- Dashboard -->
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} py-2 px-3" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon text-white"><i class="bi bi-speedometer2"></i></span>
                        <span class="nav-link-title text-white opacity-90 fw-medium">Dashboard</span>
                    </a>
                </li>

                <!-- Access Control Dropdown -->
                <li class="nav-item dropdown mb-1">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/roles*') ? 'show' : '' }} py-2 px-3"
                       href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">
                        <span class="nav-link-icon text-white"><i class="bi bi-shield-lock"></i></span>
                        <span class="nav-link-title text-white opacity-90 fw-medium">Access Control</span>
                    </a>
                    <div class="dropdown-menu {{ request()->is('admin/roles*') ? 'show' : '' }} bg-transparent border-0 ps-4">
                        <a class="dropdown-item text-white opacity-75 hover-opacity-100 py-2" href="{{ route('admin.roles.index') }}">Roles</a>
                        <a class="dropdown-item text-white opacity-75 hover-opacity-100 py-2" href="{{ route('admin.role-users.index') }}">Role Users</a>
                    </div>
                </li>
                        <!-- = KyC Dropdown -->
                <li class="nav-item dropdown mb-1">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/roles*') ? 'show' : '' }} py-2 px-3"
                       href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">
                        <span class="nav-link-icon text-white"><i class="bi bi-person-vcard"></i></span>
                        <span class="nav-link-title text-white opacity-90 fw-medium"> KYC</span>
                    </a>
                    <div class="dropdown-menu {{ request()->is('admin/roles*') ? 'show' : '' }} bg-transparent border-0 ps-4">
                        <a class="dropdown-item text-white opacity-75 hover-opacity-100 py-2" href="{{ route('admin.kyc-setting.index') }}">KYC Setting</a>
                        <a class="dropdown-item text-white opacity-75 hover-opacity-100 py-2" href="{{ route('admin.role-users.index') }}">Role Users</a>
                    </div>
                </li>

                <!-- Vendors -->
                <li class="nav-item mb-1">
                    <a class="nav-link py-2 px-3" href="#">
                        <span class="nav-link-icon text-white"><i class="bi bi-shop"></i></span>
                        <span class="nav-link-title text-white opacity-90 fw-medium">Vendors</span>
                    </a>
                </li>

                <!-- Settings (مثال إضافي) -->
                <li class="nav-item mb-1">
                    <a class="nav-link py-2 px-3" href="#">
                        <span class="nav-link-icon text-white"><i class="bi bi-gear"></i></span>
                        <span class="nav-link-title text-white opacity-90 fw-medium">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

<style>
    .navbar-vertical .nav-link {
        border-radius: 8px;
        margin: 0 10px;
        transition: all 0.2s ease;
    }

    .navbar-vertical .nav-link:hover {
        background: rgba(255, 255, 255, 0.08) !important;
    }

    .navbar-vertical .nav-link.active {
        background: rgba(255, 255, 255, 0.1) !important;
        border-left: 3px solid #206bc4; /* خط أزرق خفيف لتمييز الصفحة الحالية */
    }

    .dropdown-toggle::after {
        color: rgba(255,255,255,0.5);
    }

    .dropdown-item:hover {
        background: transparent !important;
        color: white !important;
        text-decoration: underline;
    }
</style>
