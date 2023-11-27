

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
echo search_product($conn);


function search_product($con)
{
    extract($_POST);
    $qry = $con->query("SELECT product_name,borcode,product_no FROM product  WHERE  product_name LIKE '%$q%'");
    $data = array();
    while ($row = $qry->fetch_assoc()) {
        $data[] = array("label" => $row['product_name'], "id" => $row['product_no'], "borcode" => $row['borcode']);
    }
    return json_encode($data);
}




?>
