<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use Session;

class PaymentGateway extends Controller
{
    private $api;
    public function checkout_view(){
        $id = Auth::id();
        $cart = cart::where('user_id','=',$id)->get();
        $orderid = rand(11111,99999);
        $rozarpayorder = $this->api->order->create(array(
            'receipt' => '123', 
            'amount' => 100, 
            'currency' => 'INR',
            'notes'  => [
             'orderid' => $orderid, 
            ],
        )
    ); 
   foreach($cart as $carts){
    if($carts->sale_price){
        $data[] = [$carts->name, $carts->product_title, $carts->sale_price, $carts->quantity , $carts->product_id  ];
    }
    else{
        $data[] = [$carts->name, $carts->product_title, $carts->price, $carts->quantity , $carts->product_id  ];
    }
   }  
    Session::put('echeckout_product',$data);
            if(count($cart) !== 0){
           return view('home.checkout',compact('orderid','rozarpayorder','cart'));
       }
       else {
        return redirect('/');
       }
    }
    public function __construct(){
       $this->api = new Api('rzp_test_KOzTk3J5C7Rlkx', 'euaXMwqD5kQ0wKL4h2M8yhQL');
    }
    public function make_order(Request $request){
        $this->validate($request,['check-amount' => 'required']);
        //$amount = $request
        $this->api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR'));
    }

    public function order_success(){
          $order = new order;
          $order_data = Session::get('echeckout_product');
          $serialize_data =  serialize($order_data);
          $order->user_id = Auth::id();
          $order->order_data = $serialize_data;  
          $order->save();  
          Session::forget('echeckout_product');
          return view('home.order');
    }
}


//Key Id: rzp_test_KOzTk3J5C7Rlkx

//Key Secret: euaXMwqD5kQ0wKL4h2M8yhQL