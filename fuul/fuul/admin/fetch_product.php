<?php
// Fetch_product.php
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


if (isset($_POST['barcode'])) {
    $barcode = $_POST['barcode'];

    // Replace this query with your actual query to fetch the product name based on the barcode
    $query = "SELECT s.product_name,s.cost,s.price, p.borcode FROM `stock`s, product p WHERE s.product_name=p.product_name and borcode = '$barcode'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $productName = $row['product_name'];
        $costN = $row['cost'];
        $pricen = $row['price'];

        $response = array('success' => true, 'productName' => $productName,'costN' => $costN, 'pricen' => $pricen);
    } else {
        $response = array('success' => false);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}


?>
