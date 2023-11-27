<?php
require  'ajax/config.php';

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('message.php');


$host = "localhost";
$username = "root";
$password = "";
$database = "inventory";

$con = mysqli_connect("$host","$username","$password","$database");

if(!$con)

{
    header("location: ../errors/db.php");
    die();
}

?>


<?php require_once('../config.php'); ?>
<style>
        /* Style for the Autocomplete input field */
.ui-autocomplete-input {
    width: 300px; /* Set the width as desired */
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
}

/* Style for the Autocomplete dropdown menu */
.ui-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 200px; /* Set the maximum height for the dropdown */
    overflow-y: auto;
    border: 1px solid #ccc;
    border-top: none;
    position: absolute;
    background-color: #fff;
    z-index: 1;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
}

/* Style for each item in the dropdown menu */
.ui-menu-item {
    padding: 8px;
    font-size: 16px;
    cursor: pointer;
}

/* Style for the selected item in the dropdown menu */
.ui-state-focus {
    background-color: #007bff;
    color: #fff;
}

        </style>


<?php

$sql = "SELECT MAX(CAST(SUBSTRING(TranID, 1) AS UNSIGNED)) + 1 AS max_id FROM transactions";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['max_id']) {
	$last_id = "T" . sprintf("%04d", $row['max_id']);
} else {
	$last_id = "T0001";
}

$dateTaken = date("Y-m-d");
?>


<?php





if (isset($_POST['save'])) {
    // Assuming $con is your database connection
    $supler = mysqli_real_escape_string($con, $_POST['supler']);
    $invoice = mysqli_real_escape_string($con, $_POST['invoice']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $Date = mysqli_real_escape_string($con, $_POST['Date']);
    $RefNo = mysqli_real_escape_string($con, $_POST['RefNo']);

    // echo "supler: $supler<br>";
    // echo "invoice: $invoice<br>";
    // echo "status: $status<br>";
    // echo "Date: $Date<br>";
    // echo "RefNo: $RefNo<br>";

    $query = "CALL order_pro(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    foreach ($_POST['quantty'] as $index => $quanttys) {
        $s_product_name = mysqli_real_escape_string($con, $_POST['product'][$index]);
        $s_quantity = mysqli_real_escape_string($con, $quanttys);
        $s_cost = mysqli_real_escape_string($con, $_POST['cost_out'][$index]);
        $s_price = mysqli_real_escape_string($con, $_POST['price_in'][$index]);
        $s_barcode = mysqli_real_escape_string($con, $_POST['barcode'][$index]);

        // echo "quantty: $s_product_name<br>";
        // echo "product: $s_quantity<br>";
        // echo "cost_out: $s_cost<br>";
        // echo "price_in: $s_price<br>";
        // echo "barcode: $s_barcode<br>";
        // echo "RefNo: $RefNo<br>";

        $oper_value = 'insert';

        // Assuming $con is your database connection
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'sssssssssss', $supler, $invoice, $s_barcode, $s_product_name, $s_quantity, $s_cost, $s_price, $status, $Date, $RefNo, $oper_value);
        $query_run = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

    // Move the following lines outside the loop
    // $_SESSION['status'] = "Multiple Data Inserted Successfully";
    // header("Location: purchase.php");
    // exit(0);
    
    // The following echo statement will never be executed, so it's safe to remove
    // echo "Data Not Inserted<br>";
    // echo "Error: " . mysqli_error($con) . "<br>";
}




?>
<div class="content-wrapper">

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
			
                    
<div class="card">
	<div class="card-header">
	
			
			
	</div>
	<div class="card-body">
	

			
		<form  method="POST">
			<input type="hidden" name ="id" value="">
			<div class="row">
				<div class="col-md-6 form-group">
				<label for="supplier_id">Supplier</label>
				<select name="supler" id="supler" class="custom-select custom-select-sm rounded-0 select2">
						<option value="" disabled ></option>
						<?php 
							$supplier_qry = $conn->query("SELECT * FROM `supplier` order by `supplier_name` asc");
							while($row = $supplier_qry->fetch_assoc()):
						?>
						<option value="<?php echo $row['supplier_no'] ?>" <?php echo isset($suplier_no) && $suplier_no == $row['supplier_no'] ? 'selected' : '' ?> ><?php echo $row['supplier_name'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-md-6">
				<label for="supplier_id">Invoice Number</label>
				<input type="number" class="form-control form-control-sm rounded-0"  name="invoice" />
				<input type="hidden" name="RefNo" value="<?php echo $last_id; ?>"
                                            class="form-control" value="">
			
				</div>
				<div class="col-md-2">
				

				<input type="hidden" name="Date" value="<?php echo $dateTaken; ?>"
				class="form-control" value="">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="item-list">
					<colgroup>
					<col width="5%">
							<col width="10%">
							<col width="10%">
							<col width="5%">
							<col width="5%">
							<col width="10%">
							<col width="15%">
						</colgroup>
						<thead>
							<tr class="bg-dark disabled">
								<th class="px-1 py-1 text-center"></th>
								<th class="px-1 py-1 text-center">Item</th>
								<th class="px-1 py-1 text-center">Barcode</th>
								<th class="px-1 py-1 text-center">Qty</th>
								<th class="px-1 py-1 text-center">Cost</th>
								<th class="px-1 py-1 text-center">Price</th>
								<th class="px-1 py-1 text-center">Total</th>
							</tr>
						</thead>
						<tbody>
						
							<tr class="po-item" data-id="">
								<td class="align-middle p-1 text-center">
									<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
								</td>
							
								<td class="align-middle p-1">
									<input type="hidden" name="product[]" >
									<input type="text" class="text-center w-100 border-0 product" required/>
								</td>
							
								</td>
								<td class="align-middle p-1 text-center" >
								<input type="Number" class="form-control form-control rounded-0 borcode" name="barcode[]">
								</td>

								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center form-control" step="any" name="quantty[]" />
								</td>
								
								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center form-control" step="any" name="cost_out[]" />
								</td>

								<td class="align-middle p-1">
									<input type="number" step="any" class="text-right form-control" name="price_in[]" />
								</td>
								<td class="align-middle p-1 text-right total-price"></td>
							</tr>
						
						</tbody>
						<tfoot>
							<tr class="bg-lightblue">
								<tr>
									<th class="p-1 text-right" colspan="6"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span> Sub Total</th>
									<th class="p-1 text-right" id="sub_total">0</th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="6">Total</th>
									<th class="p-1 text-right" id="total">0</th>
								</tr>
							</tr>
						</tfoot>
					</table>
					<div class="row">
						<div class="col-md-6">
							<label for="notes" class="control-label">Notes</label>
							<textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0"></textarea>
						</div>
						<div class="col-md-6">
							<label for="status" class="control-label">Status</label>
							<select name="status" id="status" class="form-control form-control-sm rounded-0">
							<option value="0" <?php echo isset($status) && $status == 0 ? 'selected': '' ?>>Pending</option>
								<option value="1" <?php echo isset($status) && $status == 1 ? 'selected': '' ?>>Approved</option>
								<option value="2" <?php echo isset($status) && $status == 2 ? 'selected': '' ?>>Denied</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
		<button type="submit"  class="btn btn-flat btn-primary" name="save" >Save</button>
		<a class="btn btn-flat btn-default" href="?page=purchase_orders">Cancel</a>
	</div>
		</form>
	</div>
	
</div>

<table class="d-none" id="item-clone" >
<tr class="po-item" data-id="">
<td class="align-middle p-1 text-center">
	<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
</td>

<td class="align-middle p-1">
<input type="hidden" name="product[]" >
<input type="text" class="text-center w-100 border-0 product" required/>

</td>
<td class="align-middle p-1 text-center" >
<input type="Number" class="form-control form-control rounded-0 borcode" name="barcode[]">
</td>

<td class="align-middle p-0 text-center">
	<input type="number" class="text-center form-control" step="any" name="quantty[]" />
</td>

<td class="align-middle p-0 text-center">
	<input type="number" class="text-center form-control" step="any" name="cost_out[]" />
</td>

<td class="align-middle p-1">
	<input type="number" step="any" class="text-right form-control" name="price_in[]" />
</td>
<td class="align-middle p-1 text-right total-price">0</td>
</tr>

</table>

</div>

</div>
    
</div> 
<?php include('includes/script.php');?>






<script>
// function _autocomplete(row) {
//     row.find('[name="search[]"]').autocomplete({
//         source: function(request, response) {
//             $.ajax({
//                 url: "search.php",
//                 type: "POST",
//                 dataType: "json",
//                 data: {
//                     product: request.term
//                 },
//                 success: function(data) {
//                     response(data);
//                 }
//             });
//         },
//         minLength: 2,
//         select: function(event, ui) {
//             row.find('[name="search[]"]').val(ui.item.value);
//             row.find('[name="product[]"]').val(ui.item.id);
//             return false;
//         }
//     });
// }


//     </script>


<script>
    $(document).ready(function(){
        // On change event of the select element
        $('#product').change(function(){
            // Get the selected option text
            var selectedProduct = $(this).find(":selected").text();
            
            // Update the content of the td with the class "item-description"
            $('.item-description').text(selectedProduct);
        });
    });
</script>
<script>
	function rem_item(_this){
		if (confirm("mahub taa inaa delete deyso this item ")) {
		_this.closest('tr').remove()
	}
}
	function calculate(){
		var _total = 0
		$('.po-item').each(function(){
			var qty = $(this).find("[name='quantty[]']").val()
			var unit_price = $(this).find("[name='cost_out[]']").val()
			var row_total = 0;
			if(qty > 0 && unit_price > 0){
				row_total = parseFloat(qty) * parseFloat(unit_price)
			}
			$(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'))
		})
		$('.total-price').each(function(){
			var _price = $(this).text()
				_price = _price.replace(/\,/gi,'')
				_total += parseFloat(_price)
		})
		var discount_perc = 0
		if($('[name="discount_percentage"]').val() > 0){
			discount_perc = $('[name="discount_percentage"]').val()
		}
		var discount_amount = _total * (discount_perc/100);
		$('[name="discount_amount"]').val(parseFloat(discount_amount).toLocaleString("en-US"))
		var tax_perc = 0
		if($('[name="tax_percentage"]').val() > 0){
			tax_perc = $('[name="tax_percentage"]').val()
		}
		
		var tax_amount = _total * (tax_perc/100);
		$('[name="tax_amount"]').val(parseFloat(tax_amount).toLocaleString("en-US"))
		$('#sub_total').text(parseFloat(_total).toLocaleString("en-US"))
		$('#total').text(parseFloat(_total-discount_amount).toLocaleString("en-US"))
	}

	function _autocomplete(_item) {
    _item.find('.product').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "search_purchase.php?f=search_product",
                method: 'POST',
                data: { q: request.term },
                dataType: 'json',
                error: function (err) {
                    console.log(err);
                    alert("Error fetching data. Please try again.");
                },
                success: function (resp) {
                    response(resp);
                }
            });
        },
        select: function (event, ui) {
            _item.find('input[name="product[]"]').val(ui.item.label);
            _item.find('input[name="barcode[]"]').val(ui.item.borcode);
        }
    });
}


	$(document).ready(function(){
	
			function initializeRowAutocomplete(row) {
				_autocomplete(row);
				row.find('[name="quantty[]"],[name="cost_out[]"]').on('input keypress', function (e) {
					calculate();
				});
			}

			$('#add_row').click(function () {
				var tr = $('#item-clone tr').clone();
				$('#item-list tbody').append(tr);
				initializeRowAutocomplete(tr);
			});

			if ($('#item-list .po-item').length > 0) {
				$('#item-list .po-item').each(function () {
					var tr = $(this);
					initializeRowAutocomplete(tr);

					tr.find('[name="quantty[]"],[name="cost_out[]"]').trigger('keypress');
				});
			} else {
				$('#add_row').trigger('click');
			}
             

      

        
	})
</script>

<script src="script/purchase.js"></script>

<?php
require('includes/scripts.php');

 include('includes/footer.php');?>