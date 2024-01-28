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
      <title>Checkout</title>
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
         <div class="card">
            <div class="row">
                <div class="col-md-12 cart">
                   
                  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <ul class="list-group mb-3">
         @php
             $total_price = 0;
         @endphp
         @foreach($cart as $carts)                       
                
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{$carts->product_title}}</h6>
            
          </div>
          @if($carts->sale_price !== '')
          <span class="text-muted">₹{{$carts->sale_price}}<div>{{$carts->quantity}}</div></span>
          @php  
          $total_price+= $carts->sale_price*$carts->quantity; 
          @endphp
          @else 
          <span class="text-muted">₹{{$carts->price}}<div> {{$carts->quantity}}</div></span>
          <span></span>
          @php 
          $total_price+= $carts->sale_price*$carts->quantity; 
          @endphp
        @endif
        </li>

        @endforeach
        
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>₹<?php  echo $total_price;   ?></strong>
        </li>
      </ul>

      {{-- Payment --}}

      <hr class="mb-4">

        <h4 class="mb-3">Payment</h4>
    
        <div class="mt-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
            <label class="custom-control-label" for="credit">Razorpay</label>
          </div>
        
        </div>
        <hr class="mb-4">   
         <!-- <form action="{{route('make.order')}}" method="post"> -->
            
        <!-- <button class="btn btn-primary" type="submit" >Make Payment</button> -->
        <button class="btn btn-primary"  id="rzp-button1">Make Payment</button>
    <!-- </form> -->
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" method="post" action="{{route('user.detail')}}">
        @csrf
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="firstName">Full Name</label>
            <input type="text" class="form-control" name="firstname"id="firstName" placeholder="" value="{{auth()->user()->name}}" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted"></span></label>
          <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="{{auth()->user()->email}}" required>
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>
           <div class="mb-3">
          <label for="phone">Phone</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="" value="{{auth()->user()->phone}}">
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="" value="{{auth()->user()->address}}">
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="country" id="country" required="">
              <option value="india">India</option>
              
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State or UT</label>
            <select class="custom-select d-block w-100" name="state" id="state" required="">
                <option value="" selected disabled>Choose...</option>
                <option>Andhra Pradesh</option>
                <option>Arunachal Pradesh</option>
                <option>Assam</option>
                <option>Bihar</option>
                <option>Chhattisgarh</option>
                <option>Goa</option>
                <option>Gujarat</option>
                <option>Haryana</option>
                <option>Himachal Pradesh</option>
                <option>Jharkhand</option>
                <option>Karnataka</option>
                <option>Kerala</option>
                <option>Maharashtra</option>
                <option>Madhya Pradesh</option>
                <option>Manipur</option>
                <option>Meghalaya</option>
                <option>Mizoram</option>
                <option>Nagaland</option>
                <option>Odisha</option>
                <option>Punjab</option>
                <option>Rajasthan</option>
                <option>Sikkim</option>
                <option>Tamil Nadu</option>
                <option>Tripura</option>
                <option>Telangana</option>
                <option>Uttar Pradesh</option>
                <option>Uttarakhand</option>
                <option>West Bengal</option>
                <option>Andaman & Nicobar (UT)</option>
                <option>Chandigarh (UT)</option>
                <option>Dadra & Nagar Haveli and Daman & Diu (UT)</option>
                <option>Delhi [National Capital Territory (NCT)]</option>
                <option>Jammu & Kashmir (UT)</option>
                <option>Ladakh (UT)</option>
                <option>Lakshadweep (UT)</option>
                <option>Puducherry (UT)</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" name="zip" id="zip" placeholder="" required="">
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <input type="submit" name="save-user" value="Save">
           @if (\Session::has('status') == 200)
    <div class="alert alert-success">
        <ul>
            <li>Information Updated Successfully</li>
        </ul>
    </div>
@endif
      </form>
    </div>
  </div>
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
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
      <script src="js\admin.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_test_KOzTk3J5C7Rlkx", // Enter the Key ID generated from the Dashboard
    "amount": "<?php  echo $total_price*100; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Ecommerce",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    //"order_id": "{{$rozarpayorder->notes->orderid}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        console.log(response);
        window.location ='{{route("order.success")}}';
    },
    "prefill": {
        "name": "Ecommerce",
        "email": "admin@ecommercepro",
        "contact": "9000090000"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        console.log(response.error.code);
        console.log(response.error.description);
         console.log(response.error.source);
         console.log(response.error.step);
         console.log(response.error.reason);
         console.log(response.error.metadata.order_id);
         console.log(response.error.metadata.payment_id);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

   </body>
</html>