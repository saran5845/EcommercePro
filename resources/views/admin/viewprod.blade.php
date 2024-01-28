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
              <h1 class="text-center"> All Product </h1>
               <div class="row">
               	<div class="product-data">
                <table class="table table-dark">
                  <thead>
                    <tr>
                    <th> ID  </th>
                    <th>  Title  </th>
                     <th> Description </th>
                     <th> Image </th>
                     <th> price </th>
                     <th> Edit </th>
                     <th> Delete </th>
                   </tr>
                  </thead>
                  <tbody class="manage-product">
                
                  </tbody> 
                </table>
              </div>

              <div class="modal" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Do you want to delete this Product.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary delete-product-pop" data-dismiss="modal">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
                
            </div>
          </div>
      </div>

        {{--- Edit Product ---}}

      <div class="modal fade" id="EditProduct" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
                    <input type="hidden" id="edit_id" required class="name form-control" value="">
              <form action="{{url('/update-product')}}" method="POST" enctype="multipart/form-data" class="mt-5" style="color:black;" id="update-form">  
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
                           
                  <select required class="selectpicker" id="prod-category" name="category" style="color:black;width: 100%;">
                    <option selected>Select Category </option>
                    @foreach($category as $category)
                     <option value="{{$category->category_name}}">{{$category->category_name}} </option>
                     @endforeach
                  </select>
                </div>

                <div class="form-group">                  
                 <label for="formFileLg" class="form-label">Large file input example</label>
                  <input  class="form-control form-control-lg" name="image" id="formFileLg" type="file" />
                  <img src="">
                </div>

                <div class="form-group">                  
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="submit" class="btn btn-primary update_product" />
                </div> 

              </div>
            </div>
          </form>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_product">Update changes</button>
 -->      </div>
    </div>
  </div>
</div>
      <!-- page-body-wrapper ends -->

    </div>
    </div>
 @include('admin.adminfooter')

                       @else
                       
                        @endauth
                        @endif