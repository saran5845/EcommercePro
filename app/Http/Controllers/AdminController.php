<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function view_category(){
      
      // if( Auth::user()){   
        $usertype = Auth::user()->usertype;
         // if($usertype == 1){
               return view('admin.category');
         // }
         //  else{
         //    return redirect('/');
         //  }
        
       //}
      //  else{
      //   return redirect('/');
      //  }

    }

    public function fetch_category(){

               $category =category::all();
                return response()->json([
                   'category' =>$category,
                ]);
    }
     

     public function view_ajax_prod(){

            $product =product::all();
                return response()->json([
                   'product' =>$product,
                ]);
     }
     public function view_prod(){

      //   if( Auth::user()){   
      //   $usertype = Auth::user()->usertype;
      //     if($usertype == 1){
             $category = category::all();
               return view('admin.viewprod',compact('category'));
      //     }
      //     else{
      //       return redirect('/');
      //     }
        
      //  }
      //  else{
      //   return redirect('/');
      //  }
    }

     public function delete_category($id){

        $cat_id =  category::find($id);
        
        if($cat_id){
            $cat_id->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student Deleted Successfully.'
            ]);

        }
        else{
            return response()->json([
                'status'=>400,
                'message'=>'Student not find.'
            ]);
        }
    }
    public function add_category(Request $request){
       $data = new Category;

       $data->category_name = $request->category;

       $data->save();

       return redirect()->back()->with('message','Category Added Successfully');
        
    }

    public function add_product(Request $request){
       $data_product = new Product;

       $data_product->title = $request->prod_title;
       $data_product->description = $request->prod_desc;
       $data_product->price = $request->prod_price;
       $data_product->discount_price = $request->prod_sale_price;
       $data_product->quantity = $request->prod_qnty;
       $data_product->category = $request->category;  

       $image = $request->image;
       $image_name = time().'-'.$image->getClientOriginalName();
       $request->image->move('product-image',$image_name);
       $data_product->image = $image_name;     

       $data_product->save();

       return redirect()->back()->with('message','Product Added Successfully');
        
    }

     public function form_product(){
        if( Auth::user()){   
        $usertype = Auth::user()->usertype;
          if($usertype == 1){
               $category = category::all();
               return view('admin.product',compact('category'));
          }
          else{
            return redirect('/');
          }
        
       }
       else{
        return redirect('/');
       }
        
    }

     public function delete_product($id){

        $pro_id =  product::find($id);
        
        if($pro_id){
            $pro_id->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Product Deleted Successfully.'
            ]);

        }
        else{
            return response()->json([
                'status'=>400,
                'message'=>'product not found.'
            ]);
        }
    }

     function edit_product($id){
       
              $product =product::find($id);
               if($product){
                return response()->json([
                  'status'=> 200,
                   'product' =>$product,
                ]);
              }
              else {
                return response()->json([
                  'status'=> 400,
                   'student' =>'is not found',
                ]);

                }
              }

              function update_product(request $request , $id){
                $product = product::find($id);
                   if($product){
                  $product->title = $request->prod_title;
                   $product->description = $request->prod_desc;
                   $product->price = $request->prod_price;
                   $product->discount_price = $request->prod_sale_price;
                   $product->quantity = $request->prod_qnty;
                   $product->category = $request->category; 

                  $image = $request->image;
                  if(!empty($image)){
                   $image_name = time().'-'.$image->getClientOriginalName();
                   $request->image->move('product-image',$image_name);
                   $product->image = $image_name;   
                   }  

                   $product->update();
                    return response()->json([
                'status'=>200,
                'message'=>'product updates Successfully.'
               ]);
                }
                else{
                     return response()->json([
                'status'=>404,
                'message'=>'Erorr'
               ]);

                }
            }



}
