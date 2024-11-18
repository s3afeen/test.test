<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.include.top')
  </head>
  <body>
    <div class="container-scroller d-flex flex-column min-vh-100">
      <!--navbar-->
      @include('layouts.include.nav')

      <!-- partial -->
      <div class="container-fluid page-body-wrapper flex-grow-1 d-flex">
        <!--sidebar-->
        @include('layouts.include.side')

        <!-- partial -->
        <div class="main-panel flex-grow-1 d-flex flex-column">
          @yield('content')
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->

      <!--footer-->
      @include('layouts.include.footer')
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('layouts.include.bottom')
    <!-- End custom js for this page -->
  </body>
</html>
