<div>
    <div class="container">
        <div class="header-wrap header-space-between position-relative">
            <div class="logo logo-width-1 d-block d-lg-none">
                <a href="{{ route('home.index') }}"><img src="{{ asset('assets/imgs/logo/logo.png') }}" alt="logo"></a>
            </div>
            <div class="header-nav d-none d-lg-flex">
                <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                    <nav>
                        <ul>
                            @foreach($last_menu_values as $value)
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ $value['link'] }}">{{ $value['name'] }}</a>
                            @endforeach
                            @auth
                                <li><a href="#">My Account<i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('admin.orders') }}">Orders</a></li>
                                        <li><a href="{{ route('admin.products') }}">Products</a></li>
                                        <li><a href="{{ route('admin.categories') }}">Categories</a></li>
                                        <li><a href="{{ route('admin.info-pages') }}">Info Pages</a></li>
                                        <li><a href="{{ route('admin.menu.edit') }}">Menu</a></li>
                                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>

                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}">Log In</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="header-action-right d-block d-lg-none">
                <div class="header-action-2">
                    <div class="header-action-2">
                        @livewire('cart-icon-component')
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
