<div class="container-fluid p-0">
    <div class="w-100 row g-0 bg-dark py-1 px-xl-5 m-0">
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center d-lg-none">
                <div class="btn-group">
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

                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 row align-items-center bg-dark py-3 px-xl-5 d-none d-lg-flex g-0 m-0">
        <div class="col-lg-4">
            <a href="home" class="text-decoration-none">
                <img src="{{asset('img/logoslo111.png')}}" alt="test" class='w-50'>
            </a>
        </div>

        <div class="col-lg-4 col-6 text-left">
            <form action="{{ route('shop') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for products" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4 col-6 text-right">
            <h5 class="m-0" style="color: #fff;">" Quality Is The Secret Of Success "</h5>
        </div>
    </div>
</div>
