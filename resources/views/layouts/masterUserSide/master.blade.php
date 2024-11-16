<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.masterUserSide.include.top')
</head>

<body>
    <!-- Topbar Start -->
  @include('layouts.masterUserSide.include.topBody')
    <!-- Topbar End -->


    <!-- Navbar Start -->
  @include('layouts.masterUserSide.include.nav')
    <!-- Navbar End -->

    @yield('content')



    <!-- Footer Start -->
    @include('layouts.masterUserSide.include.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a> -->

    @include('layouts.masterUserSide.include.bottom')

</body>

</html>
