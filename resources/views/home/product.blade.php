<section class="product_section layout_padding" id="menu-about">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">
               @foreach($product as $products)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('/product-detail',$products->id)}}" class="option1">
                          View More
                           </a>
                          
                           <form action="{{url('cart-page',$products->id)}}" method="post">
                                   @csrf
                              <input class="form-control" type="number" min="1" max="5" name="quantity" value="1">
                              <input type="submit" name="submit" value="Add to cart">
                           </form>
                        
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product-image/{{$products-> image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                          {{$products-> title}}
                        </h5>
                       @if($products-> discount_price !== '')
                        <h6 style="text-decoration: line-through;">
                          ₹{{$products-> price}}
                        </h6>
                         <h6>
                          ₹{{$products-> discount_price}}
                        </h6>
                        @else 
                         <h6>
                          ₹{{$products-> price}}
                        </h6>
                        @endif
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </section>