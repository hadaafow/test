<?php
// Establish a database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Call the search_items function
echo search_items($conn);

function search_items($conn)
{
    extract($_POST);
    $qry = $conn->query("SELECT s.product_name,s.cost,s.price, p.borcode,p.product_no,price FROM `stock`s, product p WHERE s.product_name=p.product_name  and s.product_name LIKE '%$q%'");
    $data = array();
    while ($row = $qry->fetch_assoc()) {
        $data[] = array("label" => $row['product_name'], "id" => $row['product_no'], "cost" => $row['cost'],"price" => $row['price']);
    }
    return json_encode($data);
}





?>
