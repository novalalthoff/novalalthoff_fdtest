<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{ url('') }}">
                <img class="img-fluid for-light" src="{{ asset('favicon.ico') }}" width="40%" alt="">
                <img class="img-fluid for-dark" src="{{ asset('favicon.ico') }}" width="40%" alt="">
            </a>
            <div class="back-btn"><i class="fa-solid fa-angle-left"></i></div>
            {{-- <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div> --}}
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">

                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa-solid fa-thumbtack"></i>
                        <a class="sidebar-link sidebar-title {{ request()->routeIs('landing') ? 'c-active' : '' }}" href="{{ url('') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg>
                            <span>Landing</span>
                        </a>
                    </li>

                    @if (Auth::check())
                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title {{ request()->routeIs('home') ? 'c-active' : '' }}" href="{{ url('home') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                </svg>
                                <span>Home</span>
                            </a>
                        </li>

                        <li class="sidebar-main-title">
                            <div>
                                <h6>Master Data</h6>
                            </div>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title {{ request()->routeIs('user') ? 'c-active' : '' }}" href="{{ route('user') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                                </svg>
                                <span>User List</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa-solid fa-thumbtack"></i>
                            <a class="sidebar-link sidebar-title {{ request()->routeIs('book') ? 'c-active' : '' }}" href="{{ route('book') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                                </svg>
                                <span>Book Management</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
