<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    <a href="/shop?category=5" class="nav-item nav-link">Headphones</a>
                    <a href="/shop?category=6" class="nav-item nav-link">Charger</a>
                    <a href="/shop?category=7" class="nav-item nav-link">Charger Cable</a>
                    <a href="/shop?category=8" class="nav-item nav-link">Charger For Car</a>
                </div>
            </nav>
        </div>

        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="{{ url('/home') }}" class="text-decoration-none d-block d-lg-none">
                    <img src="{{asset('img/logoslo111.png')}}" alt="test" class='w-50'>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ url('/home') }}" class="nav-item nav-link {{ Request::is('home') ? 'active' : '' }}">Home</a>
                        <a href="{{ url('/shop') }}" class="nav-item nav-link {{ Request::is('shop') ? 'active' : '' }}">Shop</a>
                        <a href="{{ route('contacts.index') }}" class="nav-item nav-link {{ Request::routeIs('contacts.index') ? 'active' : '' }}">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        @auth
                            <!-- <a href="{{ route('wishlist.index') }}" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                    {{ Auth::user()->wishlists()->count() }}
                                </span>
                            </a> -->
                            <a href="{{ route('cart.index') }}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                    {{ $productsCount ?? 0 }}
                                </span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        @endauth

                        <div class="btn-group ml-3">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                @auth
                                    <a class="dropdown-item" href="/account-settings">Account Settings</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                @else
                                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                    <a class="dropdown-item" href="{{ route('register') }}">Sign up</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
