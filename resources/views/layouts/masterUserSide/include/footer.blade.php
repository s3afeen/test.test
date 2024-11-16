<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="/home"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="/shop"><i class="fa fa-angle-right mr-2"></i>Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="/contact"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                            <!-- <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a> -->
                            <!-- <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a> -->
                        </div>
                    </div>


                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                                @auth
                                    <!-- يظهر عند تسجيل الدخول -->
                                    <a class="text-secondary mb-2" href="">Account Settings</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="text-secondary mb-2" href="{{ route('login') }}">Logout</a>
                                    </form>
                                @else
                                    <!-- يظهر عند عدم تسجيل الدخول -->
                                    <a class="text-secondary mb-2" href="{{ route('login') }}">Login</a>
                                    <a class="text-secondary mb-2" href="{{ route('register') }}">Sign up</a>
                                @endauth
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                         <h5 class="text-secondary text-uppercase mb-4">Follow Us</h5>
                        <div class="d-flex">
                            <!-- <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter" target="_blank"></i></a> -->
                            <!-- <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f" target="_blank"></i></a> -->
                            <!-- <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in" target="_blank"></i></a> -->
                            <a class="btn btn-primary btn-square" href="https://www.instagram.com/karajstore.jo/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                        <a class="btn " href="https://www.instagram.com/karajstore.jo/" target="_blank"><i class=""></i></a>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Aqaba, Jo</p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>karajstore@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="#">Kraj Store</a>
                </p>
            </div>
            <!-- <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div> -->
        </div>
    </div>
