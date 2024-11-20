<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.masterUserSide.include.top')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
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


    <!-- Before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

    @include('layouts.masterUserSide.include.bottom')

</body>

</html>
