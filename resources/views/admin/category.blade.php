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
              <h2 class="text-center"> Add Category  </h2>

              <form action="{{url('/add-category')}}" method="POST"> 
                @csrf
                <div class="form-group text-center mt-5">
                    <input class="input_color" type="text" name="category" placeholder="Add Category Here">
                    <input type="submit" class="btn btn-primary" name="cat-submit" value="Add Category">
                </div>
              </form>

              <div class="category-data">
                <table class="table table-dark">
                  <thead>
                    <tr>
                    <th> ID  </th>
                    <th>  Category Name  </th>
                     <th> Action </th>
                   </tr>
                  </thead>
                  <tbody class="manage-cat">
                
                  </tbody> 
                </table>
              </div>
              <!-- Modal -->
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
                      Do you want to delete this category.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary delete-cat-pop" data-dismiss="modal">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
             <!-- modal end -->
          </div>
      </div>
      <!-- page-body-wrapper ends -->

    </div>
    </div>
 @include('admin.adminfooter')
