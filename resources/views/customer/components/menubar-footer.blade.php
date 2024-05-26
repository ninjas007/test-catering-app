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
            @if (auth()->user()->role == 'customer')
                <a href="{{ url('cart') }}">
                    <button class="btn-menubar">
                        <div style="position: relative; top: 0; right: 0">
                            <span id="cartTotal"
                                style="background-color: #f1f1f1; border-radius: 50%; padding: 2px 5px; position: absolute; top: -5px">0</span>
                        </div>
                        <i class="fa fa-shopping-cart menu-icon"></i>
                        <span class="text-icon">Cart</span>
                    </button>
                </a>
                <a href="{{ url('customer-order') }}">
                    <button class="btn-menubar">
                        <i class="fa fa-users menu-icon"></i>
                        <span class="text-icon">Orders</span>
                    </button>
                </a>
            @endif
            <a href="javascript:void(0)">
                <button class="btn-menubar" data-mdb-toggle="modal" data-mdb-target="#modalAkun">
                    <i class="fa fa-user menu-icon {{ $menu == 'account' ? 'menu-icon-active' : '' }}"></i>
                    <span class="text-icon {{ $menu == 'account' ? 'text-icon-active' : '' }}">Profile</span>
                </button>
            </a>
        @endguest
    </div>
</nav>
