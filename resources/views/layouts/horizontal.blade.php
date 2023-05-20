<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="20">
                    </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="@lang('translation.Search')...">
                    <span class="uil-search"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="@lang('translation.Search')..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- bahasa --}}
            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @switch(Session::get('lang'))
                        @case('id')
                            <img src="{{ URL::asset('/assets/images/flags/id.png') }}" alt="Header Language" height="16">
                            <span class="align-middle">Indonesia</span>
                        @break

                        @default
                            <img src="{{ URL::asset('/assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
                            <span class="align-middle">English</span>
                    @endswitch
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="{{ url('index/en') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">English</span>
                    </a>
                    {{-- lange indonesia --}}
                    <a href="{{ url('index/id') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('assets/images/flags/id.png') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">Indonesia</span>
                    </a>

                </div>
            </div>
            {{-- endbahasa --}}

            {{-- mode option --}}
            <div class="dropdown d-inline-block">
                @if (Session::get('layout') == 'dark')
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        onclick="window.location.href='{{ url('layout', 'light') }}'">
                        <i class="uil-brightness"></i>
                    </button>
                @else
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        onclick="window.location.href='{{ url('layout', 'dark') }}'">
                        <i class="uil-brightness-half"></i>
                    </button>
                @endif
            </div>
            {{-- end mode option --}}

            {{-- aplikasi --}}
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="uil-apps"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="px-lg-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="{{ route('registration') }}">
                                    <img src="{{ URL::asset('/assets/images/brands/registration.svg') }}"
                                        alt="@lang('menu.registration')" style="width: 50px; height: 50px;">
                                    <span>@lang('menu.registration')</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('/assets/images/brands/tracking.svg') }}"
                                        alt="@lang('menu.tracker')" style="width: 50px; height: 50px;">
                                    <span>@lang('menu.tracker')</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('/assets/images/brands/medicine.svg') }}"
                                        alt="@lang('menu.rekam_medis')" style="width: 50px; height: 50px;">
                                    <span>@lang('menu.rekam_medis')</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="{{ route('list.queue') }}">
                                    <img src="{{ URL::asset('/assets/images/brands/queue.svg') }}"
                                        alt="@lang('menu.queue')" style="width: 50px; height: 50px;">
                                    <span>@lang('menu.queue')</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('/assets/images/brands/monitor.svg') }}"
                                        alt="@lang('menu.monitor')" style="width: 50px; height: 50px;">
                                    <span>@lang('menu.monitor')</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end aplikasi --}}

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="uil-minus-path"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="uil-bell"></i>
                    <span class="badge bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> @lang('translation.Notifications') </h5>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> @lang('translation.Mark_read')</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="uil-shopping-basket"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-1">@lang('translation.order_placed')</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.languages_grammar')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.3_min_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <img src="{{ URL::asset('/assets/images/users/avatar-3.jpg') }}"
                                        class="rounded-circle avatar-xs" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.simplified_English')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.1_hours_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="uil-truck"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-1">@lang('translation.item_shipped')</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.languages_grammar')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.3_min_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <img src="{{ URL::asset('/assets/images/users/avatar-4.jpg') }}"
                                        class="rounded-circle avatar-xs" alt="user-pic">
                                </div>
                                <div class="flex-1">
                                    <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.friend_occidental')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.1_hours_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="uil-arrow-circle-right me-1"></i> @lang('translation.View_More')..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ URL::asset('/assets/images/users/avatar-4.jpg') }}" alt="Header Avatar">
                    <span
                        class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ Str::ucfirst(Auth::user()->name) }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">@lang('translation.View_Profile')</span></a>
                    <a class="dropdown-item" href="#"><i
                            class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.My_Wallet')</span></a>
                    <a class="dropdown-item d-block" href="#"><i
                            class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.Settings')</span> <span
                            class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span></a>
                    <a class="dropdown-item" href="#"><i
                            class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.Lock_screen')</span></a>
                    <a class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.Sign_out')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            {{-- setting --}}
            @if (auth()->user()->role == 'user')
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        onclick="window.location.href='{{ route('setting') }}'">
                        <i class="uil-cog"></i>
                    </button>
                </div>
            @endif
            {{-- end setting --}}
        </div>
    </div>
    <div class="container-fluid">
        <div class="topnav">

            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="uil-home-alt me-2"></i> @lang('translation.Dashboard')
                            </a>
                        </li>

                        @if (auth()->user()->role == 'admin')
                            {{-- menu master data --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement"
                                    role="button">
                                    <i class="uil-flask me-2"></i>@lang('menu.master_data') <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                                    aria-labelledby="topnav-uielement">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div>
                                                <a href="{{ url('pages/master/user') }}"
                                                    class="dropdown-item">@lang('menu.pengguna')</a>
                                                <a href="{{ url('pages/master/doctor') }}"
                                                    class="dropdown-item">@lang('menu.dokter')</a>
                                                <a href="{{ url('pages/master/patient') }}"
                                                    class="dropdown-item">@lang('menu.pasien')</a>
                                                <a href="{{ url('pages/master/medicine') }}"
                                                    class="dropdown-item">@lang('menu.obat')</a>
                                                <a href="{{ url('pages/master/room') }}"
                                                    class="dropdown-item">@lang('menu.kamar')</a>
                                                <a href="{{ url('pages/master/specialist') }}"
                                                    class="dropdown-item">@lang('menu.spesialis')</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            {{-- end menu master data --}}
                        @endif

                        {{-- aplikasi --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages"
                                role="button">
                                <i class="uil-apps me-2"></i>@lang('menu.apps') <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                <a href="{{ route('registration') }}" class="dropdown-item">@lang('menu.registration')</a>
                                <a href="calendar" class="dropdown-item">@lang('menu.tracker')</a>
                                <a href="calendar" class="dropdown-item">@lang('menu.rekam_medis')</a>
                                <a href="calendar" class="dropdown-item">@lang('menu.queue')</a>
                                <a href="calendar" class="dropdown-item">@lang('menu.monitor')</a>
                            </div>
                        </li>
                        {{-- end aplikasi --}}

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
