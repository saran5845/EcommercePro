<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Usermeta;
use App\Models\Cart;
class HomeController extends Controller
{
    public function index(){        
       $product = product::paginate(3);
        return view('home.userpage',compact('product'));
    }
    public function admin(){    
        if( Auth::user()){   
            $usertype = Auth::user()->usertype;
              if($usertype == 1){
                   return view('admin.home');
              }
              else{
                return redirect('/');               
              }
            
           }
           else{
            return redirect('/');
           }      
    }
    public function product_detail($id){
        $product = product::find($id);       
        return view('home.productdetail',compact('product'));
    }

    public function add_carts(Request $request , $id){
        $product_quantity = $request->quantity;
            $product_id = $id;            
            $product =  product::find($id);
            $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
            $cart_product = new Cart;
             if($cart){
                $cart->quantity = $cart->quantity + $product_quantity;                 
                $cart->update();                
             }
             else{
              $cart_product->product_title = $product->title;
              $cart_product->price = $product->price;
              $cart_product->quantity = $product_quantity;
              $cart_product->sale_price = $product->discount_price;
              $cart_product->category = $product->category;
              $cart_product->name = Auth()->user()->name;
              $cart_product->email = Auth()->user()->email;
              $cart_product->image = $product->image;
              $cart_product->product_id = $product->id;
              $cart_product->user_id = Auth()->user()->id;
              $cart_product->save();
              return redirect()->back()->with('message','Product Added Successfully');
          }

              return redirect()->back()->with('message','Product Added Successfully');
    }

    public function view_carts(){
        $id = Auth::id();
        $cart = cart::where('user_id','=',$id)->get();
            return view('home.cart',compact('cart'));
            return response()->json([
                   'cart_data' =>$cart,
                ]);
    }

    public function fetch_cart(){
         $id = Auth::id();
        $cart = cart::where('user_id','=',$id)->get();
                 return response()->json([
                   'cart_data' =>$cart,
                ]);
    }

     public function cart_update(Request $request){
     $get = $request->data;
     $result = false;
     foreach($get as $key => $val){
          foreach($val as $k => $v){
             $cart = Cart::find($val[0]);
                if($cart){
                   
                   $cart->quantity = $val[1];
                   $cart->update();
                 $result = true;
                   
                }
                else{
                   return response()->json([
                   'cart_data' =>'Item not found',
                ]);  
                }
                
          }
         
      }
       if($result == true){
              return response()->json([
                    'status' => 200,
                   'cart_data' =>'Item updated',
                ]);  
          }       
    }

    public function delete_cart($id){
           $cart_id = $id;
           $cart = cart::find($id);
           if($cart){
            $cart->delete();
            return response()->json([
                'status' => 200,
            ]);
           }
           else{
            return response()->json([
                'status' => 400,
            ]);
           }

    }

    public function user_details(Request $request){
           $userid = Auth::id();          
           $user =  Auth::user();
           $usermeta =  Usermeta::where('usermeta_id','=',$userid)->get()->first();
           //   dd($usermeta);
           $newmeta =  new Usermeta;
        //dd($request->all());
           // user table update
            $user->name = $request->firstname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            // user meta table update
             if($usermeta){
            $usermeta->country = $request->country;
            $usermeta->state = $request->state;
            $usermeta->zip = $request->zip;
             }
             else {
            $newmeta->country = $request->country;
            $newmeta->state = $request->state;
            $newmeta->zip = $request->zip;
            $newmeta->usermeta_id = $userid;
            }
            if($user->update()){
                if($usermeta){
                $usermeta->update();
                return redirect()->back()->with('status', '200');
                }
                else {
                    $newmeta->save(); 
                    return redirect()->back()->with('status', '200');
                }
            }
            else {
                return redirect()->back()->with('status', '400');
            }

    }
    
    
    
}
