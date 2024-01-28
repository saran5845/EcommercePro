@if (Route::has('login'))
                         @auth

  
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.style')

    <style type="text/css">
      .input_color{
        color: black;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->

         @include('admin.nav')
      <!-- partial -->
      <div class="main-panel">
        @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X </button>
             {{session()->get('message')}}
          </div>

        @endif
          <div class="content-wrapper">
              <h1 class="text-center"> Add Product </h1>

              <form action="{{url('/adds-product')}}" method="POST" enctype="multipart/form-data" class="mt-5" style="color:black;"> 
                @csrf
                <div class="row">
                  <div class="col-md-6">
                 <div class="form-group">                  
                  <input required type="text" class="form-control" id="prd-title" name="prod_title" placeholder="Product Title">
                </div>

                <div class="form-group">                  
                  <textarea style="color: black;" required  type="text" class="form-control" id="prd-des" rows="3 " name="prod_desc" placeholder="Product Description"> </textarea>
                </div>

                <div class="form-group">                  
                  <input required  type="text" class="form-control" id="prd-price" name="prod_price" placeholder="Product Price">
                </div>

                <div class="form-group">                  
                  <input required  required  type="text" class="form-control" id="prdsale-price" name="prod_sale_price" placeholder="Product Sale Price">
                </div>

                <div class="form-group">                  
                  <input required  type="text" class="form-control" id="prd-qnty" name="prod_qnty" placeholder="Product Quantity">
                </div>

                <div class="form-group">     
                           
                  <select required class="selectpicker" name="category" style="color:black;width: 100%;">
                    <option selected>Select Category </option>
                    @foreach($category as $category)
                     <option value="{{$category->category_name}}">{{$category->category_name}} </option>
                     @endforeach
                  </select>
                </div>

                <div class="form-group">                  
                 <label for="formFileLg" class="form-label">Large file input example</label>
                  <input required  class="form-control form-control-lg" name="image" id="formFileLg" type="file" />
                </div>

                <div class="form-group">                  
                  <input class="form-control form-control-lg"  type="submit" name="submit" />
                </div>
              </div>
            </div>
          </form>
          </div>
      </div>

      
      <!-- page-body-wrapper ends -->

    </div>
    </div>
 @include('admin.adminfooter')

                       @else
                       
                        @endauth
                        @endif