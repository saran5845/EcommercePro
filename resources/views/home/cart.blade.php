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
      <title>Cart</title>
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
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>Shopping Cart</b></h4></div>
                            
                        </div>
                    </div>   
                    <form id="cart-update-c" action="{{url('update-cart')}}" method="post">
                     @csrf
                        {{-- Data will apned here --}}
                    <div class="row border-top border-bottom" id="cart-append">
                      
                    </div>
                           
                   
                    <input type="submit" id="update-cart" name="cart-update" value="Update Cart">
                    </form>
                   
                    <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
                </div>
                <div class="col-md-4 summary">
                    <div><h5><b>Summary</b></h5></div>
                    <hr>
                    <div id="cart-summary">
                    
                 </div>
                  <form action="{{route('make.order')}}" method="post">
                  @csrf
            <input type="hidden" name="check-amount" value="100">
        
              </form>
                </div>
            </div>
            
        </div>
        </div>
      <!-- subscribe section -->
      @include('home.newsletter')
      <!-- end subscribe section -->
      <!-- client section -->
       @include('home.testimonial')
      <!-- end client section -->
      <!-- footer start -->
       @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
      <script src="js\admin.js"></script>
      <script>
     
          /** cart update **/
     $('#cart-update-c').on('submit', function (e) {
      e.preventDefault();        
        var id = $('#edit_id').val();
        jQuery('#extra-updated').remove();
         var formData = new FormData(this);  
         var form_data = [];
         jQuery('#cart-update-c input[name=quantity]').each(function(index){
            var val = jQuery(this).val();
            var id = jQuery(this).attr('id');
               form_data.push([id,val]);                
         });
        
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

              $.ajax({
             type:'POST',
             url:'/cart-update',
             data: {data: form_data},
            dataType: 'JSON',
             success: function(response){
               if(response.status == 200)
               fetchcart();
             jQuery('#update-cart').after('<h2 class="title" id="extra-updated"><b> Cart Updated </b>  </h2>');
             }

         });
      });
       
          /** End cart update **/
     /** cart item delete **/
       jQuery(document).ready(function(){
        jQuery('body').on('click','#cart-update-c .close', function(){
            var del_id = jQuery(this).attr('id');
            
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                 });  

                $.ajax({
                   type:'DELETE',
                   url:'/delete-cart/'+del_id,
                   success:function(data) {
                     if(data.status == 200){
                        fetchcart();
                     }

                   }
                });
        })
       });
     /** End cart item delete**/
            function fetchcart(){
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
              $.ajax({
                 type:'GET',
                 url:'/cart-fetch',
                  success: function(response){
                         jQuery('#cart-append').html("");
                           var total_price = 0;
                           var count = response.cart_data.length;
                           if(count === 0){
                               jQuery('.card .row').html('');
                               jQuery('.card .row').html(' <div class="col-md-8 cart">Your Cart is empty</div>');

                           }
                           else{
                          $.each(response.cart_data, function (key, cart_data) {
                           if(cart_data.sale_price){
                              
                              var sale_price = '<div class="col-3">₹  '+cart_data.sale_price * cart_data.quantity+'<div> Single Item:'+cart_data.sale_price+'</div></div><div class="close" id="'+cart_data.id+'">&#10005;</div>';
                               total_price =  total_price + cart_data.sale_price * cart_data.quantity; 
                           }
                           else{
                              var sale_price = '<div class="col-3">₹ '+cart_data.price * cart_data.quantity+'<div> Single Item:'+cart_data.price+'</div></div><div class="close" id="'+cart_data.id+'">&#10005;</div>';
                               total_price =  total_price + cart_data.price * cart_data.quantity; 
                           }
                           
                        jQuery('#cart-append').append('<div class="row border-top border-bottom col-12"><div class="row main align-items-center col-12"><div class="col-3"><img class="img-fluid" src="/product-image/'+cart_data.image+'"></div><div class="col=3"><div class="row text-muted">Shirt</div><div class="row">'+cart_data.product_title+'</div></div>\
                            <div class="col-3">\
                            <input class="form-control" type="number" name="quantity" id="'+cart_data.id+'" min="1" max="5" value="'+cart_data.quantity+'"></div>'+sale_price+'</div>');
                        jQuery('#cart-summary').html('<div class="row">\
                        <div class="col" style="padding-left:0;">ITEMS '+count+'</div>\
                    </div>\
                    <div class="row" padding: 2vh 0;">\
                        <div class="col">TOTAL PRICE</div>\
                        <div class="col text-right">₹'+total_price+'</div>\
                     </div><!-- <form action="{{url("checkout")}}" method="get">-->\
                    <!--<input type="hidden" name="_token" value="'+csrf_token+'">-->\
            <input type="hidden" name="check-amount" value="'+total_price+'">\
        <!-- <button class="btn btn-primary" type="submit" >Make Payment</button> -->\
           <a href="/checkout" class="btn btn-primary">Checkout</a>\
              <!--</form>-->');
                                                
                });                          

        }
    }
        });
           }
         
        jQuery(document).ready(function(){
               fetchcart();
        });
          
      </script>
   </body>
</html>