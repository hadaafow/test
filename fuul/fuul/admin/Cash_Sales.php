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

$sql = "SELECT MAX(CAST(SUBSTRING(sales_no, 1) AS UNSIGNED)) + 1 AS max_id FROM cash_sales";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['max_id']) {
	$last_id = "S" . sprintf("%04d", $row['max_id']);
} else {
	$last_id = "S0001";
}

$dateTaken = date("Y-m-d");
?>


<?php

$sql = "SELECT MAX(CAST(SUBSTRING(TranID, 1) AS UNSIGNED)) + 1 AS max_id FROM transactions";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['max_id']) {
	$ref_id = "T" . sprintf("%04d", $row['max_id']);
} else {
	$ref_id = "T0001";
}

?>


<?php

$query = "SELECT * FROM account where status='1'";
$rs = $conn->query($query);
$num = $rs->num_rows;
$rew = $rs->fetch_assoc();

if($num > 0)
{
    $_SESSION['account_no'] = $rew['account_no']; 
}
    
    ?>




<?php




if (isset($_POST['save'])) {
    // Assuming $con is your database connection
    $selID = mysqli_real_escape_string($con, $_POST['selID']);
  
    $account_no = mysqli_real_escape_string($con, $_POST['account_no']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $Date = mysqli_real_escape_string($con, $_POST['Date']);
    $RefNo = mysqli_real_escape_string($con, $_POST['RefNo']);

    // Add this section to check values
    // echo "supler: $supler<br>";
    // echo "invoice: $invoice<br>";
    // echo "barcode: $barcode<br>";
    // echo "status: $status<br>";
    // echo "Date: $Date<br>";
    // echo "RefNo: $RefNo<br>";

    $query = "CALL sales(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";

    foreach ($_POST['quantity'] as $index => $quanttys) {
        $s_product_name = mysqli_real_escape_string($con, $_POST['product'][$index]);
        $s_quantity = mysqli_real_escape_string($con, $quanttys);
        $s_cost = mysqli_real_escape_string($con, $_POST['cost'][$index]);
        $s_price = mysqli_real_escape_string($con, $_POST['unit_price'][$index]);
        $s_discount = mysqli_real_escape_string($con, $_POST['discount'][$index]);
        $s_barcode = mysqli_real_escape_string($con, $_POST['barcode'][$index]);



      
    
        $oper_value = 'insert';

        // Assuming $con is your database connection
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'ssssssssssss', $selID, $s_barcode, $s_product_name, $s_quantity, $s_price, $s_cost, $s_discount,$account_no, $status, $Date, $RefNo, $oper_value);
        $query_run = mysqli_stmt_execute($stmt);
        

        if ($query_run) {

            // redirect('Cash_Sales.php','successfullt saved');

            // $_SESSION['status'] = "Multiple Data Inserted Successfully";
            // header("Location: purchase.php");
            // exit(0);
            // echo "Data Not Inserted<br>";
            // echo "Error: " . mysqli_error($con) . "<br>";
			echo '<script>window.location.href = "order-summary.php?num=' . $last_id . '";</script>';
        
        }
      
        mysqli_stmt_close($stmt);
    }
}


?>

<div class="content-wrapper">
<section class="content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
             
			
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"> </h3>
		<div id="message"></div>
	</div>
	<div class="card-body">
	<?php
            alertMessage();
            ?>
		<form  method="post">
			<input type="hidden" name ="id" value="">
			<div class="row">
				<input type="hidden" name="selID" value="<?php echo $last_id; ?>" class="form-control" value="">
				
				<input type="Hidden" name="RefNo" value="<?php echo $ref_id; ?>" class="form-control" value="">
			
				
		
				
				<input type="hidden" name="Date" value="<?php echo $dateTaken; ?>"
				class="form-control" value="">

				<input name="account_no" type="hidden" value="<?php echo $_SESSION['account_no'] ?>"
                                            class="form-control shadow-none clas">
		
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="item-list">
					<colgroup>
					<col width="5%">
							<col width="10%">
							<col width="5%">
							<col width="5%">
							<col width="2%">
							<col width="5%">
							<col width="8%">
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
								<th class="px-1 py-1 text-center">discount</th>
								<th class="px-1 py-1 text-center">Total</th>
							</tr>
						</thead>
						<tbody>
						
							<tr class="po-item" data-id="">
								<td class="align-middle p-1 text-center">
									<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
								</td>
							
								<td class="align-middle p-1">
									<input type="hidden" name="product[]" id="productInput">
									<input type="text" class="text-center w-100 border-0 product" />
								</td>
							
								</td>
								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center form-control" step="any" name="barcode[]" id="barcodeInput" />
								</td>
								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center form-control" step="any" name="quantity[]" />
								</td>
								

								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center form-control cost item-cost"  id="CostInput" step="any" name="cost[]" readonly />
								</td>
								

								<td class="align-middle p-1">
									<input type="number" step="any" class="text-right form-control price" id="priceInput" name="unit_price[]" />
								</td>
								<td class="align-middle p-1">
									<input type="number" step="any" class="text-right form-control" value="0"  name="discount[]" />
								</td>

								
								<td class="align-middle p-1 text-right total-price">0</td>
							</tr>
						
						</tbody>
						<tfoot>
							<tr class="bg-lightblue">
								<tr>
									<th class="p-1 text-right" colspan="7"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span> Sub Total</th>
									<th class="p-1 text-right" id="sub_total">0</th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="7">Discount (%)
									<input type="number" step="any" name="discount_percentage" class="border-light text-right" value="<?php echo isset($discount_percentage) ? $discount_percentage : 0 ?>">
									</th>
									<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($discount_amount) ? $discount_amount : 0 ?>" name="discount_amount"></th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="7">Tax Inclusive (%)
									<input type="number" step="any" name="tax_percentage" class="border-light text-right" value="<?php echo isset($tax_percentage) ? $tax_percentage : 0 ?>">
									</th>
									<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>" name="tax_amount"></th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="7">Total</th>
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
								<option value="1" <?php echo isset($status) && $status == 1 ? 'selected': '' ?>>Approved</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
			<a href="register-edit.php?user_id=<?php  echo $last_id;  ?>" class="btn btn-info btn-sm">edit</a>
		<button  type="submit"  class="btn btn-flat btn-primary" name="save" >Save</button>
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
	<input type="hidden" name="product[]" id="productInput">
	<input type="text" class="text-center w-100 border-0 product" />
</td>

</td>
<td class="align-middle p-0 text-center">
	<input type="number" class="text-center form-control" step="any" name="barcode[]" id="barcodeInput" />
</td>
<td class="align-middle p-0 text-center">
	<input type="number" class="text-center form-control" step="any" name="quantity[]" />
</td>


<td class="align-middle p-0 text-center">
	<input type="number" class="text-center form-control cost item-cost"  id="CostInput" step="any" name="cost[]" readonly />
</td>


<td class="align-middle p-1">
	<input type="number" step="any" class="text-right form-control price" id="priceInput" name="unit_price[]" />
</td>
<td class="align-middle p-1">
	<input type="number" step="any" class="text-right form-control" value="0" name="discount[]" />
</td>


<td class="align-middle p-1 text-right total-price">0</td>
</tr>

</table>

</div>
        </div>
</div>
</section>
</div>
         
<?php include('includes/script.php');?>




<script>
$(document).ready(function () {
    // Assuming you have multiple sets of cost and price_in inputs, you can use a common class to target them.
    $('.cost, [name="unit_price[]"]').on('input', function () {
        var cost = parseFloat($('#CostInput').val()) || 0;
        var priceIn = parseFloat($(this).val()) || 0;

        // Check if cost is less than price_in
        if (cost > priceIn) {
			if (confirm("Price ka aad gadeyso kama yaran karo cost aa kaso bixisay!")) {
            $(this).val('');  // Clear the input value
        }
        }
    });
});
</script>




<script>
$(document).ready(function () {
    $('#barcodeInput').on('input', function () {
		event.preventDefault();
        var barcode = $(this).val();

        // Make AJAX request to fetch product name based on barcode
        $.ajax({
            url: 'fetch_product.php', // Replace with the actual path to your PHP script
            method: 'POST',
            data: { barcode: barcode },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#productInput').val(response.productName);
                    $('.product').val(response.productName); 

					$('#CostInput').val(response.costN);
                    $('.cost').val(response.costN); // Optionally, set the value in the visible input

					$('#priceInput').val(response.pricen);
                    $('.price').val(response.pricen); // Optionally, set the value in the visible input
                } else {
                    $('#productInput').val('');
                    $('.product').val('');


					$('#priceInput').val('');
                    $('.price').val('');

					$('#CostInput').val('');
                    $('.cost').val('');
                }
            },
            error: function (err) {
                console.log(err);
                $('#productInput').val('');
                $('.product').val('');

				$('#CostInput').val('');
                $('.cost').val('');

				$('#priceInput').val('');
                $('.price').val('');
            }
        });
    });
});
</script>



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
			var qty = $(this).find("[name='quantity[]']").val()
			var unit_price = $(this).find("[name='unit_price[]']").val()
			// var discoun = $(this).find("[name='discount[]']").val()
			var row_total = 0;
			if(qty > 0 && unit_price > 0 ){
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
                url: "search.php?f=search_items",
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
            _item.find('input[name="cost[]"]').val(ui.item.cost);
            _item.find('input[name="unit_price[]"]').val(ui.item.price);
            // _item.find('.item-cost').text(ui.item.cost);
        }
    });
}


	$(document).ready(function(){
	
			function initializeRowAutocomplete(row) {
				_autocomplete(row);
				row.find('[name="quantity[]"],[name="unit_price[]"]').on('input keypress', function (e) {
					calculate();
				});
				$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
				calculate()
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

					$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
					calculate()
				})
					tr.find('[name="quantity[]"],[name="unit_price[]"]"]').trigger('keypress');
				});
			} else {
				$('#add_row').trigger('click');
			}
             

     

        
	})
</script>


<?php
require('includes/scripts.php');

 include('includes/footer.php');?>