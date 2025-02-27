<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-lg-none">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>                    
            <li class="nav-item d-none d-lg-block">

            </li>
        </ul>
        <div class="d-block d-lg-none">
            <img src="{{ asset('smk.png') }}" class="dark-logo" width="50" alt="" />
            <img src="{{ asset('smk.png') }}" class="light-logo" width="50" alt="" />
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="user-profile-img">
                                    {{-- <img src="../../assets/dist/images/profile/user-1.jpg" class="rounded-circle"
                                        width="35" height="35" alt="" /> --}}
                                    <img src="{{ asset('profile.jpg') }}" class="rounded-circle"
                                    width="35" height="35" alt="profile">
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop1">
                            <div class="profile-dropdown position-relative" data-simplebar>
                                <div class="py-3 px-7 pb-0">
                                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                </div>
                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                    {{-- <img src="../../assets/dist/images/profile/user-1.jpg" class="rounded-circle"
                                        width="80" height="80" alt="" /> --}}
                                        <img src="{{ asset('profile.jpg') }}" alt="profile" class="rounded-circle"
                                        width="80" height="80">
                                    <div class="ms-3">
                                        <h5 class="mb-1 fs-3">{{ auth()->user()->name }}</h5>
                                        <span class="mb-1 d-block text-dark">RPL</span>
                                        <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                            <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="d-grid py-4 px-7 pt-8">
                                    @guest
                                        @if (Route::has('login'))
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        @endif

                                        @if (Route::has('register'))
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endif
                                    @else
                                        <a class="btn btn-outline-primary" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
