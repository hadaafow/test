<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            background-color: #000;
        }

        .padding {
            padding: 2rem !important;
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2;
        }

        h3 {
            font-size: 20px;
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium';
        }

        .text-dark {
            color: #3d405c !important;
        }

        .card-footer-print {
            display: block;
        }

        .table{
            background-color: #000;
        }

        
    </style>
</head>
<body>
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
<div class="card">
    
<?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventory";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_GET['num']))
{

    $num = $_GET['num'];
    $query = "SELECT * from cash_sales where SalesID='$num' LIMIT 1 ";
// $sql = "SELECT MAX(CAST(SUBSTRING(sales_no, 1) AS UNSIGNED)) + 1 AS max_id FROM cash_sales";
$result = $conn->query($query);
$rows = $result->fetch_assoc();


}

$dateTaken = date("Y-m-d");


    // Fetch data from the 'setting' table
    $sql = "SELECT * FROM system_settings";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
<div class="card-header p-4">
<a class="pt-2 d-inline-block" href="index.html" data-abc="true"><?php echo $row['name'] ?></a>
<div class="float-right"> <h3 class="mb-0">Invoice <?php echo $rows ['SalesID'] ?></h3>
Date: <?php echo $dateTaken  ?></div>
</div>

<div class="text-center card-footer-print ">

                <button class="btn btn-primary" id="printButton" onclick="printInvoice()">Print Invoice</button>
            </div>

<div class="card-body">
<div class="row mb-4">
<div class="col-md-6">
<h5 class="mb-3">From:</h5>
<h3 class="text-dark mb-1">Name: <?php echo $row['name'] ?></h3>
<div>Address: <?php echo $row['address'] ?></div>
<div>Phone: <?php echo $row['contant'] ?></div>
<div>Email: <?php echo $row['email'] ?></div>

</div>
<div class="col-md-6 ">
<h5 class="mb-3">To:</h5>
<h3 class="text-dark mb-1">Sales ID: <?php echo $rows['SalesID']  ?></h3>
<div>Customer ID: C0001</div>
<div>Name: CASH CUSTOMER</div>
<div>Sales Date: <?php echo $dateTaken  ?></div>
</div>


</div>
<?php
    } else {
        echo "No data found in the 'setting' table.";
    }
    ?>
<?php
if(isset($_GET['num']))
{
    $i=1;
    $num = $_GET['num'];
    $query = "SELECT * from cash_sales where SalesID='$num' LIMIT 1 ";
    $result = $conn->query($query);
    $rows = $result->fetch_assoc();
    
    // Calculate total amount for the item, including the discount
    $totalAmount = $rows['quantity'] * $rows['UnitPrice'] - $rows['discount'];
    
    // Display the item details
?>

<div class="table-responsive-sm">
    <table class="table table-striped bg-dark">
        <thead class="th">
            <tr>
                <th class="center text-white">#</th>
                <th class="text-white">Item</th>
                <th class="center text-white">Qty</th>
                <th class="right text-white">Price</th>
                <th class="right text-white">Total</th>
            </tr>
        </thead>
        <tbody class="bg-light">
            <tr>
                <td class="center"><?php echo $i ?></td>
                <td class="left strong"><?php echo $rows['product_name'] ?></td>
                <td class="center"><?php echo $rows['quantity'] ?></td>
                <td class="right"><?php echo $rows['UnitPrice'] ?></td>
                <td class="right"><?php echo '$' . number_format($totalAmount, 2) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php
$i++;
}
?>

<div class="row">
    <div class="col-lg-4 col-sm-5">
    </div>
    <div class="col-lg-4 col-sm-5 ml-auto">
        <table class="table table-clear">
            <tbody>
                <tr>
                    <td class="left">
                        <strong class="text-white">Subtotal</strong>
                    </td>
                    <td class="right text-white"><?php echo '$' . number_format($totalAmount, 2) ?></td>
                </tr>
                <!-- Assuming $rows['discount'] is already a percentage -->
                <tr>
                    <td class="left">
                        <strong class="text-white">Discount</strong>
                    </td>
                    <td class="right text-white"><?php echo '$' . number_format($rows['discount'], 2) ?></td>
                </tr>
                <tr>
                    <td class="left">
                        <strong class="text-white">Total</strong>
                    </td>
                    <td class="right">
                        <strong class="text-white"><?php echo '$' . number_format($totalAmount - $rows['discount'], 2) ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>


<div class="card-footer bg-white">
<p class="mb-0">BBBootstrap.com, Sounth Block, New delhi, 110034</p>
</div>
</div>
</div>

<script>
        function printInvoice() {
            // Hide the print button before printing
            document.getElementById('printButton').style.display = 'none';

            // Trigger the browser's print functionality
            window.print();

            // Show the print button after printing
            document.getElementById('printButton').style.display = 'block';
        }
    </script>
</body>
</html>