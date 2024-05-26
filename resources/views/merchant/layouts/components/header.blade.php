<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#"
                    data-toggle="sidebar"
                    class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#"
                    data-toggle="search"
                    class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>

        {{-- @include('backend.components.elements.search-element') --}}

    </form>
    <ul class="navbar-nav navbar-right">

        {{-- @include('backend.components.elements.message-element') --}}

        {{-- @include('backend.components.elements.notification-element') --}}

        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="{{ asset('/img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ url('merchant/profile') }}"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form action="{{ route('logout') }}" method="post" style="display: none" id="logout-form">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
