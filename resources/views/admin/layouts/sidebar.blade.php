<aside class="navbar navbar-vertical navbar-expand-lg custom-sidebar">
    <div class="container-fluid">

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Logo --}}
        <h1 class="navbar-brand navbar-brand-autodark py-4">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                <div class="brand-logo-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>

                <div>
                    <span class="brand-title">PulseCRM</span>
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
                       href="#navbar-access"
                       data-bs-toggle="dropdown"
                       data-bs-auto-close="false"
                       role="button">

                        <span class="nav-link-icon">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <span class="nav-link-title">
                            Access Control
                        </span>
                    </a>

                    <div class="dropdown-menu {{ request()->is('admin/roles*') ? 'show' : '' }}">
                        <a class="dropdown-item"
                           href="{{ route('admin.roles.index') }}">
                            Roles
                        </a>

                        <a class="dropdown-item"
                           href="{{ route('admin.role-users.index') }}">
                            Role Users
                        </a>
                    </div>
                </li>

                {{-- KYC --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/kyc*') ? 'show active' : '' }}"
                       href="#navbar-kyc"
                       data-bs-toggle="dropdown"
                       data-bs-auto-close="false"
                       role="button">

                        <span class="nav-link-icon">
                            <i class="bi bi-person-vcard"></i>
                        </span>

                        <span class="nav-link-title">
                            KYC
                        </span>
                    </a>

                    <div class="dropdown-menu {{ request()->is('admin/kyc*') ? 'show' : '' }}">
                        <a class="dropdown-item"
                           href="{{ route('admin.kyc-setting.index') }}">
                            KYC Settings
                        </a>

                        <a class="dropdown-item"
                           href="{{ route('admin.kyc-request.index') }}">
                          KYC Requests
                          <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ KycCount() }}</span>
                        </a>
                    </div>
                </li>

                {{-- Vendors --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon">
                            <i class="bi bi-shop"></i>
                        </span>

                        <span class="nav-link-title">
                            Vendors
                        </span>
                    </a>
                </li>

                {{-- Settings --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon">
                            <i class="bi bi-gear"></i>
                        </span>

                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>

