<div class="dashboard-sidebar bg-white border-end shadow-sm">

    <!-- Mobile Close -->
    <button type="button"
            class="btn btn-light rounded-circle position-absolute top-0 end-0 m-3 d-lg-none d-flex align-items-center justify-content-center"
            style="width: 38px; height: 38px;">

        <i class="bi bi-x-lg text-dark"></i>

    </button>

    <div class="dashboard-sidebar__inner d-flex flex-column h-100 p-4">

        <!-- Logo -->
        <div class="mb-5">

            <a href="{{ url('/') }}"
               class="d-flex align-items-center text-decoration-none">

                <div class="sidebar-logo-icon me-3">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>

                <div>
                    <h5 class="fw-bold text-dark mb-0">
                        Pulse
                    </h5>

                    <small class="text-muted">
                        User Panel
                    </small>
                </div>

            </a>

        </div>

        <!-- Navigation -->
        <ul class="nav flex-column gap-2">

            <!-- Dashboard -->
            <li class="nav-item">

                <a href="#"
                   class="nav-link sidebar-link active">

                    <div class="sidebar-icon sidebar-primary">
                        <i class="bi bi-grid-1x2-fill"></i>
                    </div>

                    <span>
                        Dashboard
                    </span>

                </a>

            </li>

            <!-- Profile -->
            <li class="nav-item">

                <a href="{{ route('profile') }}"
                   class="nav-link sidebar-link">

                    <div class="sidebar-icon sidebar-info">
                        <i class="bi bi-person-circle"></i>
                    </div>

                    <span>
                        Profile
                    </span>

                </a>

            </li>

            <!-- Settings -->
            <li class="nav-item">

                <a href="#"
                   class="nav-link sidebar-link">

                    <div class="sidebar-icon sidebar-warning">
                        <i class="bi bi-sliders"></i>
                    </div>

                    <span>
                        Settings
                    </span>

                </a>

            </li>

            <!-- Orders -->
            <li class="nav-item">

                <a href="#"
                   class="nav-link sidebar-link">

                    <div class="sidebar-icon sidebar-success">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>

                    <span>
                        Orders
                    </span>

                </a>

            </li>

            <!-- Wishlist -->
            <li class="nav-item">

                <a href="#"
                   class="nav-link sidebar-link">

                    <div class="sidebar-icon sidebar-danger">
                        <i class="bi bi-heart-fill"></i>
                    </div>

                    <span>
                        Wishlist
                    </span>

                </a>

            </li>

        </ul>

        <!-- Logout -->
        <div class="mt-auto pt-4">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="btn btn-light border w-100 rounded-4 d-flex align-items-center justify-content-center gap-2 py-3 fw-semibold text-danger logout-btn">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </button>

            </form>

        </div>

    </div>

</div>

<style>

    .dashboard-sidebar{
        width: 290px;
        min-height: 100vh;
        position: sticky;
        top: 0;
        background: #ffffff;
    }

    /* Logo */

    .sidebar-logo-icon{
        width: 48px;
        height: 48px;

        border-radius: 16px;

        background: linear-gradient(135deg,#0d6efd,#6ea8fe);

        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;

        box-shadow: 0 10px 20px rgba(13,110,253,.18);
    }

    /* Links */

    .sidebar-link{
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 12px 14px;

        border-radius: 18px;

        color: #1e293b !important;

        font-weight: 600;

        transition: all .22s ease;
    }

    .sidebar-link:hover{
        background: #f8fafc;
        transform: translateX(4px);
    }

    .sidebar-link.active{
        background: rgba(13,110,253,.08);
        color: #0d6efd !important;
    }

    /* Icons */

    .sidebar-icon{
        width: 44px;
        height: 44px;

        border-radius: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 19px;

        flex-shrink: 0;

        transition: all .2s ease;
    }

    .sidebar-link:hover .sidebar-icon{
        transform: scale(1.05);
    }

    /* Icon Colors */

    .sidebar-primary{
        background: rgba(13,110,253,.12);
        color: #0d6efd;
    }

    .sidebar-info{
        background: rgba(13,202,240,.12);
        color: #0dcaf0;
    }

    .sidebar-warning{
        background: rgba(255,193,7,.14);
        color: #f59f00;
    }

    .sidebar-success{
        background: rgba(25,135,84,.12);
        color: #198754;
    }

    .sidebar-danger{
        background: rgba(220,53,69,.12);
        color: #dc3545;
    }

    /* Logout */

    .logout-btn{
        transition: all .2s ease;
    }

    .logout-btn:hover{
        background: rgba(220,53,69,.08);
        border-color: rgba(220,53,69,.15);
    }

</style>
