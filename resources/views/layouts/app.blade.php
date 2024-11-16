<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.include.top')

  </head>
  <body>
    <div class="container-scroller">

      <!--navbar-->
    @include('layouts.include.nav')


      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!--sidebar-->
    @include('layouts.include.side')


        <!-- partial -->
        <div class="main-panel">
          @yield('content')

          <!-- content-wrapper ends -->
          <!--footer-->
          @include('layouts.include.footer')

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('layouts.include.bottom')




    <!-- End custom js for this page -->
  </body>
</html>
