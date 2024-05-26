<nav class="navbar-wrap">
    <div class="menubar-footer">
        <a href="{{ url('/home') }}">
            <button class="btn-menubar">
                <i class="fa fa-home menu-icon {{ $menu == 'home' ? 'menu-icon-active' : '' }}"></i>
                <span class="text-icon {{ $menu == 'home' ? 'text-icon-active' : '' }}">Menu</span>
            </button>
        </a>
        @guest
            <a href="javascript:void(0)">
                <button class="btn-menubar" data-mdb-toggle="modal" data-mdb-target="#modalLogin">
                    <i class="fa fa-user menu-icon"></i>
                    <span class="text-icon">Profil</span>
                </button>
            </a>
        @else
            <a href="#">
                <button class="btn-menubar">
                    <i class="fa fa-shopping-cart menu-icon"></i>
                    <span class="text-icon">Cart</span>
                </button>
            </a>
            <a href="#">
                <button class="btn-menubar">
                    <i class="fa fa-users menu-icon"></i>
                    <span class="text-icon">History</span>
                </button>
            </a>
            <a href="javascript:void(0)">
                <button class="btn-menubar" data-mdb-toggle="modal" data-mdb-target="#modalAkun">
                    <i class="fa fa-user menu-icon {{ $menu == 'account' ? 'menu-icon-active' : '' }}"></i>
                    <span class="text-icon {{ $menu == 'account' ? 'text-icon-active' : '' }}">Profile</span>
                </button>
            </a>
        @endguest
    </div>
</nav>