<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Order</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         
   
      <!-- cart -->
      <div class="cart-page">
         
         <div class="card mt-5">
            <div class="row">
                <div class="col-md-12 cart">
                
            <table class="table">
                <h2>  Order  </h2>
                <tbody>
                    <tr>
                    <td> Order Id </td>
                    <td> @php echo rand(9,9999)  @endphp</td>
                    </tr>
                    <tr>
                    <td>Address</td>
                    <td>{{auth()->user()->address}}</td>
                    </tr>
                    <tr>
                    <td>Order status</td>
                    <td>Confirmed</td>
                    </tr>
    
                </tbody>
                </table>
            </div>
            
        </div>
        </div>
      <!-- footer start -->
       @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      
   </body>
</html>