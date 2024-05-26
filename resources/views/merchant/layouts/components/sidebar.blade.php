<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('merchant/profile') }}">{{ config('app.app_name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('merchant/profile') }}">{{ config('app.short_app_name') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item {{ $type_menu === 'profile' ? 'active' : '' }}">
                <a href="{{ url('merchant/profile') }}"
                    class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="nav-item {{ $type_menu === 'menu' ? 'active' : '' }}">
                <a href="{{ url('merchant/menu') }}"
                    class="nav-link"><i class="fas fa-hamburger"></i><span>Menu</span></a>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
             <li class="nav-item {{ $type_menu === 'order' ? 'active' : '' }}">
                 <a href="{{ url('merchant/order') }}"
                     class="nav-link"><i class="fas fa-list"></i><span>Order</span></a>
                 </ul>
             </li>
         </ul>
        {{-- <ul class="sidebar-menu">
            <li class="nav-item {{ $type_menu === 'customer' ? 'active' : '' }}">
                <a href="{{ url('merchant/customer') }}"
                    class="nav-link"><i class="fas fa-users"></i><span>Customer</span></a>
                </ul>
            </li>
        </ul> --}}
    </aside>
</div>
