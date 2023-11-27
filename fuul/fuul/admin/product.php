<?php
require  'ajax/config.php';
// require  '../includes/dbcon.php';
// require  'includes/checklogin.php';
// require  'includes/codeGener.php';
?>

<?php


include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');



?>
<!-- content wrapper con -->
<div class="content-wrapper">







<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   

  
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">register user
                
                </h3>
                <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#add">Add Product</a>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>


                    <th>id</th>
                    <th>product Name</th>
                    <th>borcode</th>
                    <th>order-level</th>
                    <th>minimum-level</th>
                    <th>status</th>
                    <th>date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="product_table">



            </tbody>
        </table>
      </div>

</div>
    
</div>



<div class="modal fade" id="add" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
               <form id="add_product" >
                 <div id="message"></div>
              <div class="modal-body">
                
              <div class="col-md-12">
                <label >product Name</label>
                <input type="text" name="product_name" class="form-control shadow-none" required>

            </div>
            <div class="col-md-12">
                <label>borcode</label>
                <input type="text" name="borcode" class="form-control shadow-none" required>

            </div>
            <div class="col-md-12">
                <label >order-level</label>
                <input type="text" name="order_level" class="form-control shadow-none" required>


            </div>


            <div class="col-md-12">
                <label>minimum-level </label>
                <input type="text" name="minimum_level" class="form-control shadow-none" required>


            </div>              
              </div>
              <div class="modal-footer">
                <button type="submit"  class="btn btn-primary" >Save</button>
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>







<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="update_product" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control shadow-none" required>
                            <input type="hidden" name="product_no" id="product_no">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">borcode</label>
                            <input type="text" name="borcode" id="borcode" class="form-control shadow-none" required>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">order-level</label>
                            <input type="text" name="order_level" id="order_level" class="form-control shadow-none" required>


                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">minimum-level </label>
                            <input type="text" name="minimum_level" id="minimum_level" class="form-control shadow-none" required>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none" onclick="refreshPage()">Submit</button>

                </div>
            </div>
        </form>
    </div>
</div>
</div>
<!-- Bootstrap CSS -->
<link href="path/to/bootstrap.css" rel="stylesheet">

<!-- Bootstrap JS with Popper.js -->
<script src="path/to/popper.min.js"></script>
<script src="path/to/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<script src="script/products.js"></script>

<?php
require('includes/scripts.php');
?>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>