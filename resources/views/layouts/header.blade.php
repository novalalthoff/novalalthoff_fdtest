<div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
        <div class="form-group w-100">
            <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                    <input
                        class="demo-input Typeahead-input form-control-plaintext w-100"
                        type="text"
                        placeholder="Search Anything Here..."
                        name="q"
                        title=""
                        autofocus
                    >
                    <div class="spinner-border Typeahead-spinner" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
            </div>
        </div>
    </form>

    <div class="header-logo-wrapper col-auto p-0">
        <div class="logo-wrapper">
            <a href="{{ url('/') }}">
                <img class="img-fluid for-light" src="{{ asset('assets/images/favicon.png') }}" width="40%" alt="">
                <img class="img-fluid for-dark" src="{{ asset('assets/images/favicon.png') }}" alt="">
            </a>
        </div>
        <div class="toggle-sidebar">
            <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
        </div>
    </div>

    <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
        @if (Auth::check())
            <ul class="nav-menus">
                <li class="profile-nav onhover-dropdown pe-0 py-0">
                    <div class="d-flex profile-media">
                        <img class="b-r-10" src="{{ asset('assets/images/dashboard/profile.png') }}" alt="">
                        <div class="flex-grow-1">
                            <span>{{ Auth::user()->name }}</span>
                            <p class="mb-0">user<i class="middle fa-solid fa-angle-down ms-2"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="#!" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">
                                <i data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i>
                                <span>LOG OUT</span>
                            </a>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @else
            <div class="d-flex justify-content-end">
                <a href="{{ url('login') }}" class="btn btn-primary f-w-500">
                    LOG IN
                </a>
            </div>
        @endif
    </div>

    <script class="result-template" type="text/x-handlebars-template">
        <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-airplay m-0">
                    <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                    <polygon points="12 15 17 21 7 21 12 15"></polygon>
                </svg>
            </div>
            <div class="ProfileCard-details">
                <div class="ProfileCard-realName">{{ Auth::check() ? Auth::user()->name : "" }}</div>
            </div>
        </div>
    </script>
</div>
