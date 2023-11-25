<div>
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ route('home.index') }}"><img src="{{ asset('assets/imgs/logo/logo.png') }}" alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        @foreach($last_menu_values as $value)
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ $value['link'] }}">{{ $value['name'] }}</a>
                        @endforeach
                        @auth
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">My Account</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.orders') }}">Orders</a></li>
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.products') }}">Products</a></li>
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.categories') }}">Categories</a></li>
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.info-pages') }}">Info Pages</a></li>
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.menu.edit') }}">Menu</a></li>
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('login') }}">Log In</a></li>
                        @endif
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
        </div>
    </div>
</div>
