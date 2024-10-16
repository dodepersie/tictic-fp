<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header d-flex justify-content-center align-items-center">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="{{ asset('/assets/img/TicTic Logo.png') }}" alt="TicTic Logo" />
        </a>
    </div>

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <div class="icon icon-shape border-radius-md text-center me-1 d-flex align-items-center justify-content-center"
                        style="width: 36px;height: 36px;">
                        <i data-feather="home"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            @can('admin')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">User Management</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'dashboard_merchants.index' ? 'active' : '' }}"
                        href="{{ route('dashboard_merchants.index') }}">
                        <div class="icon icon-shape border-radius-md text-center me-1 d-flex align-items-center justify-content-center"
                            style="width: 36px;height: 36px;">
                            <i data-feather="users"></i>
                        </div>
                        <span class="nav-link-text ms-1">Merchants</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Management</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'dashboard_categories') ? 'active' : '' }}"
                        href="{{ route('dashboard_categories.index') }}">
                        <div class="icon icon-shape border-radius-md text-center me-1 d-flex align-items-center justify-content-center"
                            style="width: 36px;height: 36px;">
                            <i data-feather="tag"></i>
                        </div>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <div class="icon icon-shape border-radius-md text-center me-1 d-flex align-items-center justify-content-center"
                            style="width: 36px;height: 36px;">
                            <i data-feather="bar-chart-2"></i>
                        </div>
                        <span class="nav-link-text ms-1">View Analytics Report</span>
                    </a>
                </li>
            @endcan

            @can('merchant')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Event Management</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'merchant_events') ? 'active' : '' }}"
                        href="{{ route('merchant_events.index') }}">
                        <div class="icon icon-shape border-radius-md text-center me-1 d-flex align-items-center justify-content-center"
                            style="width: 36px;height: 36px;">
                            <i data-feather="list"></i>
                        </div>
                        <span class="nav-link-text ms-1">View your events</span>
                    </a>
                </li>
            @endcan

            @can('customer')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Transactions</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'dashboard_transactions.index') ? 'active' : '' }}"
                        href="{{ route('dashboard_transactions.index') }}">
                        <div class="icon icon-shape border-radius-md text-center me-1 d-flex align-items-center justify-content-center"
                            style="width: 36px;height: 36px;">
                            <i data-feather="list"></i>
                        </div>
                        <span class="nav-link-text ms-1">All transactions</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Profile Management</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile.index' ? 'active' : '' }}"
                    href="{{ route('profile.index') }}">
                    <div class="icon icon-shape border-radius-md text-center me-1 d-flex align-items-center justify-content-center"
                        style="width: 36px;height: 36px;">
                        <i data-feather="user"></i>
                    </div>
                    <span class="nav-link-text ms-1">Edit profile</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
