@if (Route::has('login'))
                         @auth

  
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.style')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->

         @include('admin.nav')
      <!-- partial -->
       @include('admin.body')
      <!-- page-body-wrapper ends -->

    </div>
    </div>
   @include('admin.adminfooter')

                       @else
                       
                        @endauth
                        @endif