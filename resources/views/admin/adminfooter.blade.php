    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin1/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="admin1/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin1/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin1/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin1/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin1/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin1/assets/images/off-canvas.js"></script>
    <script src="admin1/assets/images/hoverable-collapse.js"></script>
    <script src="admin1/assets/images/misc.js"></script>
    <script src="admin1/assets/images/settings.js"></script>
    <script src="admin1/assets/images/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin1/assets/images/dashboard.js"></script>
    <!-- End custom js for this page -->
    <script>
      jQuery(document).ready(function(){
         // Fetch Categories
        fetchcategory();
        function fetchcategory(){
              $.ajax({
                 type:'GET',
                 url:'/fetch-category',
                  success: function(response){
                           $('.manage-cat').html("");
                            $.each(response.category, function (key, item) {
                         $('.manage-cat').append('<tr>\
                             <td>' + item.id + '</td>\
                             <td>' + item.category_name + '</td>\
                             <td><button type="button" value="' + item.id + '" class="delete-cat btn btn-danger deletebtn btn-sm">Delete</button></td>\
                         \</tr>');
                        });
                        }
                });

        }

          // Fetch Products
        


          jQuery('body').on('click','.delete-cat',function(){
              var cat_id = jQuery(this).attr('value');

               jQuery('#deletemodal').show();
            jQuery('body').on('click','.delete-cat-pop',function(){
         
             	$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                 });  

                $.ajax({
	               type:'DELETE',
	               url:'/delete-cat/'+cat_id,
	               success:function(data) {
	                 console.log(data);
                   jQuery('#deletemodal').hide();
                   fetchcategory(); 
	               }
                });
             
           });
            
          });


// Fetch product

         fetchproducts();
        function fetchproducts(){
              $.ajax({
                 type:'GET',
                 url:'/view-ajax-product',
                  success: function(response){
                          
                           $('.manage-product').html("");
                            $.each(response.product, function (key, item) {
                         $('.manage-product').append('<tr>\
                             <td>' + item.id + '</td>\
                             <td>' + item.title + '</td>\
                             <td>' + item.description + '</td>\
                             <td><img src="/product-image/' + item.image + '" width="50px" height="50px"/></td>\
                             <td>' + item.price + '</td>\
                             <td><button type="button" value="' + item.id + '" class="edit-product btn btn-warning editbtb btn-sm">Edit</button></td>\
                              <td><button type="button" value="' + item.id + '" class="delete-product btn btn-danger deletebtn btn-sm">Delete</button></td>\
                         \</tr>');
                        });
                        }
                });

        }
            
            jQuery('body').on('click','.delete-product',function(){
              var pro_id = jQuery(this).attr('value');
               jQuery('#deletemodal').show();
            jQuery('body').on('click','.delete-product-pop',function(){
         
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                 });  

                $.ajax({
                 type:'DELETE',
                 url:'/delete-product/'+pro_id,
                 success:function(data) {
                   jQuery('#deletemodal').hide();
                   fetchproducts(); 
                 }
                });
              
           });
            
          });


     //  On click edit button
    $(document).on('click', '.edit-product', function (e) {
        e.preventDefault();
        var pro_id = $(this).val();
        $('#EditProduct').modal('show');
        $.ajax({
            type: "GET",
            url: "/edit-product/"+pro_id,
            success: function(response){

                if(response.status == 400){
            alert(response.product.image);
                }
                else{
                    $('.update-image').remove();
                    $('#edit_id').val(response.product.id);
                    $('#prd-title').val(response.product.title);
                    $('#prd-des').val(response.product.description);
                    $('#prd-price').val(response.product.price);
                    $('#prdsale-price').val(response.product.discount_price);
                    $('#prd-qnty').val(response.product.quantity);
                    $('#formFileLg').val(response.product.image);
                    //('#edit_course').val(response.product.category);
                    var img = response.product.image;
                    $('#formFileLg').after('<div class="update-image"><img src="/product-image/'+ img+'"></div>');
                }
            }
        })

    });

        $('#update-form').on('submit', function (e) {
        e.preventDefault();
        
        var id = $('#edit_id').val();
         var formData = new FormData(this);   
        var data_update = {
                'id': $('#edit_id').val(),   
                'title': $('#prd-title').val(),
                'description': $('#prd-des').val(),
                //'image': $('#formFileLg').prop('files')[0],
                'category': $('#prod-category').find(':selected').val(),
                'quantity': $('#prd-qnty').val(),
                'price': $('#prd-price').val(),
                'discount_price': $('#prdsale-price').val(),
            }
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
             type: "post",
             url: "/update-product/"+id,
             data: formData,
             datatype: "json",
             contentType: false,
             cache: false,
             processData: false,
             success: function(response){
                if(response.status == 200){
                $('#EditProduct').modal('hide');
                fetchproducts();
               }
               else {
                console.log(response);
               }
             }

         });

      });
         });
    </script>
  </body>
</html>