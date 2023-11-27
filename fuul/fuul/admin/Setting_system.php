<?php
// include('authenticion.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
// include('config/dbcon.php');


?>

<div class="content-wrapper">






	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Setting System</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setting</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <?php
                if(isset($_SESSION['status']))
                {
                   echo "<h4>".$_SESSION['status']."</h4>";
                   unset($_SESSION['status']);
                }
              ?>

    <div class="card col-lg-12">
		<div class="card-body">
			<form action="code.php" method="POST"  enctype="multipart/form-data" >
                   <div class="form-group">
                  <label for="">Shop Name</label>
                  <input type="text" name="name" class="form-control" placeholder="name">
                </div>
                    <div class="form-group">
                  <label for="">Shop email</label>
                  <input type="email" name="email" class="form-control" placeholder="name">
                </div>
                     <div class="form-group">
                  <label for="">Shop contact</label>
                  <input type="text" name="contact" class="form-control" placeholder="name">
                </div>
                   <div class="form-group">
                  <label for="">Shop address</label>
                  <input type="text" name="address" class="form-control" placeholder="name">
                </div>
                 <div class="form-group">
                  <label>Images</label>
                  <input type="file" name="images" id="images" class="form-control" required>
                </div> 
               	<div class="form-group">
				<img src="<?php echo isset($meta['cover_img']) ? '../assets/img/'.$meta['cover_img'] :'' ?>" alt="" id="cimg">
				</div>
             <center>
			<button type="submit" name="set" class="btn btn-primary">Save</button>
			</center>
			</form>
		</div>
	</div>
</div>















<?php include('includes/script.php');?>
<script>
		function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	$('.text-jqte').jqte();

</script>
<?php include('includes/footer.php');?>